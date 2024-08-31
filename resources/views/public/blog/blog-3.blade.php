@extends('public.layouts.master')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-9 col-12 pe-lg-4 pe-0">
                <h1 class="text-center text-uppercase fw-bold">dịch vụ đưa đón 02 chiều</h1>
                <div class="is-diviner mx-auto"></div>
                <div class="banner has-hover" id="banner-animation">
                    <div class="banner-bg fill">
                        <div class="bg fill bg-fill bg-loaded"></div>
                        <div class="bg-effect fill"></div>
                        <div class="banner-content position-absolute top-50 start-50 translate-middle text-center w-100">
                            <div class="content-banner mx-5 px-5  animate__animated animate__flipInY animate__slow">
                                <div class="is-diviner mx-auto"></div>
                                <h1 class="text-white mb-3 text-uppercase" style="font-size: 150%"><b>DỊCH VỤ ĐƯA ĐÓN 02
                                        CHIỀU</b></h1>
                                <p><span style="font-size: 150%;" class="text-white">Giá chỉ từ: 113.000 VNĐ/ học sinh/ 01
                                        ngày cho 02 chiều đưa đón trên bán kính 5km từ nhà đến trường</span></p>
                                <div class="is-diviner mx-auto"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-box py-3">
                    <div>
                        <p>Thấu hiểu áp lực của phụ huynh khi phải
                            vừa chạy đua với công việc, vừa tranh thủ đón con vào giờ cao điểm trong khung giờ 4:00 – 5:30,
                            Babi2School đã cho ra đời sản phẩm <em><strong>” Dịch vụ đưa đón 01 chiều”</strong></em>. Đây là
                            sản phẩm được thiết kế với quy trình an toàn, linh hoạt, tiết kiệm nhất hiện nay so với các dịch
                            vụ đưa đón truyền thống:</p>
                        <ol style="line-height: 35px">
                            <li>Dịch vụ sử dụng xe 7 chỗ đưa đón, tiết kiệm thời gian trẻ ngồi trên xe, đặc biệt trong giờ
                                cao điểm, có thể đưa đón trẻ tận nhà.</li>
                            <li>Mỗi xe 7 chỗ đều có giám sinh giám sát riêng biệt, đảm bảo đưa đón một cách an toàn nhất.
                            </li>
                            <li>Phần mềm cập nhật vị trí, thông báo theo thời gian thực, cập nhật báo cáo bằng hình ảnh,
                                giúp phụ huynh giám sát liên tục và yên tâm khi trẻ đã về nhà.</li>
                            <li>Giá: <strong>2.500.000 VNĐ/ Học sinh/02 chiều đón/ bán kính trong vòng 5 km từ nhà học sinh
                                    đến trường.</strong></li>
                            <li>Trong trường hợp số km đưa bé về vượt quá 5km. Số km vượt được tính như sau: Số (km) vượt x
                                20.000 VNĐ x 22 ngày</li>
                            <li>Trong trường hợp xe 7 chỗ không thể vô nhà do đường quá nhỏ, giám sinh đưa học sinh vô tận
                                nhà
                                trong khoảng cách 50m.</li>
                            <li>Khung giờ đón bé: Buổi chiều 4:00 PM – 6:00 PM</li>
                        </ol>
                    </div>
                </div>
                <div class="mb-3">
                    Dịch vụ <strong>Babi2School</strong> sẽ được triển khai tại Hà Nội và TP.HCM, trước khi mở rộng tới các
                    tỉnh thành khác.
                    Trong giai đoạn đầu, <strong>Babi2School</strong> sẽ cung cấp dịch vụ trọn gói theo thời gian 01 năm
                    học. Mỗi xe sẽ phục vụ
                    tối đa 6 học sinh, theo quãng đường 05 km từ trường.
                    Phụ huynh và gia đình gọi tới số hotline {{ $settings['hotline'] }} - {{ $settings['hotline-1'] }} để
                    được tư vấn tốt hơn.
                </div>
                @include('public.blog.include.lien-he')

            </div>
            <div class="col-md-3 col-12 sidebar">
                @include('public.components.sidebar')
            </div>
        </div>
    </div>
@endsection
