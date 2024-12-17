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
    // public $timestamps = false;
    use HasFactory;

    protected $table = 'reviews'; // Nama tabel ulasan
    protected $fillable = ['idCafe', 'name', 'email', 'rating', 'review', 'created_at'];

<<<<<<< HEAD

=======
    public $timestamps = false;
>>>>>>> f2c4c8c391465d0f34af77168dd9944ae47e9e69
}
