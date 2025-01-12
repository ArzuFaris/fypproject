<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Academician;
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
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'academician',
        ]);

        // Create associated academician record
        /*Academician::create([
            'academician_id' => 'AC' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'academician_number' => 'STF' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'academician_name' => $data['name'],
            'user_id' => $user->id,
            'position' => 'Lecturer', // Default position
            'department' => 'Not Specified', // Default department
        ]);*/

        Academician::create([
            'academician_id' => 'AC' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'user_id' => $user->id,  // Link to the user
            'academician_name' => $data['name'],
            'academician_number' => 'STF' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
            'email' => $data['email'],
            'college' => 'Not Specified',  // Default value
            'department' => 'Not Specified',  // Default value
            'position' => 'Lecturer'  // Default value
        ]);

        return $user;
    }
}
