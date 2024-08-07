<button type="button" {{ $attributes->class(['btn', 'btn-danger', 'open-modal-confirm'])
    ->merge([
        'data-bs-toggle' => 'modal',
        'data-bs-target' => '#modalConfirm',
    ]) }}>
    {{ $title ?? '' }}
    {{ $slot }}
</button>

