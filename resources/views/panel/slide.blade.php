@extends('panel.layouts.app')

@section('title')
    Slide
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
                        <span>Slide</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                SLIDE
            </h2>
            <small>Slide halaman depan {{ $settings->namaOpd }}</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: -20px">
            <div class="hpanel @if (!Session::has('showCreate')) collapsed @endif">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <button class="btn btn-xs btn-info showhide">Tambah Slide <i class="fa fa-chevron-up"></i></button>
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('panel.slide.insert') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" name="img" class="form-control" accept="image/*" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea name="desc" class="form-control" required></textarea>
                            </div>
                        </div>
                        <button class="btn btn-default pull-right" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade hmodal-info" id="editModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="{{ route('panel.slide.edit') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="color-line"></div>
                        <div class="modal-body">
                            <div class="form-group" style="display: none"><label class="col-sm-2 control-label">ID</label>
                                <div class="col-sm-10">
                                    <input type="text" id="idEdit" name="id" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" name="img" class="form-control" accept="image/*">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" id="titleEdit" name="title" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea id="descEdiit" name="desc" class="form-control" required></textarea>
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
        <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <table id="datatable-slide" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">#</th>
                                <th class="text-center" width="20%">Gambar</th>
                                <th class="text-center">Deskripsi</th>
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
        fetch('slide/'+$id+'/jsonedit')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            $('#idEdit').val(data.id);
            $('#titleEdit').val(data.title);
            $('#descEdiit').val(data.desc);
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#datatable-slide').DataTable({
            "pageLength": 10,
            "processing": true,
            "language": {
                "processing": 'Memuat...'
            },
            "serverSide": true,
            "ajax": "slide/json",
            "columns": [
                { "data": "DT_RowIndex", "orderable": false, "searchable": false },
                { "data": "gambar", "orderable": false, "searchable": false },
                { "data": "desc" },
                { "data": "aksi", "orderable": false, "searchable": false },
            ],
            "columnDefs": [
                {"className": "text-center", "targets": [0,1,3]}
            ],
        });
    });
</script>
@endsection