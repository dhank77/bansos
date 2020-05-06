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
                        <span>Data Usulan Pegawai</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Data Usulan Pegawai
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
                <div class="col-sm-8">
                </div>
                <div class="col-sm-4">
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
                        <form method="POST" action="/usulan/pegawai/insert" id="FormEdit" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="color-line"></div>
                            <div class="alert alert-info">
                                <i class="fa fa-bolt"></i> Pegawai akan diusulkan sebagai penerima Penghargaan. Klik simpan untuk proses berikutnya.
                            </div>
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
                                <div class="form-group"><label class="col-sm-2 control-label">Golongan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="TMTGol" id="TMTGolEdit" style="width: 100%;" disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Jabatan" id="JabatanEdit" style="width: 100%;" disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;"><label class="col-sm-2 control-label">Unker</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Unker" id="UnitKerjaEdit" style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;"><label class="col-sm-2 control-label">Periode Sekarang</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="PeriodeSekarang" id="PeriodeSekarang" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Periode 10 Tahun</label>
                                    <div class="col-sm-10">
                                        <span id="p10"></span>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Periode 20 Tahun</label>
                                    <div class="col-sm-10">
                                        <span id="p20"></span>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Periode 30 Tahun</label>
                                    <div class="col-sm-10">
                                        <span id="p30"></span>
                                    </div>
                                </div>
                                <div class="alert alert-warning">
                                    <i class="fa fa-bolt"></i> Upload File Pendukung (jpg, jpeg, png, pdf) Ukuran File Max: 5MB
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Periode</label>
                                    <div class="col-sm-10">
                                        <select class="form-control select2" name="Periode" id="msperiodeEdit" style="width: 100%;" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-2 control-label">Upload Berkas</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="file[]" id="UploadBerkas" class="form-control" required multiple>
                                    </div>
                                </div>
                                <!-- <div class="form-group"><label class="col-sm-2 control-label">File Tambahan</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="filetambahan[]" class="form-control" required>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" onclick="tambahdiv();" class="btn btn-primary" >+</button>
                                    </div>
                                </div> -->
                                
                                <div id="divfiletambahan">

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" >Save</button>
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
    @role('superadmin|verifikator')
    $('#unker').load('/datas/unker');
    @endrole
    $('#msperiode').load('/datas/periode');
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
    $.get("/datas/usulan/pegawai/"+unker, function (data) {
        $('#loadtabel').html(data);
        $('#datatable-slide').DataTable({
            "destroy": true,
        });
    });
});

function AjaxSimpanData() { 
    var data = $('#FormEdit').serialize();
        $.ajax({
            type: 'POST',
            url: '/usulan/pegawai/insert',
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

function editData(id, nip, nama, gol, jabatan, p10, p20, p30, unker, z) { 
    $('#divfiletambahan').empty();

    $( "#p10" ).empty();
    $( "#p20" ).empty();
    $( "#p30" ).empty();

    $("#idEdit").val(id);
    $("#NipEdit").val(nip);
    $("#NamaPegawaiEdit").val(nama);
    $("#TMTGolEdit").val(gol).trigger('change');
    $("#JabatanEdit").val(jabatan).trigger('change');
    $('#msperiodeEdit').load('/datas/periode');
    $("#UnitKerjaEdit").val(unker).trigger('change');

    if(z <= 10) {
        $("#PeriodeSekarang").val('10');
    } else if (z <= 20) {
        $("#PeriodeSekarang").val('20');
    } else {
        $("#PeriodeSekarang").val('30');
    }
    

    if(p10 == 0){
        $("#p10").append('<h5 style="color: red;">Belum Diusulkan</h5>');
    } else {
        $("#p10").append('<h5 style="color: green;">Pernah Diusulkan</h5>');
    }

    if(p20 == 0){
        $("#p20").append('<h5 style="color: red;">Belum Diusulkan</h5>');
    } else {
        $("#p20").append('<h5 style="color: green;">Pernah Diusulkan</h5>');
    }

    if(p30 == 0){
        $("#p30").append('<h5 style="color: red;">Belum Diusulkan</h5>');
    } else {
        $("#p30").append('<h5 style="color: green;">Pernah Diusulkan</h5>');
    }
}

function loadData() {
    var unker = $("#unker").val();
    $.get("/datas/usulan/pegawai/"+unker, function (data) {
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
