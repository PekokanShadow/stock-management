<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komputer extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'komputer';

    // Specify the primary key
    protected $primaryKey = 'id';

    // Disable timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable properties
    protected $fillable = [
        'departmentid',
        'processor',
        'motherboard',
        'memory',
        'harddisk',
        'lancard',
        'vgacard',
        'mouse',
        'keyboard',
        'os',
        'antivirus',
        'office',
        'ip',
        'user ',
        'bagian',
        'expantivirus',
        'tanggalmasuk',
        'tanggalkeluar',
        'harga',
        'keterangan',
        'kelompok',
    ];
}
