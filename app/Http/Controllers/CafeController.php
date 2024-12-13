<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cafe;
use Carbon\Carbon;

class CafeController extends Controller
{
    public function view()
    {
        return view("home");
    }
    public function show($id)
    {
        // Menemukan cafe berdasarkan ID
        $cafe = Cafe::findOrFail($id);

        // Menampilkan view detail cafe
        return view('detail', compact('cafe'));
    }
    // public function recommend(Request $request)
    // {
    //     $longitude = $request->input('longitude');
    //     $latitude = $request->input('latitude');
    //     $userNeeds = $request->input('kebutuhan');
    //     $currentTime = now()->format('H:i');
    //     $radius = 5000; // Radius pencarian dalam meter (5 km)

    //     // Query untuk mencari cafe dalam radius tertentu
    //     $cafes = DB::table('cafes')
    //         ->select('*', DB::raw("
    //         (6371000 * acos(
    //             cos(radians(?)) *
    //             cos(radians(latitude)) *
    //             cos(radians(longitude) - radians(?)) +
    //             sin(radians(?)) *
    //             sin(radians(latitude))
    //         )) AS distance
    //     "))
    //         ->having('distance', '<=', $radius)
    //         ->where('jam_buka', '<=', $currentTime)
    //         ->where('jam_tutup', '>=', $currentTime)
    //         ->whereJsonContains('kebutuhan', $userNeeds)
    //         ->setBindings([$latitude, $longitude, $latitude])
    //         ->orderBy('distance', 'asc')
    //         ->get();

    //     return response()->json($cafes);
    // }
    // public function recommend(Request $request)
    // {
    //     $longitude = $request->input('longitude');
    //     $latitude = $request->input('latitude');
    //     $lokasi_area = $request->input('lokasi_area');

    //     $query = Cafe::query();

    //     if ($longitude && $latitude) {
    //         // Filter berdasarkan geolokasi (radius 5 km)
    //         $query->selectRaw(
    //             "*, (6371000 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance",
    //             [$latitude, $longitude, $latitude]
    //         )->having('distance', '<=', 5000)->orderBy('distance', 'asc');
    //     } elseif ($lokasi_area) {
    //         // Filter berdasarkan lokasi area manual
    //         $query->where('lokasi_area', $lokasi_area);
    //     }

    //     $cafes = $query->get();

    //     return view('home', compact('cafes'));
    // }

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
        ]);

        // Ambil data filter
        $longitude = $validated['longitude'] ?? null;
        $latitude = $validated['latitude'] ?? null;
        $lokasi_area = $validated['lokasi_area'] ?? null;
        $harga_min = $validated['harga_min'] ?? 0;
        $harga_max = $validated['harga_max'] ?? PHP_INT_MAX; // Default: tidak ada batas atas
        $kebutuhan = $validated['kebutuhan'] ?? null;

        // Ambil waktu saat ini
        $currentTime = Carbon::now()->format('H:i');

        // Query dasar
        $query = Cafe::query();

        // Filter berdasarkan lokasi area (kecuali "Semua Lokasi")
        if ($lokasi_area && $lokasi_area !== "Semua Lokasi" && $lokasi_area !== "geo") {
            $query->where('lokasi_area', $lokasi_area);
        }

        // Filter berdasarkan harga
        $query->where('hargaMin', '>=', $harga_min)
            ->where('hargaMax', '<=', $harga_max);

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

        // // Filter berdasarkan jam buka
        // $query->where('jam_buka', '<=', $currentTime)
        //     ->where('jam_tutup', '>', $currentTime);

        // Eksekusi query
        $cafes = $query->get();

        // Kembalikan data ke view
        return view('home2', compact('cafes'));
    }

    // public function recommend(Request $request)
    // {
    //     // Validasi input dari user
    //     $validated = $request->validate([
    //         'longitude' => 'nullable|numeric',
    //         'latitude' => 'nullable|numeric',
    //         'lokasi_area' => 'nullable|string',
    //         'harga_min' => 'nullable|integer|min:0',
    //         'harga_max' => 'nullable|integer|min:0',
    //         'kebutuhan' => 'nullable|string',
    //     ]);

    //     // Ambil data filter
    //     $longitude = $validated['longitude'] ?? null;
    //     $latitude = $validated['latitude'] ?? null;
    //     $lokasi_area = $validated['lokasi_area'] ?? null;
    //     $harga_min = $validated['harga_min'] ?? 0;
    //     $harga_max = $validated['harga_max'] ?? PHP_INT_MAX; // Default: tidak ada batas atas
    //     $kebutuhan = $validated['kebutuhan'] ?? null;

    //     // Query dasar
    //     $query = Cafe::query();

    //     // Filter berdasarkan lokasi area
    //     if ($lokasi_area && $lokasi_area !== "Semua Lokasi") {
    //         $query->where('lokasi_area', $lokasi_area);
    //     }       

    //     // Filter berdasarkan harga
    //     $query->where('hargaMin', '>=', $harga_min)
    //         ->where('hargaMax', '<=', $harga_max);

    //     // Filter berdasarkan kebutuhan
    //     if ($kebutuhan) {
    //         $query->where("kebutuhan->$kebutuhan", true);
    //     }        

    //     // Filter berdasarkan geolokasi (jika ada)
    //     if ($longitude && $latitude) {
    //         $query->selectRaw(
    //             "*, (6371000 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance",
    //             [$latitude, $longitude, $latitude]
    //         )->having('distance', '<=', 5000) // Radius pencarian 5 km
    //         ->orderBy('distance', 'asc');
    //     }

    //     // Eksekusi query
    //     $cafes = $query->get();

    //     // Kembalikan data ke view
    //     return view('home', compact('cafes'));
    // }
}
