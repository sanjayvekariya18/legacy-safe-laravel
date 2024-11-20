<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteUserRequest;
use App\Mail\InviteEmail;
use App\Models\Invite;
use App\Models\SharedWithUser;
use App\Models\User;
use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SharedUserController extends Controller
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
        $this->breadcrumbs->add('Users', route('shared.users.index'));

        // Get the search query from the request
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            // Search in first name and last name combined
            return $query->where(function ($query) use ($search) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%");
            });
        })
            ->where('invited_by', Auth::id()) // Add condition to check invited_by
            ->paginate(10); // Paginate the results

        return view('shared-users.index', [
            'breadcrumbs' => $this->breadcrumbs->get(),
            'users' => $users,
        ]);
    }

    public function sendInvite(InviteUserRequest $request)
    {
        DB::beginTransaction();
        // Generate a unique token
        $token = Str::random(32);

        // Optionally set the professional type (this can be null or a value based on your logic)
        $professionalType = $request->professional_type; // Can be null

        // Create the invite record
        Invite::create([
            'invited_by' => Auth::id(), // Get the current logged-in user (Client)
            'email' => $request->email,
            'token' => $token,
            'professional_type' => $professionalType,
            'role' => $request->role,
        ]);

        // Send the invite email
        $inviteLink = route('register') . '?token=' . $token;

        Mail::to($request->email)->send(new InviteEmail($inviteLink));  // InviteEmail is a mailable class

        DB::commit();
        return redirect()->route('shared.users.index')->with('success', 'Invite sent successfully!');
    }

    public function removeDocumentAccess(User $user) {
        $owner = Auth::user();
        $documentIds = $owner->documents->pluck('id')->toarray();
        DB::beginTransaction();
        SharedWithUser::whereIn('document_id', $documentIds)
            ->where('user_id', $user->id)
            ->delete();
        User::where('id', $user->id)->update(['invited_by' => NULL]);
        DB::commit();
        return redirect()->route('shared.users.index')->with('success', 'Invite user removed!');
    }
}
