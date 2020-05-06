@extends('panel.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li>
                        <span>Master</span>
                    </li>
                    <li class="active">
                        <span>Laporan</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Laporan
            </h2>
            <small>Examples of various form controls.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: -20px">
                <div class="panel-body">
                    <form method="POST" id="FormInsert" class="form-horizontal">
                        @csrf
                        <div class="form-group"><label class="col-sm-8 control-label"></label>
                            <div class="col-sm-4">
                                <select class="form-control select2" name="unker" id="Unker" onchange="LoadLaporan();" style="width: 100%;" >
                                </select>
                            </div>
                        </div>
                    </form>
            </div>
        </div><br><br>
        <div class="col-lg-12" style="margin-bottom: -20px">
            <div class="hpanel">
                <div class="panel-body">
                <iframe id="framelaporan" src="" width="100%" height="900px"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
    $('#Unker').load('/datas/unker');
    var unker = '1';
    $('#framelaporan').attr("src", "/filelaporan/laporanskpd"+unker+".pdf");
    LoadLaporan();
});

function LoadLaporan() { 
    var unker =  $('#Unker').val();
    $("#FormInsert").load('/panel/laporan/skpd/'+unker);
    $('#framelaporan').attr("src", "/filelaporan/laporanskpd"+unker+".pdf");
}

</script>
@endsection
