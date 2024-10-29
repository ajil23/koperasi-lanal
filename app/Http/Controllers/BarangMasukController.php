<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\DataBarang;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    public function index()
    {
        $masuk = BarangMasuk::all();
        $barang = DataBarang::all();
        return view('barang.masuk.view', compact('masuk', 'barang'));
    }

    public function store(Request $request)
    {
        $store = new BarangMasuk();
        $store->barang_id = $request->barang_id;
        $store->tanggal = $request->tanggal;
        $store->keterangan = $request->keterangan;
        $store->qty = $request->qty;
        $store->save();

       
        toastr()->success('Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        // Temukan data barang masuk yang akan diupdate
        $update = BarangMasuk::findOrFail($id);

        // Simpan jumlah stok yang ada sebelum update
        $previousQty = $update->qty;

        // Update data barang masuk
        $update->barang_id = $request->barang_id;
        $update->tanggal = $request->tanggal;
        $update->keterangan = $request->keterangan;
        $update->qty = $request->qty;
        $update->save(); // Simpan perubahan

        // Ambil data barang untuk diperbarui
       
        toastr()->success('Data berhasil diperbarui');
        return redirect()->back();
    }

    public function destroy($id) {
        $destroy = BarangMasuk::findOrFail($id);
        $destroy->delete();
        toastr()->success('Data berhasil dihapus');
        return redirect()->back();
    }
}
