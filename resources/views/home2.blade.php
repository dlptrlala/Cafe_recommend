@extends('layout.navbar')
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
</style>
@section('content')
<div class="container">
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
                                    {{ number_format($cafe->hargaMax) }}</p>
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