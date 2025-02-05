<?php

namespace Domain\Monitor\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class LoggerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected array $payload = [], public string $level = 'info')
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::log($this->level, json_encode($this->payload));
        $payload = json_encode($this->payload);
    }
}
