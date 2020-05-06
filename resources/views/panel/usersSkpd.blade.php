@extends('panel.layouts.app')

@section('title')
    Users
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
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
                        <span>Users</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Users
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
                        <button class="btn btn-xs btn-info showhide">Tambah User <i class="fa fa-chevron-up"></i></button>
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <form method="POST" id="FormInsert" class="form-horizontal">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control"  required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control"  required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class="form-control" required>
                                <small>*Password default sama dengan username</small>
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
                            <div class="form-group"><label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" id="UsernameEdit" name="Username" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" id="EmailEdit" name="Email" class="form-control" required>
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
                                <th class="text-center" width="1%">#</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Last Login</th>
                                <th class="text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function butEdit($id) {
        fetch('users/'+$id+'/jsonedit')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            $('#idEdit').val(data.id);
            $('#nameEdit').val(data.name);
            $('#emailEdit').val(data.email);
            $('#usernameEdit').val(data.username);
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#LoadInstansi").load('/loadinstansi');
        
        var table = $('#datatable-slide').DataTable({
            "pageLength": 10,
            "processing": true,
            "language": {
                "processing": 'Memuat...'
            },
            "serverSide": true,
            "ajax": "{{ route('panel.usersSkpd.json') }}",
            "columns": [
                { "data": "DT_RowIndex", "orderable": false, "searchable": false },
                { "data": "name" },
                { "data": "username" },
                { "data": "display_name", "searchable": false },
                { "data": "created_at" },
                { "data": "aksi", "orderable": false, "searchable": false },
            ],
        });

        $('.select2').select2();
    });

function AjaxSimpanData() { 
var data = $('#FormInsert').serialize();
    $.ajax({
        type: 'POST',
        url: '/panel/masters/users/skpd/insert',
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

function ResetPass(id) {
    swal.fire({
                title: 'Apakah anda yakin ?',
                html: "Reset Password",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    AjaxResetPass(id);
                }
            });
}

function AjaxHapusData(id) { 
    var data = id;
        $.ajax({
            type: 'GET',
            url: '/panel/masters/users/skpd/delete/'+id,
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

function AjaxResetPass(id) { 
    var data = id;
        $.ajax({
            type: 'GET',
            url: '/panel/masters/users/skpd/reset/'+id,
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
            url: '/panel/masters/users/skpd/edit',
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

function EditData(id, username, email) { 
    document.getElementById("idEdit").value= id;
    document.getElementById("UsernameEdit").value= username;
    document.getElementById("EmailEdit").value= email;
}

</script>
@endsection