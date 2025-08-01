<?php

namespace App\Exports;

use App\Models\Biodata;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnakExport implements FromCollection, WithHeadings, WithMapping
{
    private $no = 1; // ⬅️ Nomor awal

    public function collection()
    {
        return Biodata::all();
    }

    public function map($row): array
    {
        return [
            $this->no++, // ⬅️ Isi kolom No secara increment
            "$row->nik",
            $row->nama,
            $row->nama_orangtua,
            \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y'),
            $row->asal,
            $row->sekolah,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'NIK',
            'Nama',
            'Orangtua',
            'Tanggal Lahir',
            'Asal',
            'Sekolah',
        ];
    }
}
