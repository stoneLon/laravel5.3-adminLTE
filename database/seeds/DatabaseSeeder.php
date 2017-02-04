<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
//        $this->call(AdminUserTableSeeder::class);

        DB::table('admin_users')->insert([
            'username' => 'admin',
            'name' => 'Administrator',
            'password' => bcrypt('admin'),
            'is_super_admin' => '1'
        ]);

        DB::table('menus')->insert([
            'menu_name' => '首页',
            'parent_id' => '0',
            'icon' => 'fa-link',
            'uri' => 'admin.index',
            'status' => '1',
            'sort_order' => '1'
        ]);

        DB::table('menus')->insert([
            'menu_name' => '权限管理',
            'parent_id' => '0',
            'icon' => 'fa-bars',
            'uri' => '',
            'status' => '1',
            'sort_order' => '2'
        ]);

        DB::table('menus')->insert([
            'menu_name' => '管理员管理',
            'parent_id' => '2',
            'icon' => 'fa-user',
            'uri' => 'admin.adminUser.index',
            'status' => '1',
            'sort_order' => '1'
        ]);

        DB::table('menus')->insert([
            'menu_name' => '角色管理',
            'parent_id' => '2',
            'icon' => 'fa-users',
            'uri' => 'admin.role.index',
            'status' => '1',
            'sort_order' => '2'
        ]);

        DB::table('menus')->insert([
            'menu_name' => '权限管理',
            'parent_id' => '2',
            'icon' => 'fa-user-md',
            'uri' => 'admin.permission.index',
            'status' => '1',
            'sort_order' => '3'
        ]);

        DB::table('menus')->insert([
            'menu_name' => '菜单管理',
            'parent_id' => '2',
            'icon' => 'fa-align-justify',
            'uri' => 'admin.menu.index',
            'status' => '1',
            'sort_order' => '4'
        ]);
    }
}
