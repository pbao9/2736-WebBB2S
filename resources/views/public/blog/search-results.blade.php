@extends('public.layouts.master')


@section('content')
    <section class="bg-white">
        <div class="container">
            <div class="row py-3 justify-content-between align-items-start">
                <div class="col-md-9 col-12">
                    @if ($posts->count() > 0)
                        @foreach ($posts as $post)
                            <div class="card mb-3">
                                <div class="row row-0">
                                    <div class="col-lg-3 col-12">
                                        <img src="{{ asset($post->feature_image ?? 'assets/images/feature_post_3.jpg') }}"
                                            class="w-100 h-100 object-fit-contain card-img-start" alt="image_post">
                                    </div>
                                    <div class="col-lg-9 col-12 d-flex align-items-center">
                                        <div class="card-body">
                                            <a href="{{ route('blog.show', $post->slug) }}"
                                                class="fs-2 fw-bold text-brown text-decoration-none">{{ $post->title }}</a>
                                            <p class="text-muted py-2">{{ $post->excerpt }}</p>
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div class="d-flex align-items-center gap-2">
                                                    <p class="text-muted mb-0"><strong>Ngày đăng:</strong>
                                                        {{ \Carbon\Carbon::parse($post->posted_at)->format('d/m/Y') }}
                                                    </p>
                                                </div>
                                                <a href="{{ route('post.show', $post->slug) }}"
                                                    class="text-decoration-none text-brown">Xem thêm <i
                                                        class="fa-solid fa-arrow-right-long px-2"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @else
                        <div class="alert alert-warning" role="alert">
                            {{ trans('Không có kết quả tìm kiếm nào phù hợp với yêu cầu của bạn.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
