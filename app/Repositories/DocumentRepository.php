<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Models\User;
use App\Models\Document;
use App\Models\SharedWithUser;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class DocumentRepository
{

    // public function index($search = null)
    // {
    //     return Document::query()
    //         ->with(['User', 'SharedWithUser'])
    //         ->when($search, function (Builder $query) use ($search) {
    //             $query->where('name', 'LIKE', '%' . $search . '%')
    //                 ->orWhereHas('User', function ($query) use ($search) {
    //                     $query->where('first_name', 'LIKE', '%' . $search . '%')
    //                         ->orWhere('last_name', 'LIKE', '%' . $search . '%');
    //                 });
    //         })
    //         ->orderBy('updated_at', 'desc')
    //         ->paginate(5);
    // }

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
        return User::select(
            'users.id',
            'users.first_name',
            'users.company_name',
            'users.professional_type',
            'shared_with_users.id as shared_id',
            'shared_with_users.to_be_notified',
            'shared_with_users.to_be_visible'
        )
            ->join('shared_with_users', 'shared_with_users.user_id', '=', 'users.id')
            ->where('users.invited_by', $authId)
            ->get()

            ->map(function ($item) {

                $item->to_be_notify = ($item->to_be_notified === 'yes') ? 0 : 1;
                $item->to_be_visible = ($item->to_be_visible === 'yes') ? 0 : 1;

                return $item;
            });
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


    public function update($id, array $data)
    {
        try {
            $permission = SharedWithUser::findOrFail($id);
            $permission->update($data);
            return $permission;
        } catch (\Exception $e) {
            return false;
        }
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
