<?php

namespace Infrastructure\Shared\Providers;

use Domain\Project\Tenant\Models\Invoice;
use Domain\Project\Tenant\Models\Milestone;
use Domain\Project\Tenant\Models\MilestoneWork;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteBinderServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::bind('work', function ($value) {
            return MilestoneWork::where('id', $value)->firstOrFail();
        });
        Route::bind('milestone', function ($value) {
            return Milestone::where('id', $value)->firstOrFail();
        });
        Route::bind('invoice', function ($value) {
            return Invoice::where('id', $value)->firstOrFail();
        });
    }
}
