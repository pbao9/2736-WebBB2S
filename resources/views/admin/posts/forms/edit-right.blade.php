<div class="col-12 col-md-2">
    <div id="blockSubmit" class="card mb-3">
        <div class="card-header fw-bold justify-content-between">
            {{ __('Hành động') }}
            <x-link :href="config('custom.frontend_url') . config('custom.prefix_url.post') . '/' . $post->slug" :title="__('Xem bài viết')" target="_blank" />
        </div>
        <div class="card-body p-2 d-flex justify-content-between">
            <x-button.submit :title="__('Cập nhật')" />
            <x-link class="btn btn-success" :href="route('admin.post.create')" :title="__('Thêm')"></x-link>
            <x-button.modal-delete data-route="{{ route('admin.post.delete', $post->id) }}" :title="__('Xóa')" />
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header justify-content-between">
            {{ __('Lượt xem') }}
            <span class="badge bg-green-lt">{{ $post->viewed }} <i class="ti ti-eye"></i></span>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header justify-content-between">
            <span>
                {{ __('Danh mục') }}
            </span>
            <x-link :href="route('admin.post_category.create')" :title="__('Thêm danh mục')"></x-link>
        </div>
        <div class="card-body p-2 wrap-list-checkbox">
            @foreach ($categories as $category)
                <x-input-checkbox :checked="$post->categories->pluck('id')->toArray()" :depth="$category->depth" name="categories_id[]" :label="$category->name"
                    :value="$category->id" />
            @endforeach
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Trạng thái') }}
        </div>
        <div class="card-body p-2">
            <x-select name="status" :required="true">
                @foreach ($status as $key => $value)
                    <x-select-option :option="$post->status->value" :value="$key" :title="$value" />
                @endforeach
            </x-select>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            {{ __('Ảnh đại diện') }}
        </div>
        <div class="card-body p-2">
            <x-input-image-ckfinder name="image" showImage="image" :value="$post->image" />
        </div>
    </div>
</div>
