@foreach ($data as $xdata)
    @php
	$s = "";
	if( $xdata->id == $program){
		$s = "Selected";
	}
	@endphp
<option value="{{ $xdata->id }}" {{ $s }}>{{ $xdata->namaprogram }}</option>
@endforeach