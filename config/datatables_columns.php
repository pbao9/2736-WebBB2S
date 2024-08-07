<?php

return [
    'trip' => [
        'checkbox' => [
            'title' => 'choose',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'align-middle text-center',
            'footer' => '<input type="checkbox" class="form-check-input check-all" />',
        ],
        'code' => [
            'title' => 'Mã',
            'addClass' => 'align-middle text-center',
            'orderable' => false,
        ],
        'trip_date' => [
            'title' => 'Ngày bắt đầu',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'driver' => [
            'title' => 'driver',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'nany' => [
            'title' => 'nany',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'school_name' => [
            'title' => 'Trường học',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'school_address' => [
            'title' => 'address',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => false,
        ],
        'session' => [
            'title' => 'Buổi đưa/rước',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'check_in' => [
            'title' => 'Thời gian khởi hành',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'check_out' => [
            'title' => 'Thời gian kết thúc',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
            'visible' => false,
        ],
        'status' => [
            'title' => 'status',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'contract.id' => [
            'title' => 'Mã hợp đồng',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
            'visible' => false,
        ],
        'contract.type' => [
            'title' => 'Loại dịch vụ',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
            'visible' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'student' => [
        'id' => [
            'title' => 'ID',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'fullname' => [
            'title' => 'Họ và tên',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'parent_name' => [
            'title' => 'Phụ huynh',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'parents[0].user.phone' => [
            'title' => 'Số điện thoại phụ huynh',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'grade' => [
            'title' => 'Lớp',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'trip-details' => [
            'title' => 'Danh sách chuyến đi',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'school_name' => [
            'title' => 'Trường học',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'schedule' => [
        'date_off' => [
            'title' => 'Ngày nghỉ',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'type' => [
            'title' => 'Loại ngày nghỉ',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'note' => [
            'title' => 'Ghi chú',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'contract' => [
        'id' => [
            'title' => 'Mã hợp đồng',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'driver' => [
            'title' => 'Tài xế',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'nany' => [
            'title' => 'Giám sinh',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'school' => [
            'title' => 'Trường học',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'address' => [
            'title' => 'Địa chỉ trường học',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'Ngày bắt đầu',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
            'visible' => false
        ],
        'expired_at' => [
            'title' => 'Ngày hết hạn',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
            'visible' => false
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'trip-details' => [
            'title' => 'Danh sách chuyến đi',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'nany' => [
        'fullname' => [
            'title' => 'Họ tên',
            'addClass' => 'text-center align-middle',
            'orderable' => false
        ],
        'phone' => [
            'title' => 'phone',
            'addClass' => 'text-center align-middle',
            'orderable' => false
        ],
        'email' => [
            'title' => 'Email',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'address' => [
            'title' => 'Nơi ở hiện tại',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => false
        ],
        'trip-details' => [
            'title' => 'Danh sách chuyến đi',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'contract_id' => [
            'title' => 'Mã hợp đồng',
            'addClass' => 'text-center align-middle',
            'orderable' => false
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'parent' => [
        'user' => [
            'title' => 'Họ tên',
            'addClass' => 'text-center align-middle',
            'orderable' => false
        ],
        'email' => [
            'title' => 'email',
            'addClass' => 'text-center align-middle',
            'orderable' => false
        ],
        'phone' => [
            'title' => 'phone',
            'addClass' => 'text-center align-middle',
            'orderable' => false
        ],
        'gender' => [
            'title' => 'gender',
            'addClass' => 'text-center align-middle',
            'orderable' => false
        ],
        'contract_id' => [
            'title' => 'Mã hợp đồng',
            'addClass' => 'text-center align-middle',
            'orderable' => false
        ],
        'student-details' => [
            'title' => 'Danh sách học sinh',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'area' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => true
        ],
        'status' => [
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
    'school' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'address' => [
            'title' => 'address',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'province_code' => [
            'title' => 'province',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'district_code' => [
            'title' => 'district',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => true
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
        ],
        'student-details' => [
            'title' => 'Danh sách học sinh',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
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
    'discount_code' => [
        'DT_RowIndex' => [
            'title' => 'STT',
            'width' => '20px',
            'orderable' => false
        ],
        'name' => [
            'title' => 'Tên mã',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'discount' => [
            'title' => 'Giảm giá',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'apply_date' => [
            'title' => 'Ngày áp dụng',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'expiration_date' => [
            'title' => 'Ngày hết hạn',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'apply_qty' => [
            'title' => 'Số lượng áp dụng',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'text-center align-middle'
        ],
        'maximum_qty' => [
            'title' => 'Số lượng tối đa',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'text-center align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'topping' => [
        'name' => [
            'title' => 'Tên',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'price' => [
            'price' => 'Giá',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'avatar' => [
            'title' => 'Ảnh',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
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
    'vehicle' => [
        'id' => [
            'title' => 'Mã phương tiện',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'user' => [
            'title' => 'Chủ xe',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'name' => [
            'title' => 'Tên xe',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'brand' => [
            'title' => 'Hãng',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'color' => [
            'title' => 'Màu phương tiện',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'text-center align-middle'
        ],
        'type' => [
            'title' => 'Loại xe',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'license_plate' => [
            'title' => 'biển số xe',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'created_at' => [
            'title' => 'Ngày đặt',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'text-center align-middle'
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
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
    'store' => [
        'priority' => [
            'title' => 'priority',
            'orderable' => true
        ],
        'store_name' => [
            'title' => 'storeName',
            'orderable' => false
        ],
        'category' => [
            'title' => 'category2',
            'orderable' => false
        ],
        'area' => [
            'title' => 'area',
            'orderable' => false
        ],
        'open_hours_1' => [
            'title' => 'operatingTime',
            'orderable' => false,
            'visible' => false
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false
        ],
        'address_detail' => [
            'title' => 'address',
            'orderable' => false
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],

    ],
    'store_category' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
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
    'store_product' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => true
        ],
        'view-topping' => [
            'title' => 'Topping',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'view-discount' => [
            'title' => 'Discount',
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
    'category' => [
        'name' => [
            'title' => 'Tên danh mục',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'avatar' => [
            'title' => 'Hình ảnh',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'is_active' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'addClass' => 'align-middle'
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
    'attribute' => [
        'position' => [
            'title' => 'Vị trí',
            'orderable' => false,
        ],
        'name' => [
            'title' => 'Tên thuộc tính',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'type' => [
            'title' => 'Loại',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'variations' => [
            'title' => 'Các biến thể',
            'orderable' => false,
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
    'attributes_variations' => [
        'position' => [
            'title' => 'Vị trí',
            'orderable' => false,
        ],
        'name' => [
            'title' => 'Tên biến thể',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'desc' => [
            'title' => 'Mô tả',
            'orderable' => false,
        ],
        'action' => [
            'title' => 'Thao tác',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'product' => [
        'avatar' => [
            'title' => 'Ảnh',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'name' => [
            'title' => 'Tên',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'in_stock' => [
            'title' => 'Kho',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'price' => [
            'title' => 'Giá',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'is_user_discount' => [
            'title' => 'Chiếc khẩu',
            'orderable' => false,
            'addClass' => 'text-center align-middle'
        ],
        'categories' => [
            'title' => 'Danh mục',
            'orderable' => false,
            'visible' => false,
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
    'order' => [
        'id' => [
            'title' => 'Mã đơn hàng',
            'orderable' => false,
        ],
        'user' => [
            'title' => 'Thành viên',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'payment_code' => [
            'title' => 'Mã thanh toán',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'total' => [
            'title' => 'Tổng tiền',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'Ngày đặt',
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
            'title' => 'Ảnh',
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
        'is_featured' => [
            'title' => 'Nổi bật',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => false
        ],
        'created_at' => [
            'title' => 'Ngày tạo',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => false
        ],
//        'action' => [
//            'title' => 'Thao tác',
//            'orderable' => false,
//            'exportable' => false,
//            'printable' => false,
//            'addClass' => 'text-center align-middle'
//        ],
    ],
    'driver' => [
        'fullname' => [
            'title' => 'fullname',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'id_card' => [
            'title' => 'id_card',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'align-middle'
        ],
        'bank_name' => [
            'title' => 'bank_name',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
            'visible' => false
        ],
        'order_accepted' => [
            'title' => 'status',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => false
        ],
        'phone' => [
            'title' => 'Số điện thoại',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'email' => [
            'title' => 'Email',
            'orderable' => false,
            'addClass' => 'text-center align-middle',
            'visible' => true
        ],
        'license_plate' => [
            'title' => 'Biển số xe',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'address' => [
            'title' => 'Nơi ở hiện tại',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'trip-details' => [
            'title' => 'Danh sách chuyến đi',
            'addClass' => 'text-center align-middle',
            'orderable' => false,
        ],
        'contract_id' => [
            'title' => 'Mã hợp đồng',
            'addClass' => 'text-center align-middle',
            'orderable' => false
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
];
