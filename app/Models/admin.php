<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin'; // Specify the table name if it's not the plural of the model name

    protected $fillable = [
        'name',
        'Username',
        'password',
        'tanggalmasuk',
        'tanggalkeluar',
        'keterangan',
        'kelompok',
        'harga',
    ];
}
