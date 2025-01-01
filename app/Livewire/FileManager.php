<?php
namespace App\Livewire;

use App\Models\Document;
use App\Models\User;
use App\Notifications\NewNotification;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileManager extends Component
{
    use WithFileUploads;
    public $name, $user_id, $url;

    public function submitForm()
    {

        $this->validate([
            'name' => 'required',
            'url' => 'required|url|mimes:jpg,jpeg,png,pdf|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);

        $filePath = null;
        if ($this->url) {
            $filePath = $this->url->store('images', 'public');
        }

        Document::create([
            'name' => $this->name,
            'user_id' => $this->user_id,
            'url' => $filePath,
        ]);

        if (auth()->check()) {
            $message = 'A new document has been uploaded successfully.';
            auth()->user()->notify(new NewNotification($message));
        }

        session()->flash('success', 'File uploaded successfully.');
    }

    public function finishUpload($name, $tmpPath, $isMultiple)
    {
        $this->cleanupOldUploads();

        $url = collect($tmpPath)->map(function ($i) {
            return TemporaryUploadedFile::createFromLivewire($i);
        })->toArray();
        $this->emitSelf('upload:finished', $name, collect($url)->map->getFilename()->toArray());

        $url = array_merge($this->getPropertyValue($name), $url);
        $this->syncInput($name, $url);
    }

    public function render()
    {
        $users = User::where('invited_by', auth()->id())->get();
        return view('livewire.file-manager', compact('users'));
    }

}
