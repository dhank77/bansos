<table class="table table-bordered bg-warning">
	<tr>
		<th style="text-align: center">No</th>
		<th style="text-align: center">Hari</th>
		<th style="text-align: center">Tanggal</th>
		<th style="text-align: center">Pejabat</th>
		<th style="text-align: center">Lokasi</th>
		<th style="text-align: center">Kegiatan</th>
	</tr>
    @if ($agenda->count() != 0)
    	@php $no=1 @endphp
        @foreach($agenda as $rowAgenda)
            <tr>
            	<td align="center">{{ $no++ }}</td>
                <td align="center">{{ $rowAgenda->hari }}</td>
                <td align="center">{{ $rowAgenda->tanggal }}</td>
                <td align="center">{{ $rowAgenda->pejabat }}</td>
                <td>{{ $rowAgenda->lokasi }}</td>
                <td>{{ $rowAgenda->kegiatan }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td class="text-center" colspan="6"><i>Tidak ada data.</i></td>
        </tr>
    @endif
</table>