<table id="datatable-slide" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th class="text-center" width="1%">No</th>
            <th class="text-center" width="10%">Tahun Periode</th>
            <th class="text-center" width="35%">Nama Periode</th>
            <th class="text-center" width="8%">Tanggal Hitung</th>
            <th class="text-center" width="5%">Tampil</th>
            <th class="text-center" width="5%">Aktif</th>
            <th class="text-center" width="5%">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 0 @endphp
    @foreach ($data as $xdata)
    @php $no++ @endphp
    <tr>
        <td class="text-center">{{ $no }}</td>
        <td >{{ $xdata->tahun_periode }}</td>
        <td>{{ $xdata->nama_periode }}</td>
        <td class="text-center" >{{ $xdata->tanggal_hitung }}</td>
        @if($xdata->tampil == 'T')
            <td class="text-center"> <button class="btn btn-danger btn-xs" >Tidak</button> </td>
        @else
            <td class="text-center"> <button class="btn btn-success btn-xs" >Ya</button> </td>
        @endif

        @if($xdata->aktif == 'T')
            <td class="text-center"> <button class="btn btn-danger btn-xs" >Tidak</button> </td>
        @else
            <td class="text-center"><button class="btn btn-success btn-xs" >Ya</button> </td>
        @endif
        <td class="text-center">
                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModalEdit" 
                
                onclick="editData(
                    
                    '{{ $xdata->id_periode }}',
                    '{{ $xdata->tahun_periode }}',
                    '{{ $xdata->nama_periode }}',
                    '{{ $xdata->tanggal_hitung }}',
                    '{{ $xdata->tampil }}',
                    '{{ $xdata->aktif }}',
                    
                    );"> 
                
                
                <i class="fa fa-pencil"></i> </button>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
