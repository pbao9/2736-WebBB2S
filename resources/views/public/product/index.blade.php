@extends('public.layouts.master')

@section('content')
    <section class="my-5 section-1">
        <div class="container-xl">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12">
                    <div class="row">
                        @foreach ($products as $item)
                            <x-link :href="route('product.show', $item->slug)"
                                class="col-lg-4 col-12 text-center animate__animated animate__fadeInLeft animate__slow text-decoration-none mb-3">
                                <img src="{{ asset($item->image) }}" class="object-cover card-img-start img-fluid "
                                    alt="{{ $item->title }}" width="252" height="252">
                                <p class="text-uppercase fw-bold text-center pt-3 text-dark mb-1">
                                    {{ $item->title }}
                                </p>
                                <div class="is-diviner mx-auto my-1"></div>
                            </x-link>
                        @endforeach
                    </div>
                    {{ $products->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
