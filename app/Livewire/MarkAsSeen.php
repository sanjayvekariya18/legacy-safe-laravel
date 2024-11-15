<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\Document;
use App\Models\SharedWithUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MarkAsSeen extends Component
{
    public $document;
    public $markAsSeen = false;

    public function mount($documentId)
    {
        $this->document = Document::find($documentId);
        $sharedUser = SharedWithUser::
            select('mark_as_seen')
            ->where('document_id', $documentId)
            ->where('user_id', Auth::id())
            ->first();
        $this->markAsSeen = $sharedUser->mark_as_seen ? true : false;
    }

    public function markAsSeenUpdate()
    {
        // Create the chat message associated with the document
        $this->document->chats()->create([
            'message' => "Has seen the file",
            'user_id' => Auth::id(),
        ]);
        $this->document->sharedWithUsers()
            ->where('user_id', Auth::id())
            ->update(['mark_as_seen' => true]);
        $this->markAsSeen = true;

        // Refresh the component
        $this->dispatch('$refresh')->to(DocumentMessage::class);
    }

    public function render()
    {
        return view('livewire.mark-as-seen');
    }
}
