<table id="datatable-slide" class="table table-striped table-bordered table-hover display nowrap" width="100%">
    <thead>
        <tr>
            <th class="text-center" width="1%">No</th>
            <th class="text-center" >Nama Skpd</th>
            <th class="text-center" >Usul</th>
            <th class="text-center" >Terima</th>
            <th class="text-center" >Tolak</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 0 @endphp
    @foreach ($dataunker as $xdataunker)
    @php $no++ @endphp
    <tr>
        <td class="text-center" >{{ $no }}</td>
        <td >{{ $xdataunker->unker }}</td>
        <td class="text-center" >{{ $xdataunker->datausul }}</td>
        <td class="text-center" >{{ $xdataunker->datasetujui }}</td>
        <td class="text-center" >{{ $xdataunker->datatolak }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
