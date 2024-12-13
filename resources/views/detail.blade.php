<!-- resources/views/cafe/details.blade.php -->

@extends('layout.navbar')

@section('content')
<div class="container">
    <h2>{{ $cafe->name }}</h2>
    <div class="card">
        @if($cafe->image_url)
            <img src="{{ $cafe->image_url }}" class="card-img-top" alt="{{ $cafe->name }}">
        @else
            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Gambar Cafe">
        @endif
        <div class="card-body">
            <p><strong>Nama Cafe:</strong> {{ $cafe->namaCafe }}</p>
            <p><strong>Alamat:</strong> {{ $cafe->alamatCafe }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($cafe->hargaMin) }} - Rp {{ number_format($cafe->hargaMax) }}
            </p>
            <p><strong>Jam Buka:</strong> {{ $cafe->jam_buka }}</p>
            <p><strong>Jam Tutup:</strong> {{ $cafe->jam_tutup }}</p>
            <p><strong>Deskripsi:</strong> {{ $cafe->deskripsi }}</p>

            <!-- Tambahkan kebutuhan di bawah deskripsi -->
            <p><strong>Kebutuhan:</strong></p>
            <p>
                @foreach(array_keys(array_filter($cafe->kebutuhan)) as $kebutuhan)
                    <span>#{{ strtolower($kebutuhan) }}</span>
                @endforeach
            </p>
        </div>
    </div>
</div>
@endsection
