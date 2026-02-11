<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * Kolom mana saja yang boleh diisi secara massal (create/update).
     */
    protected $fillable = [
        'title',
        'description',
        'tech_stack',
        'image',
        'demo_url',
        'source_url', // <--- WAJIB DITAMBAHKAN DI SINI
    ];
}