<option value="00">Semua</option>
@foreach ($kel as $xkel)
<option value="{{ $xkel->kd_kel }}">{{ $xkel->nama_kel }}</option>
@endforeach