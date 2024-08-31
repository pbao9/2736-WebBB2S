<div class="col-12 col-md-10">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <!-- name -->
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-control-label fw-bold">{{ __('Tiêu đề') }}:</label>
                        <x-input name="title" :value="old('title')" :required="true" placeholder="{{ __('Tiêu đề') }}" />
                    </div>
                </div>
                <!-- desc -->
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-control-label fw-bold">{{ __('Nội dung') }}:</label>
                        <textarea name="content" class="ckeditor visually-hidden">
                            {{ old('content') }}
                        </textarea>
                    </div>
                </div>
                <!-- excerpt -->
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-control-label fw-bold">{{ __('Mô tả ngắn') }}:</label>
                        <textarea class="form-control"name="excerpt" rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <!-- title_seo -->
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-control-label fw-bold">{{ __('Tiêu đề SEO') }}:</label>
                        <x-input name="title_seo" :value="old('title_seo')" placeholder="{{ __('Tiêu đề SEO') }}" />
                    </div>
                </div>
                <!-- desc_seo -->
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-control-label fw-bold">{{ __('Mô tả ngắn SEO') }}:</label>
                        <x-input name="desc_seo" :value="old('desc_seo')" placeholder="{{ __('Mô tả ngắn SEO') }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <!-- banner_title -->
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-control-label fw-bold">{{ __('Nội dung trong Banner') }}:</label>
                        <textarea name="banner_title" class="ckeditor visually-hidden">
                            {{ old('banner_title') }}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
