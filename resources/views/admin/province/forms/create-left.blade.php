<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- name -->
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('nameProvince')</label>
                    <x-input name="name" :value="old('nameProvince')" :required="true" :placeholder="__('nameProvince')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('codeProvince')</label>
                    <x-input name="code" :value="old('codeProvince')" :required="true" :placeholder="__('codeProvince')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('nameProvince')</label>
                    <x-input name="name" :value="old('nameProvince')" :required="true" :placeholder="__('nameProvince')" />
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label class="control-label">@lang('codeProvince')</label>
                    <x-input name="code" :value="old('codeProvince')" :required="true" :placeholder="__('codeProvince')" />
                </div>
            </div>
        
        </div>
    </div>
</div>
