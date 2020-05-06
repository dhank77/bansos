@extends('layouts.app')

@section('title')
	JDIH - Provinsi Sulawesi Selatan
@endsection

@section('og')
    <meta property="og:title" content="JDIH - Provinsi Sulawesi Selatan">
@endsection

@section('content')

    <!--   Start: Contact Section  
==================================================-->
    <!-- <section class="contact-section" id="contact">
        <div class="container">
            <br><br><br><br><br><br>
            <div class="base-header">
                <div class="col-sm-12" align="center">
                    <form style="width: 50%;" class="footer_subs">
                            <input class="form-input" placeholder="Cari Produk Hukum" type="text">
                            <button type="submit" class="form-button"></button>
                    </form>
                </div>
            </div>
            <br><br><br>
        </div>

    </section> -->
    <!-- End:Contact Section 
==================================================-->


<!-- Start: Testimonial Section
    ==================================================-->

        <div class="testimonials-section" id="berita">
            <div class="container">
                <!-- Start: Heading -->
                <!-- <div class="base-header">
                    <a href="{{ route('index.post', ['table' => 'berita']) }}"><h5 class="pull-left">Produk Hukum Terbaru</h5></a>     
                </div> -->
                <!-- End:  heading -->
                <div class="row">
                    <div id="loadberitaterbaru" class="col-sm-3">
                    
                    </div>
                    <div class="col-sm-9">
                        @foreach($berita as $rBerita)

                        <div align="center" class="col-sm-12">
                            <img width="100%" style="margin-left: auto; margin-right: auto;" src="/assets_public/images/berita/{{ $rBerita->img }}">
                        </div>

                        <div class="row">
                        <br><br><br>

                        <div class="col-sm-12" style="margin-left: 30px;">
                            <br>
                                    <a style="font-size: 18px;" href="#"> <strong>{{ $rBerita->judul }}</strong></a>
                                    <br>
                                    <a href="#" class="blog_datee"><i class="fa fa-calendar"></i>  <small>Diposting pada {{ \Carbon\Carbon::parse($rBerita->tgl)->format('d M Y')}}</small> </a>

                                    <span>{!! nl2br($rBerita->desc) !!}</span>
                                    <br>
                                    
                        </div>
                        </div>
                        @endforeach
                   
                    </div>

                </div>
                <!--/ row -->
            </div>
            <!--/.container-->
        </div>
        <!-- End: Testimonial Section 
==================================================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      loadberitaterbaru();
    });

    function loadberitaterbaru(){
        $("#loadberitaterbaru").load("/berita/terbaru");
    }
</script>

@endsection