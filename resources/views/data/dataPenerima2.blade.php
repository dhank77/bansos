<table id="datatable-slide2" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th class="text-center" width="1%">No</th>
            <th class="text-center" width="10%">NIP</th>
            <th class="text-center" width="35%">Nama</th>
            <th class="text-center" width="8%">Tgl Masuk</th>
            <th class="text-center" width="8%">Lama Kerja</th>
            <th class="text-center" width="5%">Kategori</th>
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
        <td class="text-center" >{{ $xdata->tmtcpns }}</td>
        @php
        $x = substr($xdata->tmtcpns,0,4);
        $y = date('Y');
        $z = $y - $x;
        @endphp
        <td>{{ $z }} Tahun</td>
        <td class="text-center">
            @if ($z <= 10)
                <button class="btn btn-xs btn-warning"> Periode 10 Tahun</button>  
            @elseif ($z <= 20)
                <button class="btn btn-xs btn-success"> Periode 20 Tahun</button>
            @else
                <button class="btn btn-xs btn-info"> Periode 30 Tahun</button>
            @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
