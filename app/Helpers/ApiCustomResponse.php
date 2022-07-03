<?php
namespace App\Helpers;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;

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

    /** Return error api response */
    static function inputErrorResponse(string $message = null, int $status_code = null, Request $request = null, ValidationException $trace = null)
    {
        $code = ($status_code != null) ? $status_code : '';
        $traceMsg = empty($trace) ?  null  : $trace->getMessage();
        $traceTrace = empty($trace) ?  null  : $trace->getTrace();

        $body = [
            'msg' => $message,
            'code' => $code,
            'success' => false,
            'errors' => empty($trace) ?  null  : $trace->errors(),
        ];

        return response()->json($body)->setStatusCode($code);
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
