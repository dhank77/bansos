<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<html lang="zxx">
<!--[if gt IE 8]> <!-->
<!--
<![endif]-->

<head>
    <!-- TITLE OF SITE -->
    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Platform Website Diskominfo Provinsi Sulawesi Selatan" />
    <meta name="author" content="Tim Arsitek IT Prov. Sulsel">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicons -->
    <link rel="icon" sizes="16x16" type="image/png" href="{{ asset('assets_public/images/logo.png') }}">

    @yield('og')
    
    <!-- CSS Begins
================================================== -->
    <!--Animate Effect-->
    <link href="{{ asset('assets_public/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_public/css/hover.css') }}" rel="stylesheet">

    <!--Owl Carousel -->
    <link href="{{ asset('assets_public/css/owl.carousel.css') }}" rel="stylesheet">

    <!-- For Image Preview -->
    <link rel="stylesheet" href="{{ asset('assets_public/css/magnific-popup.css') }}">

    <!--BootStrap -->
    <link href="{{ asset('assets_public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_public/css/normalize.css') }}" rel="stylesheet">

    <!-- Main Style -->
    <link href="{{ asset('assets_public/css/style1.css') }}" rel="stylesheet">
    <link href="{{ asset('assets_public/css/responsive.css') }}" rel="stylesheet">

    <script src="{{ asset('assetsp/js/jquery.min.js') }}"></script>

    <!--[if IE]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

    <!-- ::::::::::::::::::::::::::: Start: Preloader section ::::::::::::::::::::::::::: --> 
    <!-- <div id="preloader"></div> -->
    <!-- ::::::::::::::::::::::::::: End: Preloader section ::::::::::::::::::::::::::: -->

    <!-- Start: header navigation -->
    <div class="navigation navigation_v2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="header_logo" style="min-width: 300px">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('assets_public/images/logo.png') }}" style="width: 50px; margin-right: 7px" alt="" align="left">
                            <span style="font-family: 'Palanquin', sans-serif"><span style="font-weight: bold; font-size: 17px;">Sulsel Bicara Baik</span><br/>Provinsi Sulawesi Selatan</span>
                        </a>
                    </div>
                    <div id="navigation">
                        <ul>
                            <li><a href="#"><span class="{{ (Request::is('/') ? 'cust-menu-active' : '') }}">Home</span></a></li>

                        </ul>
                    </div>
                </div>
            </div>
            <!--/ row -->
        </div>
        <!--/ container -->
    </div>
    <!-- End: header navigation -->

    @yield('content')

    <!-- Start:Footer Section 
==================================================-->
    <footer class="footer-section">
        <div class="container">
            <div class="row footer_middle">
                <!-- Start: About -->
                <div class="col-sm-3 col-xs-12">
                    <div class="widget">
                        <h5> Lokasi </h5>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1986.8917956775767!2d119.49091988547698!3d-5.138512753382992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefb8ec4523fc7%3A0x7a876a9f08ec501c!2sDinas+Pemuda+dan+Olahraga+Provinsi+Sulawesi+Selatan!5e0!3m2!1sid!2sid!4v1530779325052" width="240" height="190" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
                <!-- End: About -->
                <!-- Start: Helpful Link -->
                <div class="col-sm-3 col-xs-12">
                    <div class="widget">
                        <h5>Link Terkait</h5>
                        <ul class="recent-post helpful_post">
                            
                                <li>
                                    <h6><a href="#" target="_blank">Sulsel Prov</a></h6>
                                </li>
                            
                        </ul>
                    </div>
                </div>
                <!-- End: Helpful Link -->

                <!-- Start: Latest post -->
                <div class="col-sm-3 col-xs-12">
                    <div class="widget">
                        <h5>Berita terkini</h5>
                        <ul class="recent-post">
                            
                            <li>
                                <h6><a href="#">Judul</a></h6>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <!-- End: Latest post -->
                <!-- Start: CONTACT INFO -->
                <div class="col-sm-3 col-xs-12">
                    <div class="widget">
                        <h5>Langganan Berita</h5>
                        <!-- Start Subscribe -->
                        <p class="footer_sub_para">Dapatkan berita terbaru melalui email.</p>
                        <form class="footer_subs">
                            <input class="form-input" placeholder="Masukkan email anda" type="text">
                            <button type="submit" class="form-button"></button>
                        </form>
                    </div>
                </div>
                <!-- End: CONTACT INFO -->
                <!-- Start:Subfooter -->
                <div class="subfooter">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="copyright_text">
                                &copy;2019 Sulsel Bicara Baik Provinsi Sulawesi Selatan<br/>
                                Platform Website Diskominfo Prov. Sulsel 
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <ul class="footer_social_icons">
                                
                            </ul>
                        </div>
                        <div class="col-sm-2 col-xs-12">
                            <a class="scrollup" href="#"></a>
                        </div>
                    </div>
                </div>
                <!-- End:Subfooter -->
            </div>
        </div>
    </footer>
    <!-- End:Footer Section 
========================================-->

    <!-- Scripts
========================================-->
    <!-- jquery -->
    <script src="{{ asset('assets_public/js/jquery-1.12.4.min.js') }}"></script>
    <!-- plugins -->
    <script src="{{ asset('assets_public/js/plugins.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets_public/js/bootstrap.min.js') }}"></script>

    <!-- Custom Scripts
========================================-->
    <script src="{{ asset('assets_public/js/main.js') }}"></script>



</body>

</html>