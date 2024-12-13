<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Document;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use App\Notifications\NewNotification;
use App\Http\Requests\FileManagerRequest;
use App\Http\Controllers\MessageController;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FileManager extends Component
{

    use WithFileUploads;

    public $name, $user_id, $url;
    public function saveFile()
    {
        
        $this->validate([
            'name' => 'required',
            'url' => 'required|url|mimes:jpg,jpeg,png,pdf|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);
    
      
        $filePath = null;
        if ($this->url) {
            $filePath = $this->url->store('images', 'public');
            dd($filePath);
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
        $users = User::query()->where('invited_by', auth()->user()->id)->get();
        return view('livewire.file-manager', compact('users'))->layout('layouts.app');
    }

}


