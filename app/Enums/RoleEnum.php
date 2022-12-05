<?php

namespace App\Enums;


enum RoleEnum: string
{
    case Admin = 'admin';
    case Secretary = 'secretary';
    case Client = 'client';
}