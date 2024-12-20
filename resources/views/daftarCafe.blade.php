@extends('layout.navbar')

<head>
    <title>Daftar Cafe</title>
</head>

@section('content')
<div class="container">
    <h1 class="my-4" style="font-weight: bold; text-align: center;">Daftar Cafe</h1>
    <div class="row">
        @foreach($cafes as $cafe)
        <div class="col-md-4 mb-4">
            <div class="card h-100 d-flex flex-column"> <!-- Tambahkan h-100, d-flex, flex-column -->
                <!-- Menampilkan gambar dengan memastikan URL benar -->
                <img src="{{ asset('profilCafe/' . $cafe->gambarCafe) }}" class="card-img-top" alt="{{ $cafe->namaCafe }}"
                    style="height: 200px; object-fit: cover;"> <!-- Ganti image_url dengan gambarCafe -->
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $cafe->namaCafe }}</h5>
                    <p class="card-text">
                        Lokasi: {{ $cafe->lokasi_area }} <br>
                        Harga: Rp{{ number_format($cafe->hargaMin, 0, ',', '.') }} -
                        Rp{{ number_format($cafe->hargaMax, 0, ',', '.') }}
                    </p>
                    <a href="{{ route('cafe.details', ['id' => $cafe->idCafe]) }}" class="btn mt-auto"
                        style="background-color:rgb(189, 107, 48); color: white;">Lihat Detail</a>
                </div>
            </div>

        </div>
        @endforeach
    </div>
</div>

@endsection