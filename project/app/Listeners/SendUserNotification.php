<?php

namespace App\Listeners;
use App\User;
use App\Events\UserManageAction;
use Mail;

class SendUserNotification
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
     * @param  UserManageAction  $event
     * @return void
     */
    public function handle(UserManageAction $event)
    {
        // Access the order using $event->order...
        $user = User::find($event->userId)->toArray();
      /*  Mail::send('emails.user_created', $user, function($message) use ($user) {
            $message->to('qachd15@gmail.com');
            $message->subject('User Created');
        });*/
    }
}