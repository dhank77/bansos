@extends('layouts.app2')

@section('title')
	Sulsel Bicara Baik - Provinsi Sulawesi Selatan
@endsection

@section('og')
    <meta property="og:title" content="Sulsel Bicara Baik - Provinsi Sulawesi Selatan">
@endsection

@section('content')
    <!-- Start: Slides  -->
    <div class="slides_wrapper">
        <div class="slides__preload_wrapper">
            <div class="spinner"></div>
        </div>
        <div id="a" class="slider_home">
            <!-- Start: Slider -->
            
                <div class="single_slider"
                    style="background: #f0f0f0 url({{ asset('/assets_public/images/slide/1.jpg') }}) no-repeat; 
                            background-color: #dddd;
                            background-position: 50% 0px;
                            background-size: cover;
                            color: #fff;
                            font-size: 24px;
                            height: 800px;">
                    <div class="slider_item_tb">
                        <div class="slider_item_tbcell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6" style="margin-left: 33%; margin-left: 50%;">
                                        <h2 style="text-shadow: 0.5px 0.5px 4px #091F2C">Judul</h2>
                                        <p style="text-shadow: 0.5px 0.5px 4px #091F2C">Deskripsi</p>
                                        <!--
                                            <div class="slider_btn">
                                                <a href="#quote" class="slider_btn_one">Contact us</a>
                                            </div>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <!-- End: Slider -->
        </div>
    </div>
    <!-- End:  Slider
==================================================-->

    <!-- Start: About Section 
==================================================-->
    <section class="about-section" id="profil" style="margin-top: -22px; background: #fff url('/assets_public/images/about.png') no-repeat right; background-size: 55% 100%;">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 about_bottom_warp cust-text-shadow">
                    <div class="about_list">
                        <div class="base-header">
                            <a href="{{ route('index.profil') }}"><h3>Profil Sulsel Bicara Baik</h3></a>
                        </div>
                        <span>Deskripsi</span>
                    </div>
<!--                     <div class="row about_list_warp">
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
                <div class="col-sm-6">
                    
                </div>
                <!--End: About Video -->
            </div>
            <!--End: row-->
        </div>
        <!-- End: container-->
    </section>
    <!--  End: About Section
==================================================-->

    <!-- Start: Service Section 
==================================================-->
    <section class="service_section" id="layanan" style="display: none;">
        <div class="container">
            <!-- Start: Heading -->
            <div class="base-header">
                <h3>Pelayanan</h3>
            </div>
            <!-- End:  heading -->
            <div class="row" id="service">
                
                <div class="service_list">
                    <div class="service_img">
                        <img alt="team" class="img-responsive" src="{{ asset('assets_public/images/berita/1.jpg') }}">
                    </div>
                    <div class="service_para">
                        <a href="#"><i class="icon_piechart"></i><h5><a href="#">Judul</a></h5></a>

                        <p>Berita</p>
                        <a href="#" class="blog_btn">selengkapnya<span class="fa fa-angle-double-right"></span></a>
                    </div>
                </div>

                <div class="service_list">
                    <div class="service_img">
                        <img alt="team" class="img-responsive" src="{{ asset('assets_public/images/berita/1.jpg') }}">
                    </div>
                    <div class="service_para">
                        <a href="#"><i class="icon_piechart"></i><h5><a href="#">Judul</a></h5></a>

                        <p>Berita</p>
                        <a href="#" class="blog_btn">selengkapnya<span class="fa fa-angle-double-right"></span></a>
                    </div>
                </div>

                <div class="service_list">
                    <div class="service_img">
                        <img alt="team" class="img-responsive" src="{{ asset('assets_public/images/berita/1.jpg') }}">
                    </div>
                    <div class="service_para">
                        <a href="#"><i class="icon_piechart"></i><h5><a href="#">Judul</a></h5></a>

                        <p>Berita</p>
                        <a href="#" class="blog_btn">selengkapnya<span class="fa fa-angle-double-right"></span></a>
                    </div>
                </div>
                
                
                <!--/Item -->
                <!-- End : Tab pane 1 -->
            </div>
            <!---/.row -->
        </div>
        <!--/.container -->
    </section>
    <!-- End: Service Section 
==================================================-->


<!-- Start: Testimonial Section
    ==================================================-->
        <div class="testimonials-section" id="berita">
            <div class="container">
                <!-- Start: Heading -->
                <div class="base-header">
                    <a href="#"><h3>Berita Terkini</h3></a>
                </div>
                <!-- End:  heading -->
                <div class="row">
                    @foreach($berita as $xBerita)
                        <div class="col-sm-4 col-xs-12">
                            <div class="blog-warp-1 blog_warp_lay_1">
                                <div class="blog_imgg">
                                    <img src="{{ asset('assets_public/images/'.$xBerita->img) }}" alt="" />
                                </div>
                                <div class="blog_content_warp">
                                    <a href="#" class="blog_datee"><i class="fa fa-calendar"></i>  {{ \Carbon\Carbon::parse($xBerita->createdAt)->format('d M Y')}}  </a>
                                    <h5><a href="#">{{ $xBerita->judul }}</a></h5>
                                    <span>{!! nl2br(str_limit($xBerita->desc, 120)) !!}</span>
                                    <a href="#" class="blog_btn">selengkapnya<span class="fa fa-angle-double-right"></span></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--/ row -->
            </div>
            <!--/.container-->
        </div>
        <!-- End: Testimonial Section 
==================================================-->

<!-- Start: Work Section 
==================================================-->
    <section class="work-section" id="galeri">
        <div class="container">
            <div class="row">
                <!-- Start: Heading -->
                <div class="base-header">
                    <a href="#"><h3> Infografik </h3></a>
                </div>
                <!-- End:  heading -->

                <!-- Start: Work Item -->
                <div class="projects-list">
                    
                    <div class="col-sm-3 col-xs-12 web graphics">
                        <div class="single-project-item" style="background-image: url({{ asset('assets_public/images/berita/1.jpg') }})">
                            <div class="project-hover">
                                <h4><a href="#">Judul</a></h4>
                                <span>Tanggal</span>
                                <a class="project-link" href="{{ asset('assets_public/images/berita/1.jpg') }}"><i class="icon_image"></i></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- End: Work Section 
==================================================-->

    <!--   Start: Contact Section  
==================================================-->
    <section class="contact-section" id="contact">
        <div class="container">
            <!-- Start: Heading -->
            <div class="base-header">
                <h3>Hubungi Kami</h3>
            </div>
            <!-- End:  heading -->
            <div class="row">
                <!-- Start:  Content  -->
                <div class="inner-contact">
                    <div class="row contact_info">
                        <div class="bottom_contact col-sm-4 col-xs-12">
                            <div class="row">
                                <div class="col col-md-1">
                                    <i class="icon_pin_alt"></i>
                                </div>
                                <div class="col col-md-11">
                                    <p>Alamat</p>
                                    <h4>Makassar</h4>
                                </div>
                            </div>
                        </div>
                        <div  class="bottom_contact col-sm-4 col-xs-12">
                            <div class="row">
                                <div  class="col col-md-1">
                                    <i class="icon_phone"></i>
                                </div>
                                <div  class="col col-md-11">
                                        <p>No Telepon</p>
                                        <h4>082293424963</h4>
                                </div>
                            </div>
                        </div>
                        <div  class="bottom_contact col-sm-4 col-xs-12">
                            <div class="row">
                                <div class="col col-md-1">
                                    <i class="icon_clock_alt"></i>
                                </div>
                                <div class="col col-md-11">
                                    <p>Jam Buka</p>
                                    <h4>18:00</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: inner-contact-->
            </div>
            <!-- End: row-->
        </div>

        <!-- End: container-->
    </section>
    <!-- End:Contact Section 
==================================================-->
@endsection