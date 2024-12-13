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

        // Filter berdasarkan jam buka dan jam tutup
        if ($jam_buka && $jam_tutup) {
            $current_time = now()->format('H:i'); // Waktu saat ini dalam format H:i

            // Memastikan waktu saat ini berada dalam rentang jam buka dan tutup
            $query->where(function ($q) use ($jam_buka, $jam_tutup, $current_time) {
                $q->whereTime('jam_buka', '<=', $current_time)
                    ->whereTime('jam_tutup', '>=', $current_time);
            });
        }

        // Eksekusi query
        $cafes = $query->get();

        // Kembalikan data ke view
        return view('home2', compact('cafes'));
    }


}
