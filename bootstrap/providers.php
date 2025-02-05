<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\TelescopeServiceProvider::class,
    Infrastructure\Shared\Providers\ConfigServiceProvider::class,
    Infrastructure\Shared\Providers\EventServiceProvider::class,
    Infrastructure\Shared\Providers\LogServiceProvider::class,
    Infrastructure\Shared\Providers\RouteBinderServiceProvider::class,
];
