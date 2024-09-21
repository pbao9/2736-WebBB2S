<?php

return [
    'school' => [
        'id' => [
            'title' => 'ID',
            'orderable' => false,
            'addClass' => 'align-middle',
        ],
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'province_code' => [
            'title' => 'province',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => false
        ],
        'district_code' => [
            'title' => 'district',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => false
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'exportable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => true
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'exportable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'notifications' => [
        'title' => [
            'title' => 'Tiêu đề',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'parent_id' => [
            'title' => 'Phụ huynh nhận',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'driver_id' => [
            'title' => 'Tài xế nhận',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'nany_id' => [
            'title' => 'Giám sinh nhận',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'message' => [
            'title' => 'Nội dung',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
        ],

        'created_at' => [
            'title' => 'Ngày thông báo',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],

    ],
    'module' => [
        'id' => [
            'title' => 'ID',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'name' => [
            'title' => 'Tên Module',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'role' => [
        'id' => [
            'title' => 'ID',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'title' => [
            'title' => 'Tên vai trò',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'name' => [
            'title' => 'Slug ( role_name )',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'guard_name' => [
            'title' => 'Vai trò của nhóm ( Guard Name )',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'permission' => [
        'id' => [
            'title' => 'ID',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'title' => [
            'title' => 'Tên quyền',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'name' => [
            'title' => 'Slug ( Permission_name )',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'module_id' => [
            'title' => 'Thuộc Module',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'guard_name' => [
            'title' => 'Nhóm quyền ( Guard Name )',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'admin' => [
        'fullname' => [
            'title' => 'Họ tên',
            'orderable' => false
        ],
        'phone' => [
            'title' => 'Số điện thoại',
            'orderable' => false
        ],
        'email' => [
            'title' => 'Email',
            'orderable' => false,
        ],
        'roles' => [
            'title' => 'Vai trò',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => false,
            'visible' => false
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'user' => [

        'fullname' => [
            'title' => 'Họ tên',
            'orderable' => false
        ],
        'email' => [
            'title' => 'Email',
            'orderable' => false,
        ],
        'phone' => [
            'title' => 'Số điện thoại',
            'orderable' => false
        ],
        'gender' => [
            'title' => 'Giới tính',
            'orderable' => false,
            'visible' => false
        ],

        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => false,
            'visible' => false
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'slider' => [
        'name' => [
            'title' => 'Tên',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle text-center'
        ],
        'plain_key' => [
            'title' => 'Key',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle text-center'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle text-center'
        ],
        'items' => [
            'title' => 'Slider Item',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'align-middle text-center'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'slider_item' => [
        'title' => [
            'title' => 'Tên',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'image' => [
            'title' => 'Hình ảnh',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'position' => [
            'title' => 'Vị trí',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'post_category' => [
        'avatar' => [
            'title' => 'avatar',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'name' => [
            'title' => 'Tên danh mục',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => false
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'post' => [
        'image' => [
            'title' => 'Ảnh đại diện',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'title' => [
            'title' => 'Tiêu đề',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'updated_at' => [
            'title' => 'Thời gian',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'viewed' => [
            'title' => 'Lượt xem',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => false
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],

    'product' => [
        'image' => [
            'title' => 'Ảnh đại diện',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'title' => [
            'title' => 'Tiêu đề',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'updated_at' => [
            'title' => 'Thời gian',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'viewed' => [
            'title' => 'Lượt xem',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => false
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],

    'contact' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'form_type' => [
            'title' => 'form_type',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => true
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => true
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => true
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],

    'province' => [
        'name' => [
            'title' => 'Tỉnh thành',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'code' => [
            'title' => 'Mã tỉnh thành',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'active' => [
            'title' => 'Hiển thị',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'district' => [
        'code' => [
            'title' => 'code',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'province_code' => [
            'title' => 'province',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
];
