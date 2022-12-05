<?php

namespace App\Http\Controllers;


use App\Enums\RoleEnum;
use App\Models\Role;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private UserRepository $userRepository)
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role = Role::where('id', $user->role_id)->first();
       
        if ($role->name === RoleEnum::Client->value) {
            $clients = $this->userRepository->findClientByUuid($user->client_uuid);
        } else {
            $clients = $this->userRepository->findAllClients();
        }
    
        
        return view('home', ['clients' => $clients]);
    }

    public function show(Request $request)
    {
        $client = $this->userRepository->findClientByUuid($request->uuid)->first();
   
        return view('client', ['client' => $client]);
    }

    public function update(Request $request)
    {
        $client = $this->userRepository->findClientByUuid($request->uuid)->first();

        $contactPeople = $client->contactPerson->toArray();

        return view('editclient', ['client' => $client, 'contactPeople' => $contactPeople]);

    }

    public function edit(Request $request)
    {
        $data = [];
        
        $data['client_uuid'] = $request->uuid;
        $data['name'] = $request->name;
        $data['address'] = $request->address;
        $data['email'] = $request->email;
       
        $this->userRepository->update($data);

        return redirect(route('home'));
    }

    public function delete(int $id)
    {
        $this->userRepository->delete($id);

        return redirect(route('home'));
    }
}
