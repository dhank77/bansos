@extends('panel.layouts.app')

@section('title')
    Laporan Hoax
@endsection

@section('content')
<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li class="active">
                        <span>Laporan Hoax </span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Laporan Hoax
            </h2>
            <small>Laporan Hoax dari masyarakat.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="row">
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
        <div class="col-lg-12">
                        <div class="hpanel">
                <div  class="panel-body">
                    <table id="produkk" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">No</th>
                                <th class="text-center" width="30%">Email</th>
                                <th class="text-center" width="30%">Link</th>
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($post as $xpost)
                            @php $no++; @endphp
                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center" >{{ $xpost->email }}</td>
                                <td class="text-center" >{{ $xpost->link }}</td>
                                @if ( $xpost->status == 0)
                                <td class="text-center" >Belum Diproses</td>
                                @else
                                <td class="text-center" >Sudah Diproses</td>
                                @endif
                                <td class="text-center" >

                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#showModal" onclick="butEdit('{{ $xpost->id }}','{{ $xpost->email }}','{{ $xpost->link }}','{{ $xpost->desc }}','{{ $xpost->createAt }}','{{ $xpost->lampiran }}')"><i class="fa fa-eye"></i></button> |

                                    @if ( $xpost->status == 0)
                                    <button class="btn btn-sm btn-danger"  onclick="alertProses('{{ $xpost->id }}')"><i class="fa fa-check"></i></button> 
                                    @else
                                    <button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button> 
                                    @endif

                                    <!-- <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#loadModal" onclick="butLoad()"><i class="fa fa-trash"></i></button> -->

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

<div class="modal fade" id="showModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="color-line"></div>
            <div class="modal-body">
                <small id="tanggalshow"></small>
                <p><strong id="emailshow"></strong></p>

                <p id="linkshow"></p>

                <small>Keterangan :</small>
                <p id="keterangan"></p>

                <a id="links" href='' target="_blank"><p id="lampiranshow"></p></a><br>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
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
    function butEdit(id, email, link, desc, tgl, lamp) {

        document.getElementById("id").value = id;
        document.getElementById("emailshow").innerHTML = "Dari Email : " + email;
        document.getElementById("tanggalshow").innerHTML = "Pada tanggal : " + tgl;
        document.getElementById("linkshow").innerHTML = "Link : " + link;
        document.getElementById("keterangan").innerHTML = desc;
        document.getElementById("lampiranshow").innerHTML = "Lampiran : " + lamp;
        document.getElementById("links").setAttribute("href", "/assets_public/file/" + lamp);
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