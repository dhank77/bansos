<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id_periode }}">{{ $xdata->nama_periode }}</option>
@endforeach