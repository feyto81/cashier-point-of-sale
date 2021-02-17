<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CustomerImport implements ToModel, WithStartRow, WithCalculatedFormulas, WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => $this
        ];
    }


    public function model(array $row)
    {

        return new Customer([
            'name' => $row[0],
            'email' => $row[1],
            'gender' => $row[2],
            'phone' => $row[3],
            'address' => $row[4],
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
