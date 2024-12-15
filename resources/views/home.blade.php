@extends('layout.navbar')

<head>
    <title>Home</title>
</head>
<style>
    .form-group {
        margin-bottom: 20px;
    }

    select.form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    button.btn-success {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 8px;
    }

    #carouselExampleIndicators .carousel-item img {
        width: 50%;
        /* Mengatur lebar gambar agar mengikuti lebar kontainer */
        height: 200px;
        /* Mengatur tinggi gambar agar lebih konsisten */
        object-fit: cover;
        /* Menyesuaikan gambar agar tidak pecah atau terdistorsi */
    }
   
</style>
@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
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
            <img src="images\sepakat..jpg" class="d-block w-100" alt="Image 1">
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

<div class="container">
    <h2 style="text-align: center; font-weight: bold;">Cari Cafe Sesuai Kebutuhan Anda</h2>
    <form action="/recommend" method="GET" class="filter-form">
        <!-- Lokasi Berdasarkan Geolokasi -->
        <div class="form-group">
            <label for="lokasi">Pilih Lokasi:</label>
            <select id="lokasi" name="lokasi_area" class="form-control" onchange="handleLocationChange(this)">
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
        <div class="form-group">
            <label for="harga_min">Harga Min:</label>
            <input type="number" name="harga_min" id="harga_min" class="form-control" placeholder="Harga Min" min="0"
                value="0">
        </div>

        <div class="form-group">
            <label for="harga_max">Harga Max:</label>
            <input type="number" name="harga_max" id="harga_max" class="form-control" placeholder="Harga Max" min="0"
                value="0">
        </div>

        <!-- Kebutuhan -->
        <div class="form-group">
            <label for="kebutuhan">Kebutuhan:</label>
            <select name="kebutuhan" id="kebutuhan" class="form-control">
                <option value="kerja">Kerja</option>
                <option value="nongkrong">Nongkrong</option>
                <option value="tugas">Tugas</option>
                <option value="rapat">Rapat</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success">Cari Cafe</button>
    </form>


    <!-- Hasil Pencarian -->
    <div class="search-results mt-4">
        @if(isset($cafes) && count($cafes) > 0)
            <h3>Hasil Pencarian:</h3>
            <div class="row">
                @foreach($cafes as $cafe)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ $cafe->image_url }}" class="card-img-top" alt="{{ $cafe->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $cafe->namaCafe }}</h5>
                                <p class="card-text">{{ $cafe->deskripsiCafe }}</p>
                                <p class="card-text"><strong>Alamat:</strong> {{ $cafe->alamatCafe }}</p>
                                <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($cafe->hargaMin) }} -
                                    {{ number_format($cafe->hargaMax) }}
                                </p>
                                <a href="{{ route('cafe.details', ['id' => $cafe->idCafe]) }}" class="btn btn-primary">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Tidak ada cafe yang ditemukan sesuai dengan filter yang Anda pilih.</p>
        @endif
    </div>

    <!-- Daftar Cafe yang Buka -->
    <div class="search-results mt-4">
        <h3>Daftar Cafe yang Buka di {{ ucfirst($time_context ?? 'waktu tidak diketahui') }} Hari:</h3>
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
                                <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($cafe->hargaMin) }} - Rp
                                    {{ number_format($cafe->hargaMax) }}
                                </p>
                                <p class="card-text"><strong>Jam Buka:</strong> {{ $cafe->jam_buka }} - {{ $cafe->jam_tutup }}
                                <p class="card-text"><strong>Jam Operasional:</strong> {{ $cafe->jam_buka }} -
                                    {{ $cafe->jam_tutup }}

                                </p>
                                <a href="{{ route('cafe.details', ['id' => $cafe->idCafe]) }}" class="btn btn-primary">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Tidak ada cafe yang buka pada waktu ini.</p>
            @endif
        </div>
    </div>


</div>

<script>
    // // Mendapatkan lokasi user saat ini
    // document.getElementById('get-location').addEventListener('click', function () {
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(function (position) {
    //             document.getElementById('longitude').value = position.coords.longitude;
    //             document.getElementById('latitude').value = position.coords.latitude;
    //             document.getElementById('location-status').innerText = 'Lokasi berhasil didapatkan!';
    //         }, function (error) {
    //             document.getElementById('location-status').innerText = 'Gagal mendapatkan lokasi.';
    //         });
    //     } else {
    //         document.getElementById('location-status').innerText = 'Geolocation tidak didukung oleh browser Anda.';
    //     }
    // });
    function handleLocationChange(selectElement) {
        const selectedValue = selectElement.value;

        if (selectedValue === "geo") {
            // Mendapatkan geolokasi pengguna
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        document.getElementById("longitude").value = position.coords.longitude;
                        document.getElementById("latitude").value = position.coords.latitude;
                        alert("Lokasi Anda berhasil didapatkan! Klik 'Cari Cafe' untuk melanjutkan.");
                    },
                    function (error) {
                        alert("Gagal mendapatkan lokasi. Pastikan Anda mengizinkan akses lokasi.");
                    }
                );
            } else {
                alert("Geolokasi tidak didukung oleh browser Anda.");
            }
        } else {
            // Jika memilih area manual
            document.getElementById("longitude").value = "";
            document.getElementById("latitude").value = "";
        }
    }
</script>
@endsection