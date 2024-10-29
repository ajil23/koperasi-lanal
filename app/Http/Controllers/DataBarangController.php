<?php

namespace App\Http\Controllers;

use App\Models\DataBarang;
use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    public function index(){
        $barang = DataBarang::all();
        return view('barang.data.view', compact('barang'));
    }

    public function store(Request $request){
        $storeBarang = new DataBarang();
        $storeBarang->nama = $request->nama;
        $storeBarang->satuan = $request->satuan;
        
        $storeBarang->deskripsi = $request->deskripsi;
        $storeBarang->save();
        toastr()->success('Data berhasil ditambahkan');
        return redirect()->back();
    }
    
    public function update(Request $request, $id) {
        $barang = DataBarang::find($id);
        $barang->nama = $request->nama;
        $barang->satuan = $request->satuan;
        
        $barang->deskripsi = $request->deskripsi;
        $barang->save();
        toastr()->success('Data berhasil diperbarui');
        return redirect()->back();
    }
    
    
    public function destroy($id){
        $destroy = DataBarang::findOrFail($id);
        $destroy->delete();
        toastr()->success('Data berhasil dihapus');
        return redirect()->back();
    }
}
