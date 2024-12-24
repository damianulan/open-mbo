<?php

namespace App\Facades\Http;

use Illuminate\Http\Request;

class ResponseAjax
{
    public static function ok (string $message)
    {
        return response()->json(['status' => 'ok', 'message' => $message]);
    }

    public static function error (string $message)
    {
        return response()->json(['status' => 'error', 'message' => $message]);
    }
}
