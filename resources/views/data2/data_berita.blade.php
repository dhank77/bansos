                        @foreach($berita as $xberita)
                          <div class="col-md-4 col-sm-6 col-xs-6 views-row">
                            <div class="views-field views-field-field-image">
                              <div class="field-content post-thumb hover-cycle">
                                <a href="#">
                                  <img style="max-height: 195.54px;" src="/assets_public/images/berita/{{ $xberita->img }}" width="770" height="430" alt="presentation" typeof="foaf:Image" class="img-responsive"></a>
                              </div>
                            </div>

                            <div class="views-field views-field-nothing">
                              <span class="field-content"><div class="post-info">
                                <h3 class="post-title"><a href="/berita/{{ $xberita->id }}/{{ $xberita->slug }}" hreflang="en">{{ $xberita->judul }}</a></h3>
                                  <ul class="post-meta">
                                    <li><i class="fa fa-calendar">&zwnj;</i>{{ \Carbon\Carbon::parse($xberita->createdAt)->format('d M Y')}}</li>
                                  </ul>
                                  <div class="post-desc">{!! nl2br(str_limit($xberita->desc, 120)) !!}</div>
                                </div>
                              </span>
                            </div>
                          </div> 
                          @endforeach

                        <div>
                                {{ $berita->links() }}
                        </div>