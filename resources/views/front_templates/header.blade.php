<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content=">@if(isset($result->description)){{!!$result->description!!}@endif">
		<meta name="google-site-verification" content="algdNwwVSuWmoFPwvqF3FRAV-kPxGNf2Bo0ZcWOJsiY" />
        <meta name="author" content="">

        <title>@if(isset($result->meta_title)){!!$result->meta_title!!}@endif</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('public_theme/') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/') }}/css/front_style.css">
        <!-- Custom fonts for this template -->
        <link href="{{ asset('public_theme/') }}/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

        <!-- Plugin CSS -->
        <link href="{{ asset('public_theme/') }}/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

        <!-- Custom styles for this template -->
        <link href="{{ asset('public_theme/') }}/css/freelancer.min.css" rel="stylesheet">

    </head>

    <body id="page-top">

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="{{ url('/') }}">Binance Tools</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">

                        @if (Route::has('login'))

                        @auth
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('logout') }}">Logout</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ url('admin/dashboard') }}">Dashboard</a>
                        </li>

                        @else

                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="{{ url('register') }}">Register</a>
                        </li>

                        @endauth

                        @endif

                    </ul>
                </div>
            </div>
        </nav>
