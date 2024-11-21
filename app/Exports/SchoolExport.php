<?php

namespace App\Exports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SchoolExport implements FromCollection, WithHeadings, WithEvents
{
    /**
     * Lấy dữ liệu từ bảng School để xuất ra Excel.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return School::select('id', 'name', 'province_code', 'district_code')->get();
    }

    /**
     * Đặt các tiêu đề cột cho file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'name',
            'province_code',
            'district_code',
        ];
    }

    /**
     * Đăng ký các sự kiện.
     *
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            // Đăng ký sự kiện AfterSheet để thêm tính năng Fixed Heading
            AfterSheet::class => function (AfterSheet $event) {
                // Cố định hàng đầu tiên (header) của sheet
                $event->sheet->freezePane('A2'); // Freeze từ A2 trở đi, tức là hàng 1 sẽ cố định
            },
        ];
    }
}
