<?php

namespace App\Repositories;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findClientByUuid(string $uuid)
    {
        return $this->model->where('client_uuid', $uuid)->get();
    }

    public function findAllClients():LengthAwarePaginator
    {
        $clientRole = Role::findByName(RoleEnum::Client)->first();

        return $this->model->where('role_id', $clientRole->id)->paginate(25);
    }
}