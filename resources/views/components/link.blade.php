<a {{ $attributes }} class="text-decoration-none">

    {{ $slot }}

    @isset($title)
        <span>{{ $title }}</span>
    @endisset

    @isset($append)
        {{ $append }}
    @endisset
</a>
