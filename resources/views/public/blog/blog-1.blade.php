@extends('public.layouts.master')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-9 col-12 pe-lg-3 pe-0">
                <h1 class="text-center text-uppercase fw-bold">babi2school app</h1>
                <div class="is-diviner mx-auto"></div>
                <p>Hiện nay, các mô hình đưa đón học sinh trong trường học mang tính tự phát, thiếu các công cụ giám sát an
                    toàn. Phụ huynh buộc phải giao phó việc đưa đón học sinh cho các dịch vụ ngoài ( như “chị hàng xóm”,
                    “bác xe ôm đầu hẻm”,…), hoặc buộc phải tin vào dịch vụ ký kết với trường mà không có bất kỳ một công cụ
                    chủ động nào để có thể giám sát, theo dõi, cảnh báo kịp thời trong suốt quá trình đưa đón học sinh.
                    Thấu hiểu được khó khăn đó, <span class="text-primary fw-bold">AppBabi2School</span> đã ra đời như một
                    công cụ giám sát an toàn và hiện đại nhất hiện nay giúp tăng cường quản lý và giám sát học sinh trên xe
                    đưa rước. Đảm bảo môi trường đi lại an toàn nhất cho tất cả các em nhỏ, đặc biệt học sinh tiểu học.</p>
                <div class="row my-2">
                    <div class="col-md-4 col-12">
                        <img src="{{ asset('public/assets/images/22IP13-Mockup.png') }}" alt="" width="100%">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="{{ asset('public/assets/images/z5416553416958_cb357f987a1b465d793d17244524b287-1.jpg') }}"
                            alt="" width="100%">
                    </div>
                    <div class="col-md-4 col-12">
                        <img src="{{ asset('public/assets/images/IP13-Mockup-1-1-531x1024.png') }}" alt=""
                            width="100%">
                    </div>
                </div>


                <h4>I. Chức năng chính của ứng dụng Babi2School</h4>
                <p>
                    <span class="fst-italic fw-bold">B1:</span>Phụ huynh sau khi được tư vấn quy trình hướng dẫn và ký hợp
                    đồng cùng Babi2School sẽ được cấp 01 Account để sử dụng app không mất phí nhằm giám sát hành trình đưa
                    đón học sinh, quản lý lịch xe đưa đón, quản lý thông tin giám sinh, tài xế,… trong suốt năm học.
                </p>
                <p class="d-flex justify-content-center align-items-center flex-column gap-3">
                    <img src="{{ asset('public/assets/images/1.png') }}" alt="" width="20%">
                    <span class="fst-italic">App đăng nhập bằng số di động của phụ huynh</span>
                </p>
                <p>
                    <span class="fst-italic fw-bold">B2:</span>Phụ huynh cập nhật các thông tin cá nhân và quản lý hợp đồng
                    đưa đón dành cho phụ huynh.
                </p>
                <p class="d-flex justify-content-center align-items-center flex-column gap-3">
                    <img src="{{ asset('public/assets/images/2.png') }}" alt="" width="20%">
                    <span class="fst-italic">Quản lý thông tin hợp đồng dành cho phụ huynh</span>
                </p>
                <p>
                    <span class="fst-italic fw-bold">B3:</span>Phụ huynh quản lý và đăng ký lịch học, lịch nghỉ phép thông
                    qua App Babi2School.
                </p>
                <p class="d-flex justify-content-center align-items-center flex-column gap-3">
                    <img src="{{ asset('public/assets/images/3.png') }}" alt="" width="20%">
                    <span class="fst-italic">Quản lý lịch nghỉ phép của học sinh</span>
                </p>
                <p>
                    <span class="fst-italic fw-bold">B4:</span>Phụ huynh quản lý thông tin giám sinh, tài xế, liên hệ trong
                    trường hợp gấp, kiểm tra báo cáo bằng hình ảnh và trạng thái đưa đón học sinh.
                </p>
                <p class="d-flex justify-content-center align-items-center flex-column gap-3">
                    <img src="{{ asset('public/assets/images/4.png') }}" alt="" width="20%">
                    <span class="fst-italic">Kiểm tra báo cáo bằng hình ảnh</span>
                </p>
                <p>
                    <span class="fst-italic fw-bold">B5:</span>Phụ huynh có thể heo dõi hành trình xe đưa đón suốt chuyến
                    đi.
                </p>
                <p class="d-flex justify-content-center align-items-center flex-column gap-3">
                    <img src="{{ asset('public/assets/images/5.jpg') }}" alt="" width="20%">
                    <span class="fst-italic">Công nghệ định vị theo thời gian thực giám sát hành trình đưa đón</span>
                </p>
                <p>
                    <span class="fst-italic fw-bold">B6:</span>Phụ huynh nhận thông báo đẩy, cập nhật thông tin, trạng thái
                    cần thiết, quan trọng như xe sắp đến, báo trạng thái đưa đón, thay đổi giám sinh,…
                </p>
                <p class="d-flex justify-content-center align-items-center flex-column gap-3">
                    <img src="{{ asset('public/assets/images/6.png') }}" alt="" width="20%">
                    <span class="fst-italic">App cập nhật thông tin, trạng thái cần thiết để lưu ý phụ huynh</span>
                </p>
                <p>
                    <span class="fst-italic fw-bold">B7:</span>Phụ huynh liên hệ hotline: 0822.62.55.62 – 0924.22.99.88
                    trong trường hợp cần hỗ trợ đặc biệt
                </p>

                <h4>II. Vai trò và tầm quan trọng của ứng dụng Babi2School:</h4>
                <p>Babi2School ra đời giúp phụ huynh có thể giám sát, cập nhật trạng thái của trẻ liên tục trong quá trình
                    đưa đón. Phụ huynh giờ đây có thể chủ động kiểm soát hành trình, giải quyết những bất an, lo lắng của
                    phụ huynh như đi lạc, an toàn giao thông, giúp phụ huynh an tâm làm việc.</p>
                <p>Babi2School sử dụng xe 7 chỗ đưa đón để giám sinh có thể dễ dàng giám sát toàn bộ học sinh trên xe so với
                    các dịch vụ xe 16 chỗ hay xe bus truyền thống.</p>
                Song song đó, chức năng điểm danh bằng hình ảnh khi nhận học sinh tại nhà và đưa học sinh đến tận trường tạo
                một lớp an toàn thứ 02 cho quy trình đưa đón học sinh.
                <ul>
                    <li>An toàn của trẻ: Babi2School sử dụng xe 7 chỗ đưa đón, kết hợp giám sinh “01 kèm 01” cùng App điểm
                        danh bằng hình ảnh theo thời gian thực khi nhận học sinh tại nhà và đưa học sinh đến tận trường. Quy
                        trình Babi2School kết hợp App Babi2School là quy trình an toàn nhất hiện nay so với các dịch vụ đưa
                        đón truyền thống đang có mặt trên thị trường.</li>
                    <li>
                        Giảm thiểu sai sót con người: Giám sinh Babi2School chỉ giám sát 5-6 trẻ trên một xe, dễ dàng hơn
                        rất
                        nhiều so với việc 01 giám sinh phải giám sát rất nhiều học sinh ở các dịch vụ xe 16 chỗ, xe bus đưa
                        đón học sinh tại các trường hiện nay
                    </li>
                    <li>Quản lý thông tin chuyên nghiệp: Ứng dụng Babi2School cho phép cập nhật và lưu trữ thông tin học
                        sinh và thông tin giám sinh, tài xế một cách an toàn và hiệu quả. Điều này giúp giám sinh nắm bắt
                        thông
                        tin về từng em học sinh trong quá trình đưa đón. </li>
                </ul>

                <p class="text-center">- - - - -</p>
                <p class="text-center">Mọi thông tin về việc đưa đón học sinh, phụ huynh đều có thể liên hệ với
                    <strong>Babi2school</strong>
                    để có sự hỗ trợ tận tình và thông tin đầy đủ nhất.</p>
                @include('public.blog.include.lien-he')
            </div>
            <div class="col-md-3 col-12 sidebar">
                {{-- @include('public.components.sidebar') --}}
            </div>
        </div>
    </div>
@endsection
