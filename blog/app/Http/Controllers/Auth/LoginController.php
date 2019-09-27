<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login
     */
    public function _login(Request $request)
    {

        $validate = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'required' => 'O campo :attribute é obrigatório',
                'unique' => 'O campo :attribute já está em uso.'
            ],
            [
                'password' => 'senha'
            ]
        );

        $credentials = request(['email', 'password']);


        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Bad Credentials'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout(Request $request)
    {
        if (!$request->headers->has('Authorization')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'message' => 'Bem vindo!',
            'data' => [
                'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => auth()->factory()->getTTL() * 60
            ]
        ]);
    }

    protected function guard()
    {
        return \Auth::guard('web');
    }
}
