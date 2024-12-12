<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    public $timestamps = false;
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
