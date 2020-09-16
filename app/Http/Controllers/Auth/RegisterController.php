<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Rules\MatchStudentID;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $regex_pattern = 'regex:/^\S*(?=\S{10,30})(?=\S*[a-z])(?=\S*[A-Z])(?![ ])\S*$/';

        return Validator::make($data, [
            'std_id' => ['required', 'string', 'min:10', 'max:10', 'unique:users', new MatchStudentID],
            'realname' => ['required', 'string', 'min:2', 'max:255'],
            'account' => ['required', 'string', 'min:10', 'max:30', $regex_pattern, 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:10', 'max:30', $regex_pattern, 'confirmed'],
            'telephone' => ['required', 'string', 'min:10', 'max:10', 'unique:users']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'account' => $data['account'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'std_id' => $data['std_id'],
            'realname' => $data['realname'],
            'identify' => $data['identify'],
            'telephone' => $data['telephone'],
            'type' => 'user',
            'point' => 0
        ]);
    }
}
