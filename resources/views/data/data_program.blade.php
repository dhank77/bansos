<option value="">- Pilih -</option>
@foreach ($data as $xdata)
<option value="{{ $xdata->kodeprogram }}">{{ $xdata->namaprogram }}</option>
@endforeach