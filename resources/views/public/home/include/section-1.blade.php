<div class="section-1 my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 mb-4 animate__animated animate__fadeInLeft animate__slow">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    @foreach ($products as $item)
                        <x-link :href="route('product.show', $item['slug'])">
                            <img class="d-block mx-auto" src="{{ asset($item['avatar']) }}" width="322" height="322">
                        </x-link>
                        <x-link :href="route('product.show', $item['slug'])" :title="__($item['title'])"
                            class="fw-bold text-uppercase nav-link mx-auto is-large" />
                        <div class="is-diviner"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
