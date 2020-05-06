<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id }}">{{ $xdata->nama_skpd }}</option>
@endforeach