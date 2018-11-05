<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use App\Services\Users\BlankUser\Repository\Contracts\Repository as BlankUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    private $blankUserRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BlankUserRepository $blankUserRepository)
    {
        $this->middleware('guest');
        $this->blankUserRepository = $blankUserRepository;
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
        dd($this->blankUserRepository->all()->where('personal_key', $data['personal_key'])->first());

//        return User::create([
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);



        DB::transaction(function() use ($data)
        {
            User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        });
    }
}
