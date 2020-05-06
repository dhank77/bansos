<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id_jab }}">{{ $xdata->nama_jab }}</option>
@endforeach