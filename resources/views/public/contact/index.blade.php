@extends('public.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="section-1 mt-5">
            <div class="text">
                <h1 class="text-uppercase"><strong>Thông tin liên hệ</strong></h1>
                <p class="text-dark">Nếu có bất kỳ câu hỏi nào về các dịch vụ của Babi2School, vui lòng liên hệ với chúng
                    tôi:</p>
                <p class="text-dark"><strong>Địa chỉ: </strong>{{ $settings['address'] }}</p>
                <p class="text-dark"><strong>Di động: </strong>{{ $settings['hotline'] }}</p>
                <p class="text-dark"><strong>Email: </strong><span
                        style="text-decoration: underline;">{{ $settings['email'] }}</span></p>
            </div>

            <div class="row align-middle justify-content-center gap-3 my-5">
                <div class="col-lg-3 col-md-10 col-12 contact mb-3">
                    <div class="text">
                        <h1 class="fw-bold">Dành cho phụ huynh</h1>
                        <p class="text-dark">Dịch vụ đưa rước học sinh dành cho phụ huynh</p>
                    </div>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalParent">
                        Nhận tư vấn
                    </button>
                    @include('public.contact.include.modal_parent')
                </div>

                <div class="col-lg-3 col-md-10 col-12 contact mb-3">
                    <div class="text">
                        <h1 class="fw-bold">Dành cho nhà trường</h1>
                        <p class="text-dark">Dịch vụ đưa rước học sinh dành cho nhà trường</p>
                    </div>
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalSchool">
                        Nhận tư vấn
                    </button>
                    @include('public.contact.include.modal_school')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    @include('public.layouts.include.swal')
@endpush
