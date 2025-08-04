<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocumentRequest;
use App\Services\FileUploadService;
use App\Notifications\DocumentNotification;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use App\Services\BreadcrumbsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;
    protected $breadcrumbs;
    protected $fileUploadService;

    public function __construct(BreadcrumbsService $breadcrumbs, FileUploadService $fileUploadService)
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('subscribed', only: ['store', 'create']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Documents', route('documents.index'));

        // Get the search query from the request
        $search = $request->input('search');

        $documents = Document::
            where(function ($query) {
                $query->where('user_id', Auth::id()) // Fetch user's own documents
                    ->orWhereHas('sharedWithUsers', function ($subQuery) {
                        $subQuery->where('user_id', Auth::id()); // Fetch documents shared with the user
                    });
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%");
                });
            })
            ->orderBy('created_at', 'desc') // Sort results by latest
            ->paginate(50); // Adjust pagination limit as needed

        return view('documents.index', [
            'breadcrumbs' => $this->breadcrumbs->get(),
            'documents' => $documents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('File Manager', route('documents.create'));
        return view('documents.create', [
            'breadcrumbs' => $this->breadcrumbs->get(),
            'invitees' => Auth::user()->invitees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {
        $uploadedFilePath = $request->input('uploadedFilePath');
        // Generate the relative path (UUID + file extension)
        $fileName = sprintf(
            "%s.%s",
            Str::uuid()->toString(),
            pathinfo($uploadedFilePath, PATHINFO_EXTENSION)
        );
        $relativePath = sprintf("%s/%s", Auth::id(), basename($fileName));

        DB::beginTransaction();

        // Move the file from local storage to S3
        if (Storage::disk('local')->exists($uploadedFilePath)) {
            try {
                // Copy the file to S3
                Storage::disk('s3')->put($relativePath, Storage::disk('local')->get($uploadedFilePath));
                // Delete the local version after copying
                Storage::disk('local')->delete($uploadedFilePath);

                // Save the document details to the database
                $document = new Document();
                $document->user_id = Auth::id();
                $document->name = $request->input('name');
                $document->url = $relativePath; // Generate a URL for the S3 file
                $document->save();

                // Attach shared users
                $invitees = $request->input('invitees'); // Array of user IDs
                foreach ($invitees as $inviteeId) {
                    $document->sharedWithUsers()->create([
                        'user_id' => $inviteeId, // Add each user ID to the sharedWithUsers table
                    ]);
                    $recipient = User::find($inviteeId);
                    $recipient->notify(new DocumentNotification(
                        "Added you as a user to {$document->name}",
                        $document->id,
                    ));
                    $recipient->notify(new DocumentNotification(
                        "{$document->user->name} Uploaded {$document->name}",
                        $document->id,
                    ));
                }
                activity()
                    ->causedBy(Auth::user())
                    ->performedOn($document)
                    ->log('New document created');
                DB::commit();
                // Redirect to the documents index page with a success message
                return redirect()->route('documents.index')->with('success', 'Document saved and file moved to S3 successfully!');
            } catch (\Throwable $th) {
                DB::rollBack();
                // Log the error for debugging
                Log::error('Error storing document: ' . $th->getMessage());

                // Redirect back with an error message
                return redirect()->back()->with('error', 'An error occurred while storing the document.');
            }
        } else {
            DB::rollBack();
            // Redirect back with an error message if the file is not found
            return redirect()->back()->with('error', 'Uploaded document not found.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        // Custom authorization for this method
        $this->authorize('show', $document);
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Documents', route('documents.index'));
        $this->breadcrumbs->add($document->name, route('documents.show', $document));

        return view('documents.show', [
            'document' => $document,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function uploadDocument(Request $request)
    {
        try {
            // Validate the file input
            $request->validate([
                'document' => 'required|file|mimes:pdf,doc,docx,csv,xls'
            ]);

            // Get the authenticated user's ID
            $userId = Auth::id();

            // Store the file
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $response = $this->fileUploadService->uploadFile($file, "uploads/{$userId}");
                return response()->json(['message' => 'File uploaded successfully!', 'filePath' => $response['path']]);
            }

            return response()->json(['message' => 'File upload failed.'], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors() // JSON object of validation errors
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => [
                    'document' => [
                        $e->getMessage()
                    ]
                ]
            ], 422);
        }

    }

    public function viewDocument(Document $document)
    {
        // Custom authorization for this method
        $this->authorize('show', $document);
        try {
            $fileName = sprintf(
                "%s.%s",
                $document->name,
                pathinfo($document->url, PATHINFO_EXTENSION)
            );
            // Check if the file exists in the S3 bucket
            if (!Storage::disk('s3')->exists($document->url)) {
                return redirect()->back()->with('error', 'Document not found on S3.');
            }
            // Return the document as a downloadable response
            return Storage::disk('s3')->download($document->url, $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function removeDocument(Document $document)
    {
        // Custom authorization for this method
        $this->authorize('removeDocument', $document);
        try {
            // Start a database transaction to ensure data integrity
            DB::beginTransaction();

            // Get the relative path from the database
            $relativePath = $document->url;

            // Check if the file exists on S3
            if (Storage::disk('s3')->exists($relativePath)) {
                // Delete the file from S3
                Storage::disk('s3')->delete($relativePath);

                // Delete related entries from the shared_with_users table
                $document->sharedWithUsers()->delete();

                // Optionally, remove the document record from the database
                $document->delete();

                // Commit the transaction
                DB::commit();

                // Redirect to the documents index page with a success message
                return redirect()->route('documents.index')->with('success', 'Document removed successfully.');
            }
            // Rollback if file not found on S3
            DB::rollBack();
            return redirect()->back()->with('error', 'Document not found on S3.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

}
