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

    <!-- ***** About Us Area Start ***** -->
    <div style="display: none;">
    @php $no = 0 @endphp
    @foreach($data as $xdata)
    @php $no++ @endphp
    <input type="text" id="a{{ $no }}" value="{{ $xdata->nama_kab }}">
    <input type="text" id="b{{ $no }}" value="{{ $xdata->jumlah }}">
    @endforeach
    </div>
    <canvas id="canvas"></canvas>
    
    <!-- ***** About Us Area End ***** -->

    <!-- ***** Skills Area Start ***** -->


    <!-- ***** Footer Area Start ***** -->
    <i class="fa fa-heart-o" aria-hidden="true"></i> 
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
            var a1   = $('#a1').val();
            var a2   = $('#a2').val();
            var a3   = $('#a3').val();
            var a4   = $('#a4').val();
            var a5   = $('#a5').val();
            var a6   = $('#a6').val();
            var a7   = $('#a7').val();
            var a8   = $('#a8').val();
            var a9   = $('#a9').val();
            var a10  = $('#a10').val();
            var a11  = $('#a11').val();
            var a12  = $('#a12').val();
            var a13  = $('#a13').val();
            var a14  = $('#a14').val();
            var a15  = $('#a15').val();
            var a16  = $('#a16').val();
            var a17  = $('#a17').val();
            var a18  = $('#a18').val();
            var a19  = $('#a19').val();
            var a20  = $('#a20').val();
            var a21  = $('#a21').val();
            var a22  = $('#a22').val();
            var a23  = $('#a23').val();
            var a24  = $('#a24').val();

            var b1   =$('#b1').val();
            var b2   =$('#b2').val();
            var b3   =$('#b3').val();
            var b4   =$('#b4').val();
            var b5   =$('#b5').val();
            var b6   =$('#b6').val();
            var b7   =$('#b7').val();
            var b8   =$('#b8').val();
            var b9   =$('#b9').val();
            var b10  = $('#b10').val();
            var b11  = $('#b11').val();
            var b12  = $('#b12').val();
            var b13  = $('#b13').val();
            var b14  = $('#b14').val();
            var b15  = $('#b15').val();
            var b16  = $('#b16').val();
            var b17  = $('#b17').val();
            var b18  = $('#b18').val();
            var b19  = $('#b19').val();
            var b20  = $('#b20').val();
            var b21  = $('#b21').val();
            var b22  = $('#b22').val();
            var b23  = $('#b23').val();
            var b24  = $('#b24').val();

        
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

    
    </script>
</body>