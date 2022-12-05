<?php

namespace App\Repositories;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function __construct(protected User $model)
    {
    }

    public function findClientByUuid(string $uuid)
    {
        return $this->model->where('client_uuid', $uuid)->get();
    }

    public function findAllClients():Collection
    {
        $clientRole = Role::findByName(RoleEnum::Client)->first();

        return $this->model->where('role_id', $clientRole->id)->get();
    }

    public function update(array $data):bool
    {
        return $this->model->where('client_uuid', $data['client_uuid'])->update($data);
    }

    public function delete(int $id):void
    {
        $this->model->where('id', $id)->first()->delete();
    }
}