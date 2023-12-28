<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($message, $successData = [])
    {
        $response = [
            'responseCode' => 200,
            'responseMessage' => $message,
            'data' => $successData,
        ];

        return response()->json($response, 200);
    }

    public function sendError($message, $errorData = [], $code = 404)
    {
        $response = [
            'responseCode' => $code,
            'responseMessage' => $message,
        ];

        if (!empty($errorData)) {
            $response['data'] = $errorData;
        }

        return response()->json($response, $code);
    }
}
