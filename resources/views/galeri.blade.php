@extends('layouts.app')

@section('title')
    Galeri - {{ $settings->namaOpd }} Prov. Sulsel
@endsection

@section('og')
    <meta property="og:title" content="Galeri - {{ $settings->namaOpd }} Prov. Sulsel">
@endsection

@section('content')
    @include('include.header', ['title' => 'Galeri'])

    <!-- Start: Work Section 
==================================================-->
<section class="work-section" id="galeri">
        <div class="container">
            <div class="row">
                <!-- Start: Heading -->
                <div class="base-header">
                        <a href="{{ route('index.galeri') }}"><h3>Galeri {{ $settings->namaOpd }} Sulawesi Selatan</h3></a>
                </div>
                <!-- End:  heading -->

                <!-- Start: Work Item -->
                <div class="projects-list">
                    @foreach($galeri as $rGaleri)
                    <div class="col-sm-3 col-xs-12 web graphics">
                        <div class="single-project-item" style="background-image: url({{ asset('assets_public/images/galeri/'.$rGaleri->img) }})">
                            <div class="project-hover">
                                <h4><a href="{{ route('index.galeri.view', ['slug' => $rGaleri->slug]) }}">{{ $rGaleri->title }}</a></h4>
                                <span>{{ \Carbon\Carbon::parse($rGaleri->createdAt)->format('d M Y') }}</span>
                                <a class="project-link" href="{{ asset('assets_public/images/galeri/'.$rGaleri->img) }}"><i class="icon_image"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End: Work Section 
==================================================-->
@endsection