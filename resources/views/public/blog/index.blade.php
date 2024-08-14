@extends('public.layouts.master')

@section('content')
    <section class="my-5 section-1">
        <div class="container-xl">
            <div class="page-title justify-content-center mb-5">
                <h1 class="text-uppercase">{{ __('Tin tức') }}</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <div class="row">
                        @foreach ($posts as $item)
                            <x-link :href="route('blog.show', $item->slug)"
                                class="col-lg-4 col-12 text-center animate__animated animate__fadeInLeft animate__slow text-decoration-none">
                                <img src="{{ asset($item->image) }}" class="object-cover card-img-start img-fluid rounded-3"
                                    alt="{{ $item->title }}" width="252" height="252">
                                <p class="text-uppercase fw-bold text-center px-3 pt-3 text-dark">
                                    {{ $item->title }}
                                </p>

                                <h5>
                                    @foreach ($item->categories as $category)
                                        <span class="badge">{{ $category->name }}</span>
                                    @endforeach
                                </h5>

                                <div class="is-diviner mx-auto my-1"></div>
                            </x-link>
                        @endforeach
                    </div>
                    {{ $posts->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
