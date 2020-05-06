<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id_pend }}">{{ $xdata->nama_pend }}</option>
@endforeach