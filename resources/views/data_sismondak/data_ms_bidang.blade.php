<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id }}">{{ $xdata->namabidang }}</option>
@endforeach