<?php

namespace WAuth\Http\Controllers;

use WAuth\Http\Helpers\WResponse;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        return WResponse::collection([['foo' => 'bar']], 'foo, bar', ['page' => 0]);
    }
}
