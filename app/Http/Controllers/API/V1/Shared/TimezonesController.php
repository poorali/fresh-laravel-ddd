<?php

namespace App\Http\Controllers\API\V1\Shared;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Infrastructure\Shared\Responses\ApiResponse;

class TimezonesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        return ApiResponse::send(null,
            'success',
            ['timezones' => \DateTimeZone::listIdentifiers()]
        );
    }
}
