<?php

return [
    [
        'title' => 'Dashboard',
        'routeName' => 'admin.dashboard',
        'icon' => '<i class="ti ti-home"></i>',
        'roles' => [],
        'permissions' => ['mevivuDev'],
        'sub' => []
    ],
    [
        'title' => 'Đơn liên hệ',
        'routeName' => null,
        'icon' => '<i class="ti ti-forms"></i>',
        'roles' => [],
        'permissions' => ['viewContact', 'updateContact', 'deleteContact'],
        'sub' => [
            [
                'title' => 'DS Đơn liên hệ',
                'routeName' => 'admin.contact.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewContact'],
            ]
        ]
    ],
    [
        'title' => 'Trường học',
        'routeName' => null,
        'icon' => '<i class="ti ti-book"></i>',
        'roles' => [],
        'permissions' => ['createSchool', 'viewSchool', 'updateSchool', 'deleteSchool'],
        'sub' => [
            [
                'title' => 'Thêm Trường học',
                'routeName' => 'admin.school.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createStudent'],
            ],
            [
                'title' => 'DS Trường học',
                'routeName' => 'admin.school.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewStudent'],
            ]
        ]
    ],
    [
        'title' => 'Bài viết',
        'routeName' => null,
        'icon' => '<i class="ti ti-article"></i>',
        'roles' => [],
        'permissions' =>
            [
                'createPost', 'viewPost', 'updatePost',
                'deletePost', 'viewPostCategory', 'createPostCategory', 'updatePostCategory'
            ],
        'sub' => [
            [
                'title' => 'Thêm bài viết',
                'routeName' => 'admin.post.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createPost'],
            ],
            [
                'title' => 'DS bài viết',
                'routeName' => 'admin.post.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewPost'],
            ],
            [
                'title' => 'DS chuyên mục',
                'routeName' => 'admin.post_category.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewPostCategory'],
            ]
        ]
    ],
    [
        'title' => 'Vai trò',
        'routeName' => null,
        'icon' => '<i class="ti ti-user-check"></i>',
        'roles' => [],
        'permissions' => ['createRole', 'viewRole', 'updateRole', 'deleteRole'],
        'sub' => [
            [
                'title' => 'Thêm Vai trò',
                'routeName' => 'admin.role.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createRole'],
            ],
            [
                'title' => 'DS Vai trò',
                'routeName' => 'admin.role.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewRole'],
            ]
        ]
    ],
    [
        'title' => 'Banner',
        'routeName' => null,
        'icon' => '<i class="ti ti-bookmark"></i>',
        'roles' => [],
        'permissions' => ['createSlider', 'viewSlider', 'updateSlider', 'deleteSlider'],
        'sub' => [
            [
                'title' => 'Thêm Banner',
                'routeName' => 'admin.slider.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createSlider'],
            ],
            [
                'title' => 'DS Banner',
                'routeName' => 'admin.slider.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewSlider'],
            ]
        ]
    ],
    [
        'title' => 'Admin',
        'routeName' => null,
        'icon' => '<i class="ti ti-user-shield"></i>',
        'roles' => [],
        'permissions' => ['createAdmin', 'viewAdmin', 'updateAdmin', 'deleteAdmin'],
        'sub' => [
            [
                'title' => 'Thêm admin',
                'routeName' => 'admin.admin.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
                'permissions' => ['createAdmin'],
            ],
            [
                'title' => 'DS admin',
                'routeName' => 'admin.admin.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
                'permissions' => ['viewAdmin'],
            ],
        ]
    ],
    [
        'title' => 'Cài đặt',
        'routeName' => null,
        'icon' => '<i class="ti ti-settings"></i>',
        'roles' => [],
        'permissions' => ['settingGeneral'],
        'sub' => [
            [
                'title' => 'Chung',
                'routeName' => 'admin.setting.general',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
                'permissions' => ['settingGeneral'],
            ],
            [
                'title' => 'Thành viên mua hàng',
                'routeName' => 'admin.setting.user_shopping',
                'icon' => '<i class="ti ti-user-cog"></i>',
                'roles' => [],
                'permissions' => [],
            ],
        ]
    ],
    // [
    //     'title' => 'Dev: Quyền',
    //     'routeName' => null,
    //     'icon' => '<i class="ti ti-code"></i>',
    //     'roles' => [],
    //     'permissions' => ['mevivuDev'],
    //     'sub' => [
    //         [
    //             'title' => 'Thêm Quyền',
    //             'routeName' => 'admin.permission.create',
    //             'icon' => '<i class="ti ti-plus"></i>',
    //             'roles' => [],
    //             'permissions' => ['mevivuDev'],
    //         ],
    //         [
    //             'title' => 'DS Quyền',
    //             'routeName' => 'admin.permission.index',
    //             'icon' => '<i class="ti ti-list"></i>',
    //             'roles' => [],
    //             'permissions' => ['mevivuDev'],
    //         ]
    //     ]
    // ],
    // [
    //     'title' => 'Dev: Module',
    //     'routeName' => null,
    //     'icon' => '<i class="ti ti-code"></i>',
    //     'roles' => [],
    //     'permissions' => ['mevivuDev'],
    //     'sub' => [
    //         [
    //             'title' => 'Thêm Module',
    //             'routeName' => 'admin.module.create',
    //             'icon' => '<i class="ti ti-plus"></i>',
    //             'roles' => [],
    //             'permissions' => ['mevivuDev'],
    //         ],
    //         [
    //             'title' => 'DS Module',
    //             'routeName' => 'admin.module.index',
    //             'icon' => '<i class="ti ti-list"></i>',
    //             'roles' => [],
    //             'permissions' => ['mevivuDev'],
    //         ]
    //     ]
    // ],
    // [
    //     'title' => 'Dev: Nghiệm thu',
    //     'routeName' => 'admin.module.summary',
    //     'icon' => '<i class="ti ti-code"></i>',
    //     'roles' => [],
    //     'permissions' => ['mevivuDev'],
    //     'sub' => []
    // ]
];
