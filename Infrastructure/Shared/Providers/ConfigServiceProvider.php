<?php

namespace Infrastructure\Shared\Providers;

use Domain\Shared\Repository\ConfigRepository;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('configs', function () {
            return ConfigRepository::getListByName();
        });
    }
}
