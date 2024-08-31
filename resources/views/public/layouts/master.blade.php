<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('public.layouts.head')
</head>

<body>
    <div class="page">
        @include('public.layouts.header')

        <main>
            @yield('content')
        </main>

        @include('public.layouts.footer')

        @include('admin.layouts.modal.modal-delete')

        @include('admin.layouts.modal.modal-delete')

        @include('public.layouts.scripts')

        <x-alert />
    </div>

</body>

</html>
