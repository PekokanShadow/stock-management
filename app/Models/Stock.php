<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'stock';

    // Specify the primary key
    protected $primaryKey = 'id';

    // Disable timestamps if your table doesn't have created_at and updated_at columns
    public $timestamps = false;

    // Define the fillable properties
    protected $fillable = [
        'cabangid',
        'departemenid',
        'jenisid',
        'tanggalbeli',
        'nomorurut',
        'diperiksaoleh',
        'tanggalperiksa',
        'stocknumber',
    ];
}
