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
                                <select class="form-control select2" name="periode" id="Periode" onchange="LoadLaporan();" style="width: 100%;" >
                                </select>
                                <div id="load"></div>
                            </div>
                        </div>
                    </form>
                </div><br>
        </div><br>
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
    $('#Periode').load('/datas/periode');
    $('#load').load('/panel/laporan/semua');
    $('#framelaporan').attr("src", "/filelaporan/laporanall.pdf");
});

function LoadLaporan() { 
    var periode =  $('#Periode').val();
    $("#FormInsert").load('/panel/laporan/semua/'+periode);
    $('#framelaporan').attr("src", "/filelaporan/laporanall.pdf");
}

</script>
@endsection
