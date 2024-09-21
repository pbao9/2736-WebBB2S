<div class="section-2 mt-5">
    <div class="container">
        <!-- Tại sao chọn Babi2School -->
        <h2 class="fancy-underline mx-0"> Tại sao chọn Babi2School </h2>
        <div class="container">
            <video id="myVideo" class="d-block mx-auto mt-3" width="100%" controls>
                <source src="{{ asset($settings['video']) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('myVideo').play();
                });
            </script>

            <div class="row mt-5">
                <div class="col-lg-4 col-md-4 col-12 mb-4">
                    <img class="d-block mx-auto" src="{{ asset('public/assets/images/IP13-Mockup-2.png') }}"
                        width="202" height="390">
                    <p class="mt-3 fw-bold">Giám sát hành trình chuyến đi</p>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-4">
                    <img class="d-block mx-auto" src="{{ asset('public/assets/images/bao-mau-4.png') }}" width="202"
                        height="390">
                    <p class="mt-3 fw-bold">Giám sinh chuyên nghiệp “1 kèm 1”</p>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-4">
                    <img class="d-block mx-auto" src="{{ asset('public/assets/images/7cho.png') }}" width="202"
                        height="390">
                    <p class="mt-3 fw-bold">Xe 7 chỗ đưa đón tận nhà</p>
                </div>
            </div>
        </div>
    </div>
</div>
