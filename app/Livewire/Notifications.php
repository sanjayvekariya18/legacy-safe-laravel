<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public $unreadCount; // To display unread count

    public function mount()
    {
        $user = Auth::user();
        $this->unreadCount = $user->unreadNotifications->count(); // Get unread count
    }

    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead(); // Mark all unread notifications as read
        $this->unreadCount = 0; // Reset unread count
    }

    public function render()
    {
        return view('livewire.notifications', [
            'unreadCount' => $this->unreadCount,
        ]);
    }
}
