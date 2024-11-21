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
    protected $listeners = [
        '$refresh'
    ];

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
        $this->dispatch('$refresh')->self();
    }

    public function toBeVisibleToggleStatus($userId)
    {
        $user = SharedWithUser::find($userId);
        $user->to_be_visible = !$user->to_be_visible;
        $user->save();
        $this->dispatch('$refresh')->self();
    }

    public function openRemoveUserModal()
    {
        $this->dispatch('openRemoveUserModal');
    }

    public function removeSharedUser()
    {
        $this->document->sharedWithUsers()->where('id', $this->selectedUserId)->delete();
        $this->dispatch('$refresh')->self();
    }

    public function render()
    {
        return view('livewire.document-user-status-toggle');
    }
}

