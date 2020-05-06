<table id="datatable-slide" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th class="text-center" width="1%">No</th>
            <th class="text-center" width="10%">NIP</th>
            <th class="text-center" width="25%">Nama</th>
            <th class="text-center" width="5%">Gol</th>
            <th class="text-center" width="25%">Jabatan</th>
            <th class="text-center" width="5%">Per. 10</th>
            <th class="text-center" width="5%">Per. 20</th>
            <th class="text-center" width="5%">Per. 30</th>
            <th class="text-center" width="5%">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @php $no = 0 @endphp
    @foreach ($data as $xdata)
    @php $no++ @endphp
    <tr>
        <td class="text-center">{{ $no }}</td>
        <td >{{ $xdata->nip }}</td>
        <td>{{ $xdata->nama }}</td>
        <td class="text-center" >{{ $xdata->nama_gol }}</td>
        <td>{{ $xdata->nama_jab }}</td>
        <td class="text-center">
            @if ($xdata->periode_10 == 0)
                <button class="btn btn-xs btn-warning"> <i class="fa fa-close"></i> </button>  
            @else
                <button class="btn btn-xs btn-success"> <i class="fa fa-check"></i> </button>
            @endif
        </td>
        <td class="text-center">
            @if ($xdata->periode_20 == 0)
                <button class="btn btn-xs btn-warning"> <i class="fa fa-close"></i> </button>  
            @else
                <button class="btn btn-xs btn-success"> <i class="fa fa-check"></i> </button>
            @endif
        </td>
        <td class="text-center">
            @if ($xdata->periode_30 == 0)
                <button class="btn btn-xs btn-warning"> <i class="fa fa-close"></i> </button>  
            @else
                <button class="btn btn-xs btn-success"> <i class="fa fa-check"></i> </button>
            @endif
        </td>
        <td class="text-center">
                <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModalEdit" 
                
                onclick="editData(
                    
                    '{{ $xdata->id_p }}',
                    '{{ $xdata->nip }}',
                    '{{ $xdata->nama }}',
                    '{{ $xdata->tgl_lahir }}',
                    '{{ $xdata->kota_lahir }}',
                    '{{ $xdata->alamat }}',
                    '{{ $xdata->agama }}',
                    '{{ $xdata->jkel }}',
                    '{{ $xdata->status }}',
                    '{{ $xdata->tmtcpns }}',
                    '{{ $xdata->golru }}',
                    '{{ $xdata->tmgolru }}',
                    '{{ $xdata->jabatan }}',
                    '{{ $xdata->eselon }}',
                    '{{ $xdata->tmtlantik }}',
                    '{{ $xdata->pendumum }}',
                    '{{ $xdata->jurusan }}',
                    '{{ $xdata->tsttb }}',
                    '{{ $xdata->dikstr }}',
                    '{{ $xdata->ststtpp }}',
                    '{{ $xdata->kdkunker }}',
                    '{{ $xdata->periode_10 }}',
                    '{{ $xdata->periode_20 }}',
                    '{{ $xdata->periode_30 }}',
                    '{{ $xdata->no_kepres_10 }}',
                    '{{ $xdata->no_kepres_20 }}',
                    '{{ $xdata->no_kepres_30 }}'
                    
                    );"> 
                
                
                <i class="fa fa-pencil"></i> </button>  
                <button class="btn btn-xs btn-danger" onclick="HapusData('{{ $xdata->id_p }}')"> <i class="fa fa-trash"></i> </button>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
