<?php

namespace App\Livewire;

use App\Models\Document;
use App\Notifications\DocumentNotification;
use Livewire\Component;

class NotifyProfessional extends Component
{
    public $document;

    protected $listeners = [
        '$refresh'
    ];

    public function mount($documentId)
    {
        $this->document = $documentId;
    }

    public function notifyProfessional()
    {
        $document = Document::find($this->document);
        foreach ($document->notifiedUsers as $notifiedUser) {
            if (!$notifiedUser->is_professional_notified) {
                $notifiedUser->user->notify(new DocumentNotification(
                    "Uploaded {$document->name} for approval",
                    $document->id,
                ));
                $notifiedUser->is_professional_notified = true;
                $notifiedUser->save();
            }
        }
        $this->dispatch('notified');
    }

    public function render()
    {
        return view('livewire.notify-professional');
    }
}
