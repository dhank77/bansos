					<a style="font-size: 15px; padding: 5px; padding-left: 10px; padding-right: 10px; background-color: #fff; border-radius: 10px;" href=""> <strong> <i class="fa fa-folder-open-o" ></i> Kategori Produk Hukum</strong> </a> <br><br>
                    @foreach($kategori as $rKategori)
                    <div class="row">
                        <div class="col-sm-12">
                                <button style="background-color: white; border: 0;" onclick="butcarikategori{{ $rKategori->id_kategori }}()" id="kategori{{ $rKategori->id_kategori }}" value="{{ $rKategori->namakategori }}">{{ $rKategori->namakategori }}</button>
                                <hr style="margin: 3px">
                        </div>
                    </div>
                    @endforeach

                    