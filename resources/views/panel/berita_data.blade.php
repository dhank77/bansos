            <div class="hpanel">
                <div  class="panel-body">
                    <table id="beritaa" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">No</th>
                                <th class="text-center" width="2%">Gambar</th>
                                <th class="text-center" width="15%">#</th>
                                <th class="text-center" width="1%">Tanggal</th>
                                <th class="text-center" width="2%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($berita as $xberita)
                            @php $no++; @endphp
                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center" > <img src="/assets_public/images/berita/{{ $xberita->img }}" height="80px"></td>
                                <td class="text-left" > <strong>{{ $xberita->judul }}</strong> <br> <p>{{ str_limit($xberita->desc, 150) }}</p> </td>
                                <td class="text-center" >{{ \Carbon\Carbon::parse($xberita->tgl)->format('d M Y') }}</td>
                                <td class="text-center" >

                                    @php
                                    $descbaru = preg_replace("/[\n\r]/","", $xberita->desc);
                                    @endphp

                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit('{{ $xberita->id }}','{{ $xberita->judul }}','{{ $xberita->tgl }}','{{ $descbaru }}')"><i class="fa fa-pencil"></i></button> | 

                                    <button class="btn btn-sm btn-danger" onclick="alertDeleteBeritaHoax('{{ $xberita->id }}','{{ $xberita->judul }}')">
                                        <i class="fa fa-trash"></i></button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>