<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;

    // TAMBAHKAN BARIS INI:
    // Ini artinya: "Izinkan semua kolom diisi secara massal"
    protected $guarded = []; 
}