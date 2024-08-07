<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- type -->
            <div class="col-12">
                <div class="mb-3">
                    <label for="">{{ __('Đối tượng') }}</label>
                    <x-select class="notification-type" name="type" :required="true">
                        <x-select-option value="" :title="__('Chọn loại đối tượng')" />
                        @foreach (\App\Enums\Notification\NotificationType::getValues() as $value)
                            <x-select-option :value="$value" :title="$value == 1 ? __('Cho tất cả') : ($value == 2 ? __('Cho tài xế') : ($value == 3 ? __('Cho phụ huynh') : __('Cho giám sinh')))" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div style="display: none" id="notification-option-select" class="col-12">
                <div class="mb-3">
                    <label for="">{{ __('Loại') }}</label>
                    <x-select class="notification-option-select-value" name="option">
                        <x-select-option value="100" :title="__('Chọn loại thông báo')" selected />
                        @foreach (\App\Enums\Notification\NotificationOption::getValues() as $value)
                            <x-select-option :value="$value" :title="$value == 1 ? __('Cho tất cả') : __('Cho một người')" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- driver -->
            <div style="display: none" id="notification-driver-select" class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Tài xế') }}</label>
                    <x-select class="select2-bs5-ajax" name="driver_id" :value="old('driver_id')">
                        @foreach ($drivers as $item)
                            <x-select-option :value="$item->id" :title="$item->user->fullname . ' - ' . $item->user->phone" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- parent -->
            <div style="display: none" id="notification-parent-select" class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Phụ huynh') }}</label>
                    <x-select class="select2-bs5-ajax" name="parent_id" :value="old('parent_id')">
                        @foreach ($parents as $item)
                            <x-select-option :value="$item->id" :title="$item->user->fullname . ' - ' . $item->user->phone" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- nany -->
            <div style="display: none" id="notification-nany-select" class="col-12">
                <div class="mb-3">
                    <label class="control-label">{{ __('Giám sinh') }}</label>
                    <x-select class="select2-bs5-ajax" name="nany_id" :value="old('nany_id')">
                        @foreach ($nannies as $item)
                            <x-select-option :value="$item->id" :title="$item->user->fullname . ' - ' . $item->user->phone" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- title -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('title')</label>
                    <x-input name="title" :value="old('title')"  :placeholder="__('title')" />
                </div>
            </div>
            <!-- message -->
            <div class="col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('message')</label>
                    <x-input name="message" :value="old('message')"  :placeholder="__('message')" />
                </div>
            </div>

        </div>
    </div>
</div>

