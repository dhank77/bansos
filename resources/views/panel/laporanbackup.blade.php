
<head>
<title>Laporan Dak</title>
<style>
		td { font-size: 8px; }
		th { font-size: 10px; }
		</style>
</head>
<body style="margin-top: -30px;">
<center><h6>LAPORAN DANA ALOKASI KHUSUS (DAK)  <br> {{ strtoupper(Auth::user()->name) }} <br> TAHUN ANGGARAN 2020</h6></center><hr style="border: 1.5px solid black; margin-top: -20px;">
<table>
<tr><td style='border:none' width='60px'>Provinsi</td> <td style='border:none' colspan='5' width='260px'>: Sulawesi Selatan</td></tr>
<!-- <tr><td style='border:none'>Kabupaten / Kota</td> <td style='border:none' colspan='5'>: KABUPATEN MAROS</td></tr> -->
<tr><td style='border:none'>SKPD</td> <td style='border:none' colspan='5'>: {{ Auth::user()->name }}</td></tr>
<tr><td style='border:none'>Triwulan</td> <td style='border:none' colspan='5'>: IV</td></tr>
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
	
	@php
	$idsubbelanja = \Illuminate\Support\Facades\DB::table('data_program')
					->where('kodeskpd', Auth::user()->id)
					->where('jenisdak','1')
					->get();
	
    foreach ($idsubbelanja as $xidsubbelanja) {
        $dataidsubbelanja[] = $xidsubbelanja->subjenisdak;
	}

	$datasubbelanja = \Illuminate\Support\Facades\DB::table('ms_sub_belanja')
		->select('ms_sub_belanja.nama as namasubbelanja','ms_sub_belanja.id' )
		->whereIn('ms_sub_belanja.id', $dataidsubbelanja)
		->orderBy('ms_sub_belanja.id','asc')
		->get();
	@endphp
	
	@foreach ($datasubbelanja as $xDatasubbelanja)
		<tr>
		<td align='center'></td>
		<td>
			<table style="border-collapse: collapse; width: 100%;" border="0">
				<tbody>
					<tr>
						<td style="width: 3%;">&nbsp;</td>
						<td style="width: 97%;">{{$xDatasubbelanja->id}} - {{$xDatasubbelanja->namasubbelanja}}</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		<td align='center'></td>
		</tr>

			@php
			$idkegiatan = \Illuminate\Support\Facades\DB::table('data_program')
							->where('kodeskpd', Auth::user()->id)
							->where('jenisdak','1')
							->where('subjenisdak', $xDatasubbelanja->id)
							->get();
			
			foreach ($idkegiatan as $xidkegiatan) {
				$dataidkegiatan[] = $xidkegiatan->namakegiatan;
			}
			@endphp

			@php
			$datakegiatan = \Illuminate\Support\Facades\DB::table('kegiatan')
				->whereIn('id', $dataidkegiatan)
				->orderBy('id','asc')
				->get();
			@endphp
			
			@foreach ($datakegiatan as $xDatakegiatan)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td style="width: 6%;">&nbsp;</td>
								<td style="width: 94%;">{{$xDatakegiatan->namakegiatan}}</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				</tr>
			@endforeach
	@endforeach


	<!-- @php
			$idkegiatan = \Illuminate\Support\Facades\DB::table('data_program')
							->where('kodeskpd', Auth::user()->id)
							->where('jenisdak','1')
							->where('subjenisdak', $xDatasubbelanja->id)
							->get();
			
			foreach ($idkegiatan as $xidkegiatan) {
				$dataidkegiatan[] = $xidkegiatan->namakegiatan;
			}
			@endphp

			@php
			$datakegiatan = \Illuminate\Support\Facades\DB::table('kegiatan')
				->whereIn('id', $dataidkegiatan)
				->orderBy('id','asc')
				->get();
			@endphp
			
			@foreach ($datakegiatan as $xDatakegiatan)

				<tr>
				<td align='center'></td>
				<td>
					<table style="border-collapse: collapse; width: 100%;" border="0">
						<tbody>
							<tr>
								<td style="width: 6%;">&nbsp;</td>
								<td style="width: 94%;">{{$xDatakegiatan->id}}</td>
							</tr>
						</tbody>
					</table>
				</td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				<td align='center'></td>
				</tr>
			@endforeach -->

	

	<!-- @php
	$x = \Illuminate\Support\Facades\DB::table('data_program')
		->join('ms_belanja','data_program.jenisdak','ms_belanja.id')
		->join('program','data_program.program','program.id')
		->join('kegiatan','data_program.namakegiatan','kegiatan.id')
		->join('ms_metodepembayaran','data_program.metodepembayaran','ms_metodepembayaran.id')
		->join('ms_kodefikasi','data_program.kodefikasimasalah','ms_kodefikasi.id')
		->select('data_program.*','ms_belanja.*','program.*','kegiatan.*','ms_metodepembayaran.nama as namametode','ms_kodefikasi.*' )
		->where('data_program.kodeskpd', Auth::user()->id)
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
		->where('data_program.kodeskpd', Auth::user()->id)
		->where('data_program.jenisdak','2')
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
		->where('data_program.kodeskpd', Auth::user()->id)
		->where('data_program.jenisdak','3')
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
<td style='border:none' align="center" colspan='4'>Sulawesi Selatan, {{ $tgl }}<br> KEPALA {{ strtoupper(Auth::user()->name) }} <br><br> <strong>TTD</strong> <br><br>{{ Auth::user()->kepalaopd }}<br>NIP : {{ Auth::user()->nip }}</td>
</tr>
</table>
