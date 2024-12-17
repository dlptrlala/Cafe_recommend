@extends('layout.navbar')

<head>
    <title>Detail Cafe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .rating input[type="radio"] {
        display: none !important;
    }

    .rating label {
        color: #ccc !important;
        font-size: 30px !important;
        cursor: pointer !important;

    }

    .rating input[type="radio"]:checked~label,
    .rating label:hover,
    .rating label:hover~label {
        color: gold !important;
    }

    .btn-custom {
        background-color: rgb(189, 107, 48) !important;
        /* Warna latar belakang */
        color: white !important;
        /* Warna teks */
        border: 2px solid rgb(189, 107, 48);
        /* Menambahkan border */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Menambahkan bayangan pada tombol */
    }

    .btn-custom:hover {
        background-color: rgb(168, 95, 43) !important;
        /* Warna saat hover */
        border-color: rgb(168, 95, 43);
        /* Menyesuaikan border saat hover */
    }

    .card-img-top {
        width: 100%;
        height: 320px;
        /* Sesuaikan dengan ukuran yang diinginkan */
        object-fit: cover;
        /* Menjaga proporsi gambar agar tidak terdistorsi */
    }
</style>

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">{{ $cafe->name }}</h2>

    <!-- Gambar dan Deskripsi -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <img src="{{ asset('profilCafe/' . $cafe->gambarCafe) }}" class="card-img-top" alt="{{ $cafe->name }}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <p><strong>Nama Cafe:</strong> {{ $cafe->namaCafe }}</p>
                <p><strong>Alamat:</strong> {{ $cafe->alamatCafe }}</p>
                <p class="card-text">
                    <strong>Harga:</strong> Rp{{ number_format($cafe->hargaMin, 0, ',', '.') }} -
                    Rp{{ number_format($cafe->hargaMax, 0, ',', '.') }}
                </p>
                <p class="card-text">
                    <strong>Jam Operasional:</strong>
                    @if(empty($jamOperasional))
                        <span>Jam operasional tidak tersedia.</span>
                    @else
                        @foreach($jamOperasional as $jam)
                            <span>{{ $jam['jam_buka'] }} - {{ $jam['jam_tutup'] }}</span>
                            @if(!$loop->last)
                                <br>
                            @endif
                        @endforeach
                    @endif
                </p>
                <p><strong>Deskripsi:</strong> {{ $cafe->deskripsi }}</p>
                <p><strong>Kebutuhan:</strong>
                    @foreach(array_keys(array_filter($cafe->kebutuhan)) as $kebutuhan)
                        <a href="{{ route('searchCafe') }}?query={{ strtolower($kebutuhan) }}" class="badge badge-info">
                            #{{ strtolower($kebutuhan) }}
                        </a>
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
            <p class="ml-2 mb-0">{{ round($averageRating, 1) }} / 5 - Berdasarkan {{ $cafe->reviews->count() }} ulasan
            </p>
        </div>
    </div>
    <!-- beri ulasan -->
    <!-- Formulir Ulasan dan Daftar Ulasan -->
    <div class="row mt-4">
        <!-- Kolom Formulir Ulasan -->
        <div class="col-md-6">
            <h4>Beri Ulasan</h4>
            <div class="card p-4 mb-4 shadow-sm">
                <form method="POST" action="{{ route('cafe.review.store', ['id' => $cafe->idCafe]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama Anda"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Masukkan email Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <div class="rating" style="display: flex; gap: 5px;">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" style="display: none;"
                                    onclick="highlightStars({{ $i }})">
                                <label for="star{{ $i }}" class="fas fa-star text-muted"
                                    style="font-size: 1.5rem; cursor: pointer;">
                                </label>
                            @endfor
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review">Ulasan:</label>
                        <textarea name="review" id="review" rows="5" class="form-control"
                            placeholder="Tulis ulasan Anda" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom btn-block">Kirim Ulasan</button>
                </form>
            </div>
        </div>

        <div class="col-md-6">
            <h4>Ulasan Pengguna</h4>
            <div class="row g-3">
                <!-- Periksa apakah ada ulasan -->
                @if ($cafe->reviews->isEmpty())
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                            Belum ada ulasan untuk cafe ini. Jadilah yang pertama memberikan ulasan!
                        </div>
                    </div>
                @else
                    @foreach ($cafe->reviews as $review)
                        <div class="col-md-12 mb-3"> <!-- Ulasan dalam satu kolom penuh -->
                            <div class="card shadow-sm" style="height: auto;">
                                <div class="card-body">
                                    <!-- Nama, Email, dan Rating -->
                                    <h5 class="card-title d-flex justify-content-between align-items-center"
                                        style="font-size: 1rem;">
                                        <span>
                                            {{ $review->name }}
                                            <span class="small text-muted">({{ $review->email }})</span>
                                        </span>
                                        <div class="rating" style="display: flex; gap: 2px;">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                <i class="fas fa-star text-warning"></i>
                                            @endfor
                                            @for ($i = $review->rating; $i < 5; $i++)
                                                <i class="far fa-star text-warning"></i>
                                            @endfor
                                        </div>
                                    </h5>
                                    <!-- Review -->
                                    <p class="card-text mb-2" style="font-size: 0.9rem;">
                                        {{ $review->review }}
                                    </p>
                                    <!-- Tanggal Pembuatan -->
                                    <small class="text-muted">
                                        Dibuat pada: {{ \Carbon\Carbon::parse($review->created_at)->format('d M Y H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <script>
            function highlightStars(rating) {
                // Reset semua bintang
                const stars = document.querySelectorAll('.rating label');
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add('text-warning');
                        star.classList.remove('text-muted');
                    } else {
                        star.classList.remove('text-warning');
                        star.classList.add('text-muted');
                    }
                });
            }
        </script>
        @endsection