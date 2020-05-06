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
                <div class="row">
                    <div class="col-sm-3">
                    <input class="inputcariku" style="width: 70%;" id="cari" name="cari" placeholder="Cari Produk Hukum" type="text">
                        <button onclick="butcari()" style="margin-top: -5px; margin-left: -8px;" class="btn btn-primary"> <i class="fa fa-search" ></i></button>
                        <br><br>
                    @include('data.kategori')
                    </div>
                    <div class="col-sm-9">

                        <div id="produk" class="row">
                        <div align="center" class="col-sm-2">
                            <img width="80px" src="https://jdih.lkpp.go.id/backend/web/uploads/images/perpres.png">
                        </div>
                        @foreach($produk as $rProduk)
                        <div class="col-sm-10">
                            <a href="#" class="blog_datee"><i class="fa fa-calendar"></i>  <small>{{ \Carbon\Carbon::parse($rProduk->tgl)->format('d M Y')}}</small> </a><br>
                                    <input type="text" style="display: none;" name="idproduk" id="idproduk" value="{{ $rProduk->id }}">
                                    <a style="font-size: 18px;" href="#"> <strong>{{ $rProduk->nama }}</strong> </a><br>
                                    <span>{{ $rProduk->judul }}</span>
                                    <br>
                                    <small style="background-color: #F0F0F0; padding: 4px; color: black; border-radius: 5px;" >Tahun {{ $rProduk->tahun }} </small> | 

                                    <small style="background-color: #F0F0F0; padding: 4px; color: black; border-radius: 5px;" > {{ $rProduk->namakategori }} </small> | 

                                    <small style="background-color: #F0F0F0; padding: 4px; color: black; border-radius: 5px;" > {{ $rProduk->namastatus }} </small> | 

                                    <a href="/assets_public/file/{{ $rProduk->file }}" onclick="butdown()" target="_BLANK">
                                        <small style="background-color: #F0F0F0; padding: 4px; color: black; border-radius: 5px;" >Download</small> 
                                    </a>

                                    <small>{{ $rProduk->download }} Kali Download</small>
                                    <hr>

                        </div>

                        <iframe align="right" id="fred" style="border:1px solid #666CCC" title="PDF in an i-Frame" src="/assets_public/file/{{ $rProduk->file }}" frameborder="1" scrolling="auto" width="95%" height="1000px" ></iframe>
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js" ></script>
    <script type="text/javascript">
        function butcari() {
            var id = document.getElementById("cari").value;
            var hasil = id.split(" ");
            $("#load").show().fadeOut(1000);
            $("#produk").load("/data/produk/"+hasil);
        };

        function butdown() {
            var id = document.getElementById("idproduk").value;
            $("#idproduk").load("/download/produk/"+id);
        };

        function butcarikategori1() {
            var id = document.getElementById("kategori1").value;
            var hasil = id.split(" ");
            $("#load").show().fadeOut(1000);
            $("#produk").load("/data/produk/kategori/"+hasil);
        };

        function butcarikategori2() {
            var id = document.getElementById("kategori2").value;
            var hasil = id.split(" ");
            $("#load").show().fadeOut(1000);
            $("#produk").load("/data/produk/kategori/"+hasil);
        };


        $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        
        $("#load").show().fadeOut(1000);

        var url = $(this).attr('href');  
        getArticles(url);
        window.history.pushState("", "", url);
    });

    function getArticles(url) {
        $.ajax({
            url : url  
        }).done(function (data) {
            $('#produk').html(data);  
        }).fail(function () {
            alert('Berita tidak dapat dimuat.');
        });
    }
   </script>

@endsection