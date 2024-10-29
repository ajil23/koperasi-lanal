<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;
    protected $table = 'databarang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama', 'satuan', 'deskripsi'
    ];
}
