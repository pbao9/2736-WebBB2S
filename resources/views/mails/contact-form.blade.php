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
            width: 50%;
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
        <hr>
        <table>
            <tr>
                <th colspan="2" style="text-align: center; text-transform: uppercase"><strong>Đơn liên hệ tìm
                        xe</strong></th>
            </tr>
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
                <td>Dịch vụ</td>
                <td>
                    @foreach ($service as $key => $value)
                        @if ($key == $data['service'])
                            {{ $value }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Thời gian đón</td>
                <td>
                    @foreach ($session as $key => $value)
                        @if ($key == $data['session_arrive_school'])
                            {{ $value }}
                        @endif
                    @endforeach

                    @lang(':time_arrive_school', ['time_arrive_school' => $data['time_arrive_school']])

                    @foreach ($session as $key => $value)
                        @if ($key == $data['session_off'])
                            {{ $value }}
                        @endif
                    @endforeach
                    @lang(':time_off', ['time_off' => $data['time_off']])
                </td>
            </tr>
        </table>
        <hr>
    @elseif($data['form_type'] == 1)
        <hr>
        <table>
            <tr>
                <th colspan="2" style="text-align: center; text-transform: uppercase"><strong>Đơn liên hệ từ Phụ
                        Huynh</strong></th>
            </tr>
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
        <hr>
        <table>
            <tr>
                <th colspan="2" style="text-align: center; text-transform: uppercase"><strong>Đơn liên hệ từ Trường
                        Học</strong></th>
            </tr>
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
