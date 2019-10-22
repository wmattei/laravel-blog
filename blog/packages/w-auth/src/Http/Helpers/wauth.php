<?php
class WAuth
{

    public static function user()
    {
        return auth()->user();
    }

    public static function isAdmin()
    {
        return auth()->user()->isAdmin();
    }
}
