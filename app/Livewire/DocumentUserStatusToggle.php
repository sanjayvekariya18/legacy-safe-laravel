<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Document;
use App\Models\SharedWithUser;
use App\Models\User;

class DocumentUserStatusToggle extends Component
{
    public $document;
    public $selectedUserId = null;
    public $selectedUserName = null;

    public function mount($documentId)
    {
        $this->document = Document::find($documentId);
    }

    public function selectUser($userId, $name)
    {
        $this->selectedUserId = $userId;
        $this->selectedUserName = $name;
        $this->dispatch('openUserModal');
    }

    public function toBeNotifiedToggleStatus($userId)
    {
        $user = SharedWithUser::find($userId);
        $user->to_be_notified = !$user->to_be_notified;
        $user->save();
    }

    public function toBeVisibleToggleStatus($userId)
    {
        $user = SharedWithUser::find($userId);
        $user->to_be_visible = !$user->to_be_visible;
        $user->save();
    }

    public function openRemoveUserModal()
    {
        $this->dispatch('openRemoveUserModal');
    }

    public function removeSharedUser()
    {
        $this->document->sharedWithUsers()->where('id', $this->selectedUserId)->delete();
        $this->document->refresh(); // Refresh the document to reflect the changes in the view

        // Reset the user ID to remove
        $this->selectedUserId = null;
        $this->selectedUserName = null;
    }

    public function render()
    {
        return view('livewire.document-user-status-toggle');
    }
}

