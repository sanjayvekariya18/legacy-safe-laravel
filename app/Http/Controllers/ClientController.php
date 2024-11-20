<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
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
        $this->breadcrumbs->add('Clients', route('clients.index'));

        // Get the search query from the request
        $search = $request->input('search');

        $clients = Document::select('documents.user_id', 'users.first_name', 'users.last_name', DB::raw('COUNT(documents.id) as document_count'))
            ->join('users', 'documents.user_id', '=', 'users.id')
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('shared_with_users')
                    ->whereColumn('documents.id', 'shared_with_users.document_id')
                    ->where('shared_with_users.user_id', Auth::id())
                    ->whereNull('shared_with_users.deleted_at'); // Ensure only active shares
            })
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->whereRaw("CONCAT(users.first_name, ' ', users.last_name) LIKE ?", ["%{$search}%"])
                        ->orWhere('users.first_name', 'like', "%{$search}%")
                        ->orWhere('users.last_name', 'like', "%{$search}%");
                });
            })
            ->groupBy('documents.user_id', 'users.first_name', 'users.last_name')
            ->paginate(50);

        return view('clients.index', [
            'clients' => $clients,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function documents(Request $request, int $clientId)
    {
        $user = User::findOrFail($clientId);
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Clients', route('clients.index'));
        $this->breadcrumbs->add("Client Files", "#");

        // Get the search query from the request
        $search = $request->input('search');

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
            ->where('user_id', $user->id) // Filter by document owner ID if provided
            ->paginate(50);

        return view('clients.documents', [
            'user' => $user,
            'documents' => $documents,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Clients', route('clients.index'));
        $this->breadcrumbs->add("Client Files", "#");

        return view('clients.show', [
            'document' => $document,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }
}
