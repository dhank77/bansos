<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id_jk }}">{{ $xdata->jenis_kelamin }}</option>
@endforeach