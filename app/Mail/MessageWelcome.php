<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageWelcome extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->user['name_user']);
        return $this->view('emails.message-welcome')
        ->with([
            'name_user'=>$this->user['name_user']." ".$this->user['name_user'],
            'identification_user'=>$this->user['identification_user'],
            'email_user'=>$this->user['email_user'],
            'country_user'=>$this->user['country_user'],
            'address_user'=>$this->user['address_user'],
            'movil_user'=>$this->user['movil_user'],
            'name_category'=>$this->user['name_category'],
        ]);
    }
}
