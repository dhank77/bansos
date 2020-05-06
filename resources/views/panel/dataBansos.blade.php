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
                        <span>Data Bansos</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Bansos
            </h2>
            <small>Examples of various form controls.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: -20px">
            <div class="hpanel @if (!Session::has('showCreate')) collapsed @endif">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <button class="btn btn-xs btn-info showhide">Tambah<i class="fa fa-chevron-up"></i></button>
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <form method="POST" id="FormInsert" action="/file" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">File</label>
                            <div class="col-sm-10">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
<!--                         
                        <div class="form-group"><label class="col-sm-2 control-label">IDARTBDT</label>
                            <div class="col-sm-10">
                                <input type="text" name="IDARTBDT" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">IDBDT</label>
                            <div class="col-sm-10">
                                <input type="text" name="IDBDT" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Provinsi</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="KD_PROV" style="width: 100%;" >
                                    
                                    <option value="73">Sulawesi Selatan</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Kab / Kota</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="KD_KAB" id="KD_KAB" onchange="loadkec()" style="width: 100%;" >
                                    @foreach($kab as $xkab)
                                    <option value="{{ $xkab->id }}">{{ $xkab->nama_kab }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="KD_KEC" id="KD_KEC" style="width: 100%;" >
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Kelurahan</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="KD_KEL" style="width: 100%;" >
                                    
                                    <option value="1">Tamlanrea</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Sls</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_sls" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Penerima</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jenis Kelamin</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="jenis_kelamin" style="width: 100%;" >
                                    
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" name="tempat_lahir" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" name="tanggal_lahir" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Usia</label>
                            <div class="col-sm-10">
                                <input type="text" name="usia" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nik</label>
                            <div class="col-sm-10">
                                <input type="text" name="nik" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">KK</label>
                            <div class="col-sm-10">
                                <input type="text" name="kk" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jumlah Art</label>
                            <div class="col-sm-10">
                                <input type="text" name="jumlah_art" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Persentil</label>
                            <div class="col-sm-10">
                                <input type="text" name="persentil" class="form-control" required>
                            </div>
                        </div> -->
                        
                        <button class="btn btn-default pull-right" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade hmodal-info" id="editModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" id="FormEdit" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="color-line"></div>
                        <div class="modal-body">
                            <div class="form-group" style="display: none"><label class="col-sm-2 control-label">ID</label>
                                <div class="col-sm-10">
                                    <input type="text" id="idEdit" name="id" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" id="NamaEdit" name="Nama" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" onclick="AjaxEditData();">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <table id="datatable-slide" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">No</th>
                                <th class="text-center">Nik</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Kab / Kota</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Jumlah Art</th>
                                <th class="text-center">Persentil</th>
                                <th class="text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
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

    var table2 = $('#datatable-slide').DataTable({
            "pageLength": 10,
            "processing": true,
            "language": {
                "processing": 'Memuat...'
            },
            "serverSide": true,
            "ajax": "/panel/data/bansos/json",
            "columns": [
                { "data": "DT_RowIndex", "orderable": false, "searchable": false },
                { "data": "IDBDT" },
                { "data": "NAMA" },
                { "data": "KABUPATEN" },
                { "data": "ALAMAT" },
                { "data": "JUMLAH_ART" },
                { "data": "PERSENTIL" },
                { "data": "aksi", "orderable": false, "searchable": false },
            ],
            "columnDefs": [
                {"className": "text-center", "targets": [0,3]}
            ],
        });

});

function loadkec() {
    var id = $('#KD_KAB').val();
    $("#KD_KEC").load('/kecamatan/'+id);
}

function AjaxSimpanData() { 
    var data = $('#FormInsert').serialize();
        $.ajax({
            type: 'POST',
            url: '/panel/data/daerah/insert',
            data: data,
            success: function() {
                alertSukses();
                $('#datatable-slide').DataTable().ajax.reload();
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
            url: '/panel/data/daerah/edit',
            data: data,
            success: function() {
                alertSukses();
                $('#datatable-slide').DataTable().ajax.reload();
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
            url: '/panel/data/daerah/delete/'+id,
            data: data,
            success: function() {
                alertSukses();
                $('#datatable-slide').DataTable().ajax.reload();
            },
            error: function() {
                alertGagal();
            }
        });
}

function EditData(id, nama) { 
    document.getElementById("idEdit").value= id;
    document.getElementById("NamaEdit").value= nama;
}

</script>
@endsection
