<?php

namespace App\Support\Http;

class ResponseAjax
{
    public static function ok(string $message)
    {
        return response()->json(array('status' => 'ok', 'message' => $message));
    }

    public static function error(string $message)
    {
        return response()->json(array('status' => 'error', 'message' => $message));
    }
}
