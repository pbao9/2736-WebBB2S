<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\Setting\SettingTypeInput;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->truncate();
        DB::table('settings')->insert([
            [
                'setting_key' => 'site_name',
                'setting_name' => 'Tên site',
                'plain_value' => 'Babi2School',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'info',
                'setting_name' => 'Thông tin giới thiệu',
                'plain_value' => 'Babi2School',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'site_logo',
                'setting_name' => 'Logo',
                'plain_value' => '/public/assets/images/favi-icon.png',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            [
                'setting_key' => 'banner_on_app',
                'setting_name' => 'Banner trên App',
                'plain_value' => '/public/assets/images/favi-icon.png',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            [
                'setting_key' => 'slot_seat',
                'setting_name' => 'Số chỗ còn',
                'plain_value' => '2',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'hotline',
                'setting_name' => 'Số điện thoại',
                'plain_value' => '0822625562',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'hotline-1',
                'setting_name' => 'Số điện thoại 1',
                'plain_value' => '0924229988',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'email',
                'setting_name' => 'Email',
                'plain_value' => 'mevivu@gmail.com',
                'type_input' => SettingTypeInput::Email,
                'group' => 1
            ],
            [
                'setting_key' => 'zalo',
                'setting_name' => 'Zalo',
                'plain_value' => '0924229988',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'address',
                'setting_name' => 'Địa chỉ',
                'plain_value' => 'Tầng 12 Tháp A2 Tòa nhà Viettel số 285 Cách Mạng Tháng Tám, Phường 12, Quận 10, Thành phố Hồ Chí Minh',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'facebook',
                'setting_name' => 'Facebook',
                'plain_value' => 'https://www.facebook.com/profile.php?id=61557847006591',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
        ]);
    }
}
