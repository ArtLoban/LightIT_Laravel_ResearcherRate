<?php

namespace App\Http\Controllers\Auth;

use App\Models\Users\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Services\Users\User\UserRegister\Contracts\UserRegister;
use App\Services\Users\BlankUser\Repository\Contracts\Repository as BlankUserRepository;

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
     * @var BlankUserRepository
     */
    private $userRegister;

    /**
     * Create a new controller instance
     *
     * RegisterController constructor.
     * @param UserRegister $userRegister
     */
    public function __construct(UserRegister $userRegister)
    {
        $this->middleware('guest');
        $this->userRegister = $userRegister;
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
            'personal_key' => 'required|integer|digits:8|exists:blank_users,personal_key',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return $this->userRegister->registrate($data);
    }
}
