<div class="col-12 col-md-3">
    <div class="card mb-3">
        @if ($contact->status == 0)
            <div class="card-header">
                @lang('action')
            </div>
            <div class="card-body p-2 d-flex justify-content-between">
                <div class="d-flex align-items-center h-100 gap-2">
                    <x-button.submit :title="__('Cập nhật')" name="submitter" value="save" />
                    <x-button type="submit" name="submitter" value="saveAndExit">
                        @lang('save&exit')
                    </x-button>
                </div>
                <x-button.modal-delete data-route="{{ route('admin.contact.delete', $contact->id) }}"
                    :title="__('delete')" />
            </div>
        @else
            <x-link :href="route('admin.contact.index')" class="btn btn-icon btn-cyan">
                <i class="ti ti-arrow-left pe-2"></i>
                @lang('Trở về danh sách đơn liên hệ')
            </x-link>
        @endif

    </div>
    @if ($contact->status == 1)
        <div class="alert alert-success" role="alert">
            <div class="d-flex">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="alert-title">{{ __('Đã liên hệ') }}</h4>
                </div>
            </div>
        </div>
    @else
        <div class="card mb-3">
            <div class="card-header">
                @lang('Trạng thái')
            </div>
            <div class="card-body p-2">
                <x-select name="status" :required="true">
                    @foreach ($status as $key => $value)
                        <x-select-option :option="$contact->status" :value="$key" :title="$value" />
                    @endforeach
                </x-select>
            </div>
    @endif
</div>
</div>
