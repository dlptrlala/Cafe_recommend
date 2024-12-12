<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JamOperasional extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $primaryKey = 'idJam'; // Primary key
    protected $fillable = [
        'idCafe',
        'hari_operasional',
        'jam_buka',
        'jam_tutup',
    ];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'idCafe');
    }
}
