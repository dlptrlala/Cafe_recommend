@extends('layout.navbar')

<head>
    <title>Rekomendasi Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style untuk Filter Card */
        .filter-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff;
        }

        .filter-card h3 {
            margin-bottom: 20px;
            color: #333;
            font-size: 1.5rem;
        }

        .form-control,
        .btn {
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            transition: 0.3s;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* Style untuk Card Cafe */
        .card {
            font-family: 'Poppins';
            /* Ganti dengan font yang Anda inginkan */
            font-size: 14px;
            /* Ukuran font untuk seluruh card */
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 350px;
            /* Menetapkan tinggi tetap untuk semua card */
            display: flex;
            flex-direction: column;
            /* Memastikan konten card mengalir vertikal */
            margin-bottom: 20px;
        }

        .card-body {
            flex-grow: 1;
            /* Agar body card mengisi ruang yang tersedia */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* Menyebarkan konten secara merata */
        }

        .card img {
            height: 200px;
            object-fit: cover;
        }

        .custom-margin-up {
            margin-top: -20px;
            /* Sesuaikan nilai untuk mengatur jarak ke atas */
        }
    </style>
</head>

</style>
@section('content')
<div class="container mt-3">
    <!-- Filter Section -->
    <div class="filter-card mb-4">
        <h3>Filter Rekomendasi Cafe</h3>
        <form action="/recommend" method="GET" class="row gx-3 gy-2 align-items-center">
            <!-- Lokasi -->
            <div class="row custom-margin-up">
                <!-- Pilih Lokasi -->
                <div class="col-md-3">
                    <label for="lokasi" class="form-label">Pilih Lokasi:</label>
                    <select id="lokasi" name="lokasi_area" class="form-select" onchange="handleLocationChange(this)">
                        <option value="" disabled selected>Pilih Lokasi</option>
                        <option value="geo">Resto Sekitar (Berdasarkan Lokasi Anda)</option>
                        <option value="Semua Lokasi">Semua Lokasi</option>
                        <option value="Bantul">Bantul</option>
                        <option value="Gunung Kidul">Gunung Kidul</option>
                        <option value="Kulon Progo">Kulon Progo</option>
                        <option value="Sleman">Sleman</option>
                        <option value="Yogyakarta">Yogyakarta</option>
                    </select>
                    <input type="hidden" id="longitude" name="longitude">
                    <input type="hidden" id="latitude" name="latitude">
                </div>

                <!-- Rentang Harga -->
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-6">
                            <label for="harga_min" class="form-label">Harga Min:</label>
                            <input type="number" name="harga_min" id="harga_min" class="form-control" placeholder="Min"
                                min="0">
                        </div>
                        <div class="col-6">
                            <label for="harga_max" class="form-label">Harga Max:</label>
                            <input type="number" name="harga_max" id="harga_max" class="form-control" placeholder="Max"
                                min="0">
                        </div>
                    </div>
                </div>

                <!-- Kebutuhan -->
                <div class="col-md-3">
                    <label for="kebutuhan" class="form-label">Kebutuhan:</label>
                    <select name="kebutuhan" id="kebutuhan" class="form-select">
                        <option value="" disabled selected>Pilih Kebutuhan</option>
                        <option value="kerja">Kerja</option>
                        <option value="nongkrong">Nongkrong</option>
                        <option value="tugas">Tugas</option>
                        <option value="rapat">Rapat</option>
                    </select>
                </div>

                <!-- Button Cari -->
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">Cari</button>
                </div>

        </form>


        <!-- Hasil Pencarian -->
        <div id="cafeCarousel" class="carousel slide mt-4" data-bs-ride="carousel">

            <!-- Daftar Cafe -->
            <h4>Daftar Cafe yang Buka di {{ ucfirst($time_context ?? 'waktu tidak diketahui') }} Hari:</h4>
            <div class="row">
                @if(isset($cafes) && count($cafes) > 0)
                    @foreach($cafes as $cafe)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ $cafe->image_url }}" class="card-img-top" alt="{{ $cafe->namaCafe }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $cafe->namaCafe }}</h5>
                                    <p class="card-text">{{ $cafe->deskripsiCafe }}</p>
                                    <p class="card-text"><strong>Alamat:</strong> {{ $cafe->alamatCafe }}</p>
                                    <p class="card-text">
                                        <strong>Harga:</strong> Rp {{ number_format($cafe->hargaMin) }} - Rp
                                        {{ number_format($cafe->hargaMax) }}
                                    </p>
                                    <p class="card-text">
                                        <strong>Jam Operasional:</strong> {{ $cafe->jam_buka }} - {{ $cafe->jam_tutup }}
                                    </p>
                                    <a href="{{ route('cafe.details', ['id' => $cafe->idCafe]) }}" class="btn btn-primary">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">Tidak ada cafe yang buka pada waktu ini.</p>
                @endif
            </div>
    </div>

    <!-- Geolocation Script -->
    <script>
        function handleLocationChange(selectElement) {
            const selectedValue = selectElement.value;

            if (selectedValue === "geo") {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            document.getElementById("longitude").value = position.coords.longitude;
                            document.getElementById("latitude").value = position.coords.latitude;
                            alert("Lokasi berhasil didapatkan!");
                        },
                        function (error) {
                            alert("Gagal mendapatkan lokasi.");
                        }
                    );
                } else {
                    alert("Geolokasi tidak didukung oleh browser Anda.");
                }
            } else {
                document.getElementById("longitude").value = "";
                document.getElementById("latitude").value = "";
            }
        }
    </script>
    @endsection