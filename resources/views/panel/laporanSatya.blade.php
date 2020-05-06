<!DOCTYPE html>
<html>
<head>
</head>
<body>
<p style="text-align: center;"><strong><span style="color: #000000;">DAFTAR PENERIMA SATYA LENCANA KARYA SATYA</span></strong><br /><strong><span style="color: #000000;">LINGKUP PEMERINTAH PROVINSI SULAWESI SELATAN</span></strong></p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 3%; text-align: center; font-size: 12px;"><span style="color: #000000;"><strong>No</strong></span></td>
<td style="width: 13%; text-align: center; font-size: 12px;"><span style="color: #000000;"><strong>NAMA</strong></span></td>
<td style="width: 13%; text-align: center; font-size: 12px;"><span style="color: #000000;"><strong>NIP</strong></span></td>
<td style="width: 12%; text-align: center; font-size: 12px;"><span style="color: #000000;"><strong>PANGKAT GOL. RUANG</strong></span></td>
<td style="width: 20%; text-align: center; font-size: 12px;"><span style="color: #000000;"><strong>JABATAN</strong></span></td>
<td style="width: 16%; text-align: center; font-size: 12px;"><span style="color: #000000;"><strong>SKPD</strong></span></td>
<td style="width: 5%; text-align: center; font-size: 12px;"><span style="color: #000000;"><strong>PER 10</strong></span></td>
<td style="width: 5%; text-align: center; font-size: 12px;"><span style="color: #000000;"><strong>PER 20</strong></span></td>
<td style="width: 5%; text-align: center; font-size: 12px;"><span style="color: #000000;"><strong>PER 30</strong></span></td>
</tr>
@php $no = 0 @endphp
@foreach ($data as $xdata)
@php $no++ @endphp
<tr>
<td style="width: 3%; text-align: center; font-size: 10px;"><span style="color: #000000;">{{ $no }}</span></td>
<td style="width: 13%; text-align: left; font-size: 10px;" ><span style="color: #000000;">{{ $xdata->nama }}</span></td>
<td style="width: 13%; text-align: center; font-size: 10px;" ><span style="color: #000000;">{{ $xdata->nip }}</span></td>
<td style="width: 12%; text-align: center; font-size: 10px;" ><span style="color: #000000;">{{ $xdata->nama_gol }}</span></td>
<td style="width: 20%; text-align: left; font-size: 10px;" ><span style="color: #000000;">{{ $xdata->nama_jab }}</span></td>
<td style="width: 16%; text-align: left; font-size: 10px;" ><span style="color: #000000;">{{ $xdata->unker }}</span></td>
@if ($xdata->periode_10 == 0)
<td style="width: 5%; text-align: center; font-size: 10px;" ><span style="color: #000000;"></span></td>
@else
<td style="width: 5%; text-align: center; font-size: 10px;" ><span style="color: #000000;">Ya</span></td>
@endif
@if ($xdata->periode_20 == 0)
<td style="width: 5%; text-align: center; font-size: 10px;" ><span style="color: #000000;"></span></td>
@else
<td style="width: 5%; text-align: center; font-size: 10px;" ><span style="color: #000000;">Ya</span></td>
@endif
@if ($xdata->periode_30 == 0)
<td style="width: 5%; text-align: center; font-size: 10px;" ><span style="color: #000000;"></span></td>
@else
<td style="width: 5%; text-align: center; font-size: 10px;" ><span style="color: #000000;">Ya</span></td>
@endif
</tr>
@endforeach
</tbody>
</table>
</body>
</html>