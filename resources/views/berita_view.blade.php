@extends('layouts.app')

@section('title')
	Sulsel Bicara Baik - Provinsi Sulawesi Selatan
@endsection

@section('og')
    <meta property="og:title" content="JDIH - Provinsi Sulawesi Selatan">
@endsection

@section('content')

@foreach( $berita as $xberita)

<div class="header-wrapper page-title" >
	<div class="container" >
		<div class="row">
			<div class="col-md-12">
				<div class="region region-header">
					<div class="views-element-container block block-views block-views-blockarticle-detail-header-block-1 clearfix" 
     				id="block-views-block-article-detail-header-block-1">
     				<div class="form-group">
     					<div class="view view-article-detail-header view-id-article_detail_header view-display-id-block_1 js-view-dom-id-4ab1bb9d141583404a14759fc24be7e7eece9275f2ea0ac25998db03ca6da779">

     						<div class="view-content">
     							<div class="views-row">
     								<div class="views-field views-field-title">
          								<h1 class="field-content" style="color: black;">{{ $xberita->judul }}</h1>
          							</div>
          							<span class="views-field views-field-created">
          								<span class="views-label views-label-created" style="color: black;">Di posting pada </span><span class="field-content" style="color: black;">{{ \Carbon\Carbon::parse($xberita->createdAt)->format('d M Y')}}</span></span>
          						</div>
          					</div>
          				</div>
          			</div>
          			</div>
          		</div>
        	</div>
    	</div>
	</div>
</div>




<div role="main" id="main-container" class="main-container container js-quickedit-main-content">
	<div class="row">

		<div class="col-sm-8">
			<div class="highlighted"><div class="region region-highlighted"></div></div>
        <a id="main-content"></a>
        <div class="region region-content">
        	<article data-history-node-id="6" role="article"  typeof="schema:Article" class="node node--type-article article is-promoted full clearfix">
        	  <div class="article-image mb24">
        	  	<div class="field field--name-field-image field--type-image field--label-hidden field--item">  <img property="schema:image" src="/assets_public/images/berita/{{ $xberita->img }}" width="770" height="430" alt="presentation" typeof="foaf:Image" class="img-responsive">
        	  	</div>
        	  </div>
        	 
        	  
        	  <div class="content">
        	  	<div property="schema:text" class="field field--name-body field--type-text-with-summary field--label-hidden field--item">
        	  		{!! nl2br($xberita->desc) !!}
        		</div>
        	  </div>

        	</article>
        </div>
      </div>

@endforeach

<aside id="sidebar-second" class="col-sm-4" role="complementary">
	<div class="region region-sidebar-second">
	   <div class="views-element-container widget recent-posts-widget block block-views block-views-blockblog-block-1 clearfix">

        <h2 class="block-title">Berita Terbaru</h2>
        <div class="form-group">
          <div class="block-article-list view view-blog view-id-blog view-display-id-block_1 js-view-dom-id-34a98e89f09c6fc5add181fc6c2f41d51a7953aa296f14d1de79486713f47f0f">
          <div class="view-content">
          <div class="item-list">
      	   <ul>
              @foreach($beritaterbaru as $xberitaterbaru)
              <li>
                <div class="views-field views-field-title">
                  <span class="field-content">
                    <a href="/berita/{{ $xberitaterbaru->id }}/{{ $xberitaterbaru->slug }}" >{{ $xberitaterbaru->judul }}</a>
                  </span>
                </div>
              </li>
               @endforeach
      		  </ul>
    		  </div>
    		  </div>
    		  </div>
    		</div>

  		</div>
		</div>
	</div>
	</aside>


</div>
</div>

 

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js" ></script>

    <script type="text/javascript">

        $('#butlapor').click(function() {
        if ((parseInt($('#nomor1').val()) + parseInt($('#nomor2').val())) == parseInt($('#hasil').val())) {
            return true;
        } else {
            alert('Captcha salah!');
            $('#nomor1').val(Math.floor((Math.random() * 9) + 1));
            $('#nomor2').val(Math.floor((Math.random() * 9) + 1));
            $('#hasil').val("");
            document.getElementById('hasil').focus();
            return false;
        }
        });

        $('#file1').change(function() {
            var i = $(this).prev('label').clone();
            var file = $('#file1')[0].files[0].name;
            $('label[name="selected"]').text(file);
            //$(this).prev('selected').text(file);
            });

        function butShow(id) {
            document.getElementById("show").src = "/assets_public/file/"+id; 
        };

        function lihatmodal(id, judul) {
            document.getElementById("show").src = "/assets_public/file/"+id; 
            $("#judulgrafik").text(judul);
        };

        function butcari() {
            var id = document.getElementById("cari").value;
            var hasil = id.split(" ");
            $("#berita").load("/berita/hoax/"+hasil);
        };

        $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        
        // $("#load").show().fadeOut(1000);

        var url = $(this).attr('href');  
        getArticles(url);
        window.history.pushState("", "", url);
    });

    function getArticles(url) {
        $.ajax({
            url : url  
        }).done(function (data) {
            $('#berita').html(data);  
        }).fail(function () {
            alert('Berita tidak dapat dimuat.');
        });
    }
   </script>

@endsection





