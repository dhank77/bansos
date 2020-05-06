@extends('panel.layouts.app')

@section('title')
    Kontak
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
                        <span>Kontak</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Kontak
            </h2>
            <small>Kontak</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">

        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                    </div>
                    Kontak
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('panel.kontak.edit') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-9">
                                <input type="text" id="alamat" name="alamat" class="form-control" value="{{ $data->alamat }}" placeholder="Alamat">
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-danger" onclick="btnClear('alamat')"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Telepon</label>
                            <div class="col-sm-9">
                                <input type="text" id="telepon" name="notlp" class="form-control" value="{{ $data->noTlp }}" placeholder="Telepon">
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-danger" onclick="btnClear('telepon')"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jam Buka</label>
                            <div class="col-sm-9">
                                <input type="text" id="jambuka" name="jambuka" class="form-control" value="{{ $data->jamBuka }}" placeholder="Jam Buka">
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-danger" onclick="btnClear('jambuka')"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        <button class="btn btn-success pull-right" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<script>
        function btnClear($formId) {
        $('#'+$formId).val('');
    }
</script>
@endsection