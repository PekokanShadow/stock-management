<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'notebook';

    // Specify the primary key
    protected $primaryKey = 'id';

    // Disable timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable properties
    protected $fillable = [
        'processor',
        'merk',
        'memory',
        'harddisk',
        'dvd_cd_rw',
        'layar',
        'wifi',
        'webcam',
        'tas',
        'os',
        'antivirus',
        'office',
        'ip',
        'user ',
        'bagian',
        'tanggalmasuk',
        'tanggalkeluar',
        'harga',
        'keterangan',
        'kelompok',
        'departemenid',
    ];
}
