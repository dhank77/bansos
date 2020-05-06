
<head>
<title>Laporan Dak</title>
<style>
		td { font-size: 8px; }
		th { font-size: 10px; }
		</style>
</head>
<body style="margin-top: -30px;">
<center><h6>LAPORAN DANA ALOKASI KHUSUS (DAK)  <br> {{ strtoupper($namaskpd) }} <br> TAHUN ANGGARAN {{ $tahundak }}</h6></center><hr style="border: 1.5px solid black; margin-top: -20px;">
<table>
<!-- <tr><td style='border:none' width='60px'>Provinsi</td> <td style='border:none' colspan='5' width='260px'>: Sulawesi Selatan</td></tr> -->
<!-- <tr><td style='border:none'>Kabupaten / Kota</td> <td style='border:none' colspan='5'>: KABUPATEN MAROS</td></tr> -->
<tr><td style='border:none' width='60px'>SKPD</td> <td style='border:none' colspan='5' width='260px'>: {{ $namaskpd }}</td></tr>
<tr><td style='border:none'>Triwulan</td> <td style='border:none' colspan='5'>: {{ $triwulanromawi }}</td></tr>
</table><br>
<table width='100%' border="1" style="border: 1px solid black; border-collapse: collapse;">
<tr bgcolor='#AED6F1'>
<th align='center' rowspan='3' width='25' ><div align='center'>No</div></th>
<th align='center' rowspan='3' width='210'><div align='center'>SUB BIDANG / KEGIATAN</div></th>
<th align='center' colspan='4'><div align='center'>PERENCANAAN KEGIATAN</div></th>
<th align='center' colspan='5'><div align='center'>MEKANISME PELAKSAAN</div></th>
<th align='center' colspan='4'><div align='center'>REALISASI</div></th>
<th align='center' rowspan='3'><div align='center'>Kodefikasi </div></th>
</tr>
<tr bgcolor='#AED6F1' >
<th align='center' rowspan='2'><div align='center'>Volume</div></th>
<th align='center' rowspan='2'><div align='center'>Satuan</div></th>
<th align='center' rowspan='2'><div align='center'>Jumlah Penerima Manfaat</div></th>
<th align='center' rowspan='2'><div align='center'>Pagu Dak Fisik (Rp. Dlm. ribuan)</div></th>
<th align='center' colspan='2'><div align='center'>Swakelola</div></th>
<th align='center' colspan='2'><div align='center'>Kontraktual</div></th>
<th align='center' rowspan='2'><div align='center'>Metode Pembayaran</div></th>
<th align='center' colspan='2'><div align='center'>Keuangan</div></th>
<th align='center' colspan='2'><div align='center'>Fisik</div></th>
</tr>
<tr bgcolor='#AED6F1'>
<th align='center'><div align='center'>Volume</div></th>
<th align='center'><div align='center'>(Rp. Dalam Ribuan)</div></th>
<th align='center'><div align='center'>Volume</div></th>
<th align='center'><div align='center'>(Rp. Dalam Ribuan)</div></th>
<th align='center'><div align='center'>(Rp. Dalam Ribuan)</div></th>
<th align='center'><div align='center'>(%)</div></th>
<th align='center'><div align='center'>Volume</div></th>
<th align='center'><div align='center'>(%)</div></th>
</tr>
<tr bgcolor='#AED6F1'>
<td align='center'><strong>1</strong> </td>
<td align='center'><strong>2</strong> </td>
<td align='center'><strong>3</strong> </td>
<td align='center'><strong>4</strong> </td>
<td align='center'><strong>5</strong> </td>
<td align='center'><strong>6</strong> </td>
<td align='center'><strong>7</strong> </td>
<td align='center'><strong>8</strong> </td>
<td align='center'><strong>9</strong> </td>
<td align='center'><strong>10</strong> </td>
<td align='center'><strong>11</strong> </td>
<td align='center'><strong>12</strong> </td>
<td align='center'><strong>13</strong> </td>
<td align='center'><strong>14</strong> </td>
<td align='center'><strong>15</strong> </td>
<td align='center'><strong>16</strong> </td>
</tr> 






<tr>
<td align='center'>A</td>
<td ><strong>DAK FISIK REGULER</strong> </td>
<td align='center'><strong>{{ $dakreguler_volume }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_satuan }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_jumlahpmanfaat }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_pagudakfisik }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_swakelolavol }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_swakelolanilai }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_kontraktualvol }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_kontraktualnilai }}</strong> </td>
<td align='center'><strong></strong> </td>
<td align='center'><strong>{{ $dakreguler_keuangan }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_keuanganpersen }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_fisikvol }}</strong> </td>
<td align='center'><strong>{{ $dakreguler_fisikpersen }}</strong> </td>
<td align='center'><strong></strong> </td>


<!-- ============================================= PENDIDIKAN ==================================================== -->
	@php
	$cek1 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','1')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek1 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '1')->get();

	$reguler11 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler12 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler13 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler14 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler15 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler16 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler17 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler18 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler19 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler110 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler111 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
    $reguler112 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','1')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler11 }}</td>
		<td align='center'>{{ $reguler12 }}</td>
		<td align='center'>{{ $reguler13 }}</td>
		<td align='center'>{{ $reguler14 }}</td>
		<td align='center'>{{ $reguler15 }}</td>
		<td align='center'>{{ $reguler16 }}</td>
		<td align='center'>{{ $reguler17 }}</td>
		<td align='center'>{{ $reguler18 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler19 }}</td>
		<td align='center'>{{ $reguler110 }}</td>
		<td align='center'>{{ $reguler111 }}</td>
		<td align='center'>{{ $reguler112 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','1')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.namakegiatan','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif

	<!-- ============================================= END PENDIDIKAN ==================================================== -->

	<!-- ============================================= KESEHATAN ==================================================== -->
	@php
	$cek2 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','2')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek2 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '2')->get();

	$reguler21 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler22 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler23 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler24 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler25 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler26 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler27 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler28 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler29 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler210 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler211 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler212 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','2')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler21 }}</td>
		<td align='center'>{{ $reguler22 }}</td>
		<td align='center'>{{ $reguler23 }}</td>
		<td align='center'>{{ $reguler24 }}</td>
		<td align='center'>{{ $reguler25 }}</td>
		<td align='center'>{{ $reguler26 }}</td>
		<td align='center'>{{ $reguler27 }}</td>
		<td align='center'>{{ $reguler28 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler29 }}</td>
		<td align='center'>{{ $reguler210 }}</td>
		<td align='center'>{{ $reguler211 }}</td>
		<td align='center'>{{ $reguler212 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','2')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END KESEHATAN ==================================================== -->

	<!-- ============================================= PERUMAHAN ==================================================== -->
	@php
	$cek3 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','3')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek3 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '3')->get();

	$reguler31 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler32 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler33 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler34 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler35 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler36 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler37 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler38 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler39 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler310 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler311 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler312 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','3')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler31 }}</td>
		<td align='center'>{{ $reguler32 }}</td>
		<td align='center'>{{ $reguler33 }}</td>
		<td align='center'>{{ $reguler34 }}</td>
		<td align='center'>{{ $reguler35 }}</td>
		<td align='center'>{{ $reguler36 }}</td>
		<td align='center'>{{ $reguler37 }}</td>
		<td align='center'>{{ $reguler38 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler39 }}</td>
		<td align='center'>{{ $reguler310 }}</td>
		<td align='center'>{{ $reguler311 }}</td>
		<td align='center'>{{ $reguler312 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','3')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END PERUMAHAN ==================================================== -->

	<!-- ============================================= INDUSTRI KECIL ==================================================== -->
	@php
	$cek4 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','4')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek4 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '4')->get();

	$reguler41 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler42 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler43 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler44 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler45 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler46 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler47 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler48 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler49 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler410 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler411 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler412 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','4')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler41 }}</td>
		<td align='center'>{{ $reguler42 }}</td>
		<td align='center'>{{ $reguler43 }}</td>
		<td align='center'>{{ $reguler44 }}</td>
		<td align='center'>{{ $reguler45 }}</td>
		<td align='center'>{{ $reguler46 }}</td>
		<td align='center'>{{ $reguler47 }}</td>
		<td align='center'>{{ $reguler48 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler49 }}</td>
		<td align='center'>{{ $reguler410 }}</td>
		<td align='center'>{{ $reguler411 }}</td>
		<td align='center'>{{ $reguler412 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','4')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END INDUSTRI ==================================================== -->

	<!-- ============================================= PERTANIAN ==================================================== -->
	@php
	$cek5 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','5')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek5 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '5')->get();

	$reguler51 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler52 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler53 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler54 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler55 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler56 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler57 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler58 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler59 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler510 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler511 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler512 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','5')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler51 }}</td>
		<td align='center'>{{ $reguler52 }}</td>
		<td align='center'>{{ $reguler53 }}</td>
		<td align='center'>{{ $reguler54 }}</td>
		<td align='center'>{{ $reguler55 }}</td>
		<td align='center'>{{ $reguler56 }}</td>
		<td align='center'>{{ $reguler57 }}</td>
		<td align='center'>{{ $reguler58 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler59 }}</td>
		<td align='center'>{{ $reguler510 }}</td>
		<td align='center'>{{ $reguler511 }}</td>
		<td align='center'>{{ $reguler512 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','5')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END PERTANIAN ==================================================== -->

	<!-- ============================================= KELAUTAN ==================================================== -->
	@php
	$cek6 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','6')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek6 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '6')->get();

	$reguler61 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler62 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler63 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler64 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler65 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler66 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler67 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler68 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler69 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler610 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler611 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler612 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','6')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler61 }}</td>
		<td align='center'>{{ $reguler62 }}</td>
		<td align='center'>{{ $reguler63 }}</td>
		<td align='center'>{{ $reguler64 }}</td>
		<td align='center'>{{ $reguler65 }}</td>
		<td align='center'>{{ $reguler66 }}</td>
		<td align='center'>{{ $reguler67 }}</td>
		<td align='center'>{{ $reguler68 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler69 }}</td>
		<td align='center'>{{ $reguler610 }}</td>
		<td align='center'>{{ $reguler611 }}</td>
		<td align='center'>{{ $reguler612 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','6')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END KELAUTAN ==================================================== -->

	<!-- ============================================= PARIWISATA ==================================================== -->
	@php
	$cek7 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','7')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek7 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '7')->get();

	$reguler71 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler72 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler73 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler74 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler75 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler76 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler77 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler78 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler79 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler710 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler711 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler712 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','7')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler71 }}</td>
		<td align='center'>{{ $reguler72 }}</td>
		<td align='center'>{{ $reguler73 }}</td>
		<td align='center'>{{ $reguler74 }}</td>
		<td align='center'>{{ $reguler75 }}</td>
		<td align='center'>{{ $reguler76 }}</td>
		<td align='center'>{{ $reguler77 }}</td>
		<td align='center'>{{ $reguler78 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler79 }}</td>
		<td align='center'>{{ $reguler710 }}</td>
		<td align='center'>{{ $reguler711 }}</td>
		<td align='center'>{{ $reguler712 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','7')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END PARIWISATA ==================================================== -->

	<!-- ============================================= JALAN ==================================================== -->
	@php
	$cek8 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','8')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek8 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '8')->get();

	$reguler81 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler82 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler83 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler84 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler85 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler86 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler87 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler88 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler89 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler810 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler811 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler812 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','8')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler81 }}</td>
		<td align='center'>{{ $reguler82 }}</td>
		<td align='center'>{{ $reguler83 }}</td>
		<td align='center'>{{ $reguler84 }}</td>
		<td align='center'>{{ $reguler85 }}</td>
		<td align='center'>{{ $reguler86 }}</td>
		<td align='center'>{{ $reguler87 }}</td>
		<td align='center'>{{ $reguler88 }}</td>
		<td align='center'></td
		<td align='center'>{{ $reguler89 }}</td>
		<td align='center'>{{ $reguler810 }}</td>
		<td align='center'>{{ $reguler811 }}</td>
		<td align='center'>{{ $reguler812 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','8')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END JALAN ==================================================== -->

	<!-- ============================================= AIR MINUM ==================================================== -->
	@php
	$cek9 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','9')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek9 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '9')->get();

	$reguler91 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler92 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler93 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler94 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler95 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler96 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler97 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler98 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler99 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler910 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler911 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler912 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','9')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler91 }}</td>
		<td align='center'>{{ $reguler92 }}</td>
		<td align='center'>{{ $reguler93 }}</td>
		<td align='center'>{{ $reguler94 }}</td>
		<td align='center'>{{ $reguler95 }}</td>
		<td align='center'>{{ $reguler96 }}</td>
		<td align='center'>{{ $reguler97 }}</td>
		<td align='center'>{{ $reguler98 }}</td>
		<td align='center'></td
		<td align='center'>{{ $reguler99 }}</td>
		<td align='center'>{{ $reguler910 }}</td>
		<td align='center'>{{ $reguler911 }}</td>
		<td align='center'>{{ $reguler912 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','9')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END AIR MINUM ==================================================== -->

	<!-- ============================================= SANITASI ==================================================== -->
	@php
	$cek10 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','10')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek10 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '10')->get();

	$reguler101 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler102 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler103 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler104 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler105 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler106 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler107 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler108 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler109 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler1010 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler1011 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler1012 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','10')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler101 }}</td>
		<td align='center'>{{ $reguler102 }}</td>
		<td align='center'>{{ $reguler103 }}</td>
		<td align='center'>{{ $reguler104 }}</td>
		<td align='center'>{{ $reguler105 }}</td>
		<td align='center'>{{ $reguler106 }}</td>
		<td align='center'>{{ $reguler107 }}</td>
		<td align='center'>{{ $reguler108 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler109 }}</td>
		<td align='center'>{{ $reguler1010 }}</td>
		<td align='center'>{{ $reguler1011 }}</td>
		<td align='center'>{{ $reguler1012 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','10')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END SANITASI ==================================================== -->

	<!-- ============================================= IRIGASI ==================================================== -->
	@php
	$cek11 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','11')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek11 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '11')->get();

	$reguler111 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler112 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler113 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler114 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler115 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler116 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler117 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler118 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler119 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler1110 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler1111 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler1112 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','11')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler111 }}</td>
		<td align='center'>{{ $reguler112 }}</td>
		<td align='center'>{{ $reguler113 }}</td>
		<td align='center'>{{ $reguler114 }}</td>
		<td align='center'>{{ $reguler115 }}</td>
		<td align='center'>{{ $reguler116 }}</td>
		<td align='center'>{{ $reguler117 }}</td>
		<td align='center'>{{ $reguler118 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler119 }}</td>
		<td align='center'>{{ $reguler1110 }}</td>
		<td align='center'>{{ $reguler1111 }}</td>
		<td align='center'>{{ $reguler1112 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','11')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END IRIGASI ==================================================== -->

	<!-- ============================================= PASAR ==================================================== -->
	@php
	$cek12 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','12')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek12 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '12')->get();

	$reguler121 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler122 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler123 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler124 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler125 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler126 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler127 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler128 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler129 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler1210 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler1211 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler1212 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','12')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler121 }}</td>
		<td align='center'>{{ $reguler122 }}</td>
		<td align='center'>{{ $reguler123 }}</td>
		<td align='center'>{{ $reguler124 }}</td>
		<td align='center'>{{ $reguler125 }}</td>
		<td align='center'>{{ $reguler126 }}</td>
		<td align='center'>{{ $reguler127 }}</td>
		<td align='center'>{{ $reguler128 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler129 }}</td>
		<td align='center'>{{ $reguler1210 }}</td>
		<td align='center'>{{ $reguler1211 }}</td>
		<td align='center'>{{ $reguler1212 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','12')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END PASAR ==================================================== -->

	<!-- ============================================= LINGKUNGAN ==================================================== -->
	@php
	$cek13 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','13')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek13 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '13')->get();

	$reguler131 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler132 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler133 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler134 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler135 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler136 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler137 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler138 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler139 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler1310 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler1311 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler1312 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','13')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler131 }}</td>
		<td align='center'>{{ $reguler132 }}</td>
		<td align='center'>{{ $reguler133 }}</td>
		<td align='center'>{{ $reguler134 }}</td>
		<td align='center'>{{ $reguler135 }}</td>
		<td align='center'>{{ $reguler136 }}</td>
		<td align='center'>{{ $reguler137 }}</td>
		<td align='center'>{{ $reguler138 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler139 }}</td>
		<td align='center'>{{ $reguler1310 }}</td>
		<td align='center'>{{ $reguler1311 }}</td>
		<td align='center'>{{ $reguler1312 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','13')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END LINGKUNGAN ==================================================== -->

	<!-- ============================================= TRANSPORTASI ==================================================== -->
	@php
	$cek14 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','14')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek14 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '14')->get();

	$reguler141 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler142 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler143 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler144 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler145 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler146 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler147 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler148 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler149 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler1410 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler1411 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler1412 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','14')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler141 }}</td>
		<td align='center'>{{ $reguler142 }}</td>
		<td align='center'>{{ $reguler143 }}</td>
		<td align='center'>{{ $reguler144 }}</td>
		<td align='center'>{{ $reguler145 }}</td>
		<td align='center'>{{ $reguler146 }}</td>
		<td align='center'>{{ $reguler147 }}</td>
		<td align='center'>{{ $reguler148 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler149 }}</td>
		<td align='center'>{{ $reguler1410 }}</td>
		<td align='center'>{{ $reguler1411 }}</td>
		<td align='center'>{{ $reguler1412 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','14')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END TRANSPORTASI ==================================================== -->

	<!-- ============================================= TRANSPORTASI LAUT ==================================================== -->
	@php
	$cek15 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','15')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek15 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '15')->get();

	$reguler151 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler152 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler153 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler154 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler155 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler156 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler157 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler158 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler159 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler1510 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler1511 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler1512 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','15')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler151 }}</td>
		<td align='center'>{{ $reguler152 }}</td>
		<td align='center'>{{ $reguler153 }}</td>
		<td align='center'>{{ $reguler154 }}</td>
		<td align='center'>{{ $reguler155 }}</td>
		<td align='center'>{{ $reguler156 }}</td>
		<td align='center'>{{ $reguler157 }}</td>
		<td align='center'>{{ $reguler158 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler159 }}</td>
		<td align='center'>{{ $reguler1510 }}</td>
		<td align='center'>{{ $reguler1511 }}</td>
		<td align='center'>{{ $reguler1512 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','15')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END TRANSPORTASI LAUT ==================================================== -->

	<!-- ============================================= SOSIAL ==================================================== -->
	@php
	$cek16 = \Illuminate\Support\Facades\DB::table('data_program')
		->where('kodeskpd', $kodeskpd)
		->where('jenisdak','1')
		->where('subjenisdak','16')
		->where('tahun',$tahundak)->where('triwulan',$triwulandak)
		->count();
	@endphp

	@if($cek16 != 0)
	@php
	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')->where('id', '16')->get();

	$reguler161 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("volume");
	$reguler162 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("satuan");
	$reguler163 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("jumlahpmanfaat");
	$reguler164 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("pagudakfisik");
	$reguler165 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolavol");
	$reguler166 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("swakelolanilai");
	$reguler167 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualnilai");
	$reguler168 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("kontraktualvol");
	$reguler169 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuangan");
	$reguler1610 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("keuanganpersen");
	$reguler1611 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikvol");
	$reguler1612 = DB::table("data_program")->where('jenisdak', '1')->where('subjenisdak','16')->where('tahun',$tahundak)->where('triwulan',$triwulandak)->where('kodeskpd', $kodeskpd)->get()->sum("fisikpersen");
	@endphp

	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;"><strong>{{$xDatasubbelanja->nama}}</strong></td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{ $reguler161 }}</td>
		<td align='center'>{{ $reguler162 }}</td>
		<td align='center'>{{ $reguler163 }}</td>
		<td align='center'>{{ $reguler164 }}</td>
		<td align='center'>{{ $reguler165 }}</td>
		<td align='center'>{{ $reguler166 }}</td>
		<td align='center'>{{ $reguler167 }}</td>
		<td align='center'>{{ $reguler168 }}</td>
		<td align='center'></td>
		<td align='center'>{{ $reguler169 }}</td>
		<td align='center'>{{ $reguler1610 }}</td>
		<td align='center'>{{ $reguler1611 }}</td>
		<td align='center'>{{ $reguler1612 }}</td>
		<td align='center'></td>
		</tr>

			@php
			$x = \Illuminate\Support\Facades\DB::table('data_program')
				->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
				->join('program','data_program.program','program.id')
				->join('kegiatan','data_program.namakegiatan','kegiatan.id')
				->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
				->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
				->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
				->where('data_program.kodeskpd', $kodeskpd)
				->where('data_program.jenisdak','1')
				->where('data_program.subjenisdak','16')
				->where('data_program.tahun', $tahundak)
				->where('data_program.triwulan', $triwulandak)
				->orderBy('data_program.id','asc')
				->get();
			@endphp
			
			@foreach ($x as $y)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td align='right' style="width: 6%; vertical-align: top;"> - </td>
								<td style="width: 94%;">{{$y->namakegiatan}} <br> <small style="padding-left: 10px;"> - {{$y->rincikegiatan}}</small></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'>{{$y->volume}}</td>
				<td align='center'>{{$y->satuan}}</td>
				<td align='center'>{{$y->jumlahpmanfaat}}</td>
				<td align='center'>{{$y->pagudakfisik}}</td>
				<td align='center'>{{$y->swakelolavol}}</td>
				<td align='center'>{{$y->swakelolanilai}}</td>
				<td align='center'>{{$y->kontraktualvol}}</td>
				<td align='center'>{{$y->kontraktualnilai}}</td>
				<td align='center'>{{$y->namametode}}</td>
				<td align='center'>{{$y->keuangan}}</td>
				<td align='center'>{{$y->keuanganpersen}}</td>
				<td align='center'>{{$y->fisikvol}}</td>
				<td align='center'>{{$y->fisikpersen}}</td>
				<td align='center'>{{$y->nama}}</td>
				</tr>
			@endforeach
	@endforeach
	@endif
	<!-- ============================================= END SOSIAL ==================================================== -->



	<!-- @php
	$x = \Illuminate\Support\Facades\DB::table('data_program')
		->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
		->join('program','data_program.program','program.id')
		->join('kegiatan','data_program.namakegiatan','kegiatan.id')
		->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
		->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
		->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
		->where('data_program.kodeskpd', $kodeskpd)
		->where('data_program.jenisdak','1')
		->orderBy('data_program.id','asc')
		->get();
	@endphp

	@foreach ($x as $y)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 5%;">&nbsp;</td>
						<td style="width: 95%;">{{$y->namakegiatan}}</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{$y->volume}}</td>
		<td align='center'>{{$y->satuan}}</td>
		<td align='center'>{{$y->jumlahpmanfaat}}</td>
		<td align='center'>{{$y->pagudakfisik}}</td>
		<td align='center'>{{$y->swakelolavol}}</td>
		<td align='center'>{{$y->swakelolanilai}}</td>
		<td align='center'>{{$y->kontraktualvol}}</td>
		<td align='center'>{{$y->kontraktualnilai}}</td>
		<td align='center'>{{$y->namametode}}</td>
		<td align='center'>{{$y->keuangan}}</td>
		<td align='center'>{{$y->keuanganpersen}}</td>
		<td align='center'>{{$y->fisikvol}}</td>
		<td align='center'>{{$y->fisikpersen}}</td>
		<td align='center'>{{$y->nama}}</td>
		</tr> 
	@endforeach -->

</tr>

<tr>
<td align='center'>B</td>
<td ><strong>DAK FISIK PENUGASAN</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_volume }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_satuan }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_jumlahpmanfaat }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_pagudakfisik }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_swakelolavol }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_swakelolanilai }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_kontraktualvol }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_kontraktualnilai }}</strong> </td>
<td align='center'><strong></strong> </td>
<td align='center'><strong>{{ $dakpenugasan_keuangan }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_keuanganpersen }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_fisikvol }}</strong> </td>
<td align='center'><strong>{{ $dakpenugasan_fisikpersen }}</strong> </td>
<td align='center'><strong></strong> </td>

	@php
	$x = \Illuminate\Support\Facades\DB::table('data_program')
		->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
		->join('program','data_program.program','program.id')
		->join('kegiatan','data_program.namakegiatan','kegiatan.id')
		->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
		->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
		->select(  'data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
		->where('data_program.kodeskpd', $kodeskpd)
		->where('data_program.jenisdak','2')
		->where('data_program.tahun', $tahundak)
		->where('data_program.triwulan', $triwulandak)
		->orderBy('data_program.id','asc')
		->get();
	@endphp

	@foreach ($x as $y)
		<tr>
		<td align='center'></td>
		<td >
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 5%;">&nbsp;</td>
						<td style="width: 95%;">{{$y->namakegiatan}}</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{$y->volume}}</td>
		<td align='center'>{{$y->satuan}}</td>
		<td align='center'>{{$y->jumlahpmanfaat}}</td>
		<td align='center'>{{$y->pagudakfisik}}</td>
		<td align='center'>{{$y->swakelolavol}}</td>
		<td align='center'>{{$y->swakelolanilai}}</td>
		<td align='center'>{{$y->kontraktualvol}}</td>
		<td align='center'>{{$y->kontraktualnilai}}</td>
		<td align='center'>{{$y->namametode}}</td>
		<td align='center'>{{$y->keuangan}}</td>
		<td align='center'>{{$y->keuanganpersen}}</td>
		<td align='center'>{{$y->fisikvol}}</td>
		<td align='center'>{{$y->fisikpersen}}</td>
		<td align='center'>{{$y->nama}}</td>
		</tr> 
	@endforeach

</tr>


<tr>
<td align='center'>C</td>
<td ><strong>DAK FISIK AFFIRMASI</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_volume }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_satuan }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_jumlahpmanfaat }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_pagudakfisik }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_swakelolavol }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_swakelolanilai }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_kontraktualvol }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_kontraktualnilai }}</strong> </td>
<td align='center'><strong></strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_keuangan }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_keuanganpersen }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_fisikvol }}</strong> </td>
<td align='center'><strong>{{ $dakaffirmasi_fisikpersen }}</strong> </td>
<td align='center'><strong></strong> </td>

	@php
	$x = \Illuminate\Support\Facades\DB::table('data_program')
		->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
		->join('program','data_program.program','program.id')
		->join('kegiatan','data_program.namakegiatan','kegiatan.id')
		->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
		->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
		->select(  'data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
		->where('data_program.kodeskpd', $kodeskpd)
		->where('data_program.jenisdak','3')
		->where('data_program.tahun', $tahundak)
		->where('data_program.triwulan', $triwulandak)
		->orderBy('data_program.id','asc')
		->get();
	@endphp

	@foreach ($x as $y)
		<tr>
		<td align='center'></td>
		<td >
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 5%;">&nbsp;</td>
						<td style="width: 95%;">{{$y->namakegiatan}}</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'>{{$y->volume}}</td>
		<td align='center'>{{$y->satuan}}</td>
		<td align='center'>{{$y->jumlahpmanfaat}}</td>
		<td align='center'>{{$y->pagudakfisik}}</td>
		<td align='center'>{{$y->swakelolavol}}</td>
		<td align='center'>{{$y->swakelolanilai}}</td>
		<td align='center'>{{$y->kontraktualvol}}</td>
		<td align='center'>{{$y->kontraktualnilai}}</td>
		<td align='center'>{{$y->namametode}}</td>
		<td align='center'>{{$y->keuangan}}</td>
		<td align='center'>{{$y->keuanganpersen}}</td>
		<td align='center'>{{$y->fisikvol}}</td>
		<td align='center'>{{$y->fisikpersen}}</td>
		<td align='center'>{{$y->nama}}</td>
		</tr> 
	@endforeach

</tr>
	
<!-- @php $i=1 @endphp-->

<tr>
<td align='center'></td>
<td align='center'><strong>JUMLAH</strong></td>
<td align='center'>{{ $volume }}</td>
<td align='center'>{{ $satuan }}</td>
<td align='center'>{{ $jumlahpmanfaat }}</td>
<td align='center'>{{ $pagudakfisik }}</td>
<td align='center'>{{ $swakelolavol }}</td>
<td align='center'>{{ $swakelolanilai }}</td>
<td align='center'>{{ $kontraktualvol }}</td>
<td align='center'>{{ $kontraktualnilai }}</td>
<td align='center'></td>
<td align='center'>{{ $keuangan }}</td>
<td align='center'>{{ $keuanganpersen }}</td>
<td align='center'>{{ $fisikvol }}</td>
<td align='center'>{{ $fisikpersen }}</td>
<td align='center'></td>
</tr> 
</table>
<br>
<table width=100%>
<tr>
<td style='border:none' width="286"></td>
</tr>
<tr>
<td style='border:none'></td>
<td style='border:none'></td>
<td style='border:none'></td>
<td style='border:none'></td>
<td style='border:none'></td>
<td style='border:none'></td>
<td style='border:none'></td>
<td style='border:none'></td>
<td style='border:none'></td>
<td style='border:none' align="center" colspan='4'>Sulawesi Selatan, {{ $tgl }}<br> KEPALA {{ strtoupper($namaskpd) }} <br><br> <strong>TTD</strong> <br><br>{{ $namakepalaskpd }}<br>NIP : {{ $nipkepalaskpd }}</td>
</tr>
</table>
