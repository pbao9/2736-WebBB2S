<footer class="container-fluid">
    <div class="container-fluid">
        <div class="row justify-content-center py-5 ">
            <div class="col-12 col-lg-3 mb-3">
                <img class="d-block mx-auto" width="125px" height="125px" style="margin-bottom: 20px"
                     src="{{ asset($settings['logo_footer']) }}">
                <h2 class="mb-2 mx-auto text-uppercase">Dịch vụ công nghệ</h2>
                <h2 class="mb-2 mx-auto mb-3 text-uppercase">Đưa đón học sinh bằng xe 7 chỗ</h2>
                {{-- <div class="text-center d-flex flex-column align-items-center">
                    <p class="nav-link fw-bold mb-2">{{__('DỊCH VỤ CÔNG NGHỆ')}}</p>
                    <p class="nav-link fw-bold mb-2">{{__('ĐƯA ĐÓN HỌC SINH')}}</p>
                    <p class="nav-link fw-bold mb-2">{{__('BẰNG XE ÔTÔ')}}</p>
                </div> --}}
            </div>
            <div class="col-12 col-lg-3 mb-3">
                <h2 class="mb-3 mx-auto">BABI2SCHOOL - AN TOÀN ĐẾN TRƯỜNG</h2>
                <p class="mb-2 fw-bold">Công ty cổ phần Kỹ thuật Công nghệ HP</p>
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
            <div class="col-12 col-lg-3 mb-3 d-lg-block d-flex justify-content-center align-items-center flex-column">
                <h2 class="text-black fw-bold">DỊCH VỤ</h2>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <x-link :href="route('blog.blog1')" :title="__('Ứng dụng Babi2School')"
                                class="text-decoration-none nav-link fs-3 nav-link"/>
                    </li>
                    <li class="mb-2">
                        <x-link :href="route('blog.blog2')" :title="__('Dịch vụ đưa đón 01 chiều')"
                                class="text-decoration-none nav-link fs-3 nav-link"/>
                    </li>
                    <li class="mb-2">
                        <x-link :href="route('blog.blog3')" :title="__('Dịch vụ đưa đón 02 chiều')"
                                class="text-decoration-none nav-link fs-3 nav-link"/>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-3">
                <iframe
                    src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fprofile.php%3Fid%3D61557847006591%26mibextid%3DZbWKwL&tabs=timeline&width=340&height=331&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                    width="320" height="331" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                    allowfullscreen="true"
                    allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                </iframe>
            </div>
        </div>
    </div>

    <hr class="m-0">
    <div class="container py-3 text-center">
      <span class="text-white">
         Copyright <?php echo date("Y"); ?> © <strong>Babi2School</strong>
    </span>
    </div>
</footer>

@include('public.components.floating-button')
