<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;

    public function __construct(Chat $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        //  return ['public'];
        return new Channel('message.' . $this->message->document_id);
    }

    public function broadcastAs(): string
    {
        //return 'chat';
        return 'message.sent';
    }
}
