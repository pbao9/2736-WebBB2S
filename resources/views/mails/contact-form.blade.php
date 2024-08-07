<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@lang('LIÊN HỆ BABI2SCHOOL')</title>

    <link href="{{ asset('public/libs/tabler/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/libs/tabler/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/libs/tabler/plugins/tabler-icon/webfont/tabler-icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    @if ($data['form_type'] == 0)
        <p>Xin chào bạn vừa nhận được <strong>Đơn liên hệ tìm xe</strong></p>
        <hr>
        <table>
            <tr>
                <th>Thông tin</th>
                <th>Chi tiết</th>
            </tr>
            <tr>
                <td>Người liên hệ</td>
                <td>
                    @foreach ($type as $key => $value)
                        @if ($key == $data['type'])
                            {{ $value }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Họ và tên</td>
                <td>@lang(':name', ['name' => $data['name']])</td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td>@lang(':phone', ['phone' => $data['phone']])</td>
            </tr>
            <tr>
                <td>Tỉnh/Thành</td>
                <td>
                    @foreach ($province as $item)
                        @if ($item->code == $data['province_code'])
                            {{ $item->name }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Quận/Huyện</td>
                <td>
                    @foreach ($district as $item)
                        @if ($item->code == $data['district_code'])
                            {{ $item->name }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Địa chỉ đón/trả</td>
                <td>@lang(':location', ['location' => $data['location']])</td>
            </tr>
            <tr>
                <td>Trường học</td>
                <td>
                    @if ($data['school_other'] == 0)
                        @foreach ($school as $item)
                            @if ($item->id == $data['school_id'])
                                {{ $item->name }} - {{ $item->address }}
                            @endif
                        @endforeach
                    @else
                        @lang(':school_name', ['school_name' => $data['school_name']])
                    @endif
                </td>
            </tr>
            <tr>
                <td>Thời gian đón</td>
                <td>@lang(':time_pickup', ['time_pickup' => $data['time_pickup']])</td>
            </tr>
        </table>
        <hr>
    @elseif($data['form_type'] == 1)
        <p>Xin chào bạn vừa nhận được <strong>Đơn liên hệ từ Phụ Huynh</strong></p>
        <hr>
        <table>
            <tr>
                <th>Thông tin</th>
                <th>Chi tiết</th>
            </tr>
            <tr>
                <td>Họ và tên</td>
                <td>@lang(':name', ['name' => $data['name']])</td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td>@lang(':phone', ['phone' => $data['phone']])</td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td>@lang(':address', ['address' => $data['address'] ?? ''])</td>
            </tr>
            <tr>
                <td>Tên trường học</td>
                <td>@lang(':school_name', ['school_name' => $data['school_name'] ?? ''])</td>
            </tr>
            <tr>
                <td>Địa chỉ trường học</td>
                <td>@lang(':school_address', ['school_address' => $data['school_address'] ?? ''])</td>
            </tr>
        </table>
        <hr>
    @else
        <p>Xin chào bạn vừa nhận được <strong>Đơn liên hệ từ Trường Học</strong></p>
        <hr>
        <table>
            <tr>
                <th>Thông tin</th>
                <th>Chi tiết</th>
            </tr>
            <tr>
                <td>Họ và tên</td>
                <td>@lang(':name', ['name' => $data['name']])</td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td>@lang(':phone', ['phone' => $data['phone']])</td>
            </tr>
            <tr>
                <td>Địa chỉ trường học</td>
                <td>@lang(':school_address', ['school_address' => $data['school_address'] ?? ''])</td>
            </tr>
        </table>
        <hr>
    @endif
</body>

</html>