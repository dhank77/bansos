<option value="00">Semua</option>
@foreach ($kec as $xkec)
<option value="{{ $xkec->kd_kec }}">{{ $xkec->nama_kec }}</option>
@endforeach