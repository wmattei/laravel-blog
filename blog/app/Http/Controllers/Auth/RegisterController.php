<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'name' => 'required'
        ], 
        [
            'required' => 'O campo :attribute é obrigatório', // TODO verificar se tem como deixar os nomes por padrão assim
            'unique' => 'O campo :attribute já está em uso.'
        ], 
        [
            'name' => 'nome'
        ]);

        $user = User::create([
            'email'    => $request->email,
            'password' => $request->password,
            'name' => $request->name
        ]);

       $token = auth()->login($user);

       return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'message' => "Registrado com sucesso! Bem vindo",
                'data' => [
                    'access_token' => $token,
                    'token_type'   => 'bearer',
                    'expires_in'   => auth()->factory()->getTTL() * 60
                ]
            ]);
    }
}
