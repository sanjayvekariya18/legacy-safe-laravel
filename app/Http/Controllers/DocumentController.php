<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChatBroadCastRequest;
use App\Models\User;
use App\Notifications\NewNotification;
use App\Repositories\documentRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct(private DocumentRepository $documentRepository, private UserRepository $userRepository, private MessageController $messageController)
    {
    }

    public function index(Request $request)
    {

        $search = $request->input('search');
        $documents = $this->documentRepository->index($search);
        return view('document.document', compact('documents'));
    }

    public function create()
    {

    }

    public function show($id)
    {
        $documents = $this->documentRepository->show($id);
        $usersPermission = $this->documentRepository->getUserData($id);
        $chats = $this->documentRepository->chatView($id);

        return view('document.document_view', compact('documents', 'usersPermission', 'chats'));
    }

    public function store(ChatBroadCastRequest $request)
    {
        try {
            $chat = $this->documentRepository->store($request->validated());
            broadcast(new PusherBroadcast($chat))->toOthers();

            if (auth()->check()) {
                $message = 'New chat message sent!';
                auth()->user()->notify(new NewNotification($message));
                return response()->json(['success' => true, 'message' => $message, 'data' => $chat]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'to_be_notified' => 'required|boolean',
            'to_be_visible' => 'required|boolean',
        ]);

        try {
            $permissionUpdate = $this->documentRepository->update($id, $validatedData);
            $responseMessage = $permissionUpdate ? 'Permission Edit Success Fully !' : 'Permission not update.';

            if ($permissionUpdate) {
                auth()->user()->notify(new NewNotification($responseMessage));
            }
            return $this->messageController->sendResponse($permissionUpdate, $responseMessage);
        } catch (\Exception $e) {
            return $this->messageController->sendResponse(false, 'An error occurred: ' . $e->getMessage());
        }
    }





    public function destroy($userId)
{
    $authUserId = auth()->id();

    $deleted = app(DocumentRepository::class)->deleteUser($userId, $authUserId);

    $responseMessage = $deleted
        ? 'User deleted successfully!'
        : 'Invitation not found or unauthorized action.';

    // Notify the user
    auth()->user()->notify(new NewNotification($responseMessage));

    return redirect()->back()->with('success', $responseMessage);
}







    public function fileDelete($id)
    {
        try {
            $result = $this->documentRepository->deleteDocument($id);
            $responseMessage = $result['status'] ? 'File Deleted Successfully!' : 'File Not Deleted.';
            if ($result['status']) {
                auth()->user()->notify(new NewNotification($responseMessage));
            }
            return response()->json(['status' => $result['status'], 'message' => $responseMessage]);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => 'An error occurred while deleting the file.']);
        }
    }




    public function yesNotificationPermissionShow(Request $request)
    {
        $users = User::select('users.id', 'users.to_be_notified', 'users.to_be_visible')
            ->join('shared_with_users', 'shared_with_users.user_id', '=', 'users.id')
            ->where('shared_with_users.invited_id', auth()->id())
            ->where(function ($query) {
                $query->where('shared_with_users.to_be_notified', '0')
                    ->orWhere('shared_with_users.to_be_visible', '0');
            })
            ->get();

        if ($users->isNotEmpty()) {
            return response()->json(['success' => 'Yes Notifications sent successfully to eligible users.']);
        } else {
            return response()->json(['error' => 'Permission Off because Not Permission Yes!'], 422);
        }
    }

}
