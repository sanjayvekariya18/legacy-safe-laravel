<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChatBroadCastRequest;
use App\Models\SharedWithUser;
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
        return view('document.document', compact('documents', 'search'));
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

        $permission = SharedWithUser::find($id);
        $data = $request->only(['to_be_notified', 'to_be_visible']);

        $permission->update($data);
        return response()->json(['success' => 'Status changed successfully!']);
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
        dd($request)->all();
        $request = SharedWithUser::select('to_be_notified', 'to_be_visible')
            ->where('to_be_notified', '1')
            ->where('to_be_visible', '1')
            ->get();

        return $request;
    }

}
