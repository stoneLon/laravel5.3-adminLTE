<?php
namespace Ilongx\Presenters;

class PermissionPresenter
{

    public function showTreeSelect($data, $select_permission_ids = array())
    {
        $html = '';
        foreach ($data as $permission) {
            if(in_array($permission->permission_id, $select_permission_ids)) {
                $html .= '<option value="'. $permission->permission_id .'" selected>'. $permission->permission_name .'</option>';
            } else {
                $html .= '<option value="'. $permission->permission_id .'">'. $permission->permission_name .'</option>';
            }
        }
        return $html;
    }
}