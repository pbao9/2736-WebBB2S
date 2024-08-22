@extends('public.layouts.master')

<head>
    <meta property="og:title" content="{{ $product['title_seo'] ?? '' }}" />
    <meta property="og:description" content="{{ $product['desc_seo'] ?? '' }}" />
    <meta property="og:image" content="{{ url($product['image'] ?? '') }}" />
    <title>@yield('title', $product['title'])</title>
</head>


@section('content')
    <main class="container py-5">
        <div class="row">
            <div class="col-lg-9 col-12 pe-lg-3 pe-0">
                <h1 class="text-center text-uppercase fw-bold">{{ $product->title }}</h1>
                <div class="is-diviner mx-auto"></div>
                @if ($product['show_banner'] == true)
                    <div class="banner has-hover" id="banner-animation">
                        <div class="banner-bg fill">
                            <div class="bg fill bg-fill bg-loaded"
                                style="background-image: url({{ asset($product['banner']) }})"></div>
                            <div class="bg-effect fill"></div>
                            <div
                                class="banner-content position-absolute top-50 start-50 translate-middle text-center w-100">
                                <div class="content-banner mx-5 px-5  animate__animated animate__flipInY animate__slow">
                                    <div class="is-diviner mx-auto"></div>
                                    <h1 class="text-white mb-3 text-uppercase">
                                        <b>{!! $product['banner_title'] !!}</b>
                                    </h1>

                                    <div class="is-diviner mx-auto"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                <p>{!! $product['content'] !!}</p>
                <p class="text-center">- - -</p>
                @include('public.blog.include.lien-he')
            </div>
            <aside class="col-lg-3 col-12 sidebar">
                <div class="py-1">
                    @include('public.product.include.sidebar')

                </div>
            </aside>
        </div>
    </main>
@endsection

@push('custom-js')
@endpush
