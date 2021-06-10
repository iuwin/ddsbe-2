<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    //dad
    /**
     * Build success response 
     * @param string|array $data
     * @param int $code
     * @return illuminate\Http\JsonResponse
     */

    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data, 'site' => 2], $code);
    }

    /**
     * Build error responses
     * @param string|array $message
     * @param int $code
     * @return illuminate\Http\JsonResponse
     */

    public function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'site' => 2, 'code' => $code], $code);
    }

}