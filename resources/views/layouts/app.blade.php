<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bansos Pemprov Sulsel</title>
    <meta name="description" content="A demo landing page for agencies or product oriented businesses built using Shards, a free, modern and lightweight UI toolkit based on Bootstrap 4.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS Dependencies -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets_public3/css/shards.css?v=3.0.0">
    <link rel="stylesheet" href="/assets_public3/css/shards-extras.css?version=3.0.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">

    <!-- PETA -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />

    <style type="text/css">
        #mapid {
            height: 600px;
        }

    </style>
    <!-- end of PETA -->

    <!-- datatable  -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"> -->
    <!-- end of datatable -->

    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">


</head>

<body class="shards-bansos-page--1">
    <!-- Welcome Section -->
    <div class="container">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark  px-0 ">
            <a class="navbar-brand mr-5" href="#">
                <img src="/assets_public3/images/bansos/shards-logo-green.svg" class="mr-2" alt="Shards - Agency Landing Page">

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Transparansi Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('donasi') }}">Donasi </a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="#">Covid-19</a>
                    </li>

                </ul>

                <!-- Social Icons -->

            </div>
        </nav>
        <!-- / Navigation -->
    </div> <!-- .container -->
    <div class="welcome d-flex justify-content-center flex-column ">

        <!-- Inner Wrapper -->
        <div class="inner-wrapper mt-auto mb-auto container">
            <div class="row">
                <div class="col-lg-10 col-md-8 col-sm-12 mt-auto mb-0 mr-3 align-self-center">
                    <h1 class="welcome-heading text-white ">Website ini berisi informasi mengenai transparansi data
                        bantuan sosial COVID-19 di Sulawesi Selatan.</h1>
                    <p class="text-white ">Hubungi Call Center dibawah ini untuk mendapatkan informasi tentang Bantuan Sosial
                        <br>
                        di
                        Sulawesi Selatan
                    </p>
                    <a href="#" class="btn btn-lg btn-success btn-pill align-self-center mr-4 text-black"><i class="fa fa-phone mr-2"></i>
                        0853-6730-3111</a>
                    <a href="#" class="btn btn-lg btn-success btn-pill align-self-center text-black"><i class="fa fa-phone mr-2"></i>
                        0823-9335-0156</a>
                    <div class="d-block mt-4">
                        <!-- <a href="https://designrevision.com/download/shards"><img class="w-25 mt-2 mr-3" src="images/bansos/badge-apple-store.png" alt="Get it on Apple Store"></a> -->
                        <!-- <a href="https://designrevision.com/download/shards"><img class="w-25 mt-2" src="images/bansos/badge-google-play-store.png" alt="Get it on Google Play Store"></a> -->
                    </div>
                </div>

                <!-- <div class="col-lg-4 col-md-5 col-sm-12 ml-auto">
              <img class="iphone-mockup ml-auto" src="images/bansos/iphone-app-mockup.png" alt="iPhone App Mockup - Shards App Promo Demo">
            </div> -->
            </div>
        </div>
        <!-- / Inner Wrapper -->
    </div>

    @yield('content')

    <footer class="bg-dark">
        <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> -->
        <div class="container">
            <div class="row">
                <div class=" col-md-6 col-lg-3 mt-5 mb-5">
                    <h6 class="text-white">Connect With Us</h6>
                    <ul class="news-meta tex">
                        <li> <a class="text-white" href="">Facebook</a> </li>
                        <li> <a class="text-white" href="">Instagram</a> </li>
                    </ul>
                </div>
                <div class=" col-md-6 col-lg-5 mt-5 mb-5">
                    <h6 class="text-white">Link</h6>
                    <div class="row">
                        <div class="col-6">
                            <a class="text-white" href="">Covid-19 Sulsel</a>
                            <br>
                            <a class="text-white" href="">Dinas Sosial</a>
                            <br>
                            <a class="text-white" href="">Dinas Kesehatan</a>
                        </div>
                        <div class="col-6">
                            <a class="text-white" href="">Gugus Tugas Sulsel</a>
                            <br>
                            <a class="text-white" href="">Daftar Jadi Relawan</a>
                            <br>
                            <a class="text-white" href="">Donasi</a>
                        </div>
                    </div>

                </div>
                <div class=" col-md-6 col-lg-4 mt-5 mb-5">
                    <h6 class="text-white">Pemerintah Provinsi Sulawesi Selatan</h6>
                    <p class="text-white"> Jl. Urip Sumoharjo No. 269, Panaikang
                        <br> Kec. Panakukkang, Kota Makassar
                        <br> Sulawesi Selatan, 90231
                    </p>
                </div>
            </div>
        </div>
        <!-- </nav> -->
    </footer>
    <!-- / Footer Section -->

    <!-- JavaScript Dependencies -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script> --}}

    <!-- datatable -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    @stack('js')

</body>

</html>
