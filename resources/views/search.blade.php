@extends('layout.navbar')

@section('content')

<head>
    <title>Rekomendasi Cafe</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
</head>


<style>
    .badge-custom {
        background-color: rgb(0, 0, 0);
        /* Ganti warna sesuai kebutuhan */
        color: #ffffff;
        /* Warna teks agar kontras */
    }
</style>

<div class="container">
    <h1 class="my-4" style="font-weight: bold; text-align: center;">Hasil Pencarian</h1>
    <p>Mencari: <strong>{{ $query }}</strong></p>
    @if($cafes->isEmpty())
        <div class="alert alert-warning">Tidak ada cafe yang ditemukan.</div>
    @else
        <div class="row">
            @foreach($cafes as $cafe)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 d-flex flex-column">
                        <img src="{{ asset('profilCafe/' . $cafe->gambarCafe) }}" class="card-img-top"
                            alt="{{ $cafe->namaCafe }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $cafe->namaCafe }}</h5>
                            <p class="card-text">
                                Lokasi: {{ $cafe->lokasi_area }} <br>
                                Harga: Rp{{ number_format($cafe->hargaMin, 0, ',', '.') }} -
                                Rp{{ number_format($cafe->hargaMax, 0, ',', '.') }} <br>
                                <strong>Kebutuhan:</strong>
                                @foreach(array_keys(array_filter($cafe->kebutuhan)) as $kebutuhan)
                                    <a href="{{ route('searchCafe') }}?query={{ strtolower($kebutuhan) }}">
                                        <span class="badge badge-custom">#{{ strtolower($kebutuhan) }}</span>
                                    </a>
                                @endforeach
                            </p>
                            <a href="{{ route('cafe.details', ['id' => $cafe->idCafe]) }}" class="btn mt-auto"
                                style="background-color:rgb(189, 107, 48); color: white;">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection