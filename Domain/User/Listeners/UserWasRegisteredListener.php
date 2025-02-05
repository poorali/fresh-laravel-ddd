<?php

namespace Domain\User\Listeners;

use Domain\User\Events\UserWasRegisteredEvent;
use Domain\User\Notifications\WelcomeMessageNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserWasRegisteredListener implements ShouldQueue
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
    public function handle(UserWasRegisteredEvent $event): void
    {
        // Send a welcome message to the new user
        $event->model->notify(new WelcomeMessageNotification());
    }
}
