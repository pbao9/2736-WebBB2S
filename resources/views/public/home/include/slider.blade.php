<div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @if ($slider = $sliders->firstWhere('plain_key', config('custom.sliders.banner-1-slider')))
                @foreach ($slider->items as $sliderItem)
                    <div @class(['carousel-item', 'active' => $loop->first]) data-bs-interval="10000">
                        <img src="{{ asset($sliderItem->image) }}" class="d-block w-100  object-cover" alt="Slide Image"
                            height="684">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-7 d-flex justify-content-center flex-column">
                                        <div class="banner-content d-flex flex-column justify-content-center">
                                            <h2 class="text-light mb-4 pb-3 fancy-underline mx-auto d-inline-block text-uppercase">
                                                <strong>{{ $sliderItem->title }}</strong>
                                            </h2>
                                            <span>{!! $sliderItem->describe !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

