<footer class="container-fluid">
    <div class="container-fluid">
        <div class="row justify-content-center py-5 ">
            <div class="col-12 col-lg-3 mb-3">
                <img class="d-block mx-auto" width="125px" height="125px" style="margin-bottom: 20px"
                    src="{{ asset('public/assets/images/footer-title.png') }}">
                <h2 class="mb-2 mx-auto">Dịch vụ công nghệ</h2>
                <h2 class="mb-2 mx-auto">Đưa đón học sinh bằng xe 7 chỗ</h2>
                <div class="d-flex pt-2 justify-content-center">
                    <a class="btn btn-square btn-outline-light me-1" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-outline-light me-1" href=""><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-light me-1" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-square btn-outline-light me-0" href=""><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-12 col-lg-3 mb-3">
                <h2 class="mb-2 mx-auto">BABI2SCHOOL - AN TOÀN ĐẾN TRƯỜNG</h2>
                <p>Công ty cổ phần Kỹ thuật Công nghệ HP</p>
                <p>{{ __('Địa chỉ: ') . ' ' . $settings['address'] }}</p>
                <p>{{ __('Mã số doanh nghiệp: 0318155206 do Sở Kế Hoạch và Đầu Tư TP. Hồ Chí Minh cấp năm 2023') }}</p>
                <p>{{ __('Hotline:') . ' ' . $settings['hotline'] . ' - ' . $settings['hotline-1'] }}</p>
                <p>{{ __('Email:') . ' ' . $settings['email'] }}</p>
            </div>
            <div class="col-12 col-lg-3 mb-3 d-lg-block d-flex justify-content-center align-items-center flex-column">
                <h2 class="text-black fw-bold">DỊCH VỤ</h2>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <x-link :href="route('home.index')" :title="__('App Babi2School')" class="text-decoration-none nav-link fs-3" />
                    </li>
                    <li class="mb-2">
                        <x-link :href="route('form.contact')" :title="__('Liên hệ')" class="text-decoration-none nav-link fs-3" />
                    </li>
                    <li class="mb-2">
                        <x-link :href="route('home.index')" :title="__('Dịch vụ')" class="text-decoration-none nav-link fs-3" />
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-3 text-center">
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
            Copyright 2024 © <strong>Babi2School</strong>
        </span>
    </div>
</footer>

@include('public.components.floating-button')
