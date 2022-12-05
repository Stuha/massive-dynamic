<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public $guarded = [];

    public function roles()
    {   
        return $this->belongsToMany(Role::class, 'role_permission');
    }

    public function scopeFindByName($query, $name)
    {
        return $query->where('name', $name)->first();
    }
}
