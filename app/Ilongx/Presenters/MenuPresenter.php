<?php
namespace Ilongx\Presenters;

class MenuPresenter
{

    /**
     * 格式化显示菜单
     *
     * @param array $data
     * @return string
     */
    public function showTree($data = array())
    {
        $html = '<ol class="dd-list">';
        foreach ($data as $menu) {
            $html .= '<li class="dd-item" data-id="'. $menu->menu_id .'" id="list_'. $menu->menu_id .'"><div class="dd-handle"><strong>'. $menu->menu_name .'</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
            if($menu->uri) {
                $html .= '<a href="'. route($menu->uri) .'" class="dd-nodrag">'. $menu->uri .'</a>';
            }
            $html .= '<span class="pull-right action dd-nodrag" data-field-name="_edit"><a href="'. route('admin.menu.edit', [$menu->menu_id]) .'"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:if(confirm(\'确定要删除？\'))ajaxDeleteItem(\''. route('admin.menu.destroy') .'\',\''. $menu->menu_id .'\');" data-id="1" class="_delete"><i class="fa fa-trash"></i></a></span></div>';
            if(!empty($menu->child)) {
                $html .= $this->showTree($menu->child);
            }
            $html .= '</li>';
        }
        $html .= '</ol>';
        return $html;
    }

    /**
     * select
     *
     * @param $data
     * @param int $select_id
     * @param int $num
     * @return string
     */
    public function showTreeSelect($data, $select_id = 0, $num = 1)
    {
        if($num == 1) {
            $html = '<option value="0" >Root</option>';
        } else {
            $html = '';
        }
        $nbsp = '';
        for($i = 1; $i<=$num; $i++) {
            $nbsp .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        $num += 1;
        foreach ($data as $menu) {
            if($select_id == $menu->menu_id) {
                $html .= '<option value="'. $menu->menu_id .'" selected>'. $nbsp .$menu->menu_name .'</option>';
            } else {
                $html .= '<option value="'. $menu->menu_id .'" >'. $nbsp .$menu->menu_name .'</option>';
            }
            if(!empty($menu->child)) {
                $html .= $this->showTreeSelect($menu->child, $select_id, $num);
            }
        }
        return $html;
    }

    /**
     * sidebar
     *
     * @param $data
     * @return string
     */
    public function sidebarMenu($data)
    {
        $admin_user_roles = auth()->user()->hasManyAdminUserRole->toArray();
        $role_ids = array_column($admin_user_roles, 'role_id');
        $html = '';
        foreach ($data as $menu) {
            if(!auth()->user()->is_super_admin) {
                $menu_roles = $menu->hasManyMenuRole->toArray();
                $menu_role_ids = array_column($menu_roles, 'role_id');
                if(!empty($menu_role_ids)) {
                    if(empty($role_ids) || empty(array_intersect($role_ids, $menu_role_ids))) {
                        continue;
                    }
                }
            }
            if(!empty($menu->child)) {
                $html .= '<li class="treeview">';
                $html .= '<a href="#"><i class="fa '. $menu->icon .'"></i> <span>'. $menu->menu_name .'</span> <i class="fa fa-angle-left pull-right"></i></a>';
                $html .= '<ul class="treeview-menu">';
                $html .= $this->sidebarMenu($menu->child);
                $html .= '</ul>';
            } else {
                $url = empty($menu->uri) ? 'javascript:;' : route($menu->uri);
                $html .= '<li><a href="'. $url .'"><i class="fa '. $menu->icon .'"></i> <span>'. $menu->menu_name .'</span></a></li>';
            }
        }
        return $html;
    }
}