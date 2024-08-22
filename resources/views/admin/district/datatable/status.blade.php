<span @class([
    'badge',
    App\Enums\School\SchoolStatus::from($status)->badge(),
])>{{ \App\Enums\School\SchoolStatus::getDescription($status) }}</span>
