<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('nameDistrict')</label>
                    <x-input name="name" :value="old('nameDistrict')" :required="true" :placeholder="__('nameDistrict')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('codeDistrict')</label>
                    <x-input name="code" :value="old('codeDistrict')" :required="true" :placeholder="__('codeDistrict')" />
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('province') }} :</label>
                    <x-select id="province_code" class="select2-bs5-ajax" name="province_code"
                        :data-url="route('admin.search.select.province')"></x-select>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('divisionType')</label>
                    <x-select name="division_type" :required="true">
                        <x-select-option value="" :title="__('choose')" disabled selected />
                        @foreach ($divisionType as $key => $value)
                            <x-select-option :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
        </div>
    </div>
</div>
