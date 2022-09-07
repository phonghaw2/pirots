<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

trait ResponseTrait
{
    public function successResponse($data = [] , $message = ''):JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ]);
    }
    public function errorResponse($message = '' ,$status = 400):JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [],
            'message' => $message,
        ], $status);
    }
}
