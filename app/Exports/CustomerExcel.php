<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Customer;

class CustomerExcel implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Customer::all();
    }
    public function map($customer): array
    {
        return [
            $customer->name,
            $customer->email,
            $customer->gender,
            $customer->phone,
            $customer->address,

        ];
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Gender',
            'Phone',
            'Address'
        ];
    }
}
