<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FileUploadService
{
    /**
     * Allowed file types and their MIME types
     */
    private const ALLOWED_TYPES = [
        'image' => [
            'jpg', 'jpeg', 'png', 'gif', 'webp',
            'image/jpeg', 'image/png', 'image/gif', 'image/webp'
        ],
        'document' => [
            'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt',
            'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain'
        ],
        'readable_files' => [
            'jpg', 'jpeg', 'png', 'gif', 'webp',
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'pdf', 'application/pdf'
        ],
    ];

    /**
     * Maximum file size in bytes (10MB)
     */
    private const MAX_FILE_SIZE = 10485760;

    /**
     * Upload a file securely
     *
     * @param UploadedFile $file
     * @param string $directory
     * @param array $options
     * @return array
     * @throws \Exception
     */
    public function uploadFile(UploadedFile $file, string $directory = 'uploads', array $options = [])
    {
        try {
            // Validate file
            $this->validateFile($file);

            // Generate secure filename
            $secureFilename = $this->generateSecureFilename($file);

            // Store file
            $path = $file->storeAs($directory, $secureFilename, 'local');

            // Log upload for security audit
            $this->logFileUpload($file, $path);

            return [
                'success' => true,
                'path' => $path,
                'filename' => $secureFilename,
                'original_name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType()
            ];

        } catch (\Exception $e) {
            Log::error('File upload failed', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
                'user_id' => auth()->id(),
                'ip' => request()->ip()
            ]);

            throw $e;
        }
    }

    /**
     * Validate uploaded file
     *
     * @param UploadedFile $file
     * @throws \Exception
     */
    private function validateFile(UploadedFile $file)
    {
        // Check file size
        if ($file->getSize() > self::MAX_FILE_SIZE) {
            throw new \Exception('File size exceeds maximum allowed size of 10MB.');
        }

        // Check file extension
        $extension = strtolower($file->getClientOriginalExtension());
        $allowedExtensions = array_merge(
            self::ALLOWED_TYPES['image'],
            self::ALLOWED_TYPES['document'],
        );

        if (!in_array($extension, $allowedExtensions)) {
            throw new \Exception('File type not allowed for security reasons.');
        }

        // Check MIME type
        $mimeType = $file->getMimeType();
        $allowedMimeTypes = array_merge(
            self::ALLOWED_TYPES['image'],
            self::ALLOWED_TYPES['document'],
        );

        if (!in_array($mimeType, $allowedMimeTypes)) {
            throw new \Exception('File MIME type not allowed for security reasons.');
        }

        // Additional security checks
        $this->performSecurityChecks($file);
    }

    /**
     * Perform additional security checks
     *
     * @param UploadedFile $file
     * @throws \Exception
     */
    private function performSecurityChecks(UploadedFile $file)
    {
        // Check for PHP code in file content
        $content = file_get_contents($file->getRealPath());

        $mimeType = $file->getMimeType();

        // Check for PHP tags
        if (preg_match('/<\?php|<\?=|<\?/i', $content) && in_array($mimeType, self::ALLOWED_TYPES['readable_files'])) {
            throw new \Exception('File contains PHP code and is not allowed.');
        }

        // Check for executable content
        $executablePatterns = [
            '/eval\s*\(/i',
            '/exec\s*\(/i',
            '/system\s*\(/i',
            '/shell_exec\s*\(/i',
            '/passthru\s*\(/i'
        ];

        foreach ($executablePatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                throw new \Exception('File contains potentially dangerous code.');
            }
        }
    }

    /**
     * Generate secure filename
     *
     * @param UploadedFile $file
     * @return string
     */
    private function generateSecureFilename(UploadedFile $file)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $timestamp = time();
        $randomString = Str::random(16);

        return "file_{$timestamp}_{$randomString}.{$extension}";
    }

    /**
     * Log file upload for security audit
     *
     * @param UploadedFile $file
     * @param string $path
     */
    private function logFileUpload(UploadedFile $file, string $path)
    {
        Log::channel('security')->info('File uploaded', [
            'user_id' => auth()->id(),
            'original_name' => $file->getClientOriginalName(),
            'stored_path' => $path,
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'timestamp' => now()
        ]);
    }

    /**
     * Delete file securely
     *
     * @param string $path
     * @return bool
     */
    public function deleteFile(string $path)
    {
        try {
            if (Storage::disk('local')->exists($path)) {
                Storage::disk('local')->delete($path);

                Log::channel('security')->info('File deleted', [
                    'user_id' => auth()->id(),
                    'path' => $path,
                    'ip' => request()->ip(),
                    'timestamp' => now()
                ]);

                return true;
            }
            return false;
        } catch (\Exception $e) {
            Log::error('File deletion failed', [
                'error' => $e->getMessage(),
                'path' => $path,
                'user_id' => auth()->id()
            ]);
            return false;
        }
    }

    /**
     * Get allowed file types
     *
     * @return array
     */
    public static function getAllowedTypes()
    {
        return self::ALLOWED_TYPES;
    }

    /**
     * Get maximum file size
     *
     * @return int
     */
    public static function getMaxFileSize()
    {
        return self::MAX_FILE_SIZE;
    }
}
