<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AuditUploadedFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'security:audit-files {--fix : Fix security issues automatically}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Audit uploaded files for security issues';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('🔍 Starting File Security Audit...');

        $issues = [];
        $suspiciousFiles = [];

        // Check storage directories
        $directories = User::pluck('id');

        foreach ($directories as $directory) {
            $directory = 'uploads/' . $directory;

            if (Storage::disk('local')->exists($directory)) {
                $this->info("Checking directory: {$directory}");
                $files = Storage::disk('local')->files($directory);

                foreach ($files as $file) {
                    $issues = array_merge($issues, $this->checkFile($file));

                    if ($this->isSuspiciousFile($file)) {
                        $suspiciousFiles[] = $file;
                    }
                }
            }
        }

        // Report findings
        if (!empty($issues)) {
            $this->error('🚨 Security issues found:');
            foreach ($issues as $issue) {
                $this->error("- {$issue}");
            }
        }

        if (!empty($suspiciousFiles)) {
            $this->warn('⚠️  Suspicious files found:');
            foreach ($suspiciousFiles as $file) {
                $this->warn("- {$file}");
            }
        }

        if (empty($issues) && empty($suspiciousFiles)) {
            $this->info('✅ No security issues found in uploaded files.');
        }

        // Fix issues if requested
        if ($this->option('fix') && !empty($suspiciousFiles)) {
            $this->fixSuspiciousFiles($suspiciousFiles);
        }

        return 0;
    }

    /**
     * Check individual file for security issues
     *
     * @param string $filePath
     * @return array
     */
    private function checkFile($filePath)
    {
        $issues = [];

        // Check file extension
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $dangerousExtensions = ['php', 'php3', 'php4', 'php5', 'phtml', 'pl', 'py', 'jsp', 'asp', 'sh', 'cgi'];

        if (in_array(strtolower($extension), $dangerousExtensions)) {
            $issues[] = "Dangerous file extension: {$filePath}";
        }

        // Check file size
        $size = Storage::disk('local')->size($filePath);
        if ($size > 10485760) { // 10MB
            $issues[] = "Large file size: {$filePath} ({$size} bytes)";
        }

        return $issues;
    }

    /**
     * Check if file is suspicious
     *
     * @param string $filePath
     * @return bool
     */
    private function isSuspiciousFile($filePath)
    {
        $suspiciousPatterns = [
            '/shell\.php$/i',
            '/backdoor\.php$/i',
            '/cmd\.php$/i',
            '/eval\.php$/i',
            '/exec\.php$/i'
        ];

        foreach ($suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $filePath)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Fix suspicious files
     *
     * @param array $suspiciousFiles
     */
    private function fixSuspiciousFiles($suspiciousFiles)
    {
        $this->info('🔧 Fixing suspicious files...');

        foreach ($suspiciousFiles as $file) {
            try {
                // Move to quarantine directory
                $quarantinePath = 'quarantine/' . basename($file) . '_' . time();
                Storage::disk('local')->move($file, $quarantinePath);

                $this->info("Moved suspicious file to quarantine: {$file}");

                Log::channel('security')->warning('Suspicious file quarantined', [
                    'original_path' => $file,
                    'quarantine_path' => $quarantinePath,
                    'timestamp' => now()
                ]);

            } catch (\Exception $e) {
                $this->error("Failed to quarantine file {$file}: {$e->getMessage()}");
            }
        }
    }
}
