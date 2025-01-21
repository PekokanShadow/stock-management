<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ups extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'ups';

    // Specify the primary key
    protected $primaryKey = 'id';

    // Disable timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable properties
    protected $fillable = [
        'merk',
        'user',
        'bagian',
        'tanggalmasuk',
        'tanggalkeluar',
        'harga',
        'keterangan',
        'kelompok',
        'stocknumber',
        'departemenid'
    ];
}
