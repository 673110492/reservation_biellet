<!DOCTYPE html>
<html lang="en">

<head>
    <title>reservation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets1/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets1/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('assets1/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets1/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('assets1/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/css/style.css') }}">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">Car<span>Book</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li>
                    <a href="{{ route('reservation.index') }}" class="nav-link">Réservation</a>
                    <li class="nav-item"><a href="car.html" class="nav-link">Cars</a></li>
                    <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
