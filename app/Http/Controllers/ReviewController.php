<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Cafe;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|max:1000',
        ]);

        // Cari cafe berdasarkan id yang diberikan
        $cafe = Cafe::findOrFail($id);

        // Menyimpan ulasan baru
        $review = new Review();
        $review->idCafe = $cafe->idCafe;  // Menyimpan idCafe
        $review->name = $validated['name'];
        $review->email = $validated['email'];
        $review->rating = $validated['rating'];
        $review->review = $validated['review'];

        // Menyimpan ulasan ke database
        $review->save();

        // Redirect kembali ke halaman cafe dengan pesan sukses
        return redirect()->route('cafe.detail', ['id' => $cafe->idCafe])
                         ->with('success', 'Ulasan berhasil dikirim!');
    }
}
