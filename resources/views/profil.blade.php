@extends('layouts.app')

@section('title')
    Profil - Jdih Prov. Sulsel
@endsection

@section('og')
    <meta property="og:title" content="Profil - Jdih Prov. Sulsel">
@endsection

@section('content')
    @include('include.header', ['title' => 'Profil'])

    <!-- Start: About Section 
==================================================-->
    <section class="about-section about_pg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 about_bottom_warp">
                    <div class="about_list">
                        <div class="base-header">
                            <h3>Profil</h3>
                        </div>
                        <p>{!! nl2br($profil->desc) !!}</p>
                    </div>
                    <!-- <div class="row about_list_warp">
                        <div class="col-sm-6 col-xs-12">
                            <div class="about_list">
                                <div class="icon-fea icon_group"></div>
                                <h5>Business Develop</h5>
                                <p class="about_para">Loren ipsum dolor sitamet adipiscing elit sed do eiusmod ameth lectus id metus ornare sempereget </p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="about_list">
                                <div class="icon-fea icon_cog"></div>
                                <h5>Creative Work</h5>
                                <p class="about_para">Loren ipsum dolor sitamet adipiscing elit sed do eiusmod ameth lectus id metus ornare sempereget </p>
                            </div>
                        </div>
                    </div> -->
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