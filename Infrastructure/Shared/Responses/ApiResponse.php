<?php

namespace Infrastructure\Shared\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function send(array|null|string $message, string $type = 'success', array $data = []): JsonResponse
    {
        return $type == 'success'
            ?
            response()->json(array_merge(['status' => 'success', 'message' => $message], $data))
            :
            response()->json([
                'status' => 'error',
                'errors' => !$message ? ['general' => __('messages.NotHandledException')]: (is_array($message)? $message:['general' => $message])
            ], $data['code'] ?? 200);
    }
}
