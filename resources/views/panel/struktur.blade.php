@extends('panel.layouts.app')

@section('title')
    Struktur
@endsection

@section('content')
<div class="normalheader transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="">
                <div class="clip-header">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </a>

            <div id="hbreadcrumb" class="pull-right m-t-lg">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="{{ route('panel.dashboard') }}">Dashboard</a></li>
                    <li class="active">
                        <span>Struktur</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Struktur
            </h2>
            <small>Informasi Struktur {{ $settings->namaOpd }}</small>
        </div>
    </div>
</div>

<div class="content animate-panel">
    <div class="row">
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <div style="text-align: right"><small><strong>Terakhir diperbarui:</strong> {{ \Carbon\Carbon::parse($struktur->updatedAt)->format('d F Y, H:i')}}</small></div>
                    <form action="{{ route('panel.struktur.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <textarea class="form-control" id="editor" name="desc" rows="15" placeholder="Masukkan teks" style="height: 350px;" required>{{ $struktur->desc }}</textarea>
                        <button type="submit" class="btn btn-success" style="width: 100%; margin-top: 5px">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection