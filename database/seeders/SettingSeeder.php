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
                'setting_key' => 'company',
                'setting_name' => 'Tên công ty',
                'plain_value' => 'Công ty cổ phần Kỹ thuật Công nghệ HP',
                'type_input' => SettingTypeInput::Text,
                'group' => 2
            ],
            [
                'setting_key' => 'slogan',
                'setting_name' => 'Slogan',
                'plain_value' => 'BABI2SCHOOL - AN TOÀN ĐẾN TRƯỜNG',
                'type_input' => SettingTypeInput::Text,
                'group' => 2
            ],
            [
                'setting_key' => 'site_logo',
                'setting_name' => 'Logo',
                'plain_value' => '/public/assets/images/logo.jpg',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            [
                'setting_key' => 'logo_footer',
                'setting_name' => 'Logo Footer',
                'plain_value' => '/public/assets/images/favi-icon.png',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            [
                'setting_key' => 'favi_icon',
                'setting_name' => 'Favi icon',
                'plain_value' => '/public/assets/images/favi-icon.png',
                'type_input' => SettingTypeInput::Image,
                'group' => 1
            ],
            [
                'setting_key' => 'slot_seat',
                'setting_name' => 'Số chỗ còn',
                'plain_value' => '50',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'hotline',
                'setting_name' => 'Hotline 1',
                'plain_value' => '0822625562',
                'type_input' => SettingTypeInput::Text,
                'group' => 2
            ],
            [
                'setting_key' => 'hotline-1',
                'setting_name' => 'Hotline 2',
                'plain_value' => '0924229988',
                'type_input' => SettingTypeInput::Text,
                'group' => 2
            ],
            [
                'setting_key' => 'email',
                'setting_name' => 'Email',
                'plain_value' => 'mevivu@gmail.com',
                'type_input' => SettingTypeInput::Email,
                'group' => 1
            ],
            [
                'setting_key' => 'address',
                'setting_name' => 'Địa chỉ',
                'plain_value' => 'Tầng 12 Tháp A2 Tòa nhà Viettel số 285 Cách Mạng Tháng Tám, Phường 12, Quận 10, Thành phố Hồ Chí Minh',
                'type_input' => SettingTypeInput::Text,
                'group' => 2
            ],
            [
                'setting_key' => 'tax_code',
                'setting_name' => 'Mã số doanh nghiệp',
                'plain_value' => '0318155206 do Sở Kế Hoạch và Đầu Tư TP. Hồ Chí Minh cấp năm 2023',
                'type_input' => SettingTypeInput::Text,
                'group' => 2
            ],
            [
                'setting_key' => 'facebook',
                'setting_name' => 'Facebook',
                'plain_value' => 'https://www.facebook.com/BabiToSchool/',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'video',
                'setting_name' => 'video',
                'plain_value' => '/public/assets/videos/Babi2school-FINAL-1.mp4',
                'type_input' => SettingTypeInput::Video,
                'group' => 1
            ],
            [
                'setting_key' => 'introduce',
                'setting_name' => 'Thông tin giới thiệu',
                'plain_value' => 'DỊCH VỤ CÔNG NGHỆ ĐƯA ĐÓN HỌC SINH BẰNG XE 7 CHỖ',
                'type_input' => SettingTypeInput::Textarea,
                'group' => 2
            ],
            [
                'setting_key' => 'ch_play_link',
                'setting_name' => 'CH Link Download',
                'plain_value' => 'https://play.google.com/store/apps/details?id=mevivu.com.babi2schoolvi',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
            [
                'setting_key' => 'app_store_link',
                'setting_name' => 'App Store Download',
                'plain_value' => 'https://www.apple.com/app-store/',
                'type_input' => SettingTypeInput::Text,
                'group' => 1
            ],
        ]);
    }
}
