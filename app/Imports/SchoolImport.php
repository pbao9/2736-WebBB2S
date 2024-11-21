<?php

namespace App\Imports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\ValidationException;

class SchoolImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    use Importable;

    private $requiredHeaders = ['id', 'name', 'province_code', 'district_code'];

    public function model(array $row)
    {
        // Nếu không có cột 'id' trong Excel, sẽ để cho Laravel tự động tạo id mới
        $newId = empty($row['id']) ? null : $row['id']; // Nếu không có id thì sẽ để null

        return School::updateOrCreate(
            ['id' => $newId], // Tìm bản ghi theo ID hoặc tạo mới
            [
                'name' => $row['name'], // Cập nhật tên trường
                'province_code' => $row['province_code'], // Cập nhật mã tỉnh
                'district_code' => $row['district_code'], // Cập nhật mã quận/huyện
            ]
        );
    }

    public function headingRow(): int
    {
        return 1; // Dòng đầu tiên là tiêu đề
    }

    public function collection($collection)
    {
        $this->validateHeaders($collection->first()->keys()->toArray());
    }

    private function validateHeaders(array $sheetHeaders)
    {
        $missingHeaders = array_diff($this->requiredHeaders, $sheetHeaders);
        if (!empty($missingHeaders)) {
            $failures = collect($missingHeaders)->map(function ($header) {
                return "Thiếu cột: $header";
            })->toArray();

            throw ValidationException::withMessages($failures);
        }
    }
}