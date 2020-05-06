@extends('panel.layouts.app')

@section('title')
    InfoGrafik
@endsection

@section('content')
<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li class="active">
                        <span>Infografik </span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Infografik
            </h2>
            <small>Daftar Infografik.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12" style="margin-bottom: -20px">
            <div class="hpanel @if (!Session::has('showCreate')) collapsed @endif">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <button class="btn btn-xs btn-info showhide">Tambah Infografik<i class="fa fa-chevron-up"></i></button>
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('panel.produk.insert') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group"><label class="col-sm-2 control-label">Gambar</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" class="form-control" required accept="*/pdf">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text"  name="judul" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Link IG</label>
                                <div class="col-sm-10">
                                    <input type="text"  name="link" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#loadModal">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade hmodal-info" id="editModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="{{ route('panel.produk.edit') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="color-line"></div>
                        <div class="modal-body">
                            <div class="form-group" style="display: none"><label class="col-sm-2 control-label">ID</label>
                                <div class="col-sm-10">
                                    <input type="text" id="id" name="id" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group" style="display: none"><label class="col-sm-2 control-label">File lama</label>
                                <div class="col-sm-10">
                                    <input type="text" id="gambar_lama" name="gambar_lama" class="form-control">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">File</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" id="judul" name="judul" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Link IG</label>
                                <div class="col-sm-10">
                                    <input type="text" id="link" name="link" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#loadModal" onclick="hide()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade hmodal-info" id="deleteModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('panel.produk.delete') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="text" style="display: none;" id="idhapus" name="idhapus">
                        <input type="text" style="display: none;" id="gambarhapus" name="gambarhapus">
                        <h5>Yakin Hapus ? <small><input style="background-color: #F7F9FA; border: none;" type="text" id="judulhapus" name="judulhapus"></small> </h5>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#loadModal">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade hmodal-info" id="loadModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('panel.produk.delete') }}" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="loader"></div>
                        <div style="margin-left: auto; margin-right: auto;"> <label>Loading...</label> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="produk" class="col-lg-12"></div>
    </div>
</div>

<div class="modal fade" id="showModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="color-line"></div>
            <div class="modal-body">
                <img id="gambarShow" src="" width="100%">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        load();
    });
</script>

<script>

    function butShow(gambar) {
        document.getElementById("gambarShow").setAttribute("src", "/assets_public/file/" + gambar);
    }

    function butEdit(id, judul, link) {

        document.getElementById("id").value = id;
        document.getElementById("judul").value = judul;
        document.getElementById("link").value = link;
    }

    function butDelete(id, judul, gambar) {

        document.getElementById("idhapus").value = id;
        document.getElementById("judulhapus").value = judul;
        document.getElementById("gambarhapus").value = gambar;
    }

    function hide(){
        $("#editModal").hide();
    }

    function load(){

        $.get("{{ route('panel.post2') }}", function (post2) {

                $("#load").show().fadeOut(1000);
                $('#produk').html(post2);
                $('#produkk').DataTable();

            });
    }

</script>

@endsection