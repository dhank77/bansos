@extends('panel.layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" />
<div class="small-header transition animated fadeIn">
    <div class="hpanel">
        <div class="panel-body">
            <div id="hbreadcrumb" class="pull-right">
                <ol class="hbreadcrumb breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li class="active">
                        <span></span>
                    </li>
                </ol>
            </div>
            <h2 class="font-light m-b-xs">
                Dashboard
            </h2>
            <small>Examples of various form controls.</small>
        </div>
    </div>
</div>

<div class="content">
    <div class="form-group"><label class="col-sm-1 control-label">Periode</label>
        <div class="col-sm-11">
            <select class="form-control select2" id="Periode" onchange="TotalUsulan();" style="width: 100%;">
            <option value="9999">- Pilih -</option>
            <option value="18">18</option>
            <option value="17">17</option>
            </select>
        </div>
    </div><br><br>

    <div class="row">
        <div class="col-md-4">
            <div class="hpanel hbgyellow">
                <div class="panel-body">
                    <div class="text-center">
                        <h3>DIUSUL</h3>
                        <p class="text-big font-light" id="usul">
                        </p>
                        <small>
                            Daftar Total Pegawai yang Diusul.
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="hpanel hbggreen">
                <div class="panel-body">
                    <div class="text-center">
                        <h3>DISETUJUI</h3>
                        <p class="text-big font-light" id="terima">
                        </p>
                        <small>
                            Daftar Total Pegawai yang Disetujui.
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="hpanel hbgred">
                <div class="panel-body">
                    <div class="text-center">
                        <h3>DITOLAK</h3>
                        <p class="text-big font-light" id="tolak">
                        </p>
                        <small>
                            Daftar Total Pegawai yang Ditolak.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <!-- @role('superadmin')
        <div class="col-lg-12" style="margin-bottom: -20px">
            <div class="hpanel @if (!Session::has('showCreate')) collapsed @endif">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <button class="btn btn-xs btn-info showhide">Get Data<i class="fa fa-chevron-up"></i></button>
                    </div>
                    &nbsp;
                </div>
                <div class="panel-body">
                    <form method="POST" id="FormInsert" class="form-horizontal">
                        @csrf
                        <div class="form-group"><label class="col-sm-1 control-label">Tahun</label>
                            <div class="col-sm-11">
                                <select class="form-control select2" id="Tahun" name="tahun" style="width: 100%;">
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-1 control-label">Bulan</label>
                            <div class="col-sm-11">
                                <select class="form-control select2" id="Bulan" name="bulan" style="width: 100%;">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-primary  pull-right" type="button" onclick="insertrekap();">Get Data</button>
                    </form>
                </div>
            </div>
        </div>
        @endrole
        <br> -->
        <div class="col-lg-12 animated zoomIn" style="margin-bottom: -20px; margin-top: 20px">
            <div class="hpanel">
                <div class="panel-body">
                    <form method="POST" id="FormInsert" class="form-horizontal">
                        @csrf
                        @role('superadmin')
                        <div class="form-group"><label class="col-sm-1 control-label">SKPD</label>
                            <div class="col-sm-11">
                                <select class="form-control select2" id="Skpd" name="Skpd" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                        @endrole
                        @role('admin')
                        <div class="form-group"><label class="col-sm-1 control-label">SKPD</label>
                            <div class="col-sm-11">
                                <select class="form-control select2" id="Skpd" name="Skpd" style="width: 100%;">
                                <option value="{{ Auth::user()->kd_skpd }}">{{ Auth::user()->name }}</option>
                                </select>
                            </div>
                        </div>
                        @endrole
                        <div class="form-group" style="display: none;"><label class="col-sm-2 control-label">Anu</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" id="anu" name="anu" style="width: 100%;" >
                                    <option value="">- Pilih -</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12 animated zoomIn">
            <br>
            <div class="hpanel">
                <div class="panel-heading">
                    <div class="panel-tools">
                        <a class="showhide"><i class="fa fa-chevron-up"></i></a>
                        <a class="closebox"><i class="fa fa-times"></i></a>
                    </div>
                    Dashboard information and statistics
                </div>
                <div class="panel-body">
                    <div id="divcanvas">
                        <canvas id="canvas" height="75%"></canvas>
                    </div>
                </div>
                <div class="panel-footer">
                <span class="pull-right">
                        You have two new messages from <a href="">Monica Bolt</a>
                </span>
                    Last update: 21.05.2015
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="hpanel">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">January</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">February</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Maret</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">April</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <table id="datatable-slide1" class="table table-striped table-bordered table-hover display nowrap" width="100%">
                                <thead>
                                    <tr bgcolor='#F8F9F9'>
                                        <th class="text-center" width="1%">No</th>
                                        <th class="text-center" >Nama Skpd</th>
                                        <th class="text-center" >Anggaran Belanja Tidak Langsung</th>
                                        <th class="text-center" >Anggaran Belanja Langsung</th>
                                        <th class="text-center" >Total Anggaran</th>
                                        <th class="text-center" >Realisasi Belanja Tidak Langsung</th>
                                        <th class="text-center" >Realisasi Belanja Langsung</th>
                                        <th class="text-center" >Total Realisasi</th>
                                        <th class="text-center" >Fisik Realisasi</th>
                                        <th class="text-center" >Sisa Anggaran</th>
                                        @role('admin')
                                        <th class="text-center" >Aksi</th>
                                        @endrole
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <table id="datatable-slide2" class="table table-striped table-bordered table-hover display nowrap" width="100%">
                                <thead>
                                    <tr bgcolor='#F8F9F9'>
                                        <th class="text-center" width="1%">No</th>
                                        <th class="text-center" >Nama Skpd</th>
                                        <th class="text-center" >Anggaran Belanja Tidak Langsung</th>
                                        <th class="text-center" >Anggaran Belanja Langsung</th>
                                        <th class="text-center" >Total Anggaran</th>
                                        <th class="text-center" >Realisasi Belanja Tidak Langsung</th>
                                        <th class="text-center" >Realisasi Belanja Langsung</th>
                                        <th class="text-center" >Total Realisasi</th>
                                        <th class="text-center" >Fisik Realisasi</th>
                                        <th class="text-center" >Sisa Anggaran</th>
                                        @role('admin')
                                        <th class="text-center" >Aksi</th>
                                        @endrole
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <table id="datatable-slide3" class="table table-striped table-bordered table-hover display nowrap" width="100%">
                                <thead>
                                    <tr bgcolor='#F8F9F9'>
                                        <th class="text-center" width="1%">No</th>
                                        <th class="text-center" >Nama Skpd</th>
                                        <th class="text-center" >Anggaran Belanja Tidak Langsung</th>
                                        <th class="text-center" >Anggaran Belanja Langsung</th>
                                        <th class="text-center" >Total Anggaran</th>
                                        <th class="text-center" >Realisasi Belanja Tidak Langsung</th>
                                        <th class="text-center" >Realisasi Belanja Langsung</th>
                                        <th class="text-center" >Total Realisasi</th>
                                        <th class="text-center" >Fisik Realisasi</th>
                                        <th class="text-center" >Sisa Anggaran</th>
                                        @role('admin')
                                        <th class="text-center" >Aksi</th>
                                        @endrole
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">
                            <table id="datatable-slide4" class="table table-striped table-bordered table-hover display nowrap" width="100%">
                                <thead>
                                    <tr bgcolor='#F8F9F9'>
                                        <th class="text-center" width="1%">No</th>
                                        <th class="text-center" >Nama Skpd</th>
                                        <th class="text-center" >Anggaran Belanja Tidak Langsung</th>
                                        <th class="text-center" >Anggaran Belanja Langsung</th>
                                        <th class="text-center" >Total Anggaran</th>
                                        <th class="text-center" >Realisasi Belanja Tidak Langsung</th>
                                        <th class="text-center" >Realisasi Belanja Langsung</th>
                                        <th class="text-center" >Total Realisasi</th>
                                        <th class="text-center" >Fisik Realisasi</th>
                                        <th class="text-center" >Sisa Anggaran</th>
                                        @role('admin')
                                        <th class="text-center" >Aksi</th>
                                        @endrole
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 animated zoomIn" style="display: none;">
            <div class="hpanel">
                <div class="panel-body">
                    <table id="datatable-slide-old" class="table table-striped table-bordered table-hover display nowrap" width="100%">
                        <thead>
                            <tr bgcolor='#F8F9F9'>
                                <th class="text-center" width="1%">No</th>
                                <th class="text-center" >Nama Skpd</th>
                                <th class="text-center" >Anggaran Belanja Tidak Langsung</th>
                                <th class="text-center" >Anggaran Belanja Langsung</th>
                                <th class="text-center" >Total Anggaran</th>
                                <th class="text-center" >Realisasi Belanja Tidak Langsung</th>
                                <th class="text-center" >Realisasi Belanja Langsung</th>
                                <th class="text-center" >Total Realisasi</th>
                                <th class="text-center" >Fisik Realisasi</th>
                                <th class="text-center" >Sisa Anggaran</th>
                                @role('admin')
                                <th class="text-center" >Aksi</th>
                                @endrole
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
<script src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
    @role('superadmin')
    $("#Skpd").load('/data/skpd/load');
    @endrole

    TotalUsulan();

    $('#Skpd').on('change', function(){
        loadchart();
    });

    loadchart();

    @role('superadmin')
    $('#datatable-slide1').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
            "processing": 'Memuat...'
        },
        "serverSide": true,
        "ajax": "data/json/1",
        "columns": [
            { "data": "DT_RowIndex", "orderable": false, "searchable": false },
            { "data": "namaskpd" },
            { "data": "anggaranbelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { "data": "anggaranbelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalrealisasi", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "fisikrealisasi" },
            { "data": "sisaanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
        ],
        "scrollX": true,
    });

    $('#datatable-slide2').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
            "processing": 'Memuat...'
        },
        "serverSide": true,
        "ajax": "data/json/2",
        "columns": [
            { "data": "DT_RowIndex", "orderable": false, "searchable": false },
            { "data": "namaskpd" },
            { "data": "anggaranbelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { "data": "anggaranbelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalrealisasi", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "fisikrealisasi" },
            { "data": "sisaanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
        ],
        "scrollX": true,
    });

    $('#datatable-slide3').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
            "processing": 'Memuat...'
        },
        "serverSide": true,
        "ajax": "data/json/3",
        "columns": [
            { "data": "DT_RowIndex", "orderable": false, "searchable": false },
            { "data": "namaskpd" },
            { "data": "anggaranbelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { "data": "anggaranbelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalrealisasi", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "fisikrealisasi" },
            { "data": "sisaanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
        ],
        "scrollX": true,
    });

    $('#datatable-slide4').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
            "processing": 'Memuat...'
        },
        "serverSide": true,
        "ajax": "data/json/4",
        "columns": [
            { "data": "DT_RowIndex", "orderable": false, "searchable": false },
            { "data": "namaskpd" },
            { "data": "anggaranbelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { "data": "anggaranbelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalrealisasi", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "fisikrealisasi" },
            { "data": "sisaanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
        ],
        "scrollX": true,
    });

    @endrole
    @role('admin')
    $('#datatable-slide1').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
            "processing": 'Memuat...'
        },
        "serverSide": true,
        "ajax": "data/json/skpd/1",
        "columns": [
            { "data": "DT_RowIndex", "orderable": false, "searchable": false },
            { "data": "namaskpd" },
            { "data": "anggaranbelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { "data": "anggaranbelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalrealisasi", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "fisikrealisasi" },
            { "data": "sisaanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "aksi" },
        ],
        "scrollX": true,
    });
    $('#datatable-slide2').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
            "processing": 'Memuat...'
        },
        "serverSide": true,
        "ajax": "data/json/skpd/2",
        "columns": [
            { "data": "DT_RowIndex", "orderable": false, "searchable": false },
            { "data": "namaskpd" },
            { "data": "anggaranbelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { "data": "anggaranbelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalrealisasi", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "fisikrealisasi" },
            { "data": "sisaanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "aksi" },
        ],
        "scrollX": true,
    });
    $('#datatable-slide3').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
            "processing": 'Memuat...'
        },
        "serverSide": true,
        "ajax": "data/json/skpd/3",
        "columns": [
            { "data": "DT_RowIndex", "orderable": false, "searchable": false },
            { "data": "namaskpd" },
            { "data": "anggaranbelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { "data": "anggaranbelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalrealisasi", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "fisikrealisasi" },
            { "data": "sisaanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "aksi" },
        ],
        "scrollX": true,
    });
    $('#datatable-slide4').DataTable({
        "pageLength": 10,
        "processing": true,
        "language": {
            "processing": 'Memuat...'
        },
        "serverSide": true,
        "ajax": "data/json/skpd/4",
        "columns": [
            { "data": "DT_RowIndex", "orderable": false, "searchable": false },
            { "data": "namaskpd" },
            { "data": "anggaranbelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' )},
            { "data": "anggaranbelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjatidaklangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "realisasibelanjalangsung", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "totalrealisasi", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "fisikrealisasi" },
            { "data": "sisaanggaran", render: $.fn.dataTable.render.number( ',', '.', 3, 'Rp' ) },
            { "data": "aksi" },
        ],
        "scrollX": true,
    });
    @endrole

});

function TotalUsulan(){
    var periode = $("#Periode").val();
    $.ajax({ 
        type: 'GET', 
        url: '/data/'+periode,
        async: false,
        success: function (data) { 
            $usul    = data.usul;
            $terima  = data.terima;
            $tolak   = data.tolak;
        }
    });

    $( "#usul" ).empty();
    $( "#terima" ).empty();
    $( "#tolak" ).empty();

    $( "#usul" ).append( $usul );
    $( "#terima" ).append( $terima );
    $( "#tolak" ).append( $tolak );
}





















function butEdit(id, fr) { 
    document.getElementById("idEdit").value= id;
    document.getElementById("FisikRealisasiEdit").value= fr;
}

function AjaxEditData() { 
    var data = $('#FormEdit').serialize();
        $.ajax({
            type: 'POST',
            url: '/fisik/realisasi/edit',
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

function insertrekap(){
    var bulan = $('#Bulan').val();
    var tahun = $('#Tahun').val();
    $.ajax({ 
        type: 'GET', 
        url: '/rekap/'+bulan+'/'+tahun,
        async: false,
        success: function (data) { 
            alertSukses();
            location.reload();
        },
        error: function() {
            alertGagal();
        }
    });
}

document.getElementById('randomizeData').addEventListener('click', function() {
    var zero = Math.random() < 0.2 ? true : false;
    barChartData.datasets.forEach(function(dataset) {
        dataset.data = dataset.data.map(function() {
            return zero ? 0.0 : randomScalingFactor();
        });

    });
    window.myBar.update();
});

var colorNames = Object.keys(window.chartColors);
document.getElementById('addDataset').addEventListener('click', function() {
    var colorName = colorNames[barChartData.datasets.length % colorNames.length];
    var dsColor = window.chartColors[colorName];
    var newDataset = {
        label: 'Dataset ' + (barChartData.datasets.length + 1),
        backgroundColor: color(dsColor).alpha(0.5).rgbString(),
        borderColor: dsColor,
        borderWidth: 1,
        data: []
    };

    for (var index = 0; index < barChartData.labels.length; ++index) {
        newDataset.data.push(randomScalingFactor());
    }

    barChartData.datasets.push(newDataset);
    window.myBar.update();
});

document.getElementById('addData').addEventListener('click', function() {
    if (barChartData.datasets.length > 0) {
        var month = MONTHS[barChartData.labels.length % MONTHS.length];
        barChartData.labels.push(month);

        for (var index = 0; index < barChartData.datasets.length; ++index) {
            // window.myBar.addData(randomScalingFactor(), index);
            barChartData.datasets[index].data.push(randomScalingFactor());
        }

        window.myBar.update();
    }
});

document.getElementById('removeDataset').addEventListener('click', function() {
    barChartData.datasets.pop();
    window.myBar.update();
});

document.getElementById('removeData').addEventListener('click', function() {
    barChartData.labels.splice(-1, 1); // remove the label first

    barChartData.datasets.forEach(function(dataset) {
        dataset.data.pop();
    });

    window.myBar.update();
});


</script>
@endsection
