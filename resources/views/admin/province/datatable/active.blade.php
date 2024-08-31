<span @class([
    'badge',
    App\Enums\Province\ProvinceActive::from($active)->badge(),
])>{{ \App\Enums\Province\ProvinceActive::getDescription($active) }}</span>
