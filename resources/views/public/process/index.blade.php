@extends('public.layouts.master')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">QUY TRÌNH ĐƯA ĐÓN HỌC SINH CỦA BABI2SCHOOL</h1>
        <video id="myVideo" class="d-block mx-auto mt-5" width="100%" controls>
            <source src="{{ asset($settings['video']) }}" type="video/mp4">
        </video>
        <div class="row mt-5 justify-content-center align-items-center">
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img class="me-3" width="65" height="60"
                        src="{{ asset('public/assets/images/footer-title.png') }}">
                    <h1 class="fw-bold">Buổi sáng 6:00</h1>
                </div>
                <p class="mb-0">Babi2School bắt đầu hoạt động khi giám sinh mở app bên trong xe 7 chỗ để khởi
                    động
                    chuyến xe. Phụ huynh sẽ cập nhật được vị trí xe bắt đầu chuyến hành trình</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img class="" width="167" height="337"
                    src="{{ asset('public/assets/images/z5416553416958_cb357f987a1b465d793d17244524b287-1.jpg') }}">
            </div>
            <div class="col-lg-7 col-md-6 mb-4 justify-content-center d-flex">
                <div class="text_howitwork">
                    <p class="mb-0 text-center">Dựa trên vị trí chuyến xe, thứ tự điểm đón của bé, Phụ huynh sắp xếp chuẩn
                        bị cho bé đến trường.</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img class="me-3" width="65" height="64"
                        src="{{ asset('public/assets/images/footer-title.png') }}">
                    <h1 class="fw-bold">Buổi sáng 6:45</h1>
                </div>
                <p class="mb-0">Khi xe còn cách điểm đón 05 phút, Phụ huynh sẽ nhận được thông báo 1 lần nữa để
                    có thể chuẩn bị đưa bé ra cổng.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img class="" width="167" height="337"
                    src="{{ asset('public/assets/images/IP13-Mockup-3-1.png') }}">
            </div>
            <div class="col-lg-7 col-md-6 mb-4 justify-content-center d-flex">
                <div class="text_howitwork">
                    <p class="mb-0">Khi xe đến điểm đón, một thông báo khác sẽ được gửi cho phụ huynh.</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img class="me-3" width="65" height="64"
                        src="{{ asset('public/assets/images/footer-title.png') }}">
                    <h1 class="fw-bold">Buổi sáng 6:50</h1>
                </div>
                <p class="mb-0">Giám sinh đưa bé lên xe. Giám sinh chụp hình xác nhận tại điểm đón, cập nhật tự
                    động
                    lên App</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img class="" width="167" height="337"
                    src="{{ asset('public/assets/images/IP13-Mockup-15.png') }}">
            </div>
            <div class="col-lg-7 col-md-6 mb-4 justify-content-center d-flex">
                <div class="text_howitwork">
                    <p class="mb-0 text-center">Bây giờ bé bắt đầu ngồi trên xe, xe sẽ tiếp tục để đón các bé còn lại. Ba mẹ
                        có thể xem được vị trí của xe thông qua app Babi2School</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img class="me-3" width="65" height="64"
                        src="{{ asset('public/assets/images/footer-title.png') }}">
                    <h1 class="fw-bold">Buổi sáng 7:00</h1>
                </div>
                <p class="mb-0">Khi xe đến trường, giám sinh đưa bé đến trường, chụp hình điểm danh, cập nhật
                    lên
                    App. Phụ huynh sẽ nhận được thông báo trạng thái kèm hình ảnh, an tâm bé đã vào trường</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img class="" width="167" height="337"
                    src="{{ asset('public/assets/images/app-anh-chup-checkin-luc-don-o-truong-ve.png') }}">
            </div>
            <div class="col-lg-7 col-md-6 mb-4 justify-content-center d-flex">
                <div class="text_howitwork">
                    <p class="mb-0">Tài xế và giám sinh sẽ kiểm tra lần cuối và báo cáo xác nhận đã hoàn thành
                        chuyến đi.</p>
                </div>
            </div>
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img class="me-3" width="65" height="64"
                        src="{{ asset('public/assets/images/footer-title.png') }}">
                    <h1 class="fw-bold">Buổi chiều 4:00</h1>
                </div>
                <p class="mb-0">Giám sinh có mặt ở cổng trường trước 15 phút. Vào tận trường/ lớp để đón bé. Bảo
                    mẫu điểm danh bằng hình ảnh, xác nhận đã đón bé. App sẽ cập nhật và gửi thông báo đến phụ huynh theo
                    thời gian thực.</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img class="" width="167" height="337"
                    src="{{ asset('public/assets/images/IP13-Mockup-15.png') }}">
            </div>
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img class="me-3" width="65" height="64"
                        src="{{ asset('public/assets/images/footer-title.png') }}">
                    <h1 class="fw-bold">Buổi chiều 4:30</h1>
                </div>
                <p class="mb-0">Xe bắt đầu hành trình trả các bé về tận nhà. Phụ huynh có thể theo dõi hành
                    trình xe trên App</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img class="" width="167" height="337"
                    src="{{ asset('public/assets/images/z5416553416958_cb357f987a1b465d793d17244524b287-1.jpg') }}">
            </div>
            <div class="col-lg-7 col-md-6 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img class="me-3" width="65" height="64"
                        src="{{ asset('public/assets/images/footer-title.png') }}">
                    <h1 class="fw-bold">Buổi chiều 4:30-5:30</h1>
                </div>
                <p class="mb-0">Xe và giám sinh đưa bé về tận nhà. Giám sinh chụp hình điểm danh trả bé cho phụ
                    huynh/ ông bà ở nhà. App cập nhật bằng hình ảnh và trạng thái gửi đến phụ huynh</p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 text-center">
                <img class="" width="167" height="337"
                    src="{{ asset('public/assets/images/app-anh-chup-checkin-luc-ve-2-1.png') }}">
            </div>
            <div class="col-lg-7 col-md-6 mb-4 justify-content-center d-flex align-items-center">
                <div class="text_howitwork">
                    <p class="mb-0">Tài xế và giám sinh sẽ kiểm tra lần cuối và báo cáo xác nhận đã hoàn thành
                        chuyến đi.</p>
                </div>
            </div>
        </div>

    </div>
@endsection
