<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DocumentMessage extends Component
{
    use WithFileUploads;

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

        $chat = new Chat();
        $chat->document_id = $this->documentId;
        $chat->user_id = Auth::id();
        $chat->message = $this->message;

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
        }
        $chat->save();

        // Reset input fields
        $this->message = '';
        $this->file = null;

        // Refresh the component
        $this->dispatch('messageSent');
    }

    public function render()
    {
        $chats = Chat::where('document_id', $this->documentId)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.document-message', ['chats' => $chats]);
    }
}
