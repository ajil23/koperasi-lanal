<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'keluar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'masuk_id', 'tanggal', 'keterangan', 'qty'
    ];

    public function masuk(){
        return $this->belongsTo(BarangMasuk::class, 'masuk_id', 'id');
    }
}
