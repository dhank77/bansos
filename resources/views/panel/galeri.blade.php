@extends('panel.layouts.app')

@section('title')
    Galeri
@endsection

@section('content')
<div class="normalheader transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <a class="small-header-action" href="">
                <div class="clip-header">
                    <i class="fa fa-arrow-up"></i>
                </div>
            </a>

            <div id="hbreadcrumb" class="pull-right m-t-lg">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="{{ route('panel.dashboard') }}">Dashboard</a></li>
                    <li class="active">
                        <span>Galeri</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                GALERI
            </h2>
            <small>Daftar galeri {{ $settings->namaOpd }}</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: -20px">
            <div class="hpanel @if (!Session::has('showCreate')) collapsed @endif">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <button class="btn btn-xs btn-info showhide">Tambah Galeri <i class="fa fa-chevron-up"></i></button>
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('panel.galeri.insert') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" id="title" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea id="desc" name="desc" class="form-control" style="resize: none;" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Gambar</label>
                            <div class="col-sm-10">
                                <input id="thefiles" type="file" name="img[]" accept=".jpg, .png, image/jpeg, image/png" style="height: 0px" multiple required>
                            </div>
                        </div>
                        <button class="btn btn-default pull-right" type="button" onclick="tambahGaleri()">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade hmodal-info" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="{{ route('panel.galeri.edit') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="color-line"></div>
                        <div class="modal-body">
                            <div class="form-group" style="display: none"><label class="col-sm-2 control-label">ID</label>
                                <div class="col-sm-10">
                                    <input type="text" id="idEdit" name="id" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" id="titleEdit" name="title" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea id="descEdiit" name="desc" class="form-control" style="resize: none;" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Gambar</label>
                                <div class="col-sm-10">
                                    <div class="row" id="imgForm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade hmodal-info" id="addImageModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="{{ route('panel.galeri.edit-add-image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="color-line"></div>
                        <div class="modal-body">
                            <div class="form-group" style="display: none">
                                <input type="text" id="idEditAddImage" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <h4>Tambah Gambar</h4>
                                <h5 id="titleAddImage"></h5>
                            </div>
                            <div class="form-group">
                                <input id="thefilesAddImage" type="file" name="imgEditAddImage[]" accept=".jpg, .png, image/jpeg, image/png" style="height: 0px" multiple required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" onclick="tambahImageGaleri()">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <table id="datatable-galeri" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">#</th>
                                <th class="text-center" width="15%">Gambar</th>
                                <th class="text-center">Deskripsi</th>
                                <th class="text-center" width="15%">Dibuat</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var csrf_token = document.querySelector('meta[name=csrf-token]').getAttribute('content');
    $("#editModal").on("hidden.bs.modal", function () {
        $('#imgForm').html('');
    });

    function tambahGaleri() {
        if ($('#title').val() !== '' && $('#title').val() !== null && $('#desc').val() !== '' && $('#desc').val() !== null) {
            var title = $('#title').val();
            var desc = $('#desc').val();
            $.ajax({
                url: "{{ route('panel.galeri.insert') }}?_token="+csrf_token,
                type: 'POST',
                data: {title, desc},
                success: function(msg) {
                    $('#thefiles').next().find('.ff_fileupload_actions button.ff_fileupload_start_upload').click(); 
                },
                error: function(msg) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Maaf, terjadi kesalahan pada sistem!',
                        footer: '<a href>Butuh bantuan ? Hubungi Admin</a>'
                    });
                }
            }); 
        } else {
            Swal.fire({
                type: 'error',
                title: 'Gagal!',
                text: 'Pastikan tidak ada form yang kosong!'
            });
        }
    }

    function tambahImageGaleri() {
        sessionStorage.setItem('idGaleri', $('#idEditAddImage').val());
        $('#thefilesAddImage').next().find('.ff_fileupload_actions button.ff_fileupload_start_upload').click(); 
    }

    function butEdit($id) {
        fetch('galeri/'+$id+'/jsonedit')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            $('#idEdit').val(data.id);
            $('#titleEdit').val(data.title);
            $('#descEdiit').val(data.desc);
            for (i = 0; i < data.img.length; ++i) {
                $('#imgForm').append('<div class="col-md-3">'+
                        '<div class="hpanel">' +
                            '<div class="panel-body text-center" style="padding: 0px">' +
                                '<input type="text" name="imgEdit[]" value="'+data.img[i].img+'" style="display: none">' +
                                '<img style="height: 100px; max-width: 100%" src="/assets_public/images/galeri/'+data.img[i].img+'">' +
                                '<br/>' +
                                '<span class="small" style="font-weight: bold"><a href="#" class="removeImage">HAPUS</a></span>' +
                            '</div>' +
                        '</div>' +
                    '</div>');
            }
        });
    }

    function butEditAddImage($id) {
        fetch('galeri/'+$id+'/jsonedit')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            $('#idEditAddImage').val(data.id);
            document.getElementById("titleAddImage").innerHTML = data.title;
        });
    }

    $('#imgForm').on('click', '.removeImage', function(e) {
        e.preventDefault();
        $(this).closest("div").remove();
    });
</script>
<script type="text/javascript">
    var table = $('#datatable-galeri').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
            "processing": 'Memuat...'
        },
        "serverSide": true,
        "ajax": "galeri/json",
        "columns": [
            { "data": "DT_RowIndex", "orderable": false, "searchable": false },
            { "data": "gambar", "orderable": false, "searchable": false },
            { "data": "desc" },
            { "data": "createdAt" },
            { "data": "aksi", "orderable": false, "searchable": false },
        ],
        "columnDefs": [
            {"className": "text-center", "targets": [0,1,3,4]}
        ],
    });
    
    $(document).ready(function() {
        $('#thefiles').FancyFileUpload({
            url: "{{ route('panel.galeri.insert-image') }}?_token="+csrf_token,
            uploadcompleted: function(e, data){
                if(data._response.textStatus=='success'){
                    $('#title').val(null);
                    $('#desc').val(null);
                    data.ff_info.RemoveFile();
                    table.ajax.reload();
                }
            }
        });

        $('#thefilesAddImage').FancyFileUpload({
            url: "{{ route('panel.galeri.edit-add-image') }}?_token="+csrf_token,
            params: {
                idGaleri: sessionStorage.getItem('idGaleri')
            },
            uploadcompleted: function(e, data){
                if(data._response.textStatus=='success'){

                }
            }
        });
    });
</script>
@endsection