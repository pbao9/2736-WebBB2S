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
                                        <i class="ti ti-list"></i>
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
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    {{-- Count animated --}}
    <script defer>
        $(document).ready(function() {
            $('.count').each(function() {
                var $this = $(this);
                var countTo = $this.attr('data-count');
                $this.prop('Counter', 0).animate({
                    Counter: countTo
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function(now) {
                        $this.text(Math.ceil(now));
                    }
                });
            });
        });
    </script>
@endpush
