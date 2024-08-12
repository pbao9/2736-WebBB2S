<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seeding

        // roles
        DB::table('roles')->insert([
            'id' => 1,
            'title' => 'Super Admin',
            'name' => 'superAdmin',
            'guard_name' => 'admin',
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        //modules
        DB::table('modules')->insert([
            'id' => 1,
            'name' => 'Quản lý Bài viết',
            'description' => '<p>Quản l&yacute; c&aacute;c B&agrave;i viết trong hệ thống</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('modules')->insert([
            'id' => 2,
            'name' => 'QL Chuyên mục Bài viết',
            'description' => '<p>Quản l&yacute; Chuy&ecirc;n mục B&agrave;i viết</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('modules')->insert([
            'id' => 3,
            'name' => 'Quản lý Vai trò',
            'description' => '<p>Quản l&yacute; Vai tr&ograve; tr&ecirc;n hệ thống</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('modules')->insert([
            'id' => 4,
            'name' => 'Quản lý Admin',
            'description' => '<p>Quản l&yacute; c&aacute;c quản trị vi&ecirc;n trong Hệ thống v&agrave; Ph&acirc;n vai tr&ograve; cho c&aacute;c Admin</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('modules')->insert([
            'id' => 5,
            'name' => 'Quản lý Slider',
            'description' => '<p>Quản l&yacute; Slider c&aacute;c h&igrave;nh ảnh chạy qua lại ở trang Web b&ecirc;n ngo&agrave;i</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('modules')->insert([
            'id' => 6,
            'name' => 'Quản lý Slider Items',
            'description' => '<p>Quản l&yacute; c&aacute;c H&igrave;nh ảnh b&ecirc;n trong một Slider</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        //Module School
        DB::table('modules')->insert([
            'id' => 7,
            'name' => 'Quản lý trường học',
            'description' => '<p>Quản lý trường học</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        
        //Module Contact
        DB::table('modules')->insert([
            'id' => 8,
            'name' => 'Quản lý Đơn Liên Hệ',
            'description' => '<p>Quản lý Đơn Liên Hệ</p>',
            'status' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        //Module API
        DB::table('permissions')->insert([
            'id' => 1,
            'title' => 'Đọc tài liệu API',
            'name' => 'readAPIDoc',
            'guard_name' => 'admin',
            'module_id' => null,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 2,
            'title' => 'Xem Bài viết',
            'name' => 'viewPost',
            'guard_name' => 'admin',
            'module_id' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 3,
            'title' => 'Thêm Bài viết',
            'name' => 'createPost',
            'guard_name' => 'admin',
            'module_id' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 4,
            'title' => 'Sửa Bài viết',
            'name' => 'updatePost',
            'guard_name' => 'admin',
            'module_id' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 5,
            'title' => 'Xóa Bài viết',
            'name' => 'deletePost',
            'guard_name' => 'admin',
            'module_id' => 1,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 6,
            'title' => 'Xem Chuyên mục Bài viết',
            'name' => 'viewPostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 7,
            'title' => 'Thêm Chuyên mục Bài viết',
            'name' => 'createPostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 8,
            'title' => 'Sửa Chuyên mục Bài viết',
            'name' => 'updatePostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        

        DB::table('permissions')->insert([
            'id' => 9,
            'title' => 'Xóa Chuyên mục Bài viết',
            'name' => 'deletePostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 10,
            'title' => 'Xem Vai Trò',
            'name' => 'viewRole',
            'guard_name' => 'admin',
            'module_id' => 3,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 11,
            'title' => 'Thêm Vai Trò',
            'name' => 'createRole',
            'guard_name' => 'admin',
            'module_id' => 3,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 12,
            'title' => 'Sửa Vai Trò',
            'name' => 'updateRole',
            'guard_name' => 'admin',
            'module_id' => 3,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 13,
            'title' => 'Xóa Vai Trò',
            'name' => 'deleteRole',
            'guard_name' => 'admin',
            'module_id' => 3,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 14,
            'title' => 'Xem Admin',
            'name' => 'viewAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 15,
            'title' => 'Thêm Admin',
            'name' => 'createAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 16,
            'title' => 'Sửa Admin',
            'name' => 'updateAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 17,
            'title' => 'Xóa Admin',
            'name' => 'deleteAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 18,
            'title' => 'Xem Slider',
            'name' => 'viewSlider',
            'guard_name' => 'admin',
            'module_id' => 5,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 19,
            'title' => 'Thêm Slider',
            'name' => 'createSlider',
            'guard_name' => 'admin',
            'module_id' => 5,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 20,
            'title' => 'Sửa Slider',
            'name' => 'updateSlider',
            'guard_name' => 'admin',
            'module_id' => 5,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 21,
            'title' => 'Xóa Slider',
            'name' => 'deleteSlider',
            'guard_name' => 'admin',
            'module_id' => 5,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 22,
            'title' => 'Xem Slider Item',
            'name' => 'viewSliderItem',
            'guard_name' => 'admin',
            'module_id' => 6,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);


        DB::table('permissions')->insert([
            'id' => 23,
            'title' => 'Thêm Slider Item',
            'name' => 'createSliderItem',
            'guard_name' => 'admin',
            'module_id' => 6,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 24,
            'title' => 'Sửa Slider Item',
            'name' => 'updateSliderItem',
            'guard_name' => 'admin',
            'module_id' => 6,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 25,
            'title' => 'Xóa Slider Item',
            'name' => 'deleteSliderItem',
            'guard_name' => 'admin',
            'module_id' => 6,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 26,
            'title' => 'Cài đặt chung',
            'name' => 'settingGeneral',
            'guard_name' => 'admin',
            'module_id' => null,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        DB::table('permissions')->insert([
            'id' => 27,
            'title' => 'Cài đặt thông tin công ty',
            'name' => 'settingCompany',
            'guard_name' => 'admin',
            'module_id' => null,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);

        /** Start Permission School */
        DB::table('permissions')->insert([
            'id' => 28,
            'title' => 'Thêm trường học',
            'name' => 'createSchool',
            'guard_name' => 'admin',
            'module_id' => 7,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 29,
            'title' => 'Sửa trường học',
            'name' => 'updateSchool',
            'guard_name' => 'admin',
            'module_id' => 7,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 30,
            'title' => 'Xóa trường học',
            'name' => 'deleteSchool',
            'guard_name' => 'admin',
            'module_id' => 7,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 31,
            'title' => 'Xem trường học',
            'name' => 'viewSchool',
            'guard_name' => 'admin',
            'module_id' => 7,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        /** End Permission School */

         /** Start Permission Contact */

         DB::table('permissions')->insert([
            'id' => 32,
            'title' => 'Xem Đơn Liên Hệ',
            'name' => 'viewContact',
            'guard_name' => 'admin',
            'module_id' => 8,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 33,
            'title' => 'Thêm Đơn Liên Hệ',
            'name' => 'createContact',
            'guard_name' => 'admin',
            'module_id' => 8,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 34,
            'title' => 'Sửa Đơn Liên Hệ',
            'name' => 'updateContact',
            'guard_name' => 'admin',
            'module_id' => 8,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        DB::table('permissions')->insert([
            'id' => 35,
            'title' => 'Xóa Đơn Liên Hệ',
            'name' => 'deleteContact',
            'guard_name' => 'admin',
            'module_id' => 8,
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()')
        ]);
        /** End Permission Contact */

        //seeding model_has_roles
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'AppModelsAdmin',
            'model_id' => 1
        ]);

        DB::table('role_has_permissions')->insert([
            'permission_id' => 1,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 2,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 3,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 4,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 5,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 6,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 7,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 8,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 9,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 10,
            'role_id' => 1
        ]);
       
        DB::table('role_has_permissions')->insert([
            'permission_id' => 11,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 12,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 13,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 14,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 15,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 16,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 17,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 18,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 19,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 20,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 21,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 22,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 23,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 24,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 25,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 26,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 27,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 28,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 29,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 30,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 31,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 32,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 33,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 34,
            'role_id' => 1
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id' => 35,
            'role_id' => 1
        ]);

    }
}
