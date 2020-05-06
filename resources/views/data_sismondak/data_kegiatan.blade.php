<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id }}">{{ $xdata->namakegiatan }}</option>
@endforeach