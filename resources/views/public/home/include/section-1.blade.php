{{-- <div class="section-1 my-5">
    <div class="container">
        <div class="row">
            @foreach ($products as $item)
                <div class="col-lg-4 col-12 mb-4 animate__animated animate__fadeInLeft animate__slow">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <x-link :href="route('product.show', $item['slug'])">
                            <img class="d-block mx-auto" src="{{ asset($item['image']) }}" width="322" height="322">
                        </x-link>
                        <x-link :href="route('product.show', $item['slug'])" :title="__($item['title'])"
                            class="fw-bold text-uppercase nav-link mx-auto is-large" />
                        <div class="is-diviner"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> --}}
<div class="section-1 my-5">
    <div class="container">
        <div class="owl-carousel">
            @foreach ($products as $item)
                <div class="item">
                    <div class="d-flex flex-column animate__animated animate__fadeInLeft animate__slow">
                        <x-link :href="route('product.show', $item['slug'])">
                            <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="mb-3" />
                        </x-link>
                        <x-link :href="route('product.show', $item['slug'])" class="fw-bold text-uppercase nav-link mx-auto is-large">
                            <span class="text-center">
                                {{ __($item['title']) }}
                            </span>
                        </x-link>
                        <div class="is-diviner mx-auto"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
