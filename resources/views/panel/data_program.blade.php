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
                    <li class="active">
                        <span>Rincian Kegiatan</span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Rincian Kegiatan
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
                        <button class="btn btn-sm btn-info showhide">Tambah<i class="fa fa-chevron-up"></i></button>
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <form method="POST" id="FormInsert" class="form-horizontal">
                        @csrf
                        <div class="form-group"><label class="col-sm-2 control-label">Jenis DAK</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="JenisDak" name="JenisDak" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="DivSubReguler" style="display: none;"><label class="col-sm-2 control-label">Sub Reguler</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="SubReguler" name="SubReguler" style="width: 100%;" >
                                    <option value="0">- Pilih -</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="DivSubRegulerII" style="display: none;"><label class="col-sm-2 control-label">Sub Reguler II</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="SubRegulerII" name="SubRegulerII" style="width: 100%;" >
                                    <option value="0">- Pilih -</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Triwulan</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="Triwulan" name="Triwulan" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                    <option value="1">I</option>
                                    <option value="2">II</option>
                                    <option value="3">III</option>
                                    <option value="4">IV</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Bidang</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="Bidang" name="Bidang" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Sub Bidang</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="SubBidang" name="SubBidang" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Program</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="Program" name="Program" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nama Kegiatan</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="NamaKegiatan" name="NamaKegiatan" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Rinci Kegiatan</label>
                            <div class="col-sm-10">
                                <input type="text" name="RinciKegiatan" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Tahun</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="Tahun" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>

                        <br><hr>

                        <div class="form-group"><label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <h5 class="text-info">Perencanaan Kegiatan</h5>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Volume</label>
                            <div class="col-sm-10">
                                <input type="text" name="Volume" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Satuan</label>
                            <div class="col-sm-10">
                                <input type="text" name="Satuan" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Jumlah P. Manfaat</label>
                            <div class="col-sm-10">
                                <input type="text" name="JumlahPManfaat" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Pagu DAK Fisik</label>
                            <div class="col-sm-10">
                                <input type="text" name="PaguDakFisik" class="form-control" required>
                                <small>(Rp Dlm. Ribuan)</small>
                            </div>
                        </div>

                        <br><hr>

                        <div class="form-group"><label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <h5 class="text-warning">Mekanisme Pelaksanaan</h5>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Swakelola Vol</label>
                            <div class="col-sm-10">
                                <input type="text" name="VolumeSwakelola" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nilai Swakelola</label>
                            <div class="col-sm-10">
                                <input type="text" name="VolumeSwakelolaRP" class="form-control" required>
                                <small>(Rp Dlm. Ribuan)</small>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Kontraktual Vol</label>
                            <div class="col-sm-10">
                                <input type="text" name="VolumeKontraktual" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Nilai Kontraktual</label>
                            <div class="col-sm-10">
                                <input type="text" name="VolumeKontraktualRP" class="form-control" required>
                                <small>(Rp Dlm. Ribuan)</small>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Metode Pembayaran</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="MetodePembayaran" name="MetodePembayaran" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                        </div>

                        <br><hr>

                        <div class="form-group"><label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <h5 class="text-success">Realisasi</h5>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Keuangan</label>
                            <div class="col-sm-10">
                                <input type="text" name="Keuangan" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Keuangan (%)</label>
                            <div class="col-sm-10">
                                <input type="text" name="KeuanganPersen" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Fisik Vol.</label>
                            <div class="col-sm-10">
                                <input type="text" name="FisikVol" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Fisik (%)</label>
                            <div class="col-sm-10">
                                <input type="text" name="FisikPersen" id="FisikPersen" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Kodefikasi Masalah</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="Kodefikasi" name="Kodefikasi" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                </select>
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
                            <div class="form-group"><label class="col-sm-2 control-label">Jenis DAK</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="JenisDakEdit" name="JenisDak"  style="width: 100%;" >
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="DivSubRegulerEdit" style="display: none;"><label class="col-sm-2 control-label">Sub Reguler</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="SubRegulerEdit" name="SubReguler" style="width: 100%;" >
                                        <option value="0">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="DivSubRegulerIIEdit" style="display: none;"><label class="col-sm-2 control-label">Sub Reguler II</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="SubRegulerIIEdit" name="SubRegulerII" style="width: 100%;" >
                                        <option value="0">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Triwulan</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="TriwulanEdit" name="Triwulan" style="width: 100%;" >
                                        <option value="">- Pilih -</option>
                                        <option value="1">I</option>
                                        <option value="2">II</option>
                                        <option value="3">III</option>
                                        <option value="4">IV</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Bidang</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="BidangEdit" name="Bidang" style="width: 100%;" >
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Sub Bidang</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="SubBidangEdit" name="SubBidang" style="width: 100%;" >
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Program</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="ProgramEdit" name="Program" onchange="GantiKegiatan();"  style="width: 100%;" >
                                        <option value="">- Pilih -</option>
                                        <option value="1">Satu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Nama Kegiatan</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="NamaKegiatanEdit" name="NamaKegiatan" style="width: 100%;" >
                                    </select>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Rinci Kegiatan</label>
                                <div class="col-sm-10">
                                    <input type="text" id="RinciKegiatanEdit" name="RinciKegiatan" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Tahun</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="Tahun" id="TahunEdit" style="width: 100%;" >
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>
                                </div>
                            </div>
                            
                            <br><hr>

                            <div class="form-group"><label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <h5 class="text-info">Perencanaan Kegiatan</h5>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Volume</label>
                                <div class="col-sm-10">
                                    <input type="text" name="Volume" id="VolumeEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Satuan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="Satuan" id="SatuanEdit"class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Jumlah P. Manfaat</label>
                                <div class="col-sm-10">
                                    <input type="text" name="JumlahPManfaat" id="JumlahPManfaatEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Pagu DAK Fisik</label>
                                <div class="col-sm-10">
                                    <input type="text" name="PaguDakFisik" id="PaguDakFisikEdit" class="form-control" required>
                                    <small>(Rp Dlm. Ribuan)</small>
                                </div>
                            </div>

                            <br><hr>

                            <div class="form-group"><label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <h5 class="text-warning">Mekanisme Pelaksanaan</h5>
                                </div>
                            </div>

                            <div class="form-group"><label class="col-sm-2 control-label">Swakelola Vol</label>
                                <div class="col-sm-10">
                                    <input type="text" name="VolumeSwakelola" id="VolumeSwakelolaEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Nilai Swakelola</label>
                                <div class="col-sm-10">
                                    <input type="text" name="VolumeSwakelolaRP" id="VolumeSwakelolaRPEdit" class="form-control" required>
                                    <small>(Rp Dlm. Ribuan)</small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Kontraktual Vol</label>
                                <div class="col-sm-10">
                                    <input type="text" name="VolumeKontraktual" id="VolumeKontraktualEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Nilai Kontraktual</label>
                                <div class="col-sm-10">
                                    <input type="text" name="VolumeKontraktualRP" id="VolumeKontraktualRPEdit" class="form-control" required>
                                    <small>(Rp Dlm. Ribuan)</small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Metode Pembayaran</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="MetodePembayaranEdit" name="MetodePembayaran" style="width: 100%;" >
                                        <option value="">- Pilih -</option>
                                    </select>
                                </div>
                            </div>
                            
                            <br><hr>

                            <div class="form-group"><label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <h5 class="text-success">Realisasi</h5>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Keuangan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="Keuangan" id="KeuanganEdit" class="form-control" required>
                                    <small>(Rp Dlm. Ribuan)</small>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Keuangan (%)</label>
                                <div class="col-sm-10">
                                    <input type="text" name="KeuanganPersen" id="KeuanganPersenEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Fisik Vol.</label>
                                <div class="col-sm-10">
                                    <input type="text" name="FisikVol" id="FisikVolEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Fisik (%)</label>
                                <div class="col-sm-10">
                                    <input type="text" name="FisikPersen" id="FisikPersenEdit" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group"><label class="col-sm-2 control-label">Kodefikasi Masalah</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" id="KodefikasiEdit" name="Kodefikasi" style="width: 100%;" >
                                        <option value="">- Pilih -</option>
                                    </select>
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
                            <tr bgcolor='#F8F9F9'>
                                <th class="text-center" width="1%">No</th>
                                <th class="text-center" >Jenis Dak</th>
                                <th class="text-center" >Bidang</th>
                                <th class="text-center" >Sub Bidang</th>
                                <th class="text-center" >Program</th>
                                <th class="text-center" >Kegiatan</th>
                                <th class="text-center" >Rinci Kegiatan</th>
                                <th class="text-center">Volume</th>
                                <th class="text-center">Satuan</th>
                                <th class="text-center">Jumlah P Manfaat</th>
                                <th class="text-center">Pagu Dak Fisik</th>
                                <th class="text-center">Swakelola Volume</th>
                                <th class="text-center">Swakelola Nilai</th>
                                <th class="text-center">Kontraktual Volume</th>
                                <th class="text-center">Kontraktual Nilai</th>
                                <th class="text-center">Metode Pembayaran</th>
                                <th class="text-center">Keuangan</th>
                                <th class="text-center">Keuangan (%)</th>
                                <th class="text-center">Fisik Vol</th>
                                <th class="text-center">Fisik %</th>
                                <th class="text-center">Kodefikasi</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center" width="8%">Aksi</th>
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
    $("#Kodefikasi").load('/kodefikasi/load');
    $("#MetodePembayaran").load('/metodepembayaran/load');
    $("#MetodePembayaranEdit").load('/metodepembayaran/load');
    $("#JenisDak").load('/jenisdak/load');
    $("#Program").load('/program/load');
    $("#Bidang").load('/load/data/ms_bidang');

    $("#KodefikasiEdit").load('/kodefikasi/load');
    $("#ProgramEdit").load('/program/load');
    $("#JenisDakEdit").load('/jenisdak/load');
    


    $('#Program').on('change', function(){ 
        var id = $('#Program').val();
        $("#NamaKegiatan").load('/kegiatan/load/'+id);
    });

    $('#Bidang').on('change', function(){ 
        var id = $('#Bidang').val();
        $("#SubBidang").load('/load/data/ms_subbidang/'+id);
    });

    $('#JenisDak').on('change', function() {
      if ( this.value == '1')
      {
        $("#DivSubReguler").show();
        $("#SubReguler").load('/sub/reguler/load');
      }
      else
      {
        $("#DivSubReguler").hide();
        $("#SubReguler").val('').trigger('change');

        $("#DivSubRegulerII").hide();
        $("#SubRegulerII").val('').trigger('change');
      }
    });

    $('#SubReguler').on('change', function() {
      if ( this.value == '1')
      {
        $("#DivSubRegulerII").show();
        var id = 1;
        $("#SubRegulerII").load('/sub/reguler/ii/load/'+id);
      }
      else if ( this.value == '2')
      {
        $("#DivSubRegulerII").show();
        var id = 2;
        $("#SubRegulerII").load('/sub/reguler/ii/load/'+id);
      }
      else if ( this.value == '8')
      {
        $("#DivSubRegulerII").show();
        var id = 8;
        $("#SubRegulerII").load('/sub/reguler/ii/load/'+id);
      }
      else if ( this.value == '13')
      {
        $("#DivSubRegulerII").show();
        var id = 13;
        $("#SubRegulerII").load('/sub/reguler/ii/load/'+id);
      }
      else
      {
        $("#DivSubRegulerII").hide();
        $("#SubRegulerII").val('').trigger('change');
      }
    });



    $('#SubRegulerEdit').on('change', function() {
      if ( this.value == '1')
      {
        $("#DivSubRegulerIIEdit").show();
        var id = 1;
        $("#SubRegulerIIEdit").load('/sub/reguler/ii/load/'+id);
      }
      else if ( this.value == '2')
      {
        $("#DivSubRegulerIIEdit").show();
        var id = 2;
        $("#SubRegulerIIEdit").load('/sub/reguler/ii/load/'+id);
      }
      else if ( this.value == '8')
      {
        $("#DivSubRegulerIIEdit").show();
        var id = 8;
        $("#SubRegulerIIEdit").load('/sub/reguler/ii/load/'+id);
      }
      else if ( this.value == '13')
      {
        $("#DivSubRegulerIIEdit").show();
        var id = 13;
        $("#SubRegulerIIEdit").load('/sub/reguler/ii/load/'+id);
      }
      else
      {
        $("#DivSubRegulerIIEdit").hide();
        $("#SubRegulerIIEdit").val('').trigger('change');
      }
    });

    $("#SubRegulerEdit").load('/sub/reguler/load');

    var table2 = $('#datatable-slide').DataTable({
            "pageLength": 10,
            "processing": true,
            "scrollX": true,
            "language": {
                "processing": 'Memuat...'
            },
            "serverSide": true,
            "ajax": "/panel/data/program/json",
            "columns": [
                { "data": "DT_RowIndex", "orderable": false, "searchable": false },
                { "data": "jenisdak" },
                { "data": "bidang" },
                { "data": "subbidang" },
                { "data": "program" },
                { "data": "kegiatan" },
                { "data": "rinci" },
                { "data": "volume" },
                { "data": "satuan" },
                { "data": "jumlahpmanfaat" },
                { "data": "pagudakfisik" },
                { "data": "swakelolavol" },
                { "data": "swakelolanilai" },
                { "data": "kontraktualvol" },
                { "data": "kontraktualnilai" },
                { "data": "metodepembayaran" },
                { "data": "keuangan" },
                { "data": "keuanganpersen" },
                { "data": "fisikvol" },
                { "data": "fisikpersen" },
                { "data": "kodefikasi" },
                { "data": "tahun" },
                { "data": "aksi", "orderable": false, "searchable": false },
            ],
        });

});

function GantiKegiatan() { 
        var id = $('#ProgramEdit').val();
        $("#NamaKegiatanEdit").load('/kegiatan/load/'+id);
}

function AjaxSimpanData() { 
    var data = $('#FormInsert').serialize();
        $.ajax({
            type: 'POST',
            url: '/panel/program/insert',
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
            url: '/panel/program/edit',
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
            url: '/panel/program/delete/'+id,
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

function loadsubreguler2(id,ids){
    $("#SubRegulerIIEdit").load('/sub/reguler/edit/ii/load/'+id+'/'+ids);
}

function EditData(id, jenisdak, subjenisdak, subsubjenisdak, triwulan, bidang, subbidang, program, kegiatan, rincikegiatan, volume, satuan, jumlahpmanfaat, pagudakfisik, swakelolavol, swakelolanilai, kontraktualvol, kontraktualnilai, metodepembayaran, keuangan, keuanganpersen, fisikvol, fisikpersen, kodefikasi, tahun) { 
    
    $("#ProgramEdit").load('/program/edit/load/'+program);
    $("#NamaKegiatanEdit").load('/kegiatan/edit/load/'+program+'/'+kegiatan);

    $("#BidangEdit").load('/bidang/edit/load/'+bidang);
    $("#SubBidangEdit").load('/subbidang/edit/load/'+bidang+'/'+subbidang);

    $("#MetodePembayaranEdit").val(metodepembayaran).trigger('change');

    $("#idEdit").val(id);
    $("#JenisDakEdit").val(jenisdak).trigger('change');

    if ($("#JenisDakEdit").val() == 1){
        $("#DivSubRegulerEdit").show();
        $("#SubRegulerEdit").val(subjenisdak).trigger('change');
    } else {
        $("#DivSubRegulerEdit").hide();
        $("#SubRegulerEdit").val('').trigger('change');
    }

    if ($("#SubRegulerEdit").val() == 1){
        $("#DivSubRegulerIIEdit").show();
        var id = 1;
        var ids = subsubjenisdak;
        loadsubreguler2(id, ids);
    } else if ($("#SubRegulerEdit").val() == 2) {
        $("#DivSubRegulerIIEdit").show();
        var id = 2;
        var ids = subsubjenisdak;
        loadsubreguler2(id, ids);
    } else if ($("#SubRegulerEdit").val() == 8) {
        $("#DivSubRegulerIIEdit").show();
        var id = 8;
        var ids = subsubjenisdak;
        loadsubreguler2(id, ids);
    } else if ($("#SubRegulerEdit").val() == 13) {
        $("#DivSubRegulerIIEdit").show();
        var id = 13;
        var ids = subsubjenisdak;
        loadsubreguler2(id, ids);
    } else {
        $("#DivSubRegulerIIEdit").hide();
        $("#SubRegulerIIEdit").val('').trigger('change');
    }

    $("#TriwulanEdit").val(triwulan).trigger('change');
    $("#BidangEdit").val(bidang).trigger('change');
    $("#SubBidangEdit").val(subbidang).trigger('change');

    $("#RinciKegiatanEdit").val(rincikegiatan);
    $("#VolumeEdit").val(volume);
    $("#SatuanEdit").val(satuan);
    $("#SatuanEdit").val(satuan);
    $("#JumlahPManfaatEdit").val(jumlahpmanfaat);
    $("#PaguDakFisikEdit").val(pagudakfisik);
    $("#VolumeSwakelolaEdit").val(swakelolavol);
    $("#VolumeSwakelolaRPEdit").val(swakelolanilai);
    $("#VolumeKontraktualEdit").val(kontraktualvol);
    $("#VolumeKontraktualRPEdit").val(kontraktualnilai);
    $("#MetodePembayaranEdit").val(metodepembayaran);
    $("#KeuanganEdit").val(keuangan);
    $("#KeuanganPersenEdit").val(keuanganpersen);
    $("#FisikVolEdit").val(fisikvol);
    $("#FisikPersenEdit").val(fisikpersen);
    $("#KodefikasiEdit").val(kodefikasi).trigger('change');
    $("#TahunEdit").val(tahun).trigger('change');
}

</script>
@endsection
