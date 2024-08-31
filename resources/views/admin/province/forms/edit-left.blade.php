<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('nameProvince')</label>
                    <x-input name="name" :value="$province->name" :required="true" :placeholder="__('nameProvince')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('codeProvince')</label>
                    <x-input name="code" :value="$province->code" :required="true" :placeholder="__('codeProvince')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('phoneCode')</label>
                    <x-input name="phone_code" :value="$province->phone_code" :required="true" :placeholder="__('phoneCode')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('divisionType')</label>
                    <x-select name="division_type" :required="true">
                        <x-select-option value="" :title="__('choose')" disabled selected />
                        @foreach ($divisionType as $key => $value)
                            <x-select-option :value="$key" :title="__($value)" :selected="$province->division_type === $key" />
                        @endforeach
                    </x-select>

                </div>
            </div>

        </div>
    </div>
</div>
