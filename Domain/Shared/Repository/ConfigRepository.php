<?php

namespace Domain\Shared\Repository;

use Domain\Shared\Models\Config;
use Illuminate\Support\Facades\Cache;

class ConfigRepository
{
    public static function getListByName()
    {
        return Cache::rememberForever('configs', function () {
            return Config::all()->pluck('value', 'name')->toArray();
        });
    }
}
