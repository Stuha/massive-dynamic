<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\File;

class FileRepository extends BaseRepository implements BaseRepositoryInterface
{
    public function __construct(File $model)
    {
        parent::__construct($model);
    }
}