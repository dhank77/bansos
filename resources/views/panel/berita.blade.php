@extends('panel.layouts.app')

@section('title')
    Post Berita
@endsection

@section('content')
<style type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></style>


<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li class="active">
                        <span>Verifikasi Hoax </span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Verifikasi Hoax
            </h2>
            <small>Daftar Verifikasi Hoax.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: -20px">
            <div class="hpanel @if (!Session::has('showCreate')) collapsed @endif">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <button class="btn btn-xs btn-info showhide">Tambah Berita<i class="fa fa-chevron-up"></i></button>
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('panel.berita.insert') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group"><label class="col-sm-2 control-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" class="form-control" required accept="Image/*">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text"  name="judul" placeholder="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea id="editor" name="desc"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button onclick="butloadingtambah()" type="submit" class="btn btn-primary">
                                <span id="tambah">Tambah</span>
                                <i id="spinertambah" class="fa fa-spinner fa-spin" style="font-size:18px; display: none;"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade hmodal-info" id="editModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="{{ route('panel.berita.edit') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="color-line"></div>
                        <div class="modal-body">
                            <input type="text" style="display: none;" id="idEdit" name="id">

                            <div class="form-group"><label class="col-sm-2 control-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" id="file" name="file" class="form-control" accept="Image/*">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" id="judulEdit"  name="judul" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea id="descEdit" name="desc"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button onclick="butloadingupdate()" type="submit" class="btn btn-primary">
                                <span id="update">Simpan</span>
                                <i id="spiner" class="fa fa-spinner fa-spin" style="font-size:18px; display: none;"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="hpanel">
                <div  class="panel-body">
                    <table id="datatable-slide" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">No</th>
                                <th class="text-center" width="2%">Gambar</th>
                                <th class="text-center" width="50%">#</th>
                                <th class="text-center" width="1%">Tanggal</th>
                                <th class="text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($berita as $xberita)
                            @php $no++; @endphp
                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center" > <img src="/assets_public/images/berita/{{ $xberita->img }}" height="80px"></td>
                                <td class="text-left" > <strong>{{ $xberita->judul }}</strong> <br> <p>{{ str_limit($xberita->desc, 150) }}</p> </td>
                                <td class="text-center" >{{ \Carbon\Carbon::parse($xberita->createdAt)->format('d M Y') }}</td>
                                <td class="text-center" >

                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit('{{ $xberita->id }}')"><i class="fa fa-pencil"></i></button> | 

                                    <button class="btn btn-sm btn-danger" onclick="alertDeleteBeritaHoax('{{ $xberita->id }}','{{ $xberita->judul }}')">
                                        <i class="fa fa-trash"></i></button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-slide').DataTable();
        load();
    });
</script>
<script type="text/javascript">
        function butloadingupdate() {
          var x = document.getElementById("spiner");
          var y = document.getElementById("update");
          if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
          } else {
            x.style.display = "none";
          }
        }

        function butloadingtambah() {
          var x = document.getElementById("spinertambah");
          var y = document.getElementById("tambah");
          if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
          } else {
            x.style.display = "none";
          }
        }
</script>
<script>
    function butEdit($id) {
        fetch('berita/'+$id+'/jsonedit')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            $('#idEdit').val(data.id);
            $('#judulEdit').val(data.judul);
            tinymce.get('descEdit').setContent(data.desc);
            //tinyMCE.activeEditor.setContent(data.desc);
        });
    }

    // function butEdit(id, judul, tgl, desc) {
    //     document.getElementById("idEdit").value = id;
    //     document.getElementById("judulEdit").value = judul;
    //     document.getElementById("tglEdit").value = tgl;
    //     tinymce.get('descEdit').setContent(desc);
    // }

    function butDelete(id, nama, file) {
        document.getElementById("idhapus").value = id;
        document.getElementById("namahapus").value = nama;
        document.getElementById("filehapus").value = file;
    }

    function load(){
        $.get("{{ route('panel.berita2') }}", function (berita2) {
                $("#load").show().fadeOut(1000);
                $('#berita').html(berita2);
                $('#beritaa').DataTable();
            });
    }

</script>

<!-- <script type="text/javascript">
    $(document).ready(function() {
        var table = $('#datatable-slide').DataTable({
            "pageLength": 10,
            "processing": true,
            "language": {
                "processing": 'Memuat...'
            },
            "serverSide": true,
            "ajax": "{{ route('panel.berita.json') }}",
            "columns": [
                { "data": "DT_RowIndex", "orderable": false, "searchable": false },
                { "data": "gambar", "searchable": false },
                { "data": "desc" },
                { "data": "createdAt" },
                { "data": "aksi", "orderable": false, "searchable": false },
            ],
            "columnDefs": [
                {"className": "text-center", "targets": [0,1,3,4]}
            ],
        });
    });
</script> -->

@endsection