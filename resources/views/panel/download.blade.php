@extends('panel.layouts.app')

@section('title')
    Post
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
                        <span>Informasi Publik</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Informasi Publik
            </h2>
            <small>Daftar Informasi Publik {{ $settings->namaOpd }}</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: -20px">
            <div class="hpanel @if (!Session::has('showCreate')) collapsed @endif">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <button class="btn btn-xs btn-info showhide">Tambah Informasi Publik<i class="fa fa-chevron-up"></i></button>
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('panel.download.insert') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Judul</label>
                            <div class="col-sm-10">
                                <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                                @if ($errors->has('judul'))
                                    <span class="help-block small">{{ $errors->first('judul') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                          <label class="control-label text-right col-md-2">File</label>
                          <div class="col-md-3">
                            <input type="file" id="input-file-disable-remove" class="dropify" name="file" data-show-remove="false" data-height="90" data-max-file-size="20M" data-allowed-file-extensions="pdf" accept="application/pdf" required>
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
                    <form method="POST" action="{{ route('panel.download.edit') }}" class="form-horizontal" enctype="multipart/form-data">
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
                                <input type="text" id="titleEdit" name="judul" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                          <label class="control-label text-right col-md-2">File</label>
                          <div class="col-sm-10">
                            <input type="file" id="file" class="dropify" name="file" data-show-remove="false" data-height="90" data-max-file-size="20M" data-allowed-file-extensions="pdf" accept="application/pdf">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="control-label text-right col-md-2"></label>
                          <div class="col-sm-10">
                            <input type="text" id="fileEdit" name="#" class="form-control" disabled>
                          </div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
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
                                <th class="text-center" width="40%">Judul</th>
                                <th class="text-center" width="10%">File</th>
                                <th class="text-center" width="10%">Dibuat </th>
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
        fetch('download/'+$id+'/jsonedit')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            $('#idEdit').val(data.id);
            $('#titleEdit').val(data.title);
            $('#fileEdit').val(data.file);
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
            "ajax": "{{ route('panel.download.json') }}",
            "columns": [
                { "data": "DT_RowIndex", "orderable": false, "searchable": false },
                { "data": "title" },
                { "data": "file" },
                { "data": "created_at" },
                { "data": "aksi", "orderable": false, "searchable": false },
            ],
            "columnDefs": [
                {"className": "text-center", "targets": [0,2,3,4]}
            ],
        });
    });
</script>
@endsection