<div class="section-1 my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 mb-4 animate__animated animate__fadeInLeft animate__slow">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <x-link :href="route('blog.blog1')">
                        <img class="d-block mx-auto" src="{{ asset('public/assets/images/img-sec2-1.png') }}"
                            width="322" height="322">
                    </x-link>
                    <x-link :href="route('blog.blog1')" :title="__('Babi2School App')"
                        class="fw-bold text-uppercase nav-link mx-auto is-large" />
                    <div class="is-diviner"></div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-4 animate__animated animate__fadeInLeft animate__slow">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <x-link :href="route('blog.blog2')">
                        <img class="d-block mx-auto" src="{{ asset('public/assets/images/img-sec2-2.png') }}"
                            width="322" height="322">
                    </x-link>
                    <x-link :href="route('blog.blog2')" :title="__('Dịch vụ đưa đón 01 chiều')"
                        class="fw-bold text-uppercase nav-link mx-auto is-large" />
                    <div class="is-diviner"></div>
                </div>
            </div>
            <div class="col-lg-4 col-12 mb-4 animate__animated animate__fadeInLeft animate__slow">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <x-link :href="route('blog.blog3')">
                        <img class="d-block mx-auto" src="{{ asset('public/assets/images/img-sec2-3.png') }}"
                            width="322" height="322">
                    </x-link>
                    <x-link :href="route('blog.blog3')" :title="__('Dịch vụ đưa đón 02 chiều')"
                        class="fw-bold text-uppercase nav-link mx-auto is-large" />
                    <div class="is-diviner"></div>
                </div>
            </div>
        </div>
    </div>

</div>
