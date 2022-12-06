<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\ContactPerson;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $read = Permission::findByName(PermissionEnum::Read)->first();
        $delete = Permission::findByName(PermissionEnum::Delete)->first();
        $edit = Permission::findByName(PermissionEnum::Edit)->first();
       
        $admin = Role::findByName(RoleEnum::Admin)->first();
        $secretary = Role::findByName(RoleEnum::Secretary)->first();
        $client = Role::findByName(RoleEnum::Client)->first();


        if (! isset($read) && ! isset($delete) && ! isset($edit)) {
            $permissions[PermissionEnum::Read->value] = Permission::factory()->create(['name' => PermissionEnum::Read]);
            $permissions[PermissionEnum::Edit->value] = Permission::factory()->create(['name' => PermissionEnum::Edit]);
            $permissions[PermissionEnum::Delete->value] = Permission::factory()->create(['name' => PermissionEnum::Delete]);
     
            if (! isset($admin) && ! isset($secretary) && ! isset($client)) {
                $admin = Role::factory()->create(['name' => RoleEnum::Admin]);
                $secretary = Role::factory()->create(['name' => RoleEnum::Secretary]);
                $client = Role::factory()->create(['name' => RoleEnum::Client]);
    
                $admin->permissions()->attach($permissions[PermissionEnum::Delete->value]->id);
                $admin->permissions()->attach($permissions[PermissionEnum::Edit->value]->id);
                $secretary->permissions()->attach($permissions[PermissionEnum::Edit->value]->id);
                $client->permissions()->attach($permissions[PermissionEnum::Read->value]->id);
            }    
        }
        
        User::factory()->create(['role_id' => $admin->id]);
        User::factory()->create(['role_id' => $secretary->id]);

        User::factory()->count(20)->create(['role_id' => $client->id])->each(function ($user)
        {
            $uuid = Str::uuid()->toString();
            $user->client_uuid = $uuid;
            $user->save();
          
            $contactPersons = ContactPerson::factory()->count(rand(1, 4))->make();
            $user->contactPerson()->saveMany($contactPersons);
        });
    }
}

