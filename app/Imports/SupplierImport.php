<?php

namespace App\Imports;

use App\Models\Penduduks;
use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SupplierImport implements ToModel, WithStartRow, WithCalculatedFormulas, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }


    public function model(array $row)
    {

        return new Supplier([
            'name' => $row[0],
            'phone' => $row[1],
            'address' => $row[2],
            'description' => $row[3],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
    public function batchSize(): int
    {
        return 2000;
    }
}
