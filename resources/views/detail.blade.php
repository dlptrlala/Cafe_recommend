@extends('layout.navbar')

<head>
    <title>Detail</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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

    .rating input[type="radio"]:checked~label {
        color: gold;
    }

    .rating label:hover,
    .rating label:hover~label {
        color: gold;
    }
</style>

@section('content')
<div class="container">
    <h2>{{ $cafe->name }}</h2>

    <!-- Tampilkan Rating Rata-Rata -->
    <div class="mb-3">
        <strong>Rating Keseluruhan:</strong>
        <div class="rating">
            @for ($i = 0; $i < round($averageRating); $i++)
                <i class="fas fa-star"></i>
            @endfor
            @for ($i = round($averageRating); $i < 5; $i++)
                <i class="far fa-star"></i>
            @endfor
        </div>
        <p>{{ round($averageRating, 1) }} / 5 - Berdasarkan {{ $cafe->reviews->count() }} ulasan</p>
    </div>

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
            <p><strong>Kebutuhan:</strong></p>
            <p>
                @foreach(array_keys(array_filter($cafe->kebutuhan)) as $kebutuhan)
                    <span>#{{ strtolower($kebutuhan) }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <!-- Tampilkan Ulasan -->
    <h3>Ulasan Pengguna</h3>
    @foreach ($cafe->reviews as $review)
        <div class="card mb-3">
            <div class="card-body">
                <p><strong>{{ $review->name }}</strong> ({{ $review->email }}) -
                    @for ($i = 0; $i < $review->rating; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @for ($i = $review->rating; $i < 5; $i++)
                        <i class="far fa-star"></i>
                    @endfor
                </p>
                <p>{{ $review->review }}</p>
                <p class="text-muted">Dibuat pada: {{ $review->created_at->format('d M Y H:i') }}</p>
            </div>
        </div>
    @endforeach

    <!-- Form Tambah Ulasan -->
    <h3>Beri Ulasan</h3>
    <form method="POST" action="{{ route('cafe.review.store', ['id' => $cafe->idCafe]) }}">
        @csrf
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <div class="rating" id="rating">
                <input type="radio" name="rating" id="star5" value="5"><label for="star5" class="fa fa-star"></label>
                <input type="radio" name="rating" id="star4" value="4"><label for="star4" class="fa fa-star"></label>
                <input type="radio" name="rating" id="star3" value="3"><label for="star3" class="fa fa-star"></label>
                <input type="radio" name="rating" id="star2" value="2"><label for="star2" class="fa fa-star"></label>
                <input type="radio" name="rating" id="star1" value="1"><label for="star1" class="fa fa-star"></label>
            </div>
        </div>
        <div class="form-group">
            <label for="review">Ulasan:</label>
            <textarea name="review" id="review" rows="5" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>
@endsection