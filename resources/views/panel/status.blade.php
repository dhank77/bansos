@extends('panel.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="/assets_panel/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<link rel="stylesheet" href="/assets_panel/vendor/bootstrap-datepicker-master/dist/css/bootstrap-datepicker3.min.css" />

<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li class="active">
                        <span>Penerima Penghargaan</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Penerima Penghargaan
            </h2>
            <small>Examples of various form controls.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12 animated zoomIn">

            <div class="form-group">
                <!-- <div class="col-sm-7"><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Tambah</button>  </div> -->
                <div class="col-sm-5"></div>
                <div class="col-sm-2">
                    <select class="form-control select2" id="Periode" style="width: 100%;" onchange="loadData();"></select>
                </div>
                <div class="col-sm-5">
                @role('superadmin|verifikator')
                    <select class="form-control select2" id="unker" onchange="loadData();" style="width: 100%;">
                    </select>
                @endrole
                @role('admin')
                    <select class="form-control select2" id="unker" style="width: 100%;">
                        <option value="{{ Auth::user()->id_unker }}">{{ Auth::user()->name }} </option>
                    </select>
                @endrole
                </div>
            </div>

            <div class="modal fade" id="myModalEdit"  role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="/panel/tolak/usulan/pegawai" id="FormEdit" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="color-line"></div>
                            <div class="modal-body">
                                <div class="form-group" style="display: none;"><label class="col-sm-2 control-label">ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="id" id="idEdit" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Alasan Penolakan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="alasan" id="alasanEdit" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger" >Tolak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="hpanel">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">Diusulkan</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">Diterima</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">Ditolak</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <div class="hpanel"><div class="panel-body" id="loadtabel"></div></div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <div class="hpanel"><div class="panel-body" id="loadtabel2"></div></div>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <div class="hpanel"><div class="panel-body" id="loadtabel3"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<script src="/assets_panel/vendor/moment/moment.js"></script>
<script src="/assets_panel/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="/assets_panel/vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/assets_panel/scripts/homer.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
    $("#Periode").load('/datas/periode');
    @role('superadmin|verifikator')
    $('#unker').load('/datas/unker');
    @endrole
    $('#UnitKerjaEdit').load('/datas/unker');

    $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });

    var unker = $('#unker').val();
    var periode = $('#Periode').val();
    $.get("/datas/penerima/penghargaan/usul/"+unker+"/"+periode, function (data) {
        $('#loadtabel').html(data);
        $('#datatable-slide1').DataTable({
            "destroy": true,
        });
    });
    $.get("/datas/penerima/penghargaan/terima/"+unker+"/"+periode, function (data) {
        $('#loadtabel2').html(data);
        $('#datatable-slide2').DataTable({
            "destroy": true,
        });
    });
    $.get("/datas/penerima/penghargaan/tolak/"+unker+"/"+periode, function (data) {
        $('#loadtabel3').html(data);
        $('#datatable-slide3').DataTable({
            "destroy": true,
        });
    });

});

function alertTerima($id, $nama) {
    swal.fire({
        title: 'Apakah anda yakin ?',
        html: "Acc usulan pegawai a.n <strong>"+$nama+"</strong> ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            window.location = '/panel/acc/usulan/pegawai/'+$id;
        }
    });
}

function alertTolak($id){
    $("#idEdit").val($id);
}

function loadData() {
    var unker = $("#unker").val();
    var periode = $('#Periode').val();
    $.get("/datas/penerima/penghargaan/usul/"+unker+"/"+periode, function (data) {
        $('#loadtabel').html(data);
        $('#datatable-slide1').DataTable({
            "destroy": true,
        });
    });
    $.get("/datas/penerima/penghargaan/terima/"+unker+"/"+periode, function (data) {
        $('#loadtabel2').html(data);
        $('#datatable-slide2').DataTable({
            "destroy": true,
        });
    });
    $.get("/datas/penerima/penghargaan/tolak/"+unker+"/"+periode, function (data) {
        $('#loadtabel3').html(data);
        $('#datatable-slide3').DataTable({
            "destroy": true,
        });
    });
}

function TotalUsulan(){
    var periode = $("#Periode").val();
    $.ajax({ 
        type: 'GET', 
        url: '/data/'+periode,
        async: false,
        success: function (data) { 
            $usul    = data.usul;
            $terima  = data.terima;
            $tolak   = data.tolak;
        }
    });

    $( "#usul" ).empty();
    $( "#terima" ).empty();
    $( "#tolak" ).empty();

    $( "#usul" ).append( $usul );
    $( "#terima" ).append( $terima );
    $( "#tolak" ).append( $tolak );
}

</script>
@endsection
