

                 	<a style="font-size: 15px; padding: 5px; padding-left: 10px; padding-right: 10px; background-color: #fff; border-radius: 10px;" href=""> <strong> <i class="fa fa-folder-open-o" ></i> Berita Terbaru </strong> </a> <br><br>
                    @foreach($berita as $rBerita)
                    <div class="row">
                        <div class="col-sm-12">
                                <a href="/detail/berita/{{ $rBerita->id }}">{{ $rBerita->judul }}</a>
                                <hr style="margin: 3px">
                        </div>
                    </div>
                    @endforeach