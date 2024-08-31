<span @class([
    'badge',
    App\Enums\Contact\ContactStatus::from($status)->badge(),
])>{{ \App\Enums\Contact\ContactStatus::getDescription($status) }}</span>
