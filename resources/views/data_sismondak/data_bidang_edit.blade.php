@foreach ($data as $xdata)
    @php
	$s = "";
	if( $xdata->id == $bidang){
		$s = "Selected";
	}
	@endphp
<option value="{{ $xdata->id }}" {{ $s }}>{{ $xdata->namabidang }}</option>
@endforeach