<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    body {
        font-family: 'Poppins';
    }

    /* Navbar */
    .navbar {
        background-color: white;
        padding: 20px 80px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 0;
        /* Ensure there is no margin at the bottom */
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: #000;
    }

    .navbar-brand .highlight {
        color: #6c9969;
    }

    .navbar-nav .nav-link {
        color: #333;
        margin-right: 20px;
    }

    /* Navbar Icons */
    .navbar-icons {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .navbar-icons a {
        margin-left: 20px;
        color: #333;
        font-size: 1.2rem;
    }

    .fa-mug-saucer {
        transform: scaleX(-1);
        /* Membalik secara horizontal */
        transform: scaleY(-1);
        /* Membalik secara vertikal */
        display: inline-block;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span>Caffe</span><span class="highlight"><span>.i</span><i class="fa-solid fa-mug-saucer"></i></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Daftar Cafe</a></li>
            </ul>
        </div>
        <div class="navbar-icons d-flex align-items-center">
            <!-- Search Icon -->
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>
        </div>
    </nav>
    <!-- Main content area -->
    <div class="container mt-4">
        @yield('content')
    </div>