<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\DataBarang;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index(){
        $keluar = BarangKeluar::all();
        $masuk = BarangMasuk::all();
        return view('barang.keluar.view', compact('keluar', 'masuk'));
    }

    public function store(Request $request)
    {
        $store = new BarangKeluar();
        $store->barang_id = $request->barang_id;
        $store->tanggal = $request->tanggal;
        $store->keterangan = $request->keterangan;
        $store->qty = $request->qty;
        $store->save();

        $barang = DataBarang::find($request->barang_id);
        if ($barang) {
            $barang->stok -= $request->qty;
            $barang->save();
        }
        toastr()->success('Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // Temukan data barang masuk yang akan diupdate
        $update = BarangKeluar::findOrFail($id);

        // Simpan jumlah stok yang ada sebelum update
        $previousQty = $update->qty;

        // Update data barang masuk
        $update->barang_id = $request->barang_id;
        $update->tanggal = $request->tanggal;
        $update->keterangan = $request->keterangan;
        $update->qty = $request->qty;
        $update->save(); // Simpan perubahan

        // Ambil data barang untuk diperbarui
        $barang = DataBarang::find($request->barang_id);
        if ($barang) {
            // Sesuaikan stok: Kurangi stok barang berdasarkan jumlah sebelumnya, lalu tambahkan jumlah yang baru
            $barang->stok -= $request->qty - $previousQty;
            $barang->save();
        }
        toastr()->success('Data berhasil diperbarui');
        return redirect()->back();
    }

    public function destroy($id){
        $destroy = BarangKeluar::findOrFail($id);
        $destroy->delete();
        toastr()->success('Data berhasil dihapus');
        return redirect()->back();
    }
}
