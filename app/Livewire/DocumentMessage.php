<?php

namespace App\Livewire;

use App\Notifications\DocumentNotification;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Chat;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DocumentMessage extends Component
{
    use WithFileUploads;

    protected $listeners = [
        '$refresh'
    ];
    public $documentId;
    public $message;
    public $file;

    public $isUploading = false; // To track if the file is uploading

    // Define the validation rules
    protected $rules = [
        'message' => 'required|string|max:500',  // Message is required and a string with max length
        'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,zip',  // Optional file upload, validate type
    ];

    // You can also add custom messages for validation
    protected $messages = [
        'message.required' => 'Message is required.',
        'file.mimes' => 'Only image, pdf, doc, and zip files are allowed.',
    ];

    public function mount($documentId)
    {
        $this->documentId = $documentId;
    }

    public function sendMessage()
    {
        $this->isUploading = true; // Set uploading state to true

        // Validate the inputs
        $this->validate();

        DB::beginTransaction();

        $chat = new Chat();
        $chat->document_id = $this->documentId;
        $chat->user_id = Auth::id();
        $chat->message = $this->message;

        activity()
            ->causedBy(Auth::user())
            ->performedOn($chat->document)
            ->log('New comment added');

        // Handle the file upload if there's a file
        if ($this->file) {
            $path = $this->file->storeAs(
                'documents/' . $this->documentId,
                $this->file->getClientOriginalName(),
                's3'
            );
            $chat->file = $path;

            // Manually remove the temporary file after upload
            $temporaryFilePath = $this->file->getRealPath();
            unlink($temporaryFilePath); // Delete the temporary file
            activity()
                ->causedBy(Auth::user())
                ->performedOn($chat->document)
                ->log('New file uploaded');
        }
        $chat->save();

        // Reset input fields
        $this->message = '';
        $this->file = null;

        // Notified the Users for new message
        $authUser = User::find(Auth::id());
        $document = Document::find($this->documentId);

        $authUser->notify(new DocumentNotification(
            "Submitted a message to {$document->name}",
            $document->id,
        ));

        if ($document->user->id == $authUser->id) {
            foreach ($document->sharedWithProfessionalUsers as $notifiedUser) {
                $notifiedUser->user->notify(new DocumentNotification(
                    "{$document->user->name} Submitted a message to {$document->name}",
                    $document->id,
                ));

            }
        } else {
            $document->user->notify(new DocumentNotification(
                "{$authUser->name} Submitted a message to {$document->name}",
                $document->id,
            ));
        }
        DB::commit();

        // Refresh the component
        $this->dispatch('$refresh')->self();
    }

    public function render()
    {
        $chats = Chat::where('document_id', $this->documentId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.document-message', ['chats' => $chats]);
    }
}
