<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id_sker }}">{{ $xdata->status_kerja }}</option>
@endforeach