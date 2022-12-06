<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\File;
use Illuminate\Database\Eloquent\Collection;

class FileRepository extends BaseRepository implements BaseRepositoryInterface
{
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    public function getAssignedFiles(int $clientId):Collection
    {
        $assignedFiles = $this->model->where('user_id', $clientId)->where('assigned', true)->get();

        return $assignedFiles;
    }

    public function getUnassignedFiles(int $clientId):Collection
    {
        $unassignedFiles = $this->model->where('user_id', $clientId)->where('assigned', false)->get();

        return $unassignedFiles;
    }
}