                        <div id="load" style="display: none;" align="center">
                            <img  src="/assets_public/images/load.gif">
                        </div>
                        @foreach($produk as $rProduk)
                        <div align="center" class="col-sm-2">
                            <img width="80px" src="https://jdih.lkpp.go.id/backend/web/uploads/images/perpres.png">
                        </div>

                        <div class="col-sm-10">
                            <a href="#" class="blog_datee"><i class="fa fa-calendar"></i>  <small>{{ \Carbon\Carbon::parse($rProduk->tgl)->format('d M Y')}}</small> </a><br>
                                    <a style="font-size: 18px;" href="/detail/produk/{{ $rProduk->id }}"> <strong>{{ $rProduk->nama }}</strong> </a><br>
                                    <span>{{ $rProduk->judul }}</span>
                                    <br>
                                    <a href="#">
                                    <small data-toggle="modal" data-target="#lihatModal" onclick="butShow('{{ $rProduk->file }}')"  style="background-color: #e9f1f7; padding: 4px; color: black; border-radius: 5px;" > <i class="fa fa-eye"></i> Lihat</small></a> |
                                    <small style="background-color: #F0F0F0; padding: 4px; color: black; border-radius: 5px;" >Tahun {{ $rProduk->tahun }}</small> | <small style="background-color: #F0F0F0; padding: 4px; color: black; border-radius: 5px;" >{{ $rProduk->namakategori }}</small>
                                    <hr>
                        </div>
                        @endforeach