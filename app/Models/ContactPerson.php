<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    use HasFactory;

    public $guarded = [];

    public function users()
    {
        $this->belongsTo(User::class);
    }

}
