<?php

namespace Domain\User\Listeners;

use Domain\User\Events\UserWasLoggedInEvent;
use Domain\User\Notifications\NewLoginNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserWasLoggedInListener implements ShouldQueue
{
    use Queueable;

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
    //Todo: Uncomment it later
//    public function handle(UserWasLoggedInEvent $event): void
//    {
//        // Send a welcome message to the new user
//        if ($event->model->tokenable->tokens()->count() > 1 && $event->model->last_used_at === null) {
//            $event->model->notify(new NewLoginNotification());
//        }
//    }
}
