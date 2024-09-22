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
                        @forelse ($posts as $item)
                            <div
                                class="col-xl-4 col-lg-6 col-12 text-center animate__animated animate__fadeInLeft animate__slow text-decoration-none mb-3">
                                <x-link :href="route('blog.show', $item->slug)">
                                    <div class="card d-flex flex-column h-100">
                                        <!-- Photo -->
                                        <div class="img-responsive img-responsive-1x1 card-img-top"
                                            style="background-image: url({{ asset($item->image) }})">
                                        </div>
                                        <div class="card-body">
                                            <h3 class="card-title text-dark clamped-text">{{ $item->title }}</h3>
                                        </div>
                                        <div class="card-footer">
                                            @foreach ($item->categories as $category)
                                                <span class="badge">{{ $category->name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </x-link>
                            </div>
                        @empty
                            <p class="text-center">Chưa có tin tức nào được đăng!</p>
                        @endforelse
                    </div>

                    {{ $posts->appends(request()->all())->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
