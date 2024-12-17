<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    // use HasFactory;
    // public $timestamps = true;
    // protected $primaryKey = 'idReview';

    // protected $fillable = ['idCafe', 'name', 'email', 'rating', 'review'];

    // public function cafe()
    // {
    //     return $this->belongsTo(Cafe::class, 'idCafe', 'idCafe');
    // }

    // // Relasi dengan model User (satu ke banyak)
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'idUser', 'id');
    // }

    use HasFactory;

    protected $table = 'reviews'; // Nama tabel ulasan
    protected $fillable = ['idCafe', 'name', 'email', 'rating', 'review', 'created_at'];

    public $timestamps = false;
}
