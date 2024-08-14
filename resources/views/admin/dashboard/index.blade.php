@extends('admin.layouts.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Tổng quan') }}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body ">
        <div class="container-xl">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fw-bold text-primary">
                                        <span class="count">
                                            <span class="count" data-count="{{ $countContact }}">0</span>
                                        </span>
                                    </div>
                                    <div class="text-secondary text-uppercase fw-bold">
                                        Đơn liên hệ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar">
                                        <i class="ti ti-school"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fw-bold text-primary">
                                        <span class="count">
                                            <span class="count" data-count="{{ $countSchool }}">0</span>
                                        </span>
                                    </div>
                                    <div class="text-secondary text-uppercase fw-bold">
                                        Trường học</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar">
                                        <i class="ti ti-school"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fw-bold text-primary">
                                        <span class="count">
                                            <span class="count" data-count="{{ $countPost }}">0</span>
                                        </span>
                                    </div>
                                    <div class="text-secondary text-uppercase fw-bold">
                                        Bài viết</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card card-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="bg-green text-white avatar">
                                        <i class="ti ti-mail"></i>
                                    </span>
                                </div>
                                <div class="col">
                                    <div class="fw-bold text-primary">
                                        <span class="count">
                                            <span class="count" data-count="{{ $countProduct }}">0</span>
                                        </span>
                                    </div>
                                    <div class="text-secondary text-uppercase fw-bold">
                                        Sản phẩm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
