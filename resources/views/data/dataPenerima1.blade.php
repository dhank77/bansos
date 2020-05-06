<table id="datatable-slide1" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th class="text-center" width="1%">No</th>
            <th class="text-center" width="10%">NIP</th>
            <th class="text-center" width="25%">Nama</th>
            <th class="text-center" width="8%">Tgl Masuk</th>
            <th class="text-center" width="8%">Lama Kerja</th>
            <th class="text-center" width="5%">Kategori</th>
            <th class="text-center" width="10%">Berkas</th>
            @role('superadmin|verifikator')
            <th class="text-center" width="5%">Aksi</th>
            @endrole
            @role('admin')
            <th class="text-center" width="5%">Status</th>
            @endrole
        </tr>
    </thead>
    <tbody>
    @php $no = 0 @endphp
    @foreach ($data as $xdata)
    @php $no++ @endphp

    @php
    $file = \Illuminate\Support\Facades\DB::table('t_berkas')
        ->select('t_berkas.file as files')
        ->join('t_penerima', 't_penerima.id_penerima','t_berkas.id_penerima')
        ->where('t_penerima.id_penerima', $xdata->id_penerima)
        ->get();
    @endphp

    <tr>
        <td class="text-center">{{ $no }}</td>
        <td >{{ $xdata->nip }}</td>
        <td>{{ $xdata->nama }}</td>
        <td class="text-center" >{{ $xdata->tmtcpns }}</td>
        @php
        $x = substr($xdata->tmtcpns,0,4);
        $y = date('Y');
        $z = $y - $x;
        @endphp
        <td>{{ $z }} Tahun</td>
        <td class="text-center">
            @if ($z <= 10)
                <button class="btn btn-xs btn-warning"> Periode 10 Thn</button>  
            @elseif ($z <= 20)
                <button class="btn btn-xs btn-success"> Periode 20 Thn</button>
            @else
                <button class="btn btn-xs btn-info"> Periode 30 Thn</button>
            @endif
        </td>
        <td class="text-center">
            @foreach($file as $xfile)
            <a href="/fileberkas/{{ $xfile->files }}" target="_BLANK" ><button class="btn btn-xs btn-info" style="margin-bottom: 5px;"> Lihat</button></a>
            @endforeach
        </td>
        @role('superadmin|verifikator')
        <td class="text-center">
                <button class="btn btn-xs btn-success" style="margin-bottom: 5px;" 
                
                onclick="alertTerima(
                    
                    '{{ $xdata->id_penerima }}',
                    '{{ $xdata->nama }}',
                    
                    );"> 
                
                <i class="fa fa-check"></i> Terima</button>

                <button class="btn btn-xs btn-danger" onclick="alertTolak('{{ $xdata->id_penerima }}')" data-toggle="modal" data-target="#myModalEdit"><i class="fa fa-close"></i>&nbsp;&nbsp;Tolak&nbsp;&nbsp;</button>
        </td>
        @endrole
        @role('admin')
        <td>

            @if ($xdata->proses == 'T')
            <button class="btn btn-xs btn-warning">Pending</button>
            @else
            <button class="btn btn-xs btn-success">Proses</button>
            @endif

        </td>
        @endrole
    </tr>
    @endforeach
    </tbody>
</table>
