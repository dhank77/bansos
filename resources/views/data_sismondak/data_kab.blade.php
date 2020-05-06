<option value="">- Pilih Kab / Kota -</option>
@foreach ($kab as $xkab)
<option value="{{ $xkab->kode_kota }}">{{ $xkab->nama_kota }}</option>
@endforeach