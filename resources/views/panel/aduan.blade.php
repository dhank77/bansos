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
                        <span>Data Aduan</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Aduan
            </h2>
            <small>Examples of various form controls.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: -50px">

            <div class="row" style="margin-bottom: 15px;">
                <div class="col-lg-1"><label class="control-label">Kabupaten</label></div>
                <div class="col-lg-4">
                    <select name="kab" id="kab" class="select2" style="width: 100%;">
                        <option value="00">Semua</option>
                        @foreach($data as $xdata)
                        <option value="{{ $xdata->kd_kab }}">{{ $xdata->nama_kab }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-7"></div>
            </div>

            <div class="row" style="margin-bottom: 15px;">
                <div class="col-lg-1"><label class="control-label">Kecamatan</label></div>
                <div class="col-lg-4">
                    <select name="kec" id="kec" class="select2" style="width: 100%;">
                        <option value="00">Semua</option>
                    </select>
                </div>
                <div class="col-lg-7"></div>
            </div>

            <div class="row">
                <div class="col-lg-1"><label class="control-label">Kelurahan</label></div>
                <div class="col-lg-4">
                    <select name="kel" id="kel" class="select2" style="width: 100%;">
                        <option value="00">Semua</option>
                    </select>
                </div>
                <div class="col-lg-7"></div>
            </div>



            <div class="hpanel @if (!Session::has('showCreate')) collapsed @endif">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <!-- <button class="btn btn-xs btn-info showhide">Tambah<i class="fa fa-chevron-up"></i></button> -->
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <!-- <form method="POST" id="FormInsert" action="/file" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">File</label>
                            <div class="col-sm-10">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                        <button class="btn btn-default pull-right" type="submit">Tambah</button>
                    </form> -->
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
                    <table id="datatable-slide" class="table table-striped table-bordered table-hover display nowrap" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">No</th>
                                <th class="text-center">Nik</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">No Telp</th>
                                <th class="text-center">No Wa</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Kab / Kota</th>
                                <th class="text-center">Kecamatan</th>
                                <th class="text-center">Kelurahan</th>
                                <th class="text-center">Rt</th>
                                <th class="text-center">Rw</th>
                                <th class="text-center">Pekerjaan</th>
                                <th class="text-center">Status Kedudukan</th>
                                <th class="text-center">Penghasilan Sebelum</th>
                                <th class="text-center">Penghasilan Setelah</th>
                                <th class="text-center">Jumlah Keluarga</th>
                                <th class="text-center">Jenis Laporan</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Foto KTP</th>
                                <th class="text-center">Foto Kepala Keluarga</th>
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

    var kab = '00';
    var kec = '00';
    var kel = '00';
    var table2 = $('#datatable-slide').DataTable({
            "pageLength": 10,
            "processing": true,
            "language": {
                "processing": 'Memuat...'
            },
            "serverSide": true,
            "ajax": "/panel/data/aduan/json/"+kab+"/"+kec+"/"+kel,
            "columns": [
                { "data": "DT_RowIndex", "orderable": false, "searchable": false },
                { "data": "nik" },
                { "data": "nama" },
                { "data": "email" },
                { "data": "no_tlp" },
                { "data": "no_wa" },
                { "data": "alamat" },
                { "data": "kd_kab", "searchable": false },
                { "data": "kd_kec", "searchable": false },
                { "data": "kd_kel", "searchable": false },
                { "data": "rt" },
                { "data": "rw" },
                { "data": "pekerjaan" },
                { "data": "id_status_kedudukan", "searchable": false },
                { "data": "penghasilan_sebelum" },
                { "data": "penghasilan_setelah" },
                { "data": "jum_keluarga" },
                { "data": "id_jenis_laporan", "searchable": false },
                { "data": "id_kategori", "searchable": false },
                { "data": "id_jenis", "searchable": false },
                { "data": "foto_ktp", "searchable": false },
                { "data": "foto_kepalakeluarga", "searchable": false },
                { "data": "aksi", "orderable": false, "searchable": false },
            ],
            "scrollX": true,
            "columnDefs": [
                {"className": "text-center", "targets": [0,3]}
            ],
        });

    $("#kab").change(function () {
        var kab = $('#kab').val();
        var kec = '00';
        var kel = '00';
        url = "/panel/data/aduan/json/"+kab+"/"+kec+"/"+kel;
        table2.ajax.url(url)
        table2.ajax.reload();
        $("#kec").load('/kecamatan/' + kab);
      });

      $("#kec").change(function () {
        var kab = $('#kab').val();
        var kec = $('#kec').val();
        var kel = '00';
        url = "/panel/data/aduan/json/"+kab+"/"+kec+"/"+kel;
        table2.ajax.url(url)
        table2.ajax.reload();
        $("#kel").load('/kelurahan/' + kab + '/'+ kec);
      });

      $("#kel").change(function () {
        var kab = $('#kab').val();
        var kec = $('#kec').val();
        var kel = $('#kel').val();
        url = "/panel/data/aduan/json/"+kab+"/"+kec+"/"+kel;
        table2.ajax.url(url)
        table2.ajax.reload();
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
