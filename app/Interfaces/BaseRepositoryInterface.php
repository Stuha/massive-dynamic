<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function create(array $data):Model;

    public function fetchAll():Collection;

    public function delete(int $id):void;

    public function findById(int $id);
}

