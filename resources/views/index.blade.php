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
            <div id="mapid"></div>
            <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
            <script>
                var map = L.map('mapid').setView([-4.516667, 119.683611], 7);
                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>'
                    , maxZoom: 18
                    , id: 'mapbox/streets-v11'
                    , tileSize: 512
                    , zoomOffset: -1
                    , accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                }).addTo(map);

                var maps = '{!! $maps !!}';
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

            </script>
        </div>
    </div>
</div>

<div style="display: none;">
    @php $no = 0 @endphp
    @foreach($data2 as $xdata2)
    @php $no++ @endphp
    <input type="text" id="a{{ $no }}" value="{{ $xdata2->nama_kab }}">
    <input type="text" id="b{{ $no }}" value="{{ $xdata2->jumlah }}">
    @endforeach
</div>
<div class="testimonials section py-4">
    <div class="container">
        <h5 class="section-title text-center m-5">Grafik</h5>
        <div class="contact-form col-sm-12 col-md-12 col-lg-12 p-5 mb-4 card">
            <div class="container">
                <canvas id="canvas"></canvas>
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
    var a1 = $('#a1').val();
    var a2 = $('#a2').val();
    var a3 = $('#a3').val();
    var a4 = $('#a4').val();
    var a5 = $('#a5').val();
    var a6 = $('#a6').val();
    var a7 = $('#a7').val();
    var a8 = $('#a8').val();
    var a9 = $('#a9').val();
    var a10 = $('#a10').val();
    var a11 = $('#a11').val();
    var a12 = $('#a12').val();
    var a13 = $('#a13').val();
    var a14 = $('#a14').val();
    var a15 = $('#a15').val();
    var a16 = $('#a16').val();
    var a17 = $('#a17').val();
    var a18 = $('#a18').val();
    var a19 = $('#a19').val();
    var a20 = $('#a20').val();
    var a21 = $('#a21').val();
    var a22 = $('#a22').val();
    var a23 = $('#a23').val();
    var a24 = $('#a24').val();

    var b1 = $('#b1').val();
    var b2 = $('#b2').val();
    var b3 = $('#b3').val();
    var b4 = $('#b4').val();
    var b5 = $('#b5').val();
    var b6 = $('#b6').val();
    var b7 = $('#b7').val();
    var b8 = $('#b8').val();
    var b9 = $('#b9').val();
    var b10 = $('#b10').val();
    var b11 = $('#b11').val();
    var b12 = $('#b12').val();
    var b13 = $('#b13').val();
    var b14 = $('#b14').val();
    var b15 = $('#b15').val();
    var b16 = $('#b16').val();
    var b17 = $('#b17').val();
    var b18 = $('#b18').val();
    var b19 = $('#b19').val();
    var b20 = $('#b20').val();
    var b21 = $('#b21').val();
    var b22 = $('#b22').val();
    var b23 = $('#b23').val();
    var b24 = $('#b24').val();


    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var color = Chart.helpers.color;
    var horizontalBarChartData = {
        labels: [a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12, a13, a14, a15, a16, a17, a18, a19, a20, a21, a22, a23, a24, ]
        , datasets: [{
            label: 'Jumlah Penerima'
            , backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString()
            , borderColor: window.chartColors.blue
            , borderWidth: 1
            , data: [
                b1
                , b2
                , b3
                , b4
                , b5
                , b6
                , b7
                , b8
                , b9
                , b10
                , b11
                , b12
                , b13
                , b14
                , b15
                , b16
                , b17
                , b18
                , b19
                , b20
                , b21
                , b22
                , b23
                , b24
            ]
        }]

    };

    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myHorizontalBar = new Chart(ctx, {
            type: 'horizontalBar'
            , data: horizontalBarChartData
            , options: {
                // Elements options apply to all of the options unless overridden in a dataset
                // In this case, we are setting the border of each horizontal bar to be 2px wide
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

    };

    document.getElementById('randomizeData').addEventListener('click', function() {
        var zero = Math.random() < 0.2 ? true : false;
        horizontalBarChartData.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return zero ? 0.0 : randomScalingFactor();
            });

        });
        window.myHorizontalBar.update();
    });

    var colorNames = Object.keys(window.chartColors);

    document.getElementById('addDataset').addEventListener('click', function() {
        var colorName = colorNames[horizontalBarChartData.datasets.length % colorNames.length];
        var dsColor = window.chartColors[colorName];
        var newDataset = {
            label: 'Dataset ' + (horizontalBarChartData.datasets.length + 1)
            , backgroundColor: color(dsColor).alpha(0.5).rgbString()
            , borderColor: dsColor
            , data: []
        };

        for (var index = 0; index < horizontalBarChartData.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
        }

        horizontalBarChartData.datasets.push(newDataset);
        window.myHorizontalBar.update();
    });

    document.getElementById('addData').addEventListener('click', function() {
        if (horizontalBarChartData.datasets.length > 0) {
            var month = MONTHS[horizontalBarChartData.labels.length % MONTHS.length];
            horizontalBarChartData.labels.push(month);

            for (var index = 0; index < horizontalBarChartData.datasets.length; ++index) {
                horizontalBarChartData.datasets[index].data.push(randomScalingFactor());
            }

            window.myHorizontalBar.update();
        }
    });

    document.getElementById('removeDataset').addEventListener('click', function() {
        horizontalBarChartData.datasets.pop();
        window.myHorizontalBar.update();
    });

    document.getElementById('removeData').addEventListener('click', function() {
        horizontalBarChartData.labels.splice(-1, 1); // remove the label first

        horizontalBarChartData.datasets.forEach(function(dataset) {
            dataset.data.pop();
        });

        window.myHorizontalBar.update();
    });

</script>

@endpush
