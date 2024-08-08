<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url-home" content="{{ url('/') }}">
    <meta name="position_currency" content="{{ config('custom.format.position_currency') }}">
    <title>@yield('title', $settings['site_name'])</title>

{{--    <link rel="shortcut icon" href="{{ asset(config('custom.images.favicon')) }}" type="image/x-icon" />--}}
    <link rel="shortcut icon" href="{{ asset($settings['favi_icon']) }}" type="image/x-icon" />

    <link href="{{ asset('public/libs/tabler/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/libs/tabler/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/libs/tabler/plugins/tabler-icon/webfont/tabler-icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/libs/Parsley.js-2.9.2/style.css') }}" rel="stylesheet" />

    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" /> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/libs/select2/dist/css/select2-bootstrap-5-theme.min.css') }}">
    @stack('libs-css')
    @stack('custom-css')
</head>
