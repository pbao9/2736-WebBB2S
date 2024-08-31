<h3>Thông tin liên hệ</h3>
<ul>
    <li class="mb-3 fw-bold">
        Địa chỉ: <span class="fw-normal">{{ $settings['address'] }}</span>
    </li>
    <li class="mb-3 fw-bold">Hotline: <span class="fw-normal">{{ $settings['hotline'] }} -
            {{ $settings['hotline-1'] }}</span></li>
    <li class="mb-3 fw-bold">Email: <span class="fw-normal">{{ $settings['email'] }}</span></li>
</ul>
<h3>Xem hình ảnh hoạt động của chúng tôi tại:</h3>
<ul>
    <li class="mb-3">
        <span>{{ __('Facebook') }} - <x-link :href="$settings['facebook']" :title="__('Xem ngay!')" target="_blank"></x-link> </span>
        {{-- Facebook: {{ $settings['facebook'] }} --}}
    </li>
</ul>
