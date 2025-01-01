<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;
    protected $role;

    public function __construct($url,$role)
    {
        $this->url = $url;
        $this->role = $role;
    }

    public function build()
    {
        $view = $this->role == 0  ? 'document.professional-invitation'
        : 'document.customer-invitation';

        return $this->subject('You are invited!')
                    ->view($view)
                    ->with(['url' => $this->url]);
    }
}
