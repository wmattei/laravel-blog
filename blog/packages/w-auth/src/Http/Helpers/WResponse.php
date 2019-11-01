<?php

namespace Wauth\Http\Helpers;

use Illuminate\Support\Facades\Facade;

class WResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wresponse';
    }

    public static function error($code, $message)
    {
        return response()->json([
            'error' => $message,
            'status' => $code
        ]);
    }

    public static function token($token, $message)
    {
        return response()->json([
            'message' => $message,
            'data' => [
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => auth()->factory()->getTTL() * 60
            ]
        ]);
    }

    public static function item($item, $includes, $message)
    {
        return response()->json([
            'message' => $message,
            'data' => $item,
            'includes' => $includes
        ]);
    }

    public static function collection($collection, $includes, $meta)
    {
        return response()->json([
            'data' => $collection,
            'includes' => $includes,
            'meta' => $meta
        ]);
    }
}
