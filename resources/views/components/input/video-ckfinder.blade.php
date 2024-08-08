<input type="text" {{ $attributes->class(['d-none']) }} name="{{ $name }}" value="{{ $value }}">

<video id="{{ $showImage }}"
       class="add-video-ckfinder pointer"
       data-preview="#{{ $showImage }}"
       data-input="input[name='{{ $name }}']"
       data-type=""
       src="{{ asset($value) }}"
       style="width: 100%;"
       controls>
    Trình duyệt của bạn không hỗ trợ thẻ video.
</video>
