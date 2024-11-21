<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12 col-md-12">
                <div class="mb-3">
                    <label class="control-label">@lang('name')</label>
                    <x-input name="name" :value="$school->name" :required="true" :placeholder="__('name')" />
                </div>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label class="control-label">@lang('Tỉnh/Thành')</label>
                <x-select name="province_code" :required="true" :selected="$school->province_code">
                    <x-select-option value="" :title="__('choose')" />
                    @foreach ($provinces as $province)
                        <x-select-option :value="$province->code" :title="__($province->name)" :selected="$province->code == $school->province_code" />
                    @endforeach
                </x-select>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label class="control-label">@lang('Quận/Huyện')</label>
                <x-select name="district_code" data-district-code="{{ $currentDistrict }}" required>
                    @if ($districts)
                        <option value="{{ $districts->code }}"
                            {{ $districts->code == $currentDistrict ? 'selected' : '' }}>
                            {{ $districts->name }}
                        </option>
                    @else
                        <option value="">No district available</option>
                    @endif
                </x-select>

            </div>
        </div>
    </div>
</div>
