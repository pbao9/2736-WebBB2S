<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('LIÊN HỆ BABI2SCHOOL')</title>
</head>

<body>
    @if ($data['form_type'] == 0)
        @if ($data['school_other'] == 0)
            <p>Xin chào bạn vừa nhận được <strong>Đơn liên hệ tìm xe</strong></p>
            <hr>
            <p><strong>Người liên hệ: </strong>
                @foreach ($type as $key => $value)
                    @if ($key == $data['type'])
                        {{ $value }}
                    @endif
                @endforeach
            </p>
            <p><strong>Họ và tên: </strong>@lang(':name', ['name' => $data['name']]) </p>
            <p><strong>Số điện thoại: </strong>@lang(':phone', ['phone' => $data['phone']])</p>
            <div class="d-flex align-items-center gap-2">
                @foreach ($province as $item)
                    @if ($item->code == $data['province_code'])
                        <span><strong>Tỉnh/Thành: </strong>{{ $item->name }}</span>
                    @endif
                @endforeach
                @foreach ($district as $item)
                    @if ($item->code == $data['district_code'])
                        <span><strong>Quận/Huyện: </strong>{{ $item->name }}</span>
                    @endif
                @endforeach
            </div>
            <p><strong>Địa chỉ đón/trả: </strong>@lang(':location', ['location' => $data['location']])</p>
            @foreach ($school as $item)
                @if ($item->id == $data['school_id'])
                    <p><strong>Trường học: </strong>{{ $item->name }} - {{ $item->address }}</p>
                @endif
            @endforeach
            <p><strong>Thời gian đón: </strong>@lang(':time_pickup', ['time_pickup' => $data['time_pickup']])</p>
            <hr>
        @else
            <p>Xin chào bạn vừa nhận được <strong>Đơn liên hệ tìm xe</strong></p>
            <hr>
            <p><strong>Người liên hệ: </strong>
                @foreach ($type as $key => $value)
                    @if ($key == $data['type'])
                        {{ $value }}
                    @endif
                @endforeach
            </p>
            <p><strong>Họ và tên: </strong>@lang(':name', ['name' => $data['name']]) </p>
            <p><strong>Số điện thoại: </strong>@lang(':phone', ['phone' => $data['phone']])</p>
            <div class="d-flex align-items-center gap-2">
                @foreach ($province as $item)
                    @if ($item->code == $data['province_code'])
                        <span><strong>Tỉnh/Thành: </strong>{{ $item->name }}</span>
                    @endif
                @endforeach
                @foreach ($district as $item)
                    @if ($item->code == $data['district_code'])
                        <span><strong>Quận/Huyện: </strong>{{ $item->name }}</span>
                    @endif
                @endforeach
            </div>
            <p><strong>Tên trường học: </strong>@lang(':school_name', ['school_name' => $data['school_name']])</p>
            <p><strong>Địa chỉ trường học: </strong>@lang(':school_address', ['school_address' => $data['school_address']])</p>
            <p><strong>Địa chỉ đón/trả: </strong>@lang(':location', ['location' => $data['location']])</p>
            <p><strong>Thời gian đón: </strong>@lang(':time_pickup', ['time_pickup' => $data['time_pickup']])</p>
            <hr>
        @endif
    @elseif($data['form_type'] == 1)
        <p>Xin chào bạn vừa nhận được <strong>Đơn liên hệ từ Phụ Huynh</strong></p>
        <hr>
        <p><strong>Họ và tên: </strong>@lang(':name', ['name' => $data['name']]) </p>
        <p><strong>Số điện thoại: </strong>@lang(':phone', ['phone' => $data['phone']])</p>
        <p><strong>Địa chỉ: </strong>@lang(':address', ['address' => $data['address'] ?? ''])</p>
        <p><strong>Tên trường học: </strong>@lang(':school_name', ['school_name' => $data['school_name'] ?? ''])</p>
        <p><strong>Địa chỉ trường học: </strong>@lang(':school_address', ['school_address' => $data['school_address'] ?? ''])</p>
        <hr>
    @else
        <p>Xin chào bạn vừa nhận được <strong>Đơn liên hệ từ Trường Học</strong></p>
        <hr>
        <p><strong>Họ và tên: </strong>@lang(':name', ['name' => $data['name']]) </p>
        <p><strong>Số điện thoại: </strong>@lang(':phone', ['phone' => $data['phone']])</p>
        <p><strong>Địa chỉ trường học: </strong>@lang(':school_address', ['school_address' => $data['school_address'] ?? ''])</p>
        <hr>
    @endif
</body>

</html>
