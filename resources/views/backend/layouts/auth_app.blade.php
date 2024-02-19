<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>
        @yield('title') | {{ config('app.name') }}
    </title>

    <!-- General CSS Files -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
 {{-- favicon --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('backend/assets/favicon/apple-icon-57x57.png') }}">
<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('backend/assets/favicon/apple-icon-60x60.png') }}">
<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('backend/assets/favicon/apple-icon-72x72.png') }}">
<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/assets/favicon/apple-icon-76x76.png') }}">
<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('backend/assets/favicon/apple-icon-114x114.png') }}">
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('backend/assets/favicon/apple-icon-120x120.png') }}">
<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('backend/assets/favicon/apple-icon-144x144.png') }}">
<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('backend/assets/favicon/apple-icon-152x152.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/favicon/apple-icon-180x180.png') }}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('backend/assets/favicon/android-icon-192x192.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/assets/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('backend/assets/favicon/favicon-96x96.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('backend/assets/favicon/manifest.json') }}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">


    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('backend/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/web/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/iziToast.min.css') }}">
    <link href="{{ asset('backend/assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        {{-- <div class="login-brand">
                            <img src="{{ asset('backend/img/logo.png') }}" alt="logo" width="100"
                                class="shadow-light">
                        </div> --}}
                        @yield('content')
                        <div class="simple-footer">
                            Copyright &copy;   {{ date('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.nicescroll.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('backend/web/js/stisla.js') }}"></script>
    <script src="{{ asset('backend/web/js/scripts.js') }}"></script>
    <!-- Page Specific JS File -->
</body>

</html>
