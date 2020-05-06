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
                        <span>Data Pemberi Bantuan</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Data Pemberi Bantuan
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
                    <form method="POST" id="FormInsert" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Pemberi Bantuan</label>
                            <div class="col-sm-10">
                                <input type="text" name="pemberi_bantuan" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jenis Bantuan</label>
                            <div class="col-sm-10">
                                <input type="text" name="jenis_bantuan" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="text" name="jumlah" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Total Bantuan</label>
                            <div class="col-sm-10">
                                <input type="text" name="total_bantuan" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Tanggal Masuk</label>
                            <div class="col-sm-10">
                                <input type="date" name="tanggal_masuk" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="keterangan" class="form-control" required>
                            </div>
                        </div>
                        
                        <button class="btn btn-default pull-right" type="button" onclick="AjaxSimpanData();">Tambah</button>
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
                            <div class="form-group"><label class="col-sm-2 control-label">Pemberi Bantuan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="pemberi_bantuan" id="pemberi_bantuanEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Jenis Bantuan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="jenis_bantuan" id="jenis_bantuanEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="text" name="jumlah" id="jumlahEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Total Bantuan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="total_bantuan" id="total_bantuanEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Tanggal Masuk</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal_masuk" id="tanggal_masukEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="keterangan" id="keteranganEdit" class="form-control" required>
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
                                <th class="text-center">Pemberi Bantuan</th>
                                <th class="text-center">Jenis Bantuan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Total Bantuan</th>
                                <th class="text-center">Tanggal Masuk</th>
                                <th class="text-center">Keterangan</th>
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
            "ajax": "/panel/data/pemberi/bantuan/json",
            "columns": [
                { "data": "DT_RowIndex", "orderable": false, "searchable": false },
                { "data": "pemberi_bantuan" },
                { "data": "jenis_bantuan" },
                { "data": "jumlah" },
                { "data": "total_bantuan" },
                { "data": "tanggal_masuk" },
                { "data": "keterangan" },
                { "data": "aksi", "orderable": false, "searchable": false },
            ],
            "columnDefs": [
                {"className": "text-center", "targets": [0,3]}
            ],
        });

});

function AjaxSimpanData() { 
    var data = $('#FormInsert').serialize();
        $.ajax({
            type: 'POST',
            url: '/panel/data/pemberi/bantuan/insert',
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
            url: '/panel/data/pemberi/bantuan/delete/'+id,
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

function EditData(id){
    $.get( "/panel/data/pemberi/bantuan/edit/json/"+id, function( data ) {
        $("#idEdit").val(id);
        $("#pemberi_bantuanEdit").val(data[0].pemberi_bantuan);
        $("#jenis_bantuanEdit").val(data[0].jenis_bantuan);
        $("#jumlahEdit").val(data[0].jumlah);
        $("#total_bantuanEdit").val(data[0].total_bantuan);
        $("#tanggal_masukEdit").val(data[0].tanggal_masuk);
        $("#keteranganEdit").val(data[0].keterangan);
    });
}

</script>
@endsection
