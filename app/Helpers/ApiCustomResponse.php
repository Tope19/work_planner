<?php
namespace App\utils;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;

class ApiCustomResponse
{
    /** Return valid api response */
    public static function successResponse(string $message = null, $data = null, $code = null)
    {
        if (is_null($data) || empty($data)) {
            $data = null;
        }
        $body = [
            'message' => $message,
            'data' => $data,
            'success' => true,
            'status_Code' => $code,

        ];
        return response()->json($body, $code);
    }

    public static function errorResponse(string $message = null, int $status_code, Exception $trace = null)
    {
        $code = !empty($status_code) ? $status_code : null;
        $traceMsg = empty($trace) ?  null  : $trace->getMessage();

        $body = [
            'message' => $message,
            'status_Code' => $code,
            'success' => false,
            'error_debug' => $traceMsg,
        ];

        !empty($trace) ? logger($trace->getMessage(), $trace->getTrace()) : null;
        return response()->json($body)->setStatusCode($code);
    }


}
