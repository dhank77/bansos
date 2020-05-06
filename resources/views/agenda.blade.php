@extends('layouts.app')

@section('title')
     {{ $settings->namaOpd }} Prov. Sulsel
@endsection

@section('og')
    <meta property="og:title" content=" {{ $settings->namaOpd }} Prov. Sulsel">
@endsection

@section('content')

@include('include.header', ['title' => 'Agenda Kegiatan'])

    <!-- Start : Blog Page Content 
    ==================================================-->
    <script type="text/javascript">
        function pilih() {
            month = $("#bulan").val();
            year  = $("#tahun").val();
            $("#data").load("/agenda/pilih/"+month+"/"+year);
        }
    </script>
    <div class="page-content">
        <div class="content-area">
            <div class="container" >
                <div class="p-a30 bg-white m-b40">
                    <div class="section-head">
                        <div class="text-center">
                            <h3 class="text-uppercase text-center">Agenda Kegiatan</h3>
                            <div class="dez-separator bg-primary"></div>
                        </div>
                        <div class="pull-right" style="width: 80px;">
                            <select name="tahun" id="tahun" class="bs-select-hidden" onchange="pilih()">
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                            </select>
                        </div>
                        <div class="pull-right" style="width: 120px; margin-bottom: 5px">
                            <select name="bulan" id="bulan" class="bs-select-hidden" onchange="pilih()">
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <span id="data" ></span>
                        <p class="pull-right" style="margin-top: -20px"><small><i>*Jadwal yang tertera diatas dapat berubah sewaktu-waktu, silahkan hubungi kami untuk informasi lebih lanjut.</i></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--     <script type="text/javascript">

    var d = new Date();
    var bln = "0" + ( d.getMonth() + 1 );
    var thn = d.getFullYear();
    document.getElementById("bulan").value = bln;
    document.getElementById("tahun").value = thn;
    load();

    function load() {
        $("#data").load("/agenda/pilih/"+bln+"/"+thn);
    }

    </script> -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js" ></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var date = new Date();
            var month = ("0" + (date.getMonth()+1)).slice(-2);
            var year  = date.getFullYear();

            $("#bulan").val(month);
            $("#tahun").val(year);
            $("#data").load("/agenda/pilih/"+month+"/"+year);
            refresh();
        });

        function refresh(){

            setTimeout( function() {
                var date = new Date();
                var month = ("0" + (date.getMonth()+1)).slice(-2);
                var year  = date.getFullYear();

                $("#bulan").val(month);
                $("#tahun").val(year);
                $("#data").load("/agenda/pilih/"+month+"/"+year);
                refresh();
            },200);
        }
    </script>
    <!--  End : Blog Page Content
    ==================================================-->
@endsection

