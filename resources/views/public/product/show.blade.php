@extends('public.layouts.master')

<head>
    <meta property="og:title" content="{{ $product['title_seo'] ?? '' }}" />
    <meta property="og:description" content="{{ $product['desc_seo'] ?? '' }}" />
    <meta property="og:image" content="{{ url($product['image'] ?? '') }}" />
    <title>@yield('title', $product['title'])</title>
</head>


@section('content')
    <div class="py-3 d-md-block d-none"></div>
    <main class="container pt-3 pb-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center text-uppercase fw-bold">{{ $product->title }}</h1>
                <div class="is-diviner mx-auto d-md-block d-none"></div>
                @if ($product['show_banner'] == true)
                    <div class="banner has-hover" id="banner-animation">
                        <div class="banner-bg fill">
                            <div class="bg fill bg-fill bg-loaded"
                                style="background-image: url({{ asset($product['banner']) }})"></div>
                            <div class="bg-effect fill"></div>
                            <div
                                class="banner-content position-absolute top-50 start-50 translate-middle text-center w-100">
                                <div class="content-banner animate__animated animate__flipInY animate__slow">
                                    <div class="is-diviner mx-auto d-md-block d-none"></div>
                                    <h2 class="text-white mb-3 text-uppercase mx-auto">
                                        <b>{!! $product['banner_title'] !!}</b>
                                    </h2>
                                    <div class="is-diviner mx-auto d-md-block d-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <p>{!! $product['content'] !!}</p>
                <p class="text-center">- - -</p>
                @include('public.blog.include.lien-he')
            </div>
            <div class="col-12">
                <div class="py-1">
                    @include('public.product.include.sidebar')
                </div>
            </div>
        </div>
    </main>
@endsection

@push('custom-js')
@endpush
