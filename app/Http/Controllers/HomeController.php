<?php

namespace App\Http\Controllers;

use App\Exports\BarangKeluarExport;
use App\Exports\BarangMasukExport;
use App\Exports\DataBarangExport;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\DataBarang;
use App\Exports\MultiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $barang = DataBarang::count();
        $masuk = BarangMasuk::count();
        $keluar = BarangKeluar::count();
        $chartData = [
            'Data Barang' => $barang,
            'Barang Masuk' => $masuk,
            'Barang Keluar' => $keluar,
        ];

        // Pisahkan keys dan values untuk Chart.js
        $labels = array_keys($chartData); // Mendapatkan labels
        $values = array_values($chartData); // Mendapatkan values
        return view('admin.index', compact('barang', 'masuk', 'keluar', 'labels', 'values'));
    }

    public function export()
    {
        return Excel::download(new MultiExport(), 'data_barang.xlsx');
    }
}
