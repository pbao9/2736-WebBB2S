<?php

use App\Enums\Contact\ContactStatus;
use App\Enums\Contact\ContactType;
use App\Enums\Contact\UserType;
use App\Enums\Contract\ContractStatus;
use App\Enums\Contract\ContractTerm;
use App\Enums\Contract\ContractType;
use App\Enums\DefaultStatus;
use App\Enums\Driver\DriverStatus;
use App\Enums\Event\EventType;
use App\Enums\Post\PostStatus;
use App\Enums\PostCategory\PostCategoryStatus;
use App\Enums\Module\ModuleStatus;
use App\Enums\Notification\NotificationType;
use App\Enums\Notification\NotificationStatus;
use App\Enums\ScheduleOff\ScheduleOffType;
use App\Enums\School\SchoolStatus;
use App\Enums\Slider\SliderType;
use App\Enums\Trip\PickupStatus;
use App\Enums\Trip\TripStatus;
use App\Enums\Session\Session;
use App\Enums\Setting\SettingGroup;
use App\Enums\Slider\SliderStatus;
use App\Enums\Student\StudentGrade;
use App\Enums\User\{Gender};

return [
    NotificationType::class => [
        NotificationType::All => 'Tất cả',
        NotificationType::Driver => 'Tài xế',
        NotificationType::Parent => 'Phụ huynh',
        NotificationType::Nany => 'Giám sinh',
    ],
    ContractType::class => [
        ContractType::PickUpOnly->value => 'Chỉ đón đi',
        ContractType::DropOffOnly->value => 'Chỉ đón về',
        ContractType::Both->value => 'Cả hai',
    ],
    ContractStatus::class => [
        ContractStatus::Active => 'Đang hoạt động',
        ContractStatus::Stopped => 'Đã kết thúc hợp đồng',
        ContractStatus::Draft => 'Bản nháp',
        ContractStatus::Ready => 'Sẵn sàng',
    ],
    NotificationStatus::class => [
        NotificationStatus::NOT_READ->value => 'Chưa xem',
        NotificationStatus::READ->value => 'Đã xem',
    ],
    ContractTerm::class => [
        ContractTerm::Valid->value => 'Hợp Đồng Còn Hiệu Lực',
        ContractTerm::Expired->value => 'Hợp Đồng Không Còn Hiệu Lực',
    ],
    PickupStatus::class => [
        PickupStatus::Skipped->value => 'Bỏ qua',
        PickupStatus::ExcusedAbsence->value => 'Xin nghỉ',
        PickupStatus::ArrivedAtSchool->value => 'Đã tới trường',
        PickupStatus::ArrivedAtHome->value => 'Đã về nhà',
        PickupStatus::NotPickedToSchool->value => 'Chưa được đón đi',
        PickupStatus::PickedUpToSchool->value => 'Đã đón đi',
        PickupStatus::NotPickedFromSchool->value => 'Chưa được đón về',
        PickupStatus::PickedUpFromSchool->value => 'Đã đón về',
    ],

    Session::class => [
        Session::Morning => 'Sáng',
        Session::Afternoon => 'Chiều',
    ],
    SliderType::class => [
        SliderType::Staff->value => 'Nhân viên',
        SliderType::Parent->value => 'Phụ huynh',
    ],
    EventType::class => [
        EventType::Off->value => 'Xin nghỉ',
    ],
    ScheduleOffType::class => [
        ScheduleOffType::Public->value => 'Chung',
        ScheduleOffType::Private->value => 'Riêng',
        ScheduleOffType::Normal->value => 'Không phân loại',
    ],
    TripStatus::class => [
        TripStatus::Active->value => 'Đang hoạt động',
        TripStatus::Pending->value => 'Đang chờ',
        TripStatus::Completed->value => 'Hoàn thành',
        TripStatus::Cancelled->value => 'Huỷ bỏ',
        TripStatus::Holiday->value => 'Nghỉ lễ',
    ],
    StudentGrade::class => [
        StudentGrade::Grade1 => 'Lớp 1',
        StudentGrade::Grade2 => 'Lớp 2',
        StudentGrade::Grade3 => 'Lớp 3',
        StudentGrade::Grade4 => 'Lớp 4',
        StudentGrade::Grade5 => 'Lớp 5',
        StudentGrade::Grade6 => 'Lớp 6',
        StudentGrade::Grade7 => 'Lớp 7',
        StudentGrade::Grade8 => 'Lớp 8',
        StudentGrade::Grade9 => 'Lớp 9',
        StudentGrade::Seed => 'Lớp mầm non',
    ],
    Gender::class => [
        Gender::Male->value => 'Nam',
        Gender::Female->value => 'Nữ',
        Gender::Other->value => 'Khác',
    ],
    DriverStatus::class => [
        DriverStatus::Active->value => 'Đang hoạt động',
        DriverStatus::OnBreak->value => 'Không hoạt động',
    ],
    SliderStatus::class => [
        SliderStatus::Active->value => 'Hoạt động',
        SliderStatus::InActive->value => 'Ngưng hoạt động'
    ],
    SettingGroup::class => [
        SettingGroup::General => 'Chung',
        SettingGroup::UserDiscount => 'Chiếc khấu mua hàng theo cấp TV',
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
    UserType::class => [
        UserType::parent->value => 'Phụ Huynh',
        UserType::school->value => 'Trường học',
    ],
    SchoolStatus::class => [
        SchoolStatus::Active->value => 'Hoạt động',
        SchoolStatus::InActive->value => 'Không Hoạt động',
    ],
];
