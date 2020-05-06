<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id }}">{{ $xdata->nama }}</option>
@endforeach