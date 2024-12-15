<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $primaryKey = 'idReview';

    protected $fillable = ['idCafe', 'name', 'email', 'rating', 'review'];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class, 'idCafe','idCafe');
    }
}
