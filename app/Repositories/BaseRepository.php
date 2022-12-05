<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class BaseRepository implements BaseRepositoryInterface
{
    
    public function __construct(protected Model $model)
    {}

    public function create(array $data):Model
    {
        return $this->model->create($data);
    }

    public function fetchAll():Collection
    {
        return $this->model->all();
    }

    public function delete(int $id):void
    {
        $this->model->where('id', $id)->first()->delete();
    }

    public function findById(int $id)
    {
        return $this->model->where('id', $id)->first();
    }
}