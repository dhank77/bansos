<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id_gol }}">{{ $xdata->nama_gol }}</option>
@endforeach