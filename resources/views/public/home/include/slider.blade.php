<div class="main-carousel">
    @if ($slider = $sliders->firstWhere('plain_key', config('custom.sliders.banner-1-slider')))
        @foreach ($slider->items as $sliderItem)
            <div @class(['carousel-cell', 'active' => $loop->first])>
                <img src="{{ asset($sliderItem->image) }}" class="d-block w-100  object-cover" alt="Slide Image"
                    height="100%">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 d-flex justify-content-center flex-column">
                                <div class="banner-content d-flex flex-column justify-content-center">
                                    <h2
                                        class="text-light mb-4 pb-3 fancy-underline mx-auto d-inline-block text-uppercase">
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
