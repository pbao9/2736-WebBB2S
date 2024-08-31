<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            @lang('action')
        </div>
        <div class="card-body p-2">
            <div class="d-flex align-items-center h-100 gap-2">
                <x-button.submit :title="__('save')" name="submitter" value="save" />
                <x-button type="submit" name="submitter" value="saveAndExit">
                    @lang('save&exit')
                </x-button>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Hiển thị ngoài giao diện Marketing') }}
        </div>
        <div class="card-body p-2">
            <input type="hidden" name="active" value="{{ App\Enums\Province\ProvinceActive::InActive->value }}">
            <x-input-switch name="active" value="{{ App\Enums\Province\ProvinceActive::Active->value }}"
                :label="__('Hiển thị ngoài giao diện Marketing')" />
        </div>
    </div>
</div>
