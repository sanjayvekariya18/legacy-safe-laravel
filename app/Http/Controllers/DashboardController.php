<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $breadcrumbs;

    public function __construct(BreadcrumbsService $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));

        $user = Auth::user();
        $documents = [];
        if ($user->hasRole(User::ROLE_CLIENT)) {
            // Fetch user's own documents
            $ownDocuments = Document::where('user_id', $user->id);

            // Fetch documents shared with the user
            $sharedDocuments = Document::whereHas('sharedWithUsers', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->whereNull('deleted_at'); // Exclude soft-deleted rows
            });

             // Combine and take latest 3
            $documents = $ownDocuments->union($sharedDocuments)->latest()->take(3)->get();

            // $documents = Document::where('user_id', $user->id)->latest()->take(3)->get();

        } else if ($user->hasRole(User::ROLE_PROFESSIONAL)) {
            $documents = Document::whereHas('sharedWithUsers', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->whereNull('deleted_at'); // Exclude soft-deleted rows
            })->latest()->take(3)->get();
        }

        return view('dashboard', [
            'documents' => $documents,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }
}
