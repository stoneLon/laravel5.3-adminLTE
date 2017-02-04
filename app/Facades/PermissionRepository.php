<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the Permission repository facade class
 */
class PermissionRepository extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'PermissionRepository';
    }
}
