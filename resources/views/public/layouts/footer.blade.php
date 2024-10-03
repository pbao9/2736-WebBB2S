<footer class="container-fluid">
    <div class="container-fluid">
        <div class="row justify-content-center py-5 ">
            <div class="col-12 col-xl-3 col-lg-12 col-md-12 mb-3 text-lg-center text-left">
                <img class="mb-2" width="125px" height="125px" src="{{ asset($settings['logo_footer']) }}">
                <h2 class="mx-lg-auto me-auto">{!! $settings['introduce'] !!}
                </h2>
            </div>
            <div class="col-12 col-xl-3 col-lg-12 col-md-12 mb-3">
                <h2 class="m-0 mb-3">{{ $settings['slogan'] }}</h2>
                <p class="mb-2 fw-bold">{{ $settings['company'] }}</p>
                <p class="mb-2 fw-bold">
                    {{ __('Địa chỉ: ') }}
                    <span class="fw-normal">{{ $settings['address'] }}</span>
                </p>
                <p class="mb-2 fw-bold">
                    {{ __('Mã số doanh nghiệp: ') }}
                    <span class="fw-normal">{{ $settings['tax_code'] }}</span>
                </p>
                <p class="mb-2 fw-bold">{{ __('Hotline:') }} <span
                        class="fw-normal">{{ $settings['hotline'] . ' - ' . $settings['hotline-1'] }}</span></p>
                <p class="mb-2 fw-bold">{{ __('Email:') }} <span class="fw-normal">{{ $settings['email'] }}</span></p>
            </div>
            <div class="col-12 col-xl-3 col-lg-12 col-md-12 mb-3">
                <div class="col-service text-center">
                    <h2 class="text-black fw-bold text-uppercase mb-3 mx-auto">{{ __('Sản phẩm') }}</h2>
                    <ul class="list-unstyled d-flex align-items-center flex-column">
                        @foreach ($products as $item)
                            <li class="mb-2">
                                <x-link :href="route('product.show', $item['slug'])" :title="__($item['title'])"
                                    class="text-decoration-none nav-link fs-3 nav-link" />
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="col-12 col-xl-3 col-lg-12 col-md-12 mb-3 text-center">
                <div class="fb-page" data-href="https://www.facebook.com/BabiToSchool" data-tabs="" data-width="500"
                    data-height="200" data-small-header="false" data-adapt-container-width="true"
                    data-hide-cover="false" data-show-facepile="false">
                    <blockquote cite="https://www.facebook.com/BabiToSchool" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/BabiToSchool">Babi2School</a>
                    </blockquote>
                </div>

            </div>
        </div>
    </div>

    <hr class="m-0">
    <div class="container py-3 text-center">
        <span class="text-white">
            Copyright <?php echo date('Y'); ?> © <strong>Babi2School</strong>
        </span>
    </div>
</footer>

@include('public.components.floating-button')
