@extends('layouts.app')

@section('content')
<div class="blog section section-invert py-4">
    <div class="container">
        <h6 class="section-title underline--left mb-5 mt-5">Coronavirus (COVID-19)</h6>

        <div class="py-4">
            <div class="card-group">
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class=" mt-4">
                        <img class="card-img" src="/assets_public3/images/common/card-1.jpg" alt="">
                        <div class="card-body">
                            <h6>KETAHUI SYARAT-SYARAT MENDAPATKAN BANTUAN</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="mt-4 ">
                        <img class="card-img" src="/assets_public3/images/common/card-3.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h6 class="">MENDAPATKAN BANTUAN BAGI PERANTAU DI SULSEL</h6>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="mt-4 ">
                        <img class="card-img" src="/assets_public3/images/common/card-2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h6 class="">BANTUAN UNTUK WARGA SULSEL YANG MERANTAU</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="mt-4 ">
                        <img class="card-img" src="/assets_public3/images/common/card-2.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h6 class="">UPDATE DATA DAN SEBARAN PETA COVID-19</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-4">
                <div class="row">
                    <div class="col-md-12 col-lg-4">
                        <div class="card ">
                            <div class="card-header">
                                <ul class="news-meta">
                                    <li>Humas Sulsel</li>
                                    <li>21 Maret 2019</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h6>Pemprov dan TNI Polri Kompak Tangani Warga Terdampak Covid-19</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <ul class="news-meta">
                                    <li>Humas Sulsel</li>
                                    <li>21 Maret 2019</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h6>Pemprov Sulsel bantu 1000 APD dan 500 Rapid Test ke RSUD Kota Makassar</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-4">
                        <div class="card mb-4">
                            <div class="card-header ">
                                <ul class="news-meta">
                                    <li>Humas Sulsel</li>
                                    <li>21 Maret 2019</li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <h6>Gubernur Pastikan Kebutuhan Pangan Rakyat Tidak Bersoal</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h6 style="text-align: right;" class="text-right mb-5 mt-2">Berita Covid-19 Lainnya</h6>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="testimonials section py-4">
    <div class="container">
        <h5 class="section-title text-center m-5">Data Penerima Bantuan Sosial</h5>
        <div class="contact-form col-sm-12 col-md-12 col-lg-12 p-5 mb-4 card">

            <div style="margin-bottom: 10px;">
                Pilih Kab / Kota &nbsp; &nbsp;:
                <select name="kab" id="kab" style="width: 100%;" class="select2">
                    <option value="00">Semua</option>
                    @foreach($data as $xdata)
                    <option value="{{ $xdata->kd_kab }}">{{ $xdata->nama_kab }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom: 10px;">
                Pilih Kecamatan :
                <select name="kec" id="kec" style="width: 100%;" class="select2">
                    <option value="00">Semua</option>
                </select>
            </div>
            <div style="margin-bottom: 10px;">
                Pilih Kelurahan / Desa &nbsp; :
                <select name="kel" id="kel" style="width: 100%;" class="select2">
                    <option value="00">Semua</option>
                </select>
            </div>

            <div class="container">
                <table id="datatable-slide" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center" width="1%">No</th>
                            <th class="text-center">ID</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Kab / Kota</th>
                            <th class="text-center">Alamat</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="blog section section-invert py-4">
    <div class="container">
        <h6 class="section-title underline--left mb-5 mt-5">Monitoring Distribusi Bantuan Sosial</h6>
        <div class="col-sm-12 col-md-12 col-lg-12 p-5 mb-4 card">
            <div id="loader" style="display: none; text-align:center;">
                <div class="spinner-border text-primary" style="width: 10rem; height: 10rem; text-align:center;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div id="mapid" style="display: none"> </div>
            <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
            <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
            <script>
                var localCache = {
                    data: {}
                    , remove: function(url) {
                        delete localCache.data[url];
                    }
                    , exist: function(url) {
                        return localCache.data.hasOwnProperty(url) && localCache.data[url] !== null;
                    }
                    , get: function(url) {
                        console.log('Getting in cache for url' + url);
                        return localCache.data[url];
                    }
                    , set: function(url, cachedData, callback) {
                        localCache.remove(url);
                        localCache.data[url] = cachedData;
                        if ($.isFunction(callback)) callback(cachedData);
                    }
                };
                const url = "/mapsJSON";
                $.ajax({
                    url: url
                    , type: "GET"
                    , cache: true
                    , beforeSend: function() {
                        console.log('before cache');
                        $('#loader').show();
                        if (localCache.exist(url)) {
                            console.log('ada cache');
                            doSomething(localCache.get(url));
                            return false;
                        }
                        return true;
                    }
                    , complete: function(jqXHR, textStatus) {
                        localCache.set(url, jqXHR, doSomething);
                    }
                })

                function doSomething(data) {
                    console.log("data cachse");
                    console.log(data.responseText);
                    $('#loader').hide();
                    $('#mapid').show();
                    var map = L.map('mapid').setView([-4.516667, 119.683611], 7);
                    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
                        , maxZoom: 18
                        , id: 'mapbox/streets-v11'
                        , tileSize: 512
                        , zoomOffset: -1
                        , accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                    }).addTo(map);

                    var maps = data.responseText;
                    var data_maps = JSON.parse(maps);
                    data_maps.forEach(data_maps_foreach)

                    function get_color(jumlah) {
                        let color = "";
                        if (jumlah < 10000) {
                            color = "#e6f5fe"
                        }
                        if (jumlah > 10000 && jumlah < 25000) {
                            color = "#b5e2fd"
                        }
                        if (jumlah > 25000 && jumlah < 40000) {
                            color = "#84cffd"
                        }
                        if (jumlah > 40000 && jumlah < 50000) {
                            color = "#53bcfc"
                        }
                        if (jumlah > 50000) {
                            color = "#0aa0fb"
                        }
                        return color;
                    }

                    function data_maps_foreach(item) {
                        L.geoJson(item, {
                            style: function(feature) {
                                return {
                                    fillOpacity: 0.8
                                    , weight: 1
                                    , opacity: 1
                                    , color: "black"
                                    , fillColor: get_color(feature.properties.jumlah)
                                };
                            }
                            , onEachFeature: function(feature, layer) {
                                var label = L.marker(layer.getBounds().getCenter(), {
                                        icon: L.divIcon({
                                            className: 'label'
                                            , html: "<span style='color:black'>" + feature.properties.jumlah + "<span>"
                                            , iconSize: [40, 40]
                                        })
                                    }).addTo(map)
                                    .bindTooltip('<p style="font-size: 10px; color:black; line-height:14px; margin-bottom:0px;">Kabupaten : <b>' + feature.properties.NAME_2 + '</b><br> Jumlah : ' + feature.properties.jumlah + '</p>', {
                                        direction: 'top'
                                    });
                            }
                        }).addTo(map);
                    }
                }

            </script>
        </div>
    </div>
</div>

<div class="testimonials section py-4">
    <div class="container">
        <h5 class="section-title text-center m-5">Grafik</h5>
        <div class="contact-form col-sm-12 col-md-12 col-lg-12 p-5 mb-4 card">
            <div class="container">
                <div id="loaderchart" style="display: none; text-align:center;">
                    <div class="spinner-border text-primary" style="width: 10rem; height: 10rem; text-align:center;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <canvas id="canvas" style="display: none"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<!-- end of datatable -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
        //   $('#totKab').DataTable({});

        var kab = $('#kab').val();
        var kec = '00';
        var kec = '00';
        var table2 = $('#datatable-slide').DataTable({
            "pageLength": 10
            , "processing": true
            , "language": {
                "processing": 'Memuat...'
            }
            , "destroy": true
            , "serverSide": true
            , "scrollX": true
            , "ajax": "/panel/data/bansos/index/json/" + kab + "/" + kec + "/" + kel
            , "columns": [{
                    "data": "DT_RowIndex"
                    , "orderable": false
                    , "searchable": false
                }
                , {
                    "data": "IDBDT"
                }
                , {
                    "data": "NIK"
                }
                , {
                    "data": "NAMA"
                }
                , {
                    "data": "KABUPATEN"
                }
                , {
                    "data": "ALAMAT"
                }
            , ]
            , "columnDefs": [{
                "className": "text-center"
                , "targets": [0, 4]
            }]
        , });

        $("#kab").change(function() {
            var kab = $('#kab').val();
            var kec = '00';
            var kel = '00';
            url = "/panel/data/bansos/index/json/" + kab + "/" + kec + "/" + kel;
            table2.ajax.url(url)
            table2.ajax.reload();
            $("#kec").load('/kecamatan/' + kab);
        });

        $("#kec").change(function() {
            var kab = $('#kab').val();
            var kec = $('#kec').val();
            var kel = '00';
            url = "/panel/data/bansos/index/json/" + kab + "/" + kec + "/" + kel;
            table2.ajax.url(url)
            table2.ajax.reload();
            $("#kel").load('/kelurahan/' + kab + '/' + kec);
        });

        $("#kel").change(function() {
            var kab = $('#kab').val();
            var kec = $('#kec').val();
            var kel = $('#kel').val();
            url = "/panel/data/bansos/index/json/" + kab + "/" + kec + "/" + kel;
            table2.ajax.url(url)
            table2.ajax.reload();
        });

        $("#kabs").change(function() {
            var kabs = $('#kabs').val();
            $("#kecs").load('/kecamatan/' + kabs);
        });

        $("#kecs").change(function() {
            var kabs = $('#kabs').val();
            var kecs = $('#kecs').val();
            $("#kels").load('/kelurahan/' + kabs + '/' + kecs);
        });

    });

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="https://www.chartjs.org/samples/latest/utils.js"></script>

<script>
    $.ajax({
        url: "/getChart"
        , type: "GET"
        , cache: true
        , beforeSend: function() {
            $('#loaderchart').show();
        }
        , success: function(data_success) {
            $('#loaderchart').hide();
            $('#canvas').show();
            var data1 = data_success[0];
            var data2 = data_success[1];
            var color = Chart.helpers.color;
            var ctx = document.getElementById('canvas').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'horizontalBar'
                , data: {
                    labels: data1
                    , datasets: [{
                        label: 'Jumlah Perima Bantuan'
                        , backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString()
                        , borderColor: window.chartColors.blue
                        , data: data2
                    }]
                }
                , options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2
                        , }
                    }
                    , responsive: true
                    , legend: {
                        position: 'right'
                    , }
                    , title: {
                        display: true
                        , text: 'Data'
                    }
                }
            });
        }
    });
</script>

@endpush
