@extends('layout.navbar')

<head>
    <title>Detail Cafe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .rating input[type="radio"] {
        display: none;
    }

    .rating label {
        color: #ccc;
        font-size: 30px;
        cursor: pointer;
    }

    .rating input[type="radio"]:checked~label,
    .rating label:hover,
    .rating label:hover~label {
        color: gold;
    }
</style>

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">{{ $cafe->name }}</h2>

    <!-- Gambar dan Deskripsi -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <img src="{{ $cafe->image_url ?? 'https://via.placeholder.com/500x300' }}" class="card-img-top" alt="{{ $cafe->name }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <p><strong>Nama Cafe:</strong> {{ $cafe->namaCafe }}</p>
                <p><strong>Alamat:</strong> {{ $cafe->alamatCafe }}</p>
                <p class="card-text">
                    <strong>Harga:</strong> Rp{{ number_format($cafe->hargaMin, 0, ',', '.') }} - Rp{{ number_format($cafe->hargaMax, 0, ',', '.') }}
                </p>
                <p class="card-text">
                    <strong>Jam Operasional:</strong>
                    @if(date('H:i', strtotime($cafe->jam_buka)) == '00:00' && date('H:i', strtotime($cafe->jam_tutup)) == '00:00')
                        24 Jam
                    @else
                        {{ date('H:i', strtotime($cafe->jam_buka)) }} - {{ date('H:i', strtotime($cafe->jam_tutup)) }}
                    @endif
                </p>
                <p><strong>Deskripsi:</strong> {{ $cafe->deskripsi }}</p>
                <p>
                    <strong>Kebutuhan:</strong>
                    @foreach(array_keys(array_filter($cafe->kebutuhan)) as $kebutuhan)
                    <span class="badge badge-info">#{{ strtolower($kebutuhan) }}</span>
                    @endforeach
                </p>
            </div>
        </div>
    </div>

    <!-- Rating Rata-Rata -->
    <div class="my-4">
        <h4>Rating Keseluruhan</h4>
        <div class="d-flex align-items-center">
            <div class="rating">
                @for ($i = 0; $i < round($averageRating); $i++)
                    <i class="fas fa-star text-warning"></i>
                    @endfor
                    @for ($i = round($averageRating); $i < 5; $i++)
                        <i class="far fa-star text-warning"></i>
                        @endfor
            </div>
            <p class="ml-2 mb-0">{{ round($averageRating, 1) }} / 5 - Berdasarkan {{ $cafe->reviews->count() }} ulasan</p>
        </div>
    </div>

    <!-- Daftar Ulasan -->
    <h4>Ulasan Pengguna</h4>
    @foreach ($cafe->reviews as $review)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-1">{{ $review->name }}
                <span class="small text-muted">({{ $review->email }})</span>
            </h5>
            <div class="rating mb-2">
                @for ($i = 0; $i < $review->rating; $i++)
                    <i class="fas fa-star text-warning"></i>
                    @endfor
                    @for ($i = $review->rating; $i < 5; $i++)
                        <i class="far fa-star text-warning"></i>
                        @endfor
            </div>
            <p class="card-text">{{ $review->review }}</p>
            <small class="text-muted">Dibuat pada: {{ $review->created_at->format('d M Y H:i') }}</small>
        </div>
    </div>
    @endforeach

    <!-- Form Tambah Ulasan -->
    <h4>Beri Ulasan</h4>
    <div class="card p-4 mb-4 shadow-sm" style="max-width: 600px; margin-left: 0;">
        <form method="POST" action="{{ route('cafe.review.store', ['id' => $cafe->idCafe]) }}">
            @csrf
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email Anda" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <div class="rating">
                    @for ($i = 5; $i >= 1; $i--)
                    <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}">
                    <label for="star{{ $i }}" class="fas fa-star"></label>
                    @endfor
                </div>
            </div>
            <div class="form-group">
                <label for="review">Ulasan:</label>
                <textarea name="review" id="review" rows="5" class="form-control" placeholder="Tulis ulasan Anda" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Kirim Ulasan</button>
        </form>
    </div>


    @endsection