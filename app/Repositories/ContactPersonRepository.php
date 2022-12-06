<?php

namespace App\Repositories;

use App\Models\ContactPerson;

class ContactPersonRepository extends BaseRepository
{
    public function __construct(ContactPerson $model)
    {
        parent::__construct($model);
    }
}