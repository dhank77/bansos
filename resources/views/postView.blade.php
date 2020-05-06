@extends('layouts.app')

@section('title')
    {{ $post->title }} - {{ $settings->namaOpd }} Prov. Sulsel
@endsection

@section('og')
    <meta property="og:title" content="{{ $post->title }} - {{ $settings->namaOpd }} Prov. Sulsel">
    <meta property="og:image" content="{{ asset('assets_public/images/'.$post->img) }}">
@endsection

@section('content')
    <!-- header -->
    <header id="page-top" class="blog-banner">
        <!-- Start: Header Content -->
        <div class="container" id="blog">
            <div class="row blog-header text-center wow" data-wow-delay="0.5s">
                <div class="col-sm-12">
                    <!-- Headline Goes Here -->
                    <h4><a href="{{ route('index') }}"> {{ $settings->namaOpd }} </a> / <a href="{{ route('index.post', ['submenu' => $submenu->submenu]) }}">{{ $submenu->displayName }}</a> / #{{ $post->id }}</h4>
                    <h3>{{ $post->title }}</h3>
                </div>
            </div>
            <!-- End: .row -->
        </div>
        <!-- End: Header Content -->
    </header>
    <!--/. header -->
    <!-- End: Header Section
    ==================================================-->

    <!-- Start : Blog Page Content 
    ==================================================-->
    <div class="blog_container blog_page_one">
        <div class="container">
            <div class="row">
                <!-- Blog Area -->
                <div class="col-sm-8 col-xs-12 blog-area">
                    <div class="blog-warp-1 blog_warp_lay_1">
                        <div class="blog_imgg">
                            <img src="{{ asset('assets_public/images/'.$post->img) }}" alt="" />
                        </div>
                        <div class="blog_content_warp">
                            <a href="#" class="blog_datee"><i class="fa fa-calendar"></i>  {{ \Carbon\Carbon::parse($post->createdAt)->format('d M Y')}}  </a>
                            <h5> {{ $post->title }}</h5>
                            <span>{!! nl2br($post->desc) !!}</span>
                        </div>
                    </div>
                    <!--/ article -->
                </div>
                <!--/ Blog Area -->
                @include('include.sidebarRight')
            </div>
        </div>
        <!-- Container /- -->
    </div>
    <!--  End : Blog Page Content
    ==================================================-->
@endsection