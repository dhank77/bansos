@foreach ($data as $xdata)
    @php
	$s = "";
	if( $xdata->id == $ids){
		$s = "Selected";
	}
	@endphp
<option value="{{ $xdata->id }}" {{ $s }}>{{ $xdata->nama }}</option>
@endforeach