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
        /* Filter pada seluruh card */
        .card {
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.2));
            /* Bayangan lembut */
            transition: filter 0.3s ease, transform 0.3s ease;
            /* Efek transisi */

            margin-bottom: 20px;
            /* Jarak antar card ke bawah */
        }



        /* Efek saat hover untuk memperjelas card */
        .card:hover {
            filter: brightness(1.1) drop-shadow(0 6px 8px rgba(0, 0, 0, 0.3));
            transform: scale(1.03);
            /* Sedikit memperbesar card */
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


        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 10%;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            color: white;
        }


        .carousel-indicators [data-bs-target] {
            width: 10px;
            height: 10px;
            background-color: rgba(0, 0, 0, 0.5);
        }


        .container {
            width: 95%;
            /* Lebar container menjadi 80% dari lebar layar */
            max-width: 1200px;
            /* Lebar maksimal container */

        }
    </style>
</head>

</style>

@section('content')
<div id="carouselExampleIndicators" class="carousel slide container-fluid p-0" data-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images\lap.jpeg" class="d-block w-100" alt="Image 1">
        </div>
        <div class="carousel-item">
            <img src="images\sunsett.jpg" class="d-block w-100" alt="Image 2">
        </div>
        <div class="carousel-item">
            <img src="images\cafe0.jpg" class="d-block w-100" alt="Image 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<h2 style="text-align: center; font-weight: bold; font-size: 20px; margin-top: 10px;">Cari Cafe Sesuai Kebutuhan Anda
</h2>
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
                    <button type="submit" class="btn btn-success w-100">Cari cafe</button>
                </div>
            </div>
        </form>
    </div>
</div>
<h3 style="font-size: 25px;">Daftar Cafe yang Buka di {{ ucfirst($time_context ?? 'waktu tidak diketahui') }} Hari:</h3>
<!-- Hasil Pencarian -->
<div id="cafeCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="row">
                @if(isset($cafes) && count($cafes) > 0)
                            @foreach($cafes as $index => $cafe)
                                        @if($index % 3 == 0 && $index != 0)
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="row">
                                        @endif
                                        <div class="col-md-4">
                                            <div class="card">
                                                <img src="{{ $cafe->image_url }}" class="card-img-top" alt="{{ $cafe->namaCafe }}">
                                                <div class="card-body">
                                                    <h5 class="card-title"><strong>{{ $cafe->namaCafe }}</strong></h5>
                                                    <p class="card-text">{{ $cafe->deskripsiCafe }}</p>
                                                    <p class="card-text"><strong>Alamat:</strong> {{ $cafe->alamatCafe }}</p>
                                                    <p class="card-text">
                                                        <strong>Harga:</strong> Rp{{ number_format($cafe->hargaMin, 0, ',', '.') }} -
                                                        Rp{{ number_format($cafe->hargaMax, 0, ',', '.') }}
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
    </div>
    <!-- Carousel controls dipindahkan ke luar dari row -->
    <button class="carousel-control-prev" type="button" data-bs-target="#cafeCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#cafeCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
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