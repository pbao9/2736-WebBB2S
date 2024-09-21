<script src="{{ asset('/public/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('public/libs/tabler/dist/js/tabler.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/public/libs/datatables/plugins/buttons/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('/public/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
<script src="{{ asset('/public/libs/Parsley.js-2.9.2/parsley.min.js') }}"></script>
<script src="{{ asset('/public/libs/jquery-throttle-debounce/jquery.ba-throttle-debounce.min.js') }}"></script>

<script defer src="{{ asset('/public/libs/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script defer src="{{ asset('/public/libs/flickity/js/flickity.pkgd.min.js') }}"></script>

@stack('libs-js')

<script type="module" src="{{ asset('public/admin/assets/js/i18n.js') }}"></script>
<script src="{{ asset('public/assets/js/scripts.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/setup.js') }}"></script>

<script src="{{ asset('/public/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('/public/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('/public/libs/select2/dist/js/i18n/vi.js') }}"></script>
<script src="https://cdn.gtranslate.net/widgets/latest/flags.js" defer></script>
@stack('custom-js')

<script>
    $(document).ready(function() {
        // Khởi tạo owl-carousel
        $('.owl-carousel-1').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplaySpeed: 1000,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: false
                }
            }
        });

        // Khởi tạo flickity
        $('.main-carousel').flickity({
            pageDots: false,
            contain: true,
            wrapAround: true,
            autoPlay: true,
            pauseAutoPlayOnHover: true,
            prevNextButtons: true,
        });

        $('.owl-carousel-2').owlCarousel({
            loop: true,
            margin: 10,
            responsiveClass: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplaySpeed: 1000,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: false
                }
            }
        });
    });
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v20.0"
    nonce="YT8pI24x"></script>
