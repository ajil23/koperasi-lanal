<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'masuk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'barang_id', 'tanggal', 'keterangan', 'qty'
    ];

    public function barang(){
        return $this->belongsTo(DataBarang::class, 'barang_id', 'id');
    }
}
