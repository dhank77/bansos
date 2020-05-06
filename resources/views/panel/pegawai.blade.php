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
                        <span>Data Pegawai</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Data Pegawai
            </h2>
            <small>Examples of various form controls.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12 animated zoomIn">

            <div class="form-group">
                <div class="col-sm-8"><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Tambah</button>  </div>
                <div class="col-sm-4">
                    @role('superadmin')
                    <select class="form-control select2" id="unker" onchange="loadData();" style="width: 100%;">
                    </select>
                    @endrole
                    @role('admin')
                    <select class="form-control select2" id="unker" style="width: 100%;">
                        <option value="{{ Auth::user()->id_unker }}">{{ Auth::user()->name }} </option>
                    </select>
                    @endrole
                </div>
            </div><br><br>

            <div class="modal fade" id="myModal"  role="dialog"  aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="POST" id="FormInsert" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="color-line"></div>
                            <div class="modal-body">
                                <div class="form-group"><label class="col-sm-2 control-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="Nip" class="form-control" placeholder="1970100519********" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Nama Pegawai</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="NamaPegawai" class="form-control" placeholder="Julius Novachrono" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalLahir" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="TempatLahir" class="form-control" placeholder="Makassar" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="Alamat" class="form-control" placeholder="Jln. Perintis Km 99" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Agama</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Agama" id="Agama" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="JenisKelamin" id="JenisKelamin" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Status Kerja</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="StatusKerja" id="StatusKerja" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">TMT CPNS</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TMTCpns" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">TMT Gol</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="TMTGol" id="TMTGol" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Golongan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalGolongan" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Jabatan" id="Jabatan" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Eselon</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Eselon" id="Eselon" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Lantik</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalLantik" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Pendidikan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Pendidikan" id="Pendidikan" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Jurusan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="Jurusan" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Lulus</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalLulus" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Diklat</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Diklat" id="Diklat" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Diklat</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalDiklat" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Unit Kerja</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="UnitKerja" id="UnitKerja" style="width: 100%;">
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
                        <form method="POST" id="FormEdit" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="color-line"></div>
                            <div class="modal-body">
                                <div class="form-group" style="display: none;"><label class="col-sm-2 control-label">ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="id" id="idEdit" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">NIP</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="Nip" id="NipEdit" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Nama Pegawai</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="NamaPegawai" id="NamaPegawaiEdit" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalLahir" id="TanggalLahirEdit" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="TempatLahir" id="TempatLahirEdit" class="form-control" placeholder="Makassar" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="Alamat" id="AlamatEdit" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Agama</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Agama" id="AgamaEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="JenisKelamin" id="JenisKelaminEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Status Kerja</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="StatusKerja" id="StatusKerjaEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">TMT CPNS</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TMTCpns" id="TMTCpnsEdit" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">TMT Gol</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="TMTGol" id="TMTGolEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Golongan</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalGolongan" id="TanggalGolonganEdit" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Jabatan" id="JabatanEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Eselon</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Eselon" id="EselonEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Lantik</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalLantik" id="TanggalLantikEdit" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Pendidikan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Pendidikan" id="PendidikanEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Jurusan</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="Jurusan" id="JurusanEdit"  class="form-control" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Lulus</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalLulus" id="TanggalLulusEdit" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Diklat</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Diklat" id="DiklatEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Tanggal Diklat</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date datetimepicker">
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            <input type="text" name="TanggalDiklat" id="TanggalDiklatEdit" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Unit Kerja</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="UnitKerja" id="UnitKerjaEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Periode 10 Tahun</label>
                                    <div class="col-sm-2" id="StatusP10">
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" name="P10" id="P10" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Periode 20 Tahun</label>
                                    <div class="col-sm-2" id="StatusP20">
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" name="P20" id="P20" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Periode 30 Tahun</label>
                                    <div class="col-sm-2" id="StatusP30">
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" name="P30" id="P30" class="form-control"/>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="AjaxEditData();">Save</button>
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
    @role('superadmin')
    $('#unker').load('/datas/unker');
    @endrole
    $('#Agama').load('/datas/agama');
    $('#JenisKelamin').load('/datas/jeniskelamin');
    $('#StatusKerja').load('/datas/statuskerja');
    $('#TMTGol').load('/datas/tmtgol');
    $('#Jabatan').load('/datas/jabatan');
    $('#Eselon').load('/datas/eselon');
    $('#Pendidikan').load('/datas/pendidikan');
    $('#Diklat').load('/datas/diklat');
    $('#UnitKerja').load('/datas/unker');

    $('#AgamaEdit').load('/datas/agama');
    $('#JenisKelaminEdit').load('/datas/jeniskelamin');
    $('#StatusKerjaEdit').load('/datas/statuskerja');
    $('#TMTGolEdit').load('/datas/tmtgol');
    $('#JabatanEdit').load('/datas/jabatan');
    $('#EselonEdit').load('/datas/eselon');
    $('#PendidikanEdit').load('/datas/pendidikan');
    $('#DiklatEdit').load('/datas/diklat');
    $('#UnitKerjaEdit').load('/datas/unker');

    $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
    
    var unker = $('#unker').val();
    $.get("/datas/pegawai/"+unker, function (data) {
        $('#loadtabel').html(data);
        $('#datatable-slide').DataTable({
            "destroy": true,
        });
    });

    loadData();
});

function AjaxSimpanData() { 
    var data = $('#FormInsert').serialize();
        $.ajax({
            type: 'POST',
            url: '/pegawai/insert',
            data: data,
            success: function() {
                alertSukses();
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
            url: '/pegawai/edit',
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

function editData(id, nip, nama, tgllahir, tempatlahir, alamat, agama, jkel, status, tmtcpns, gol, tglgol, jabatan, eselon, tgllantik, pendumum, jurusan, tsttb, diklat, tgldiklat, unker, p10, p20, p30, n10, n20, n30) { 
    $("#idEdit").val(id);
    $("#NipEdit").val(nip);
    $("#NamaPegawaiEdit").val(nama);
    $("#TanggalLahirEdit").val(tgllahir);
    $("#TempatLahirEdit").val(tempatlahir);
    $("#AlamatEdit").val(alamat);
    $("#AgamaEdit").val(agama).trigger('change');
    $("#JenisKelaminEdit").val(jkel).trigger('change');
    $("#StatusKerjaEdit").val(status).trigger('change');
    $("#TMTCpnsEdit").val(tmtcpns);
    $("#TMTGolEdit").val(gol).trigger('change');
    $("#TanggalGolonganEdit").val(tglgol);
    $("#JabatanEdit").val(jabatan).trigger('change');
    $("#EselonEdit").val(eselon).trigger('change');
    $("#TanggalLantikEdit").val(tgllantik);
    $("#PendidikanEdit").val(pendumum).trigger('change');
    $("#JurusanEdit").val(jurusan);
    $("#TanggalLulusEdit").val(tsttb);
    $("#DiklatEdit").val(diklat).trigger('change');
    $("#TanggalDiklatEdit").val(tgldiklat);
    $("#UnitKerjaEdit").val(unker).trigger('change');

    $("#StatusP10").empty();
    $("#StatusP20").empty();
    $("#StatusP30").empty();

    if (p10 == 1) {
        $("#StatusP10").append('<button type="button" class="btn btn-info btn-sm">Diusul</button>');
    } else {
        $("#StatusP10").append('<button type="button" class="btn btn-danger btn-sm">Belum Diusul</button>');
    }

    if (p20 == 1) {
        $("#StatusP20").append('<button type="button" class="btn btn-info btn-sm">Diusul</button>');
    } else {
        $("#StatusP20").append('<button type="button" class="btn btn-danger btn-sm">Belum Diusul</button>');
    }

    if (p30 == 1) {
        $("#StatusP30").append('<button type="button" class="btn btn-info btn-sm">Diusul</button>');
    } else {
        $("#StatusP30").append('<button type="button" class="btn btn-danger btn-sm">Belum Diusul</button>');
    }

    $("#P10").val(n10);
    $("#P20").val(n20);
    $("#P30").val(n30);
}

function loadData() {
    var unker = $("#unker").val();
    $.get("/datas/pegawai/"+unker, function (data) {
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
