<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\ContactPerson;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'contact' => ['optional', 'string', 'max:255'],
            'phoneNumber' => ['optional', 'string', 'max:255'],
            'contact1' => ['optional', 'string', 'max:255'],
            'phoneNumber1' => ['optional', 'string', 'max:255'],
            'contact2' => ['optional', 'string', 'max:255'],
            'phoneNumber2' => ['optional', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string']
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
        $role = Role::findByName($data['role'])->first();
        
        $clientUuid = null;
      
        if ($data['role'] === RoleEnum::Client->value) {
            $clientUuid = Str::uuid();
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'role_id' => $role->id,
            'client_uuid' => $clientUuid
        ]);

        $contactPeople = [];
        if (count($data['contacts']) > 0 && isset($clientUuid)) {
            foreach ($data['contacts'] as $key => $value) {
                $contactPeople[$key] = ContactPerson::create([
                    'name' => $value,
                    'phone_number' => $data['phoneNumbers'][$key],
                    'user_id' => $user->id
                ]);
            }
        }

        return $user;
    }
}
