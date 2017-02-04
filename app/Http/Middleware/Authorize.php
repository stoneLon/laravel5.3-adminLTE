<?php

namespace App\Http\Middleware;

use App\Facades\PermissionRepository;
use App\Facades\PermissionRoleRepository;
use Closure;
use Illuminate\Support\Facades\Route;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->is_super_admin) {
            return $next($request);
        }
        $route_name = Route::currentRouteName();
        $permission_id = PermissionRepository::getIdForRoute($route_name);
        if(empty($permission_id)) {
            return $next($request);
        }
        $admin_user_roles = auth()->user()->hasManyAdminUserRole->toArray();
        $role_ids = array_column($admin_user_roles, 'role_id');
        if(!empty($role_ids)) {
            $permission_ids = PermissionRoleRepository::getPermissionRole($role_ids);
            if(in_array($permission_id, $permission_ids)) {
                return $next($request);
            }
        }
        if(!$request->ajax()) {
            return abort(503);
        } else {
            return responseJson('0', '没有权限执行此操作');
        }
    }
}
