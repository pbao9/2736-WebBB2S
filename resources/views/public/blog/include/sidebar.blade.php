<div class="d-flex align-item-center justify-content-between">
    <h2 class=" text-dark fw-bold text-uppercase title-sidebar pb-2">@lang(__('Bài viết liên quan gần đây'))</h2>
    <x-link :href="route('blog.index')">
        <span>{{ __('Xem tất cả') }}</span>
        <i class="fa-solid fa-arrow-right-long px-1"></i>
    </x-link>
</div>
<div class="container">
    <div class="owl-carousel owl-carousel-2">
        @foreach ($related as $item)
            <div class="item">
                <div class="d-flex flex-column animate__animated animate__fadeInLeft animate__slow tex-dark">
                    <x-link :href="route('blog.show', $item['slug'])">
                        <div class="card">
                            <div class="img-responsive img-responsive-16x9 card-img-top object-fit-contain"
                                style="background-image: url({{ asset($item['image']) }})" alt="{{ $item['title'] }}">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title text-dark"> {{ __($item['title']) }}</h3>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div class="d-flex text-dark align-items-center">
                                    {{ $item['viewed'] }}
                                    <span class="fs-3 px-1">{{ __('Lượt xem') }}</span>
                                </div>
                                <div class="text-dark">
                                    {{ \Carbon\Carbon::parse($item['created_at'])->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    </x-link>
                </div>
            </div>
        @endforeach
    </div>
</div>


{{-- <x-link :href="route('product.show', $item['slug'])"> --}}
