<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PengeluaranExcel implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Pengeluaran::all();
    }
    public function map($pengeluaran): array
    {
        return [
            $pengeluaran->pengeluaran_id,
            $pengeluaran->pengeluaran_count,
            $pengeluaran->keterangan

        ];
    }
    public function headings(): array
    {
        return [
            '#',
            'Pengeluaran',
            'Keterangan'

        ];
    }
}
