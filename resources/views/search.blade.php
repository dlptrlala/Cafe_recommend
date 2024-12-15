@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="my-4">Hasil Pencarian</h1>
    <p>Mencari: <strong>{{ $query }}</strong></p>
    @if($cafes->isEmpty())
        <div class="alert alert-warning">Tidak ada cafe yang ditemukan.</div>
    @else
        <div class="row">
            @foreach($cafes as $cafe)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $cafe->gambarCafe) }}" class="card-img-top" alt="{{ $cafe->namaCafe }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $cafe->namaCafe }}</h5>
                        <p class="card-text">
                            Lokasi: {{ $cafe->lokasi_area }} <br>
                            Harga: Rp{{ number_format($cafe->hargaMin, 0, ',', '.') }} - Rp{{ number_format($cafe->hargaMax, 0, ',', '.') }}
                        </p>
                        <a href="#" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
