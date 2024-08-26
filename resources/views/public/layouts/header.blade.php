<div class="header-main shadow sticky-top">
    <nav class="navbar navbar-expand-lg sticky-top p-0 container align-items-center">
        <div class="d-lg-none d-block col-4 text-start ps-3">
            <i class="fa-solid fa-bars fs-3 text-white bg-gray-500 rounded-5 p-2" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"></i>
        </div>
        <div class="col-lg-2 col-md-4 col-4 text-center">
            <x-link :href="route('home.index')">
                <img src="{{ asset($settings['site_logo']) }}" width="164" height="96">
            </x-link>
        </div>

        <div class="d-lg-none d-block col-4 text-end pe-3">
            {{-- <i class="ti ti-car"></i> --}}
            <x-link :href="route('form.findcar')" class="text-decoration-none fs-3 text-white bg-danger rounded-5 p-2 shadow-lg">
                <img alt="Findcar" src="{{ asset('public/assets/images/car-svgrepo-com.svg') }}" width="15%">
                <span class="ms-2">
                    {{ __('Tìm xe') }}
                </span>
            </x-link>
        </div>
        <div class="col-lg-8 col-md-6">
            <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                <div class="navbar-nav p-4 p-lg-0">
                    <x-link :href="route('home.index')" :title="__('Về Babi2School')"
                        class="nav-item nav-link fw-bold {{ Request::routeIs('home.index') ? 'active' : '' }}" />
                    <x-link :href="route('product.index')" :title="__('Sản phẩm')"
                        class="nav-item nav-link fw-bold {{ Request::routeIs('product.index') ? 'active' : '' }}" />
                    <x-link :href="route('process.index')" :title="__('Quy trình đưa đón')"
                        class="nav-item nav-link fw-bold {{ Request::routeIs('process.index') ? 'active' : '' }}" />
                    <x-link :href="route('form.contact')" :title="__('Liên hệ')"
                        class="nav-item nav-link fw-bold {{ Request::routeIs('form.contact') ? 'active' : '' }}" />
                    <x-link :href="route('blog.index')" :title="__('Tin tức')"
                        class="nav-item nav-link fw-bold {{ Request::routeIs('blog.index') ? 'active' : '' }}" />
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 d-lg-block d-none">
            <div class="d-flex gap-2 align-items-center">
                <x-link :href="route('form.findcar')" :title="__('Tìm xe')"
                    class="btn btn-danger d-none d-lg-block rounded-2 text-uppercase" />
                <div class="gtranslate_wrapper"></div>
            </div>
        </div>
    </nav>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title text-uppercase" id="offcanvasRightLabel">Babi2School</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-unstyled">
            <li>
                <x-link :href="route('home.index')" :title="__('Về Babi2School')" class="nav-item nav-link text-uppercase mb-3" />
            </li>
            <li>
                <x-link :href="route('product.index')" :title="__('Sản phẩm')" class="nav-item nav-link text-uppercase mb-3" />
            </li>
            <li>
                <x-link :href="route('process.index')" :title="__('Quy trình đưa đón')" class="nav-item nav-link text-uppercase mb-3" />
            </li>
            <li>
                <x-link :href="route('form.contact')" :title="__('Liên hệ')" class="nav-item nav-link text-uppercase mb-3" />
            </li>
            <li>
                <x-link :href="route('blog.index')" :title="__('Tin tức')" class="nav-item nav-link text-uppercase mb-3" />
            </li>
        </ul>
    </div>
</div>
