<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->kodekegiatan }}">{{ $xdata->namakegiatan }}</option>
@endforeach