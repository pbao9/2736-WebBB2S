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

    private $requiredHeaders = ['name', 'address', 'province_code', 'district_code'];

    public function model(array $row)
    {
        return new School([
            'name' => $row['name'],
            'address' => $row['address'],
            'province_code' => $row['province_code'],
            'district_code' => $row['district_code'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
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