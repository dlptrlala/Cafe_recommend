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

    // untuk menampilkan detail cafe
    public function show($id)
    {
        $cafe = Cafe::with(['reviews', 'jamOperasionals'])->findOrFail($id);

        // Memodifikasi nama cafe untuk setiap cafe
        $cafe->namaCafe = ucwords(strtolower($cafe->namaCafe)); // Ubah nama cafe menjadi kapital di awal setiap kata
        // Menghitung rata-rata rating cafe
        $averageRating = $cafe->reviews->avg('rating');

        // Mendapatkan hari saat ini dalam bahasa Indonesia
        $hariSekarang = Carbon::now()->locale('id')->dayName;

        // Menyaring jam operasional berdasarkan hari
        $jamOperasional = [];
        foreach ($cafe->jamOperasionals as $jam) {
            if (is_array($jam->jadwal)) {
                foreach ($jam->jadwal as $item) {
                    // Periksa apakah hari ini termasuk dalam hari yang ada di jadwal
                    if (in_array($hariSekarang, $item['hari'])) {
                        $jamOperasional[] = $item;
                    }
                }
            }
        }

        // Menampilkan detail cafe beserta rata-rata rating
        return view('detail', compact('cafe', 'averageRating', 'jamOperasional', 'hariSekarang'));
    }

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

    // Rekomendasi cafe berdasarkan filter langsung ke home2
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
        // $query = Cafe::query();
        $query = Cafe::query()
            ->leftJoin('jam_operasionals', 'cafes.idCafe', '=', 'jam_operasionals.idCafe')
            ->select('cafes.*', 'jam_operasionals.jadwal');

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
        // Filter berdasarkan jam buka dan jam tutup
        // Ambil data cafe
        $cafes = $query->get();

        // Tambahkan jam operasional berdasarkan hari ini
        $hari_ini = now()->locale('id')->isoFormat('dddd'); // Hari ini dalam format nama hari

        foreach ($cafes as $cafe) {
            $jam_operasional = json_decode($cafe->jadwal, true); // Decode JSON jadwal
            $jam_buka = 'Tidak tersedia';
            $jam_tutup = 'Tidak tersedia';

            // Loop untuk mencari jam buka dan tutup berdasarkan hari ini
            foreach ($jam_operasional as $operasional) {
                if (in_array($hari_ini, $operasional['hari'])) {
                    $jam_buka = $operasional['jam_buka'];
                    $jam_tutup = $operasional['jam_tutup'];
                    break;
                }
            }

            // Menyimpan jam operasional dalam objek cafe
            $cafe->jam_buka = $jam_buka;
            $cafe->jam_tutup = $jam_tutup;
        }
        // Memodifikasi nama cafe untuk setiap cafe
        foreach ($cafes as $cafe) {
            $cafe->namaCafe = ucwords(strtolower($cafe->namaCafe)); // Ubah nama cafe menjadi kapital di awal setiap kata
        }

        // Kembalikan data ke view
        return view('home2', compact('cafes'));
    }

    // menampilkan context aware di home
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

        // Memodifikasi nama cafe untuk setiap cafe
        foreach ($cafes as $cafe) {
            $cafe->namaCafe = ucwords(strtolower($cafe->namaCafe)); // Ubah nama cafe menjadi kapital di awal setiap kata
        }
        return view('home', compact('time_context', 'cafes'));
    }

    // untuk merekomendasi context aware
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


    // Method untuk menentukan konteks waktu
    private function getTimeContext()
    {
        $hour = now()->hour;
        if ($hour >= 5 && $hour < 12) {
            return 'pagi';
        } elseif ($hour >= 12 && $hour < 18) {
            return 'siang';
        } elseif ($hour >= 18 && $hour < 23) {
            return 'malam';
        } else {
            return 'dini hari';
        }
    }

    public function daftarCafe()
    {
        // Mengambil semua data cafe dari database
        $cafes = Cafe::all();

        // Mengirim data cafe ke view
        return view('daftarCafe', compact('cafes'));
    }


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
