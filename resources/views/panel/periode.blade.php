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
                        <span>Periode</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Periode
            </h2>
            <small>Examples of various form controls.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12 animated zoomIn">

            <div class="form-group">
                <div class="col-sm-4">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Tambah</button>  </div>
                </div>
                <div class="col-sm-4">
                    </select>
                </div>
                <div class="col-sm-4">
                </div>
            </div><br><br><br>

            <div class="modal fade" id="myModal"  role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" id="FormInsert" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="color-line"></div>
                            <div class="modal-body">
                                <div class="form-group"><label class="col-sm-2 control-label">Tahun Periode</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="TahunPeriode" style="width: 100%;">
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Nama Periode</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="NamaPeriode" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Hitung</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalHitung" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tampil</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Tampil" style="width: 100%;">
                                            <option value="">- Pilih -</option>
                                            <option value="Y">Ya</option>
                                            <option value="T">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Aktif</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Aktif" style="width: 100%;">
                                            <option value="">- Pilih -</option>
                                            <option value="Y">Ya</option>
                                            <option value="T">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="AjaxSimpanData();">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModalEdit"  role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" action="/usulan/pegawai/insert" id="FormEdit" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="color-line"></div>
                            <div class="modal-body">
                                <div class="form-group" style="display: none;"><label class="col-sm-2 control-label">ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="id" id="idEdit" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tahun Periode</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="TahunPeriode" id="TahunPeriodeEdit" style="width: 100%;">
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Nama Periode</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="NamaPeriode" id="NamaPeriodeEdit" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Hitung</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalHitung" id="TanggalHitungEdit" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tampil</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Tampil" id="TampilEdit"  style="width: 100%;">
                                            <option value="">- Pilih -</option>
                                            <option value="Y">Ya</option>
                                            <option value="T">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Aktif</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Aktif" id="AktifEdit" style="width: 100%;">
                                            <option value="">- Pilih -</option>
                                            <option value="Y">Ya</option>
                                            <option value="T">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary"  onclick="AjaxEditData();">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hpanel">
                <div class="panel-body" id="loadtabel">
                    
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

    $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });

    loadData();
});

function AjaxSimpanData() { 
    var data = $('#FormInsert').serialize();
        $.ajax({
            type: 'POST',
            url: '/datas/ms/periode/insert',
            data: data,
            success: function() {
                alertSukses();
                loadData();
            },
            error: function() {
                alertGagal();
            }
        });
}

function AjaxEditData() { 
    var data = $('#FormEdit').serialize();
        $.ajax({
            type: 'POST',
            url: '/datas/ms/periode/edit',
            data: data,
            success: function() {
                alertSukses();
                loadData();
            },
            error: function() {
                alertGagal();
            }
        });
}

function HapusData(id) {
    swal.fire({
                title: 'Apakah anda yakin ?',
                html: "Hapus data",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    AjaxHapusData(id);
                }
            });
}

function AjaxHapusData(id) { 
    var data = id;
        $.ajax({
            type: 'GET',
            url: '/pegawai/delete/'+id,
            data: data,
            success: function() {
                alertSukses();
            },
            error: function() {
                alertGagal();
            }
        });
}

function tambahdiv() {
    $("#divfiletambahan").append('<div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-9"><input type="file" name="filetambahan[]" class="form-control" required></div><div class="col-sm-1"></div> </div>');
}

function editData(id, tahun, nama, tanggal, tampil, aktif) { 
    $("#idEdit").val(id);
    $("#TahunPeriodeEdit").val(tahun).trigger('change');
    $("#NamaPeriodeEdit").val(nama);
    $("#TanggalHitungEdit").val(tanggal);
    $("#TampilEdit").val(tampil).trigger('change');
    $("#AktifEdit").val(aktif).trigger('change');
}

function loadData() {
    var unker = $("#unker").val();
    $.get("/datas/ms/periode", function (data) {
        $('#loadtabel').html(data);
        $('#datatable-slide').DataTable({
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
