@extends('public.layouts.master')

@section('content')
    {{-- <div class="section-1 my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 mb-4 animate__animated animate__fadeInLeft animate__slow">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <x-link :href="route('blog.blog1')">
                        <img class="d-block mx-auto" src="{{ asset('public/assets/images/img-sec2-1.png') }}"
                            width="252" height="252">
                    </x-link>
                    <x-link :href="route('blog.blog1')" :title="__('Babi2School App')"
                        class="fw-bold text-uppercase nav-link mx-auto is-large mt-2" />
                    <div class="is-diviner"></div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-4 animate__animated animate__fadeInLeft animate__slow">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <x-link :href="route('blog.blog2')">
                        <img class="d-block mx-auto" src="{{ asset('public/assets/images/img-sec2-2.png') }}"
                            width="252" height="252">
                    </x-link>
                    <x-link :href="route('blog.blog2')" :title="__('Dịch vụ đưa đón 01 chiều')"
                        class="fw-bold text-uppercase nav-link mx-auto is-large mt-2" />
                    <div class="is-diviner"></div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-4 animate__animated animate__fadeInLeft animate__slow">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <x-link :href="route('blog.blog3')">
                        <img class="d-block mx-auto" src="{{ asset('public/assets/images/img-sec2-3.png') }}"
                            width="252" height="252">
                    </x-link>
                    <x-link :href="route('blog.blog3')" :title="__('Dịch vụ đưa đón 02 chiều')"
                        class="fw-bold text-uppercase nav-link mx-auto is-large mt-2" />
                    <div class="is-diviner"></div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

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
