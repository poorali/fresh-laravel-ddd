<?php

namespace Domain\User\Jobs;

use Domain\User\Models\User;
use Domain\User\Repository\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateAvatarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $handler;

    public function __construct(private string $image, private User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $userRepository = new UserRepository($this->user);
            if (!$userRepository->setAvatar($this->image)) {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            app('logs')($e);
        }
    }
}
