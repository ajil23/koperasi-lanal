<?php

namespace App\Exports;

use App\Models\DataBarang;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        return [
            new DataBarangExport(),
            new BarangMasukExport(),
            new BarangKeluarExport(),
        ];
    }
}
