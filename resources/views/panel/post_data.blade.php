            <div class="hpanel">
                <div  class="panel-body">
                    <table id="produkk" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="1%">No</th>
                                <th class="text-center" width="10%">Tanggal</th>
                                <th class="text-center" width="20%">Judul</th>
                                <th class="text-center" width="20%">Link</th>
                                <th class="text-center" width="5%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($post as $xpost)
                            @php $no++; @endphp
                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center" >{{ $xpost->createdAt }}</td>
                                <td><i data-toggle="modal" data-target="#showModal" onclick="butShow('{{ $xpost->gambar }}')" style="color: green;" class="fa fa-photo"> </i> {{ $xpost->judul }}</td>
                                <!-- <td class="text-center" > <img style="width: 50px; height: 50px;" src="../assets_public/file/{{ $xpost->gambar }}"> </td> -->
                                <td class="text-center" >{{ $xpost->link }}</td>
                                <td class="text-center" >

                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" onclick="butEdit('{{ $xpost->id }}','{{ $xpost->judul }}','{{ $xpost->link }}')"><i class="fa fa-pencil"></i></button> |

                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="butDelete('{{ $xpost->id }}','{{ $xpost->judul }}','{{ $xpost->gambar }}')"><i class="fa fa-trash"></i></button> 

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>