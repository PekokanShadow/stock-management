<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hub extends Model
{
    use HasFactory;

    protected $table = 'hub'; // Specify the table name if it's not the plural of the model name

    protected $fillable = [
        'stockid',
        'departemenid',
        'merk',
        'User',
        'bagian',
        'tanggalmasuk',
        'tanggalkeluar',
        'keterangan',
        'kelompok',
        'harga',
        'jenisid',
    ];
}
