<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            // Filter the documents by name if the search term is provided
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
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
}
