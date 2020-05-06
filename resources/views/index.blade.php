<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Bantuan Sosial</title>

    <!-- Favicon -->
    <link rel="icon" href="/assets_public/img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link href="/assets_public/style.css" rel="stylesheet">

    <!-- Responsive CSS -->
    <link href="/assets_public/css/responsive/responsive.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="loader">
            <span class="inner1"></span>
            <span class="inner2"></span>
            <span class="inner3"></span>
        </div>
    </div>

    <!-- Search Form Area -->
    <div class="fancy-search-form d-flex align-items-center">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Close Btn -->
                    <div class="search-close-btn" id="closeBtn">
                        <i class="ti-close" aria-hidden="true"></i>
                    </div>
                    <!-- Form -->
                    <form action="#" method="get">
                        <input type="search" name="fancySearch" id="search" placeholder="| Enter Your Search...">
                        <input type="submit" class="d-none" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header_area" id="header">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-12 h-100">
                    <nav class="h-100 navbar navbar-expand-lg align-items-center" width="100%">
                        
                        <a class="navbar-brand" href="index.html"> <img src="/assets_public/img/logo.png" width="60" height="60" > Bantuan Sosial</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#fancyNav"
                            aria-controls="fancyNav" aria-expanded="false" aria-label="Toggle navigation"><span
                                class="ti-menu"></span></button>
                        <div class="collapse navbar-collapse" id="fancyNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/">Home <span
                                            class="sr-only">(current)</span></a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/persyaratan">Persyaratan</a>
                                <!-- </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">FAQ</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="index.html">Home</a>
                                        <a class="dropdown-item" href="static-page.html">Static Page</a>
                                        <a class="dropdown-item" href="contact.html">Contact</a>
                                    </div>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" href="/panel">Login</a>
                                </li>

                            </ul>
                            <!-- Search & Shop Btn Area -->
                            <div class="fancy-search-and-shop-area">
                                <a id="search-btn" href="#"><i class="icon_search" aria-hidden="true"></i></a>

                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Hero Area Start ***** -->
    <div class="fancy-hero-area bg-img bg-overlay animated-img" style="background-image: url(/assets_public/img/bg-img/hero-1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="fancy-hero-content text-center">
                        <!-- Video Overview -->

                        <h2>Website ini berisi informasi terkait data penerima bantuan sosial
                        </h2>
                        <!-- <h2>Provinsi Sulawesi Selatan</h2> -->
                        <!-- <a href="#" class="btn fancy-btn fancy-active">About Us</a>
                        <a href="#" class="btn fancy-btn">Get a quote</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Hero Area End ***** -->

    <!-- ***** About Us Area Start ***** -->
    <!-- <section class="fancy-about-us-area bg-gray" style="padding: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="about-us-text">
                        <h2>Tentang Karya Satya Lencana</h2>
                        <p>Satyalancana Karya Satya adalah sebuah tanda penghargaan yang diberikan kepada pegawai negeri
                            sipil yang telah berbakti selama 10 atau 20 atau 30 tahun lebih secara terus menerus dengan
                            menunjukkan kecakapan, kedisiplinan, kesetian dan pengabdian sehingga dapat dijadikan
                            teladan bagi setiap pegawai lainnya.
                        </p>
                        <p>Satyalancana Karya Satya dibagi dalam tiga kelas, yaitu Satyalancana Karya Satya 10 Tahun,
                            Satyalancana Karya Satya 20 Tahun, dan Satyalancana Karya Satya 30 Tahun.</p>
                        <a href="#" class="btn fancy-btn fancy-dark">Read More</a>
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-5 ml-xl-auto">
                    <div class="about-us-thumb wow fadeInUp" data-wow-delay="0.5s">
                        <img src="/assets_public/img/bg-img/2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- ***** About Us Area End ***** -->

    <!-- ***** About Us Area Start ***** -->
    <section class="fancy-about-us-area bg-gray" style="padding-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="about-us-text">
                        <h2>Hubungi Call Center dibawah ini untuk informasi mengenai Bantuan Sosial Sulsel</h2>
                        <p>Website ini berisi informasi terkait data - data para penerima bantuan sosial provinsi sulawesi - selatan</p>
                        <a href="#" class="btn fancy-btn fancy-active">081 255 XXX XXX</a> <a href="#" class="btn fancy-btn fancy-active">081 255 XXX XXX</a>
                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-5 ml-xl-auto">
                    <div class="about-us-thumb wow fadeInUp" data-wow-delay="0.5s">
                        <img src="/assets_public/img/bg-img/2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** About Us Area End ***** -->


    <!-- ***** About Us Area Start ***** -->
    <section class="fancy-about-us-area bg-white" style="padding-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="about-us-text">
                            <div style="margin-bottom: 30px;">
                                Pilih Kab / Kota &nbsp; &nbsp;: 
                                <select name="kab" id="kab" style="width: 100%;" class="select2">
                                    <option value="00">Semua</option>
                                    @foreach($data as $xdata)
                                    <option value="{{ $xdata->kd_kab }}">{{ $xdata->nama_kab }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin-bottom: 30px;">
                                Pilih Kecamatan : 
                                <select name="kec" id="kec" style="width: 100%;" class="select2">
                                    <option value="00">Semua</option>
                                    <!-- @foreach($data as $xdata)
                                    <option value="{{ $xdata->kd_kab }}">{{ $xdata->nama_kab }}</option>
                                    @endforeach -->
                                </select>
                            </div>
                            <div style="margin-bottom: 30px;">
                                Pilih Kelurahan &nbsp; : 
                                <select name="kel" id="kel" style="width: 100%;" class="select2">
                                    <option value="00">Semua</option>
                                    <!-- @foreach($data as $xdata)
                                    <option value="{{ $xdata->kd_kab }}">{{ $xdata->nama_kab }}</option>
                                    @endforeach -->
                                </select>
                            </div>
                        
                        <table id="datatable-slide" class="table table-striped table-bordered table-hover display nowrap" width="100%">
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
    </section>
    <!-- ***** About Us Area End ***** -->

    <!-- ***** About Us Area Start ***** -->
    <section class="fancy-about-us-area bg-gray" style="padding-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="about-us-text">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** About Us Area End ***** -->

    <!-- ***** Skills Area Start ***** -->


    <!-- ***** Footer Area Start ***** -->
    <footer class="fancy-footer-area fancy-bg-dark">
        <div class="footer-content section-padding-80-50">
            <div class="container">
                <div class="row">
                    <!-- Footer Widget -->

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-footer-widget">
                            <h6>Satya Lencana <br> Prov. Sulawesi Selatan</h6>
                            <div class="single-tweet">
                                <a href="#"> helpdesk@sulselprov.go.id
                                    Jl. Urip Sumoharjo No.269, Panaikang, Kec. Panakkukang, 90231
                                    Kota Makassar, Sulawesi Selatan <br>https://sulselprov.go.id 
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-footer-widget">
                            <h6>Link Categories</h6>
                            <nav>
                                <ul>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Home</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            About</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i> FAQ</a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            Contact</a></li>
                                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-footer-widget">
                            <h6>Info Terbaru</h6>
                            <p>Masukkan Email anda untuk mendapatkan informasi terbaru</p>
                            <form action="#" method="get">
                                <input type="search" name="search" id="footer-search" placeholder="E-mail">
                                <button type="submit">Subscribe</button>
                            </form>
                            <div class="footer-social-widegt d-flex align-items-center">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Widget -->
                    
                    <!-- Footer Widget -->
                    
                   
                </div>
            </div>
        </div>
        <!-- Footer Copywrite -->
        <div class="footer-copywrite-area">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-12 h-100">
                        <div class="copywrite-content h-100 d-flex align-items-center justify-content-between">
                            <!-- Copywrite Text -->
                            <div class="copywrite-text">
                                <p>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;
                                    <script>document.write(new Date().getFullYear());</script> All rights reserved |
                                    This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                                        href="https://colorlib.com" target="_blank">Colorlib</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                            <!-- Footer Nav -->
                            <div class="footer-nav">
                                <nav>
                                    <ul>
                                        <li><a href="#">Disclaimer</a></li>
                                        <li><a href="#">Privacy</a></li>
                                        <li><a href="#">Advertisement</a></li>
                                        <li><a href="#">Contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ***** Footer Area End ***** -->

    <!-- jQuery-2.2.4 js -->
    <script src="/assets_public/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="/assets_public/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap-4 js -->
    <script src="/assets_public/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="/assets_public/js/others/plugins.js"></script>
    <!-- Active JS -->
    <script src="/assets_public/js/active.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.select2').select2();

        var kab = $('#kab').val();
        var kec = '00';
        var kec = '00';
        var table2 = $('#datatable-slide').DataTable({
                "pageLength": 10,
                "processing": true,
                "language": {
                    "processing": 'Memuat...'
                },
                "serverSide": true,
                "scrollX": true,
                "ajax": "/panel/data/bansos/index/json/"+kab+"/"+kec+"/"+kel,
                "columns": [
                    { "data": "DT_RowIndex", "orderable": false, "searchable": false },
                    { "data": "IDBDT" },
                    { "data": "NIK" },
                    { "data": "NAMA" },
                    { "data": "KABUPATEN" },
                    { "data": "ALAMAT" },
                ],
                "columnDefs": [
                    {"className": "text-center", "targets": [0,4]}
                ],
            });

            $("#kab").change(function(){
                var kab = $('#kab').val();
                var kec = '00';
                var kel = '00';
                url = "/panel/data/bansos/index/json/"+kab+"/"+kec+"/"+kel;
                table2.ajax.url(url)
                table2.ajax.reload();
                $("#kec").load('/kecamatan/'+kab);
            });

            $("#kec").change(function(){
                var kab = $('#kab').val();
                var kec = $('#kec').val();
                var kel = '00';
                url = "/panel/data/bansos/index/json/"+kab+"/"+kec+"/"+kel;
                table2.ajax.url(url)
                table2.ajax.reload();
                $("#kel").load('/kelurahan/'+kec);
            });

            $("#kel").change(function(){
                var kab = $('#kab').val();
                var kec = $('#kec').val();
                var kel = $('#kel').val();
                url = "/panel/data/bansos/index/json/"+kab+"/"+kec+"/"+kel;
                table2.ajax.url(url)
                table2.ajax.reload();
            });

        });
    </script>


    <script>
        $.getJSON('chart/data', function(data) {
            var a1   = data[0].nama_kab;
            var a2   = data[1].nama_kab;
            var a3   = data[2].nama_kab;
            var a4   = data[3].nama_kab;
            var a5   = data[4].nama_kab;
            var a6   = data[5].nama_kab;
            var a7   = data[6].nama_kab;
            var a8   = data[7].nama_kab;
            var a9   = data[8].nama_kab;
            var a10  = data[9].nama_kab;
            var a11  = data[10].nama_kab;
            var a12  = data[11].nama_kab;
            var a13  = data[12].nama_kab;
            var a14  = data[13].nama_kab;
            var a15  = data[14].nama_kab;
            var a16  = data[15].nama_kab;
            var a17  = data[16].nama_kab;
            var a18  = data[17].nama_kab;
            var a19  = data[18].nama_kab;
            var a20  = data[19].nama_kab;
            var a21  = data[20].nama_kab;
            var a22  = data[21].nama_kab;
            var a23  = data[22].nama_kab;
            var a24  = data[23].nama_kab;

            var b1   = data[0].jumlah;
            var b2   = data[1].jumlah;
            var b3   = data[2].jumlah;
            var b4   = data[3].jumlah;
            var b5   = data[4].jumlah;
            var b6   = data[5].jumlah;
            var b7   = data[6].jumlah;
            var b8   = data[7].jumlah;
            var b9   = data[8].jumlah;
            var b10  = data[9].jumlah;
            var b11  = data[10].jumlah;
            var b12  = data[11].jumlah;
            var b13  = data[12].jumlah;
            var b14  = data[13].jumlah;
            var b15  = data[14].jumlah;
            var b16  = data[15].jumlah;
            var b17  = data[16].jumlah;
            var b18  = data[17].jumlah;
            var b19  = data[18].jumlah;
            var b20  = data[19].jumlah;
            var b21  = data[20].jumlah;
            var b22  = data[21].jumlah;
            var b23  = data[22].jumlah;
            var b24  = data[23].jumlah;

        
		var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var color = Chart.helpers.color;
		var horizontalBarChartData = {
			labels: [ a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12, a13, a14, a15, a16, a17, a18, a19, a20, a21, a22, a23, a24,],
			datasets: [{
				label: 'Jumlah Penerima',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: [
					b1,
					b2,
					b3,
                    b4,
                    b5,
                    b6,
                    b7,
                    b8,
                    b9,
                    b10,
                    b11,
                    b12,
                    b13,
                    b14,
                    b15,
                    b16,
                    b17,
                    b18,
                    b19,
                    b20,
                    b21,
                    b22,
                    b23,
                    b24
				]
			}]

		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myHorizontalBar = new Chart(ctx, {
				type: 'horizontalBar',
				data: horizontalBarChartData,
				options: {
					// Elements options apply to all of the options unless overridden in a dataset
					// In this case, we are setting the border of each horizontal bar to be 2px wide
					elements: {
						rectangle: {
							borderWidth: 2,
						}
					},
					responsive: true,
					legend: {
						position: 'right',
					},
					title: {
						display: true,
						text: 'Grafik Penerima Bantuan Sosial'
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
				label: 'Dataset ' + (horizontalBarChartData.datasets.length + 1),
				backgroundColor: color(dsColor).alpha(0.5).rgbString(),
				borderColor: dsColor,
				data: []
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

    });
    </script>
</body>