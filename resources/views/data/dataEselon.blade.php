<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->id_eselon }}">{{ $xdata->nama_eselon }}</option>
@endforeach