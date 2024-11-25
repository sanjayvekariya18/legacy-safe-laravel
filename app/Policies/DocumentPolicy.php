<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\SharedWithUser;
use App\Models\User;

class DocumentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function show(User $user, Document $document)
    {
       // Check if the user is the document owner or if the user is shared the document
       return $document->user_id === $user->id || SharedWithUser::where('user_id', $user->id)
       ->where('document_id', $document->id)
       ->exists();
    }

    public function removeDocument(User $user, Document $document)
    {
        // Only the document owner can remove it
        return $user->id === $document->user_id;
    }
}
