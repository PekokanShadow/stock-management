<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'monitor';

    // Specify the primary key
    protected $primaryKey = 'stockid';

    // Disable timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable properties
    protected $fillable = [
        'stockid',
        'merk',
        'User ',
        'bagian',
        'tanggalmasuk',
        'tanggalkeluar',
        'keterangan',
        'kelompok',
        'departemenid',
    ];
}
