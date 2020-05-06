@foreach ($data as $xdata)
    @php
	$s = "";
	if( $xdata->id == $kegiatan){
		$s = "Selected";
	}
	@endphp
<option value="{{ $xdata->id }}" {{ $s }}>{{ $xdata->namakegiatan }}</option>
@endforeach