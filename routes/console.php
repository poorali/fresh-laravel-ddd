<?php

use Infrastructure\Subscription\Commands\ExpireSubscriptionsCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::call(ExpireSubscriptionsCommand::class)->everyMinute();
