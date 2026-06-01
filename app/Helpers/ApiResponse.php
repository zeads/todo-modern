<?php

namespace App\Helpers;

class ApiResponse
{
    public static function success(
        $data = null,
        string $message = 'OK'
    ) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
