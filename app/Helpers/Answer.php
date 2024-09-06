<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class Answer
{
    public static function json($data = [], $message = '', $status = 'OK', $statusCode = 200)
    {
        $response = [
            'data' => $data,
            'message' => $message,
            'status' => $status
        ];

        return response()->json($response, $statusCode);
    }
}
