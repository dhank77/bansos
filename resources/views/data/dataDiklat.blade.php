<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id_diklat }}">{{ $xdata->nm_diklat }}</option>
@endforeach