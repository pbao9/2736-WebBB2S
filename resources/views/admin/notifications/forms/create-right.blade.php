<div class="col-12 col-md-3">
    <div class="card mb-3">
        <div class="card-header">
            @lang('action')
        </div>
        <div class="card-body p-2">
            <div class="d-flex align-items-center h-100 gap-2">
                <x-button.submit :title="__('save')" name="submitter" value="save" />
                {{-- <x-button type="submit" name="submitter" value="saveAndExit">
                    @lang('save&exit')
                </x-button> --}}
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                @lang('status')
            </div>
            <div class="card-body p-2">
                <x-select name="status" :required="true">
                    @foreach ($status as $key => $value)
                        @if($key == 1)
                            <x-select-option :value="$key" :title="$value" selected />
                        @else
                            <x-select-option :value="$key" :title="$value" />
                        @endif
                    @endforeach
                </x-select>
            </div>
        </div>
    </div>
</div>
