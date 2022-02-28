<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageAdminUsersRegisters extends Mailable
{
    use Queueable, SerializesModels;
    public $usersAdmin;
    public $usersCountries;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userAdmin,$usersCountries)
    {
        $this->userAdmin = $userAdmin;
        $this->usersCountries = $usersCountries;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $users_countries = $this->usersCountries;
        $users_admin = $this->userAdmin;
        return $this->view('emails.message-admin',compact('users_countries','users_admin'));
    }
}
