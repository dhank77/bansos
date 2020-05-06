<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id_agama }}">{{ $xdata->nama }}</option>
@endforeach