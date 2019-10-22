<?php

namespace Wauth\Http\Helpers;

use Illuminate\Support\Facades\Facade;

class WResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wresponse';
    }

    protected static function error($code, $message)
    {
        return response()->json([
            'error' => $message,
            'status' => $code
        ]);
    }

    protected static function token($token, $message)
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

    protected static function item($item, $includes)
    {
        return response()->json([
            'data' => $item,
            'includes' => $includes
        ]);
    }

    protected static function collection($collection, $includes, $meta)
    {
        return response()->json([
            'data' => $collection,
            'includes' => $includes,
            'meta' => $meta
        ]);
    }
}
