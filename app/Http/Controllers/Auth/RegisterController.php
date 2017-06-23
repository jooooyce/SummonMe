<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request; 
use Summon\Http\Requests;

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
    public function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:20|unique:users|alpha_num',
            'email' => 'required|email|max:255|unique:users',
            'first_name' => 'required|max:100|alpha_dash',
            'last_name' => 'required|max:100|alpha_dash',
            'password' => 'required|min:6|max:100|alpha_dash',
            'confirm_password' => 'required|min:6|same:password',
            'phone_number' => 'required|digits:10|numeric',
            'user_policy_accepted' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
      public function create(array $data)
    { 
        $user = new User;  
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->password = $data['password'];
        $user->phone_number = $data['phone_number'];
        $user->user_policy_accepted = date('Y-m-d H:i:s');
		$user-> remember_token = $data['_token'];
        $user->admin = false;
		$user->disabled = false;
        $user->save();   
		return $user;
    }
}
