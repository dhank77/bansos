@extends('layouts.app')

@section('title')
    Struktur Organisasi - {{ $settings->namaOpd }} Prov. Sulsel
@endsection

@section('og')
    <meta property="og:title" content="Struktur Organisasi - {{ $settings->namaOpd }} Prov. Sulsel">
@endsection

@section('content')
    @include('include.header', ['title' => 'Struktur Organisasi'])

    <!-- Start: About Section 
==================================================-->
    <section class="about-section about_pg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 about_bottom_warp">
                    <div class="about_list">
                        <div class="base-header">
                            <h3>Struktur Organisasi</h3>
                        </div>
                        <p>{!! nl2br($struktur->desc) !!}</p>
                    </div>
                </div>
                <!--End: about_bottom_warp -->
            </div>
            <!--End: row-->
        </div>
        <!-- End: container-->
    </section>
    <!--  End: About Section
==================================================-->
@endsection