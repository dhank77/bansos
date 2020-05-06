
                    @if(count($produk) > 0 )
                    
                    <div class="row">
                        @foreach($produk as $rProduk)
                        <div align="center" class="col-sm-2">
                            @if($rProduk->namakategori == 'Peraturan Gubernur')
                            <img  width="80px" src="assets_public/images/icon/pergub.png">
                            @elseif($rProduk->namakategori == 'Peraturan Daerah')
                            <img  width="80px" src="assets_public/images/icon/perda.png">
                            @endif
                        </div>

                        <div class="col-sm-10">
                            <a href="#" class="blog_datee"><i class="fa fa-calendar"></i>  <small>{{ \Carbon\Carbon::parse($rProduk->tgl)->format('d M Y')}}</small> </a><br>
                                    <a style="font-size: 18px;" href="/detail/produk/{{ $rProduk->id }}"> <strong>{{ $rProduk->nama }}</strong> </a><br>
                                    <span>{{ str_limit($rProduk->judul, 110) }}</span>
                                    <br>
                                    <a href="#">
                                    <small data-toggle="modal" data-target="#lihatModal" onclick="butShow('{{ $rProduk->file }}')"  style="background-color: #E9F1F8; padding: 4px; color: black; border-radius: 5px;" > <i class="fa fa-eye"></i> Lihat</small></a>
                                    
                                    <small style="background-color: #E9F1F8; padding: 4px; margin-left: 5px; color: black; border-radius: 5px;" >Tahun {{ $rProduk->tahun }}</small>

                                    @if($rProduk->namakategori == 'Peraturan Gubernur')
                                    <small style="background-color: #D00003; padding: 4px; margin-left: 5px; color: white; border-radius: 5px;" >{{ $rProduk->namakategori }}</small>
                                    @elseif($rProduk->namakategori == 'Peraturan Daerah')
                                    <small style="background-color: #FFB908; padding: 4px; margin-left: 5px; color: black; border-radius: 5px;" >{{ $rProduk->namakategori }}</small>
                                    @endif
                                    <hr>
                        </div>
                        @endforeach
                    </div>
                    
                    @else
                    <div align="center"><strong> <h5>Data Tidak Ditemukan</h5> </strong> </div>
                    @endif

                    <div>
                        {{ $produk->links() }}
                    </div>