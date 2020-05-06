@extends('layouts.app')

@section('title')
    {{ $galeriTitle->title }} - {{ $settings->namaOpd }} Prov. Sulsel
@endsection

@section('og')
    <meta property="og:title" content="{{ $galeriTitle->title }} - {{ $settings->namaOpd }} Prov. Sulsel">
    <meta property="og:image" content="{{ asset('assets_public/images/galeri/'.$galeriImg[0]->img) }}">
@endsection

@section('content')
<!-- header -->
    <header id="page-top" class="blog-banner">
        <!-- Start: Header Content -->
        <div class="container" id="blog">
            <div class="row blog-header text-center wow" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h4><a href="{{ route('index') }}"> {{ $settings->namaOpd }} </a> / <a href="{{ route('index.galeri') }}">Galeri</a> / #{{ $galeriTitle->id }}</h4>
                    <h3>{{ $galeriTitle->title }}</h3>
                </div>
            </div>
            <!-- End: .row -->
        </div>
        <!-- End: Header Content -->
    </header>
    <!--/. header -->

    <!-- End: Header Section
==================================================-->

<!--Start: Work Section 
==================================================-->
    <section class="single-work-page">
        <div class="container">
            <!-- Start: Heading -->
            <div class="base-header">
                <h3>{{ $galeriTitle->title }}</h3>
            </div>
            <!-- End: Heading -->
            <div class="row">
                <!-- portfolio item -->
                <div class="col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="portfolioitem col-sm-12">
                            <div class="carousel slide" data-ride="carousel" id="blog-post-slider">
                                <a class="post-thumbnail" data-animsition-out="fade-out-up-sm" data-animsition-out-duration="500">
                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        @foreach($galeriImg as $rGaleriImg => $img)
                                        <div class="item @if ($rGaleriImg == 0) active @endif">
                                            <img alt="blog" src="{{ asset('assets_public/images/galeri/'.$img->img) }}" width="100%">
                                        </div>
                                        @endforeach
                                    </div>
                                    <!-- Controls -->
                                </a>
                                <a class="left carousel-control" data-slide="prev" href="#blog-post-slider" role="button">
                                <span aria-hidden="true" class="fa fa-angle-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                                <a class="right carousel-control" data-slide="next" href="#blog-post-slider" role="button">
                                <span aria-hidden="true" class="fa fa-angle-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-xs-12">
                    <div class="portfolio-single-detail">
                        <h4>Deskripsi</h4>
                        <p>{{ $galeriTitle->desc }}</p>
                    </div>
                </div>

                <!--/ portfolio item -->
            </div>
            <!-- row /- -->
        </div>
        <!-- Container /- -->
    </section>
    <!-- End: Work Section 
==================================================-->
@endsection