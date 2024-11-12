<?php

namespace App\Policies;

use App\Models\Document;
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
        // Only the document owner can view it
        return $user->id === $document->user_id;
    }

    public function viewDocument(User $user, Document $document)
    {
        // Only the document owner can view it
        return $user->id === $document->user_id;
    }

    public function removeDocument(User $user, Document $document)
    {
        // Only the document owner can remove it
        return $user->id === $document->user_id;
    }
}
