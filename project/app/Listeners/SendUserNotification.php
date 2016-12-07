<?php

namespace App\Listeners;
use App\User;
use App\Events\UserManageAction;

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
        Mail::send('emails.mailEvent', $user, function($message) use ($user) {
            $message->to($user['email']);
            $message->subject('User Created');
        });
    }
}