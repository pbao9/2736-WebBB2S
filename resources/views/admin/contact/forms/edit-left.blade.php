<div class="col-12 col-md-9">
    <div class="card">
        <div class="card-header">
            <div class="fw-bold text-uppercase me-3">
                <span
                    @class([
                        'badge',
                        App\Enums\Contact\ContactType::from($contact->form_type)->badge(),
                    ])>{{ __('Loại đơn: ') . ' ' . \App\Enums\Contact\ContactType::getDescription($contact->form_type) }}</span>
            </div>
            <div class="text-uppercase me-3">
                <span
                    @class([
                        'badge',
                        App\Enums\Contact\UserType::from($contact->type)->badge(),
                    ])>{{ __('Đối tượng: ') . ' ' . \App\Enums\Contact\UserType::getDescription($contact->type) }}</span>
            </div>
            <div class="text-uppercase">
                @if ($contact->service)
                    <span
                        @class([
                            'badge',
                            App\Enums\Contact\ContactService::from($contact->service)->badge(),
                        ])>{{ __('Dịch vụ: ') . ' ' . \App\Enums\Contact\ContactService::getDescription($contact->service) }}</span>
                @endif
            </div>
        </div>
        <div class="row card-body">
            <!-- title -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label fw-bold">@lang('Họ tên: ')</label>
                    <span>{{ __($contact->name) }}</span>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label fw-bold">@lang('Số điện thoại'):</label>
                    <span>{{ __($contact->phone) }}</span>
                </div>
            </div>
            @if ($contact->form_type == 0)
                @if ($contact->school_other == 0)
                    <div class="col-md-6 mb-3">
                        <label for="" class="control-label fw-bold">{{ __('Trường học') }}:</label>
                        <span>{{ __($school->name) }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="control-label fw-bold">{{ __('Địa chỉ trường học') }}:</label>
                        <span>{{ __($school->school_address) }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="control-label fw-bold">@lang('Tỉnh/Thành')</label>
                        <span>{{ __($province->name) }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="control-label fw-bold">@lang('Quận/Huyện: ')</label>
                        <span>{{ __($district->name) }}</span>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label fw-bold">@lang('Địa điểm đón/trả: ')</label>
                            <span>{{ __($contact->location) }}</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="control-label fw-bold">@lang('Thời gian đón: ')</label>
                            <span>{{ __($contact->time_pickup) }}</span>
                        </div>
                    </div>
                @else
                    <div class="col-md-6 mb-3">
                        <label class="control-label fw-bold">@lang('Tỉnh/Thành: ')</label>
                        <span>{{ __($province->name) }}</span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="control-label fw-bold">@lang('Quận/Huyện: ')</label>
                        <span>{{ __($district->name) }}</span>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label class="control-label fw-bold">@lang('Tên trường: ')</label>
                            <span>{{ __($contact->school_name) }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label class="control-label fw-bold">@lang('Địa chỉ trường: ')</label>
                            <span>{{ __($contact->school_address) }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label class="control-label fw-bold">@lang('Địa điểm đón/trả: ')</label>
                            <span>{{ __($contact->location) }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="mb-3">
                            <label class="control-label fw-bold">@lang('Thời gian đón: ')</label>
                            <span>{{ __($contact->time_pickup) }}</span>
                        </div>
                    </div>
                @endif
            @elseif($contact->form_type == 1)
                <div class="col-md-12 col-12">
                    <div class="mb-3">
                        <label class="control-label fw-bold">@lang('Tên trường: ')</label>
                        <span>{{ __($contact->school_name) }}</span>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="control-label fw-bold">@lang('Địa chỉ trường học: ')</label>
                        <span>{{ __($contact->school_address) }}</span>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label class="control-label fw-bold">@lang('Địa chỉ nơi ở: ')</label>
                        <span>{{ __($contact->address) }}</span>
                    </div>
                </div>
            @else
                <div class="col-md-12 col-12">
                    <div class="mb-3">
                        <label class="control-label fw-bold">@lang('Tên trường học: ')</label>
                        <span>{{ __($contact->school_name) }}</span>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="mb-3">
                        <label class="control-label fw-bold">@lang('Địa chỉ trường học: ')</label>
                        <span>{{ __($contact->school_address) }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
