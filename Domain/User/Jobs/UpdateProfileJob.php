<?php

namespace Domain\User\Jobs;

use Domain\User\Models\User;
use Domain\User\Repository\UserRepository;
use Domain\User\Services\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateProfileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $handler;

    public function __construct(private array $creationData, private User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $userService = new UserService(new UserRepository($this->user));
            if (!$userService->updateProfile($this->creationData, $this->user)) {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            app('logs')($e);
        }
    }
}
