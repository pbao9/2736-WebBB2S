@extends('public.layouts.master')

<head>
    <meta property="og:title" content="{{ $posts['title_seo'] ?? '' }}" />
    <meta property="og:description" content="{{ $posts['desc_seo'] ?? '' }}" />
    <meta property="og:image" content="{{ url($posts['image'] ?? '') }}" />
    <title>@yield('title', $posts['title'])</title>
</head>


@section('content')
    <main class="container py-5">
        <div class="row">
            <div class="col-md-12 col-12 pe-lg-3 pe-0">
                <h1 class="text-center text-uppercase fw-bold">{{ $posts->title }}</h1>
                <div class="is-diviner mx-auto"></div>
                <p>{!! $posts['content'] !!}</p>
                <p>{{ __('Ngày đăng: ') . ' ' . $posts['created_at'] }}</p>
                <p class="text-center">- - -</p>
                @include('public.blog.include.lien-he')
            </div>
            <aside class="col-md-12">
                <div class="py-1">
                    @include('public.blog.include.sidebar')
                </div>
            </aside>
        </div>
    </main>
@endsection

@push('custom-js')
@endpush
