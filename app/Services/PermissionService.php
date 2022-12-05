<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class PermissionService
{

    public function getPermissions():array
    {
        $permissions = Auth::user()->role->permissions->toArray();
        return array_column($permissions, 'name');
    }

    public function checkPermissions(string $permission)
    {
        $userPermissions = $this->getPermissions();
       
        if (in_array($permission, $userPermissions)) {
            return true;
        }

        return false;
    }
}