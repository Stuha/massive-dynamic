<?php

namespace App\Http\Controllers;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Role;
use App\Repositories\UserRepository;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(private UserRepository $userRepository, private PermissionService $permissionService)
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
        $userPermissions = $this->permissionService->getPermissions();
        
        $client = $this->userRepository->findClientByUuid($request->uuid)->first();
        
        if (Auth::user()?->client_uuid === $client->client_uuid || in_array(PermissionEnum::Edit->value, $userPermissions)) {
            return view('client', ['client' => $client, 'userPermissions' => $userPermissions]);
        }

        return redirect(route('home'));
   
    }

    public function update(Request $request)
    {
        $hasPermissions = $this->permissionService->checkPermissions(PermissionEnum::Edit->value);

        if (! $hasPermissions) {
            return redirect(route('home'));
        }

        $client = $this->userRepository->findClientByUuid($request->uuid)->first();
        $contactPeople = $client->contactPerson->toArray();

        return view('editclient', ['client' => $client, 'contactPeople' => $contactPeople]);

    }

    public function edit(Request $request)
    {
        $hasPermissions = $this->permissionService->checkPermissions(PermissionEnum::Edit->value);

        if ($hasPermissions) {
            $data = [];
            $data['client_uuid'] = $request->uuid;
            $data['name'] = $request->name;
            $data['address'] = $request->address;
            $data['email'] = $request->email;
           
            $this->userRepository->update($data);
        }

        return redirect(route('home'));
    }

    public function delete(int $id)
    {
        $hasPermissions = $this->permissionService->checkPermissions(PermissionEnum::Delete->value);

        if ($hasPermissions) {
            $this->userRepository->delete($id);
        }
      
        return redirect(route('home'));
    }
}
