<span @class([
    'badge',
    App\Enums\Contact\ContactType::from($form_type)->badge(),
])>{{ \App\Enums\Contact\ContactType::getDescription($form_type) }}</span>
