<?php

namespace App\Listeners;

use App\Mail\MessageAdminUsersRegisters;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class sendMailAdminUsersRegisters
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //dd($event->usersCountries['users_admin']);
        foreach ($event->usersCountries['users_admin'] as $mails) {
            Mail::to($mails['email'])->send(new MessageAdminUsersRegisters($mails,$event->usersCountries['users_system']));
        }
    }
}
