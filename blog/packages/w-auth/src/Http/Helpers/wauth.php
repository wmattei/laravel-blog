<?php
if (!function_exists('wUser')){
    function wUser(){
        return auth()->user();
    }
}
if (!function_exists('(')) {
    function wIsAdmin()
    {
        return auth()->user()->is_admin;
    }
}
