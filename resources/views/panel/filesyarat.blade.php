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
                        <span>Persyaratan</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Persyaratan
            </h2>
            <small>Examples of various form controls.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: -20px">
            <div class="hpanel">
                <div class="panel-body">
                    <form method="POST" id="FormInsert" action="/panel/persyaratan/insert" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-1 control-label">File</label>
                            <div class="col-sm-9">
                                <input type="file" name="nama" class="form-control" required>
                            </div>
                            <div class="col-sm-2">
                            <button class="btn btn-default pull-right" type="submit">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div >
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});

function AjaxSimpanData() { 
    var data = $('#FormInsert').serialize();
        $.ajax({
            type: 'POST',
            url: '/panel/master/kodefikasi/insert',
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
            url: '/panel/master/kodefikasi/edit',
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
            url: '/panel/master/kodefikasi/delete/'+id,
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
