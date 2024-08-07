<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('name')</label>
                    <x-input name="name" :value="old('name')" :required="true" :placeholder="__('name')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('address')</label>
                    <x-input name="address" :value="old('address')" :required="true" :placeholder="__('address')" />
                </div>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label class="control-label">@lang('Tỉnh/Thành'):</label>
                <x-select name="province_code" :required="true">
                    <x-select-option value="" :title="__('choose')" />
                    @foreach ($provinces as $province)
                        <x-select-option :value="$province->code" :title="__($province->name)" />
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label class="control-label">@lang('Quận/Huyện'):</label>
                <x-select name="district_code" required>
                    <option value="">-- Chọn Quận/Huyện --</option>
                </x-select>
            </div>
        </div>
    </div>
</div>
