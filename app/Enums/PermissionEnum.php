<?php

namespace App\Enums;


enum PermissionEnum: string
{
    case Read = 'read';
    case Edit = 'edit';
    case Delete = 'delete';
}