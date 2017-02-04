<?php
namespace Ilongx\Repositories;

use App\Models\Permission;

class PermissionRepository extends CommonRepository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function getAll($columns = ['*'])
    {
        return $this->all($columns);
    }

    public function getIdForRoute($route)
    {
        $permissions = $this->findBy('route', $route);
        $permission_id = !empty($permissions) ? $permissions->permission_id : '0';
        return $permission_id;
    }

}