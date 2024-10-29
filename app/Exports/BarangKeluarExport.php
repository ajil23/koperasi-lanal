<?php

namespace App\Exports;

use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangKeluarExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BarangKeluar::with('barang')->get()->map(function ($item) {
            return [
                'barang' => $item->barang ? $item->barang->nama : 'N/A', // Mengambil nama barang
                'qty' => $item->qty,
                'tanggal' => $item->tanggal,
                'keterangan' => $item->keterangan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Barang', // Mengganti 'barang_id' dengan 'Nama Barang'
            'Kuantitas',
            'Tanggal',
            'Keterangan',
        ];
    }
}
