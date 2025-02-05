<?php

namespace Infrastructure\Shared\Providers;

use Domain\Monitor\Jobs\LoggerJob;
use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('logs', function () {
            return function (\Throwable|array $payload = [], string $level = 'error') {

                LoggerJob::dispatch(
                    !is_array($payload) && $payload instanceof \Throwable
                        ?
                        [$payload->getMessage(), $payload->getFile(), $payload->getLine()]
                        :
                        $payload,
                    $level);
            };
        });
    }
}
