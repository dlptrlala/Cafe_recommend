<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Cafe;
use App\Models\Review;
use Carbon\Carbon;

class CafeController extends Controller
{
    public function view()
    {
        return view("home");
    }

    public function show($id)
    {
        $cafe = Cafe::with('reviews')->findOrFail($id);

        // Menghitung rata-rata rating cafe
        $averageRating = $cafe->reviews->avg('rating');

        // Menampilkan detail cafe beserta rata-rata rating
        return view('detail', compact('cafe', 'averageRating'));
    }


    // Rekomendasi cafe berdasarkan filter
    public function recommend(Request $request)
    {
        // Validasi input dari user
        $validated = $request->validate([
            'longitude' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'lokasi_area' => 'nullable|string',
            'harga_min' => 'nullable|integer|min:0',
            'harga_max' => 'nullable|integer|min:0',
            'kebutuhan' => 'nullable|string',
            'jam_buka' => 'nullable|date_format:H:i', // Format jam buka
            'jam_tutup' => 'nullable|date_format:H:i', // Format jam tutup
        ]);

        // Ambil data filter
        $longitude = $validated['longitude'] ?? null;
        $latitude = $validated['latitude'] ?? null;
        $lokasi_area = $validated['lokasi_area'] ?? null;
        $harga_min = $validated['harga_min'] ?? 0;
        $harga_max = $validated['harga_max'] ?? PHP_INT_MAX; // Default: tidak ada batas atas
        $kebutuhan = $validated['kebutuhan'] ?? null;
        $jam_buka = $validated['jam_buka'] ?? null;
        $jam_tutup = $validated['jam_tutup'] ?? null;

        // Query dasar
        $query = Cafe::query();

        // Filter berdasarkan lokasi area (kecuali "Semua Lokasi")
        if ($lokasi_area && $lokasi_area !== "Semua Lokasi" && $lokasi_area !== "geo") {
            $query->where('lokasi_area', $lokasi_area);
        }

        // Filter berdasarkan harga
        // $query->where('hargaMin', '>=', $harga_min)
        //     ->where('hargaMax', '<=', $harga_max);
        // Filter berdasarkan harga
        $query->where(function ($q) use ($harga_min, $harga_max) {
            $q->where('hargaMin', '<=', $harga_max)
                ->where('hargaMax', '>=', $harga_min);
        });

        // Filter berdasarkan kebutuhan
        if ($kebutuhan) {
            $query->where("kebutuhan->$kebutuhan", true);
        }

        // Filter berdasarkan geolokasi (jika ada)
        if ($longitude && $latitude) {
            $radius = 5000; // Radius pencarian dalam meter (5 km)
            $query->selectRaw(
                "*, (6371000 * acos(
                cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + 
                sin(radians(?)) * sin(radians(latitude))
            )) AS distance",
                [$latitude, $longitude, $latitude]
            )
                ->having('distance', '<=', $radius)
                ->orderBy('distance', 'asc');
        }

        // // Filter berdasarkan jam buka dan jam tutup
        // if ($jam_buka && $jam_tutup) {
        //     $current_time = now()->format('H:i'); // Waktu saat ini dalam format H:i

        //     // Memastikan waktu saat ini berada dalam rentang jam buka dan tutup
        //     $query->where(function ($q) use ($jam_buka, $jam_tutup, $current_time) {
        //         $q->whereTime('jam_buka', '<=', $current_time)
        //             ->whereTime('jam_tutup', '>=', $current_time);
        //     });
        // }

        // Filter berdasarkan jam buka dan jam tutup
        if ($jam_buka || $jam_tutup) {
            $current_time = now()->format('H:i'); // Waktu saat ini dalam format H:i

            $query->where(function ($q) use ($jam_buka, $jam_tutup, $current_time) {
                // Jika jam buka dan jam tutup disediakan, pastikan waktu saat ini berada di antaranya
                if ($jam_buka && $jam_tutup) {
                    $q->whereTime('jam_buka', '<=', $current_time)
                        ->whereTime('jam_tutup', '>=', $current_time);
                } elseif ($jam_buka) {
                    $q->whereTime('jam_buka', '<=', $current_time);
                } elseif ($jam_tutup) {
                    $q->whereTime('jam_tutup', '>=', $current_time);
                }
            });
        }


        // Eksekusi query
        $cafes = $query->get();

        // Kembalikan data ke view
        return view('home2', compact('cafes'));
    }
    public function showHomePage(Request $request)
    {
        // Mendapatkan hari saat ini
        $hari_ini = Carbon::now()->locale('id')->format('l'); // Menghasilkan nama hari dalam bahasa Indonesia, seperti 'Senin'
        $time_context = $this->getTimeContext(); // Fungsi untuk menentukan konteks waktu

        // Menggabungkan tabel cafes dan jam_operasionals
        $cafes = DB::table('cafes')
            ->join('jam_operasionals', 'cafes.idCafe', '=', 'jam_operasionals.idCafe') // Join berdasarkan idCafe
            ->select(
                'cafes.idCafe',
                'cafes.namaCafe',
                'cafes.gambarCafe as image_url',
                'cafes.alamatCafe as alamatCafe',
                'cafes.latitude',
                'cafes.longitude',
                'cafes.hargaMin',
                'cafes.hargaMax',
                'cafes.deskripsi as deskripsiCafe',
                DB::raw("JSON_UNQUOTE(JSON_EXTRACT(jam_operasionals.jadwal, '$[*].hari')) as hari_operasional"),
                DB::raw("JSON_UNQUOTE(JSON_EXTRACT(jam_operasionals.jadwal, '$[0].jam_buka')) as jam_buka"),
                DB::raw("JSON_UNQUOTE(JSON_EXTRACT(jam_operasionals.jadwal, '$[0].jam_tutup')) as jam_tutup")
            )
            ->distinct() // Menghindari duplikasi
            ->get();

        return view('home', compact('time_context', 'cafes'));
    }

    public function recommendByTimeContext()
    {
        // Mendapatkan hari saat ini
        $hari_ini = Carbon::now()->locale('id')->format('l'); // Menghasilkan nama hari dalam bahasa Indonesia, seperti 'Senin'
        $time_context = $this->getTimeContext(); // Mendapatkan konteks waktu
        $current_time = now()->format('H:i'); // Waktu saat ini dalam format 24 jam (08:00:00)

        // Query data kafe dan jam buka dari tabel 'cafes' dan 'jam_operasionals'
        $cafes = Cafe::join('jam_operasionals', 'cafes.idCafe', '=', 'jam_operasionals.idCafe')
            ->select(
                'cafes.idCafe',
                'cafes.namaCafe',
                'cafes.gambarCafe as image_url',
                'cafes.alamatCafe as alamatCafe',
                'cafes.latitude',
                'cafes.longitude',
                'cafes.hargaMin',
                'cafes.hargaMax',
                'cafes.deskripsi as deskripsiCafe',
                DB::raw("JSON_UNQUOTE(JSON_EXTRACT(jam_operasionals.jadwal, '$[*].hari')) as hari_operasional"),
                DB::raw("JSON_UNQUOTE(JSON_EXTRACT(jam_operasionals.jadwal, '$[0].jam_buka')) as jam_buka"),
                DB::raw("JSON_UNQUOTE(JSON_EXTRACT(jam_operasionals.jadwal, '$[0].jam_tutup')) as jam_tutup")
            )
            ->whereRaw("TIME(JSON_UNQUOTE(JSON_EXTRACT(jam_operasionals.jadwal, '$[0].jam_buka'))) <= ?", [$current_time]) // Buka sebelum waktu sekarang
            ->whereRaw("TIME(JSON_UNQUOTE(JSON_EXTRACT(jam_operasionals.jadwal, '$[0].jam_tutup'))) >= ?", [$current_time]) // Tutup setelah waktu sekarang
            ->orderBy(DB::raw("JSON_UNQUOTE(JSON_EXTRACT(jam_operasionals.jadwal, '$[0].jam_buka'))"), 'asc') // Urutkan berdasarkan jam buka
            ->get();

        // Menyaring cafe berdasarkan hari yang sesuai dengan hari ini
        $cafes_filtered = $cafes->filter(function ($cafe) use ($hari_ini) {
            // Mengubah string JSON menjadi array PHP
            $hari_operasional = json_decode($cafe->hari_operasional);

            // Mengecek apakah hari ini ada dalam array hari operasional cafe
            return in_array($hari_ini, $hari_operasional);
        });

        return view('home', compact('time_context', 'cafes', 'cafes_filtered'));
    }



    // public function showHomePage(Request $request)
    // {
    //     $time_context = $this->getTimeContext(); // Fungsi untuk menentukan konteks waktu
    //     $cafes = Cafe::all(); // Contoh data cafe
    //     return view('home', compact('time_context', 'cafes'));
    // }

    // public function recommendByTimeContext()
    // {
    //     $time_context = $this->getTimeContext(); // Mendapatkan konteks waktu
    //     $current_time = now()->format('H:i:s'); // Waktu saat ini dengan format 24 jam (08:00:00)

    //     // Query cafe yang buka sesuai waktu saat ini
    //     $cafes = Cafe::whereTime('jam_buka', '<=', $current_time)
    //         ->whereTime('jam_tutup', '>=', $current_time)
    //         ->orderBy('jam_buka', 'asc')  // Urutkan berdasarkan jam buka
    //         ->get();

    //     // Kirim data cafe dan waktu ke view 'home'
    //     return view('home', compact('time_context', 'cafes'));
    // }

    // Method untuk menentukan konteks waktu
    private function getTimeContext()
    {
        $hour = now()->hour;
        if ($hour >= 5 && $hour < 12) {
            return 'pagi';
        } elseif ($hour >= 12 && $hour < 18) {
            return 'siang';
        } elseif ($hour >= 18 && $hour < 22) {
            return 'malam';
        } else {
            return 'dini hari';
        }
    }


    // public function storeReview(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'rating' => 'required|integer|min:1|max:5',
    //         'review' => 'required|string',
    //     ]);

    //     Review::create([
    //         'idCafe' => $id,
    //         'name' => $validated['name'],
    //         'email' => $validated['email'],
    //         'rating' => $validated['rating'],
    //         'review' => $validated['review'],
    //     ]);

    //     return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan!');
    // }


    public function storeReview(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        // Simpan ulasan ke database
        $review = new Review();
        $review->idCafe = $id; // ID cafe yang diulas
        $review->name = $validatedData['name'];
        $review->email = $validatedData['email'];
        $review->rating = $validatedData['rating'];
        $review->review = $validatedData['review'];
        $review->created_at = now();

        // Simpan data
        $review->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Ulasan Anda berhasil disimpan!');
    }


    public function daftarCafe()
    {
        // Mengambil semua data cafe dari database
        $cafes = Cafe::all();

        // Mengirim data cafe ke view
        return view('daftarCafe', compact('cafes'));
    }

    // public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     // Mencari cafe berdasarkan nama atau lokasi
    //     $cafes = Cafe::where('namaCafe', 'LIKE', "%$query%")
    //         ->orWhere('lokasi_area', 'LIKE', "%$query%")
    //         ->get();

    //     // Mengembalikan hasil pencarian ke view
    //     return view('search', compact('cafes', 'query'));
    // }

    public function search(Request $request)
    {
        $query = $request->input('query'); // Menangkap query pencarian

        // Pencarian berdasarkan nama atau lokasi
        $cafes = Cafe::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('namaCafe', 'like', '%' . $query . '%')
                ->orWhere('lokasi_area', 'like', '%' . $query . '%') // Mencari berdasarkan lokasi
                ->orWhereRaw("JSON_UNQUOTE(JSON_EXTRACT(kebutuhan, '$.\"$query\"')) = 'true'"); // Mencari berdasarkan kebutuhan
        })->get();

        return view('search', compact('cafes', 'query'));
    }
}
