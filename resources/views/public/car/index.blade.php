@extends('public.layouts.master')

@push('libs-css')
    <link href="{{ asset('public/libs/virtualselect/virtual-select.min.css') }}" rel="stylesheet">
@endpush

@push('custom-css')
    <style>
        .vscomp-ele {
            max-width: 100% !important;
        }

        .vscomp-toggle-button {
            border: var(--tblr-border-width) solid var(--tblr-border-color);
            border-radius: var(--tblr-border-radius);
        }

        .vscomp-wrapper.focused .vscomp-toggle-button,
        .vscomp-wrapper:focus .vscomp-toggle-button {
            box-shadow: none;
        }
    </style>
@endpush

@section('content')
    <section id="find-car">
        <div class="container">
            <div class="row py-5 align-items-center justify-content-center">
                <div class="col-lg-6 col-12 animate__animated animate__fadeIn">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title text-uppercase">
                                Tìm xe
                            </div>
                        </div>
                        <x-form id="form-contact" action="{{ route('contact.store') }}" :validate="true" type="POST">
                            <x-input type="hidden" value="0" name="form_type" />
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-label required">Bạn là</div>
                                    <x-select name="type" :required="true">
                                        @foreach ($type as $key => $value)
                                            <x-select-option :value="$key" :title="$value" />
                                        @endforeach
                                    </x-select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <div class="form-label required">Tên</div>
                                            <x-input type="text" class="form-control shadow-none" name="name"
                                                :value="old('name')" :required="true" placeholder="Họ & tên">
                                            </x-input>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <div class="form-label required">Số điện thoại</div>
                                            <x-input-phone class="form-control" name="phone" placeholder="Số điện thoại"
                                                :value="old('phone')" />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="form-label fw-bold">Địa điểm</div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label">Tỉnh/Thành</label>
                                            <x-select name="province_code" :required="true"
                                                class="form-select shadow-none">
                                                <x-select-option value="" :title="__('— Chọn Tỉnh/Thành —')" disable="true" />
                                                @foreach ($provinces as $province)
                                                    <x-select-option :value="$province->code" :title="__($province->name)" />
                                                @endforeach
                                            </x-select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label
                                                class=
                                            "form-label">Quận/Huyện</label>
                                            <select name="district_code" class="form-select shadow-none" required
                                                id="district-select">
                                                <option value="">— Chọn Quận/Huyện —</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 d-block" id="school_select">
                                    <div class="form-label required">Trường học</div>
                                    <div id="school-select"></div>
                                    <input type="hidden" name="school_id" id="school_id_input">
                                </div>
                                <div id="school_address" class="d-none">
                                    <div class="form-label required">Địa chỉ trường học</div>
                                    <input type="text" class="form-control" name="school_address"
                                        placeholder="Địa chỉ trường học">
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="form-label">Trường khác</div>
                                        <span class="float-end text-yellow mb-2" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-title="Không có trường học trong danh sách?">
                                            <i class="ti ti-bulb"></i>
                                        </span>
                                    </div>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="school_other" value="1"
                                            id="radio_yes" {{ old('school_other', 0) == 1 ? 'checked' : '' }}>
                                        <span class="form-check-label">Có</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="school_other" value="0"
                                            id="radio_no" {{ old('school_other', 0) == 0 ? 'checked' : '' }}>
                                        <span class="form-check-label">Không</span>
                                    </label>
                                </div>
                                <div class="row mb-3 d-none" id="school_other_frm">
                                    <div class="col-md-6 col-12">
                                        <label for="school_name_other"
                                            class="form-label">{{ __('Tên trường khác') }}</label>
                                        <x-input type="text" class="form-control shadow-none" name="school_name"
                                            :value="old('school_name')" placeholder="Tên trường học"></x-input>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="school_address_other"
                                            class="form-label">{{ __('Địa chỉ trường khác') }}</label>
                                        <x-input type="text" class="form-control shadow-none" name="school_address_other"
                                            :value="old('school_address')" placeholder="Địa chỉ trường học"></x-input>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label required">{{ __('Địa chỉ đón/trả') }}</div>
                                    <textarea class="form-control" name="location" rows="6" placeholder="Địa chỉ đón/trả bé"></textarea>
                                </div>
                                <hr>
                                <div class="row align-items-start mb-3">
                                    <div class="col-md-12 col-12 mb-3">
                                        <label for="service" class="form-label required">Dịch vụ</label>
                                        <x-select name="service" :required="true" class="form-select shadow-none">
                                            <x-select-option value="" :title="__('— Chọn Dịch vụ —')" disabled selected />
                                            @foreach ($service as $key => $value)
                                                <x-select-option :value="$key" :title="__($value)" />
                                            @endforeach
                                        </x-select>
                                    </div>

                                    <div class="col-12" id="pickUpOnlyRow">
                                        <div class="row">
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="session_arrive_school"
                                                    class="form-label required">{{ __('Buổi đón đi') }}</label>
                                                <x-select name="session_arrive_school" class="form-select shadow-none">
                                                    <x-select-option value="" :title="__('— Buổi đón đi —')" disabled selected />
                                                    @foreach ($session as $key => $value)
                                                        <x-select-option :value="$key" :title="__($value)" />
                                                    @endforeach
                                                </x-select>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <div class="form-label required">{{ __('Thời gian tới trường') }}</div>
                                                <input type="time" class="form-control" name="time_arrive_school"
                                                    placeholder="Thời gian tới trường">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12" id="dropOffOnlyRow">
                                        <div class="row">
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="session_off"
                                                    class="form-label required">{{ __('Buổi đón về') }}</label>
                                                <x-select name="session_off" class="form-select shadow-none">
                                                    <x-select-option value="" :title="__('— Buổi đón về —')" disabled selected />
                                                    @foreach ($session as $key => $value)
                                                        <x-select-option :value="$key" :title="__($value)" />
                                                    @endforeach
                                                </x-select>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <div class="form-label required">{{ __('Thời gian về') }}</div>
                                                <input type="time" class="form-control" name="time_off"
                                                    placeholder="Thời gian tới trường">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <button type="submit" class="btn btn-yellow w-100">{{ __('Nhận báo giá') }}</button>
                            </div>
                        </x-form>
                    </div>
                </div>
                <div class="col-lg-6 col-12 text-center d-none" id="car">
                    <img src="{{ asset('public/assets/images/car.png') }}" alt="">
                    <h1 style="font-size: 2rem">Số chỗ còn:
                        <strong class="text-danger" id="slotSeat"></strong>
                    </h1>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('custom-js')
    @include('public.car.scripts.scripts')
    @include('public.car.scripts.address')
    @include('public.layouts.include.swal')
    @include('public.car.scripts.schoolSearch')
    <script defer src="{{ asset('/public/libs/virtualselect/virtual-select.min.js') }}"></script>
@endpush
