<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JamOperasional extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'jam_operasionals';
    protected $fillable = [
        'idCafe', // Kunci asing yang merujuk ke tabel 'cafes'
        'jadwal', // Kolom JSON untuk jadwal operasional
    ];
    // Menentukan cast untuk kolom yang disimpan dalam format JSON
    protected $casts = [
        'jadwal' => 'array', // Menyimpan JSON sebagai array
    ];
    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'idCafe');
    }
}
