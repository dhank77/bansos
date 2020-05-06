@extends('layouts.app')

@section('title')
     {{ $settings->namaOpd }} Prov. Sulsel
@endsection

@section('og')
    <meta property="og:title" content=" {{ $settings->namaOpd }} Prov. Sulsel">
@endsection

@section('content')

@include('include.header', ['title' => 'Informasi Publik'])



<div class="page-content">
        <div class="content-area">
            <div class="container">
                <div class="p-a30 bg-white m-b40">
                    <div class="section-head">
                        <div class="text-center">
                            <h3 class="text-uppercase text-center">Informasi Publik</h3>
                            <div class="dez-separator bg-primary"></div>
                        </div>
                        <table class="table table-bordered" >
                            @foreach($download as $rowDownload)
                                <tr>
                                    <td>{{ $rowDownload->title }}</td>
                                    <td align="center" width="150px">{{ $rowDownload->created_at }}</td>
                                    <td width="95px" align="center"><button style="background-color: #FF4B5A;" class="btn btn-xs" type="button" data-toggle="modal" data-target="#modal-{{ $rowDownload->id }}"><span class="site-button-inr" style="font-weight: bold;"><i class="fa fa-eye"></i> Lihat</span></button></td>
                                </tr>
                                <div id="modal-{{ $rowDownload->id }}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">{{ $rowDownload->title }}</h4>
                                            </div>
                                            <div class="modal-body">
                                                <embed src="assets_public/download/{{ $rowDownload->file }}" width="550" height="600"></embed>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

