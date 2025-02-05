<?php
namespace Domain\AI\Listeners;

use Domain\AI\Events\AiRequestWasCreatedEvent;
use Domain\AI\Jobs\AiSendRequestJob;
use Domain\Align\Repository\AlignRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class AiRequestWasCreatedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(protected AlignRepository $alignRepository)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AiRequestWasCreatedEvent $event): void
    {
        AiSendRequestJob::dispatch($event->model);
    }
}
