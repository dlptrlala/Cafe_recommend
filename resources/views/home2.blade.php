@extends('layout.navbar')

<head>
    <title>Home 2</title>
</head>
<style>
    .form-group {
        margin-bottom: 20px;
    }

    select.form-control,
    input.form-control {
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

    .sidebar {
        background-color: rgb(255, 219, 140);
        padding: 20px;
        border-radius: 8px;
        margin-right: 20px;
        margin-top: 50px;
    }

    .sidebar h4 {
        margin-bottom: 20px;
    }
</style>
@section('content')
<div class="container">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="sidebar mt-5 ">
                <h4 style="font-weight: bold;">Filter Pencarian</h4>
                <form action="/recommend" method="GET" class="filter-form">
                    <!-- Lokasi -->
                    <div class="form-group">
                        <label for="lokasi">Pilih Lokasi:</label>
                        <select id="lokasi" name="lokasi_area" class="form-control"
                            onchange="handleLocationChange(this)">
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
                        <input type="number" name="harga_min" id="harga_min" class="form-control"
                            placeholder="Harga Min" min="0" value="0">
                    </div>

                    <div class="form-group">
                        <label for="harga_max">Harga Max:</label>
                        <input type="number" name="harga_max" id="harga_max" class="form-control"
                            placeholder="Harga Max" min="0" value="100000">
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
                    <!-- Pilih Waktu -->
                    <div class="form-group">
                        <label for="pilihWaktu">Pilih Waktu:</label>
                        <select name="pilihWaktu" id="pilihWaktu" class="form-control" onchange="toggleJamInput()">
                            <option value="sekarang">Waktu Saat Ini</option>
                            <option value="pilihJam">Pilih Jam</option>
                        </select>
                    </div>

                    <!-- Rentang Waktu -->
                    <div class="form-group" id="jamBukaGroup" style="display:none;">
                        <label for="jamBuka">Jam Buka:</label>
                        <input type="time" name="jamBuka" id="jamBuka" class="form-control" placeholder="Jam Buka"
                            value="00:00">
                    </div>

                    <div class="form-group" id="jamTutupGroup" style="display:none;">
                        <label for="jamTutup">Jam Tutup:</label>
                        <input type="time" name="jamTutup" id="jamTutup" class="form-control" placeholder="Jam Tutup"
                            value="23:59">
                    </div>

                    <script>
                        function toggleJamInput() {
                            var waktuOption = document.getElementById('pilihWaktu').value;

                            if (waktuOption === 'pilihJam') {
                                // Menampilkan input waktu
                                document.getElementById('jamBukaGroup').style.display = 'block';
                                document.getElementById('jamTutupGroup').style.display = 'block';
                            } else {
                                // Menyembunyikan input waktu
                                document.getElementById('jamBukaGroup').style.display = 'none';
                                document.getElementById('jamTutupGroup').style.display = 'none';
                            }
                        }
                    </script>

                    <!-- Submit Button -->
                    <button type="submit" class="btn" style="background-color: #8B4513; color: white;;">Cari
                        Cafe</button>
                </form>
            </div>
        </div>

        <!-- Hasil Pencarian -->
        <div class="col-md-9">
            <div class="search-results mt-4">
                @if(isset($cafes) && count($cafes) > 0)
                    <h3 style="margin-top: -5px;">Hasil Pencarian:</h3>
                    <div class="row mb-3">
                        @foreach($cafes as $cafe)
                            <div class="col-md-4" style="margin-bottom: 20px">
                                <div class="card h-100 d-flex flex-column"> <!-- Tambahkan d-flex dan flex-column -->
                                    <img src="{{ $cafe->image_url }}" class="card-img-top" alt="{{ $cafe->name }}"
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $cafe->namaCafe }}</h5>
                                        <p class="card-text">{{ $cafe->deskripsiCafe }}</p>
                                        <p class="card-text"><strong>Alamat:</strong> {{ $cafe->alamatCafe }}</p>
                                        <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($cafe->hargaMin) }} -
                                            {{ number_format($cafe->hargaMax) }}
                                        </p>
                                        <p class="card-text"><strong>Jam Operasional:</strong> {{$cafe->jam_buka}} -
                                            {{$cafe->jam_tutup}}</p>
                                        <a href="{{ route('cafe.details', ['id' => $cafe->idCafe]) }}" class="btn mt-auto"
                                            style="background-color:rgb(189, 107, 48); color: white;">Lihat Detail</a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Tidak ada cafe yang ditemukan sesuai dengan filter yang Anda pilih.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
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