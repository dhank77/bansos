@foreach ($data as $xdata)
    @php
	$s = "";
	if( $xdata->id == $subbidang){
		$s = "Selected";
	}
	@endphp
<option value="{{ $xdata->id }}" {{ $s }}>{{ $xdata->namasubbidang }}</option>
@endforeach