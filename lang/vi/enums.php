<?php

use App\Enums\Contact\ContactStatus;
use App\Enums\Contact\ContactType;
use App\Enums\Contact\UserType;
use App\Enums\Contact\ContactService;
use App\Enums\Post\PostStatus;
use App\Enums\PostCategory\PostCategoryStatus;
use App\Enums\Module\ModuleStatus;
use App\Enums\Notification\NotificationType;
use App\Enums\Notification\NotificationStatus;
use App\Enums\Product\ProductStatus;
use App\Enums\School\SchoolStatus;
use App\Enums\Slider\SliderType;
use App\Enums\Session\Session;
use App\Enums\Setting\SettingGroup;
use App\Enums\Slider\SliderStatus;
use App\Enums\User\{Gender};

return [
    NotificationType::class => [
        NotificationType::All => 'Tất cả',
        NotificationType::Driver => 'Tài xế',
        NotificationType::Parent => 'Phụ huynh',
        NotificationType::Nany => 'Giám sinh',
    ],
    NotificationStatus::class => [
        NotificationStatus::NOT_READ->value => 'Chưa xem',
        NotificationStatus::READ->value => 'Đã xem',
    ],
    SliderType::class => [
        SliderType::Staff->value => 'Nhân viên',
        SliderType::Parent->value => 'Phụ huynh',
    ],
    Gender::class => [
        Gender::Male->value => 'Nam',
        Gender::Female->value => 'Nữ',
        Gender::Other->value => 'Khác',
    ],
    SliderStatus::class => [
        SliderStatus::Active->value => 'Hoạt động',
        SliderStatus::InActive->value => 'Ngưng hoạt động'
    ],
    SettingGroup::class => [
        SettingGroup::General => 'Chung',
        SettingGroup::Company => 'Công ty',
        SettingGroup::UserUpgrade => 'SL SP nâng cấp TV',
    ],
    PostCategoryStatus::class => [
        PostCategoryStatus::Published => 'Đã xuất bản',
        PostCategoryStatus::Draft => 'Bản nháp'
    ],
    PostStatus::class => [
        PostStatus::Published->value => 'Đã xuất bản',
        PostStatus::Draft->value => 'Bản nháp'
    ],

    ModuleStatus::class => [
        ModuleStatus::ChuaXong => 'Chưa xong',
        ModuleStatus::DaXong => 'Đã xong',
        ModuleStatus::DaDuyet => 'Đã duyệt'
    ],
    ContactType::class => [
        ContactType::findCar->value => 'Đơn Tìm xe',
        ContactType::forParent->value => 'Đơn Phụ huynh',
        ContactType::forSchool->value => 'Đơn Trường học',
    ],
    ContactStatus::class => [
        ContactStatus::contacted->value => 'Đã liên hệ',
        ContactStatus::notContacted->value => 'Chưa liên hệ',
    ],
    ContactService::class => [
        ContactService::Both->value => 'Hai chiều',
        ContactService::PickUpOnly->value => 'Chỉ đón đi',
        ContactService::DropOffOnly->value => 'Chỉ đón về',
    ],
    UserType::class => [
        UserType::parent->value => 'Phụ Huynh',
        UserType::school->value => 'Trường học',
    ],
    SchoolStatus::class => [
        SchoolStatus::Active->value => 'Hoạt động',
        SchoolStatus::InActive->value => 'Không Hoạt động',
    ],
    Session::class => [
        Session::morning->value => 'Buổi sáng',
        Session::afternoon->value => 'Buổi chiều',
    ],
    ProductStatus::class => [
        ProductStatus::Published->value => 'Đã xuất bản',
        ProductStatus::Draft->value => 'Bản nháp'
    ],
];
