<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cafe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'idCafe'; // Primary key
    protected $fillable = [
        'namaCafe',
        'gambarCafe',
        'lokasi_area',
        'latitude',
        'longitude',
        'hargaMin',
        'hargaMax',
        'kebutuhan',
        'jam_buka',
        'jam_tutup',
        'deskripsi',
    ];

    protected $casts = [
        'kebutuhan' => 'array', // Menyimpan JSON sebagai array
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'idCafe');
    }

    public function jamOperasionals()
    {
        return $this->hasMany(JamOperasional::class, 'idCafe');
    }
}
