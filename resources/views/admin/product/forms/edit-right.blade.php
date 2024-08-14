<div class="col-12 col-md-2">
    <div id="blockSubmit" class="card mb-3">
        <div class="card-header fw-bold justify-content-between">
            {{ __('Hành động') }}
            <x-link :href="config('custom.frontend_url') . config('custom.prefix_url.product') . '/' . $product->slug" :title="__('Xem sản phẩm')" target="_blank" />
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-link class="btn btn-success" :href="route('admin.product.create')" :title="__('Thêm')"></x-link>
            <x-button.modal-delete data-route="{{ route('admin.product.delete', $product->id) }}" :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header justify-content-between">
            {{ __('Lượt xem') }}
            <span class="badge bg-green-lt">{{ $product->viewed }} <i class="ti ti-eye"></i></span>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select name="status" :required="true">
                @foreach ($status as $key => $value)
                    <x-select-option :option="$product->status->value" :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh đại diện') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="image" showImage="image" :value="$product->image" />
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Banner') }}
        </div>
        <div class="card-body p-2">
            <input type="hidden" name="show_banner" value="{{ App\Enums\Product\ProductBanner::Off->value }}">
            <x-input-switch name="show_banner" value="{{ App\Enums\Product\ProductBanner::On->value }}"
                :label="__('Hiển thị ảnh banner')" :checked="$product->show_banner == App\Enums\Product\ProductBanner::On->value" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh Banner') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="banner" showImage="banner" :value="$product->banner" />
        </div>
    </div>


</div>
