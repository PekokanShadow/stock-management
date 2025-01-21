<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'cabang', 'departemen', 'jenis', 'tanggal_beli', 'nomor_urut', 'diperiksa_oleh', 'tanggal_periksa',
        // add other fields here that are in your database
    ];
}
