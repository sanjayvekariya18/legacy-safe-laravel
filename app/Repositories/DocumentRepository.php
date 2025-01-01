<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DocumentRepository
{

    public function index($search = null, $invitedBy = null)
    {
        return Document::query()
            ->with(['User', 'SharedWithUser'])
            ->when($search, function (Builder $query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('User', function ($query) use ($search) {
                        $query->where('first_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('last_name', 'LIKE', '%' . $search . '%');
                    });
            })
            ->when($invitedBy, function (Builder $query) use ($invitedBy) {
                $query->whereHas('User', function ($query) use ($invitedBy) {
                    $query->where('invited_by', $invitedBy);
                });
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
    }

    public function show($id)
    {
        return Document::with([
            'User' => function ($query) {
                $query->where('invited_by', auth()->id());
            },
            'SharedWithUser' => function ($query) {
                $query->where('invited_by', auth()->id());
            },
        ])->findOrFail($id);
    }

    public function store(array $data)
    {
        $data['user_id'] = Auth::id();

        if (isset($data['file']) && $data['file']->isValid()) {
            $data['file'] = $data['file']->store('chat_files', 'public');
        }

        return Chat::create($data);
    }

    public function getUserData($id)
    {
        $authId = auth()->id();
        return User::with(['SharedWithUser' , 'roles'])
            ->where('invited_by', $authId)
            ->get();
    }

    public function chatView($id)
    {
        $authId = auth()->id();

        return Chat::where('document_id', $id)
            ->whereHas('User', function ($query) use ($authId) {
                $query->where('invited_by', $authId);
            })
            ->with('User')
            ->get();
    }

    public function deleteDocument($id)
    {
        try {
            $document = Document::find($id);
            if (!$document) {
                return ['status' => false, 'message' => 'Document not found.'];
            }
            $document->delete();

            return ['status' => true, 'message' => 'Document deleted successfully.'];
        } catch (\Exception $e) {
            Log::error("Error deleting document with ID {$id}: {$e->getMessage()}");
            return ['status' => false, 'message' => 'An error occurred while deleting the document.'];
        }
    }

    public function deleteUser($userId, $authUserId)
    {
        $user = User::where('id', $userId)
            ->where('invited_by', $authUserId)
            ->first();

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
