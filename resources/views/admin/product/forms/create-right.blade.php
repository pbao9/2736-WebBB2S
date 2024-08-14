<div class="col-12 col-md-2">
    <div id="id="blockSubmit"" class="card mb-3">
        <div class="card-header">
            {{ __('Đăng') }}
        </div>
        <div class="card-body p-2">
            <x-button.submit :title="__('Thêm')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select name="status" :required="true">
                @foreach ($status as $key => $value)
                    <x-select-option :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>


    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh đại diện') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="image" showImage="image" />
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Banner') }}
        </div>
        <div class="card-body p-2">
            <input type="hidden" name="show_banner" value="{{ App\Enums\Product\ProductBanner::Off->value }}">
            <x-input-switch name="show_banner" value="{{ App\Enums\Product\ProductBanner::On->value }}"
                :label="__('Hiển thị ảnh Banner')" />
        </div>
    </div>

    
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh Banner') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="banner" showImage="banner" />
        </div>
    </div>
</div>
