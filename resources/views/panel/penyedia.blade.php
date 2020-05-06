@extends('panel.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">


<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li>
                        <span>Forms</span>
                    </li>
                    <li class="active">
                        <span>Penyedia</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Penyedia
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
                <form method="POST" id="FormPenyedia" class="form-horizontal">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Paket</label>
                            <div class="col-sm-10">
                                <input type="text" name="NamaPaket" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">KLDP</label>
                            <div class="col-sm-10">
                                <input type="text" name="KLDP" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Satuan Kerja</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="SatKer" >
                                    <option value="">- Pilih -</option>
                                    <option value="1">DISKOMINFO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Tahun Anggaran</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="TahunAnggaran" >
                                    <option value="">- Pilih -</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Lokasi Pekerjaan</label>
                            <div class="col-sm-2">
                                <select class="form-control select2" id="propinsi" >
                                    <option value="">- Pilih Provinsi -</option>
                                    @foreach ($provinsi as $xprovinsi)
                                    <option value="{{ $xprovinsi->kode_prop }}" placeholder="{{ $xprovinsi->nama_propinsi }}">{{ $xprovinsi->nama_propinsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control select2" id="kab" >
                                    <option value="">- Pilih Kab / Kota -</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" id="detail_lokasi" placeholder="Detail lokasi" class="form-control" >
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="ButTambahLokasi">Tambah</button>
                            </div>
                        </div>

                        <div id="DivTambahLokasi"></div>


                        <div class="form-group"><label class="col-sm-2 control-label">Volume Pekerjaan</label>
                            <div class="col-sm-10">
                                <input type="text" name="volume_pekerjaan" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Uraian Pekerjaan</label>
                            <div class="col-sm-10">
                                <input type="text" name="uraian_pekerjaan" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Spesifikasi Pekerjaan</label>
                            <div class="col-sm-10">
                                <input type="text" name="spesifikasi_pekerjaan" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Produk Dalam Negeri</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label><input type="radio" value="1" name="produk_dalam_negeri"> Ya</label>
                                    <label> <input type="radio" value="0" name="produk_dalam_negeri"> Tidak </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Usaha Kecil</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <label> <input type="radio" value="1" name="usaha_kecil"> Ya</label>
                                    <label> <input type="radio" value="0" name="usaha_kecil"> Tidak </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Pra DIPA / DPA</label>
                            <div class="col-sm-10">
                                <div class="checkbox"><label> <input type="checkbox" id="pradipa"> </label></div>
                            </div>
                        </div>
                        <div class="form-group" id="kuappas" style="display: none;"><label class="col-sm-2 control-label">No. KUAPPAS</label>
                            <div class="col-sm-10">
                                <input type="text" name="kuappas" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <small>&nbsp</small>
                            <label class="col-sm-2 control-label">Sumber Dana</label>
                            <div class="col-sm-1">
                                <small>Tahun</small>
                                <select class="form-control select2" id="TahunSumberDana" >
                                    <option value="">- Pilih -</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <small>Jenis</small>
                                <select class="form-control select2" id="JenisSumberDana" >
                                    <option value="">- Pilih -</option>
                                    <option value="APBD">APBD</option>
                                    <option value="APBDP">APBDP</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <small>MAK</small>
                                <input type="text" id="MakSumberDana" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <small>Komponen / Kegiatan</small>
                                <select class="form-control select2" id="KomponenSumberDana" >
                                    <option value="">- Pilih -</option>
                                    <option value="Komponen">Komponen</option>
                                    <option value="Kegiatan">Kegiatan</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <small>Pagu</small>
                                <input type="text" id="PaguSumberDana" class="form-control">
                            </div>
                            <small>&nbsp</small>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="ButTambahSumberDana">Tambah</button>
                            </div>
                        </div>

                        <div id="DivTambahSumberDana"></div>



                        <div class="form-group"><label class="col-sm-2 control-label">No. Izin Tahun Jamak</label>
                            <div class="col-sm-3">
                                <input type="text" name="izin_tahun_jamak" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jenis Pengadaan</label>
                            <div class="col-sm-3">
                                <small>Daftar Jenis Pengadaan</small>
                                <select class="form-control select2" id="DaftarJenisPengadaan" >
                                    <option value="">- Pilih -</option>
                                    <option value="Barang">Barang</option>
                                    <option value="Jasa Konsultasi">Jasa Konsultasi</option>
                                    <option value="Jasa Lainnya">Jasa Lainnya</option>
                                    <option value="ekerjaan Konstruksi">Pekerjaan Konstruksi</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <small>Jumlah Pagu</small>
                                <input type="text" id="PaguJenisPengadaan" class="form-control">
                            </div>
                            <small>&nbsp</small>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-primary" id="ButTambahJenisPengadaan">Tambah</button>
                            </div>
                        </div>

                        <div id="DivJenisPengadaan"></div>




                        <div class="form-group"><label class="col-sm-2 control-label">Pengadaan Dikecualikan</label>
                            <div class="col-sm-10">
                                <div class="checkbox"><label> <input type="checkbox" id="PengadaanDikecualikan"> </label></div>
                            </div>
                        </div>
                        <div class="form-group" id="RencanaMetodePemilihan" style="display: none;"><label class="col-sm-2 control-label">Rencana Metode Pemilihan</label>
                            <div class="col-sm-3">
                                <select class="form-control select2" name="" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                    <option value="">ePurchasing</option>
                                    <option value="">Kontes</option>
                                    <option value="">Pengadaan Langsung</option>
                                    <option value="">Penunjukan Langsung</option>
                                    <option value="">Sayembara</option>
                                    <option value="">Seleksi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="AlasanPbjp" style="display: none;"><label class="col-sm-2 control-label">Alasan Menggunakan Aturan PBJP</label>
                            <div class="col-sm-3">
                                <input type="text" name="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Pemanfaatan Barang /Jasa</label>
                            <div class="col-sm-2">
                                <small>Awal</small>
                                <div class='input-group date' id='datetimepicker9'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <small>Akhir</small>
                                <div class='input-group date' id='datetimepicker9'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Pelaksanaan Kontrak</label>
                            <div class="col-sm-2">
                                <small>Awal</small>
                                <div class='input-group date' id='datetimepicker9'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <small>Akhir</small>
                                <div class='input-group date' id='datetimepicker9'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Pemilihan Penyedia</label>
                            <div class="col-sm-2">
                                <small>Awal</small>
                                <div class='input-group date' id='datetimepicker9'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <small>Akhir</small>
                                <div class='input-group date' id='datetimepicker9'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar">
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                            
                        
                        <button class="btn btn-default pull-right" type="button" onclick="SimpanDataPenyedia();" >Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade hmodal-info" id="editModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="POST" action="{{ route('panel.users.edit') }}" class="form-horizontal" enctype="multipart/form-data">
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
                                    <input type="text" id="nameEdit" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" id="emailEdit" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" id="usernameEdit" name="username" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="role_idEdit" name="role_id" required>
                                        <option value="">- Pilih -</option>
                                    </select>
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
        <!-- <div class="col-lg-12">
            <div class="hpanel">
                <div class="panel-body">
                    <table id="datatable-slide" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">#</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Dibuat</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> -->
    </div>
</div>

        

        
        


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    $('#pradipa').on('change', function(){ 
        if(this.checked) {
                $("#kuappas").show();
            } else {
                $("#kuappas").hide();
            }
    });

    $('#PengadaanDikecualikan').on('change', function(){ 
        if(this.checked) {
                $("#RencanaMetodePemilihan").show();
                $("#AlasanPbjp").show();
            } else {
                $("#RencanaMetodePemilihan").hide();
                $("#AlasanPbjp").hide();
            }
    });

    $('#propinsi').on('change', function(){ 
        var id = $("#propinsi").val();
        $("#kab").load('/loadkab/'+id);
    });

    $('#datetimepicker9').datetimepicker({
                viewMode: 'years',
                format: 'MM/YYYY'
            });

    $('.select2').select2();

    // $('#tabellokasi').DataTable({
    //     "bPaginate": false,
    //     "bFilter": false,
    //     "bInfo": false,
    // });

    var JumlahLokasi = 1;
    $("#ButTambahLokasi").click(function(){
        var Provinsi    = $('#propinsi').val();
        var Kabupaten   = $('#kab').val();
        var Detail      = $('#detail_lokasi').val();
        var TextProvinsi   = $('#propinsi option:selected').text();
        var TextKabupaten  = $('#kab option:selected').text();
        $("#DivTambahLokasi").append('<div class="form-group" id="DivLokasiNew-'+JumlahLokasi+'"><label class="col-sm-2 control-label"></label>'+
                                     '<div class="col-sm-2"><input name="provinsi[]" type="text" class="form-control" style="display: none;" value="'+Provinsi+'"><input type="text" class="form-control" value="'+TextProvinsi+'"></div>'+
                                     '<div class="col-sm-3"><input name="kab[]" type="text" class="form-control" style="display: none;" value="'+Kabupaten+'"><input type="text" class="form-control" value="'+TextKabupaten+'"></div>'+
                                     '<div class="col-sm-4"><input name="detail[]" type="text" class="form-control" value="'+Detail+'"> </div>'+
                                     '<div class="col-sm-1"><button type="button" class="btn btn-danger" onclick="HapusLokasi('+JumlahLokasi+');">X</button></div></div>');
        JumlahLokasi++;
    });


    var JumlahSumberDana = 1;
    $("#ButTambahSumberDana").click(function(){
        var TahunSumberDana      = $('#TahunSumberDana').val();
        var JenisSumberDana      = $('#JenisSumberDana').val();
        var MakSumberDana        = $('#MakSumberDana').val();
        var KomponenSumberDana   = $('#KomponenSumberDana').val();
        var PaguSumberDana       = $('#PaguSumberDana').val();
        $("#DivTambahSumberDana").append('<div class="form-group" id="DivSumberDanaNew-'+JumlahSumberDana+'"><label class="col-sm-2 control-label"></label>'+
                                     '<div class="col-sm-1"><input name="tahunsumberdana[]" type="text" class="form-control" value="'+TahunSumberDana+'"></div>'+
                                     '<div class="col-sm-1"><input name="jenissumberdana[]" type="text" class="form-control" value="'+JenisSumberDana+'"></div>'+
                                     '<div class="col-sm-2"><input name="maksumberdana[]" type="text" class="form-control" value="'+MakSumberDana+'"></div>'+
                                     '<div class="col-sm-2"><input name="komponensumberdana[]" type="text" class="form-control" value="'+KomponenSumberDana+'"></div>'+
                                     '<div class="col-sm-3"><input name="pagusumberdana[]" type="text" class="form-control" value="'+PaguSumberDana+'"></div>'+
                                     '<div class="col-sm-1"><button type="button" class="btn btn-danger" onclick="HapusSumberDana('+JumlahSumberDana+');">X</button></div></div>');
        JumlahSumberDana++;
    });


    var JumlahJenisPengadaan = 1;
    $("#ButTambahJenisPengadaan").click(function(){
        var DaftarJenisPengadaan   = $('#DaftarJenisPengadaan').val();
        var PaguJenisPengadaan     = $('#PaguJenisPengadaan').val();
        $("#DivJenisPengadaan").append('<div class="form-group" id="DivJenisPengadaanNew-'+JumlahJenisPengadaan+'"><label class="col-sm-2 control-label"></label>'+
                                     '<div class="col-sm-3"><input name="daftarjenispengadaan[]" type="text" class="form-control" value="'+DaftarJenisPengadaan+'"></div>'+
                                     '<div class="col-sm-6"><input name="pagujenispengadaan[]" type="text" class="form-control" value="'+PaguJenisPengadaan+'"></div>'+
                                     '<div class="col-sm-1"><button type="button" class="btn btn-danger" onclick="HapusJenisPengadaan('+JumlahJenisPengadaan+');">X</button></div></div>');
        JumlahJenisPengadaan++;
    });

});

function HapusLokasi(id) {
    document.getElementById("DivLokasiNew-"+id).remove();
}

function HapusSumberDana(id) {
    document.getElementById("DivSumberDanaNew-"+id).remove();
}

function HapusJenisPengadaan(id) {
    document.getElementById("DivJenisPengadaanNew-"+id).remove();
}

function SimpanDataPenyedia() {
    swal.fire({
                title: 'Apakah anda yakin ?',
                html: "Simpan data",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.value) {
                    AjaxSimpanDataPenyedia();
                }
            });
}

function AjaxSimpanDataPenyedia() { 
    var data = $('#FormPenyedia').serialize();
        $.ajax({
            type: 'POST',
            url: '/panel/rup/penyedia/insert',
            data: data,
            success: function() {
                alertBerhasilTambahDataPenyedia();
            },
            error: function() {
                alertGagalTambahDataPenyedia();
            }
        });
}

// var jmllokasi = 2;
// function tambahlokasi() {
//         var provinsi = $('#propinsi').val();
//         var txtprovinsi = $('#propinsi option:selected').text();
//         var kab = $('#kab').val();
//         var txtkab = $('#kab option:selected').text();
//         var detail = $('#detail_lokasi').val();
//         var tabel = $('#tabellokasi').DataTable();
//         tabel.row.add([
//             '<div id="raw'+jmllokasi+'"><input name="provinsi[]" type="text" value="' + provinsi + '" style="border: 0; background:transparent; display: none;" readonly> <input type="text" value="' + txtprovinsi + '" style="border: 0; background:transparent; width: 100%;" readonly></div>',
//             '<td><input name="kab[]" type="text" value="' + kab + '" style="border: 0; background:transparent; display: none;" readonly> <input type="text" value="' + txtkab + '" style="border: 0; background:transparent; width: 100%;" readonly></td>',
//             '<td><input name="detail[]" type="text" value="' + detail + '" style="border: 0; background:transparent;" readonly></td>',
//         ]).draw();
//         jmllokasi++;
//         $('#pegawai').val("").trigger('change');
// }
</script>
@endsection