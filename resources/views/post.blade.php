@extends('layouts.app')

@section('title')
    {{ $submenu->displayName }} - {{ $settings->namaOpd }} Prov. Sulsel
@endsection

@section('og')
    <meta property="og:title" content="{{ $submenu->displayName }} - {{ $settings->namaOpd }} Prov. Sulsel">
@endsection

@section('content')
    @include('include.header', ['title' => $submenu->displayName])

    <!-- Start : Blog Page Content 
    ==================================================-->
    <div class="blog_container blog_page_one">
        <div class="container">
            <div class="row">
                <!-- Blog Area -->
                <div class="col-sm-8 col-xs-12 blog-area">
                    <div class="row">
                        <div class="paginate">
                              @include('data.data_berita')
                        </div>
                    </div>

                </div>
                <!--/ Blog Area -->
                @include('include.sidebarRight', ['submenu' => $submenu->submenu])
            </div>
        </div>
        <!-- Container /- -->
    </div>

    <script type="text/javascript">
$(function() {
    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();
        
        $('#load').append('<img class="mg-t-10" style="margin-bottom: -15px" src="/assets/images/loading.gif">');

        var url = $(this).attr('href');  
        getArticles(url);
        window.history.pushState("", "", url);
    });

    function getArticles(url) {
        $.ajax({
            url : url  
        }).done(function (data) {
            $('.paginate').html(data);  
        }).fail(function () {
            alert('Berita tidak dapat dimuat.');
        });
    }
});
</script>
    <!--  End : Blog Page Content
    ==================================================-->
@endsection

