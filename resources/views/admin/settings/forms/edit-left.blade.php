<div class="card h-100">
    <div class="card-header justify-content-center">
        <h2 class="mb-0">{{ $title ?? __('Thông tin') }}</h2>
    </div>
    <div class="row card-body wrap-loop-input">
        @foreach ($settings as $setting)
            <div class="col-12">
                <div class="mb-3">
                    <label for="">{{ $setting->setting_name }}</label>
                    @if ($setting->type_input == App\Enums\Setting\SettingTypeInput::Textarea)
                        <x-textarea :name="$setting->setting_key" class="ckeditor">
                            {!! $setting->plain_value ?? '' !!}
                        </x-textarea>
                      
                    @else
                        <x-dynamic-component :component="$setting->getNameComponent()" :name="$setting->setting_key" :value="$setting->plain_value"
                            showImage="{{ $setting->setting_key }}" :required="true" />
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
