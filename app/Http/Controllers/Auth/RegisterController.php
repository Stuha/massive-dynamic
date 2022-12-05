<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use App\Services\ContactPersonService;
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
    public function __construct(
        private UserRepository $userRepository,
        private ContactPersonService $contactPersonService
    ){
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
    protected function create(array $client)
    {
        $role = Role::findByName($client['role'])->first();

        $clientUuid = null;
      
        if ($role->name === RoleEnum::Client->value) {
            $clientUuid = Str::uuid();
        }
       
        $data['name'] = $client['name'];
        $data['email'] = $client['email'];
        $data['password'] = Hash::make($client['password']);
        $data['address'] = $client['address'];
        $data['role_id'] = $role->id;
        $data['client_uuid'] = $clientUuid;

        $user = $this->userRepository->create($data);

        if (isset($clientUuid)) {
            $this->contactPersonService->createContactPerson($client, $user, $clientUuid);
        }

        return $user;
    }
}
