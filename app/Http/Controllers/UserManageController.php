<?php

namespace App\Http\Controllers;

use App\Http\Requests\editUserValidate;
use App\Mail\InvitationMail;
use App\Models\User;
use App\Notifications\NewNotification;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserManageController extends Controller
{
    public function __construct(private UserRepository $userRepository, private MessageController $messageController)
    {
    }

    public function index(Request $request)
    {
        $search = $request->get('search', null);
        $users = $this->userRepository->index($search);
        return view('document.view_user', compact('users', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'invited_by' => 'required|exists:users,id',
            'role' => 'required|in:0,1', // 0 = Professional, 1 = Customer
        ]);

        $url = route('register');
        Mail::to($request->email)->send(new InvitationMail($url));

        $role = $request->input('role');
        if ($role == 0) {
            $request->validate([
                'professional_type' => 'string|in:Solicitor,Professional',
            ]);
        }

        $data = $request->only(['email', 'invited_by']);
        $data['professional_type'] = $role == 0 ? $request->input('professional_type') : null;
        $user = $this->userRepository->inviteUser($data);

        if ($user) {
            $message = $role == 0
            ? 'Invition Link successfully as a professional.'
            : 'Invition Link successfully as a customer.';
            event(new Registered($user));

            if (auth()->user()) {
                auth()->user()->notify(new NewNotification($message));
            }
            return $this->messageController->sendResponse($user, $message);
        }

    }

    public function destroy($id)
    {
        if (!$id) {
            return redirect()->back()->with('error', 'User ID is missing.');
        }

        if (auth()->user()) {
            $deletedUser = $this->userRepository->deleteUser($id);
            $responseMessage = $deletedUser ? 'User Delete SuccessFully !' : 'User Not Deleted';
            auth()->user()->notify(new NewNotification($responseMessage));
        }
        return $this->messageController->sendResponse($deletedUser, $responseMessage);
    }

    // Soft delete method


    public function deleteuser($id)
    {
        $deletedUser = $this->userRepository->deleteUser($id);
        $responseMessage = $deletedUser ? 'User deleted successfully!' : 'User could not be deleted.';

        if (auth()->check()) {
            auth()->user()->notify(new NewNotification($responseMessage));
        }

        return redirect()->route('login');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('document.edit_user', compact('user'));
    }

    public function update(editUserValidate $request, $id)
    {

        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user = $this->userRepository->updateUser($id, $data);
        auth()->user()->notify(new NewNotification("User Updated SuccessFully !", $user));
        return redirect()->route('user-manage.index');
    }

    public function show()
    {

    }

}
