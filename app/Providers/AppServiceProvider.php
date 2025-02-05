<?php

namespace App\Providers;

use Domain\User\Models\PersonalAccessToken;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Storage::extend('dropbox', function (Application $app, array $config) {
            app('logs')([$config['authorization_token']]);
            $adapter = new DropboxAdapter(new Client(
                $config['authorization_token']
            ));

            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
        $mainPath = database_path('migrations');
        $directories = glob($mainPath . '/*', GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);

        $this->loadMigrationsFrom($paths);
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
