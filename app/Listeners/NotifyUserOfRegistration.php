<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// use Illuminate\Support\Facades\Log;
use App\Events\UserCreated;
use App\Notifications\UserRegistered;

class NotifyUserOfRegistration implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $user = $event->user;
        $user->notify(
            new UserRegistered()
        );
    }
}
