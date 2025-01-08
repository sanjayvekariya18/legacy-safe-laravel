<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\BreadcrumbsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SharedDocumentController extends Controller
{
    protected $breadcrumbs;

    public function __construct(BreadcrumbsService $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Documents to review', route('shared.documents.index'));

        // Get the search query from the request
        $search = $request->input('search');
        $clientId = $request->input('client_id');

        // Retrieve documents that are shared with this professional user
        $documents = Document::
            whereHas('sharedWithUsers', function ($query) {
                // Check if the user has access to the document
                $query->where('user_id', Auth::id());
            })
            // Filter the documents by name or document owner name if the search term is provided
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($query) use ($search) {
                        $query->where('first_name', 'like', '%' . $search . '%')
                            ->orWhere('last_name', 'like', '%' . $search . '%');
                    })
                    ->orWhere(function ($query) use ($search) {
                        if (preg_match('/^\d{2}-\d{2}-\d{4}$/', $search)) {
                            // Check if search term is a valid date in DD-MM-YYYY format
                            $date = Carbon::createFromFormat('d-m-Y', $search)->format('Y-m-d');
                            $query->whereDate('updated_at', $date); // Filter by created_at
                        }
                    });
            })
            // Filter by document owner ID if provided
            ->when($clientId, function ($query) use ($clientId) {
                return $query->where('user_id', $clientId);
            })
            ->paginate(50);


        return view('shared-documents.index', [
            'breadcrumbs' => $this->breadcrumbs->get(),
            'documents' => $documents,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Documents', route('shared.documents.index'));
        $this->breadcrumbs->add($document->name, route('shared.documents.show', $document));

        return view('shared-documents.show', [
            'document' => $document,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    public function viewSharedDocument(Document $document)
    {
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
}
