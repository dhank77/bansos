<!-- Widget Area -->
<div class="col-sm-4 col-xs-12 widget-area">
    <!-- Widget Search -->
    <aside class="widget widget-search">
        <!-- input-group -->
        <div class="input-group">
            <input class="form-control" placeholder="Search" type="text">
            <span class="input-group-btn">
                <button type="button"><i class="fa fa-search"></i></button>
            </span>
        </div>
        <!-- /input-group -->
    </aside>
    <!-- Widget Search /- -->
    
    <!-- Recent Post -->
    <aside class="widget wiget-recent-post">
        <h3 class="widget-title">{{ $submenu }} Terkini</h3>
        @foreach($post as $rPost)
            <div class="recent-post-box">
                <div class="recent_wid_pic">
                    <img alt="" style="border-radius: 5%" class="img-responsive" src="{{ asset('assets_public/images/'.$rPost->img) }}">
                </div>
                <div class="recent-title">
                    <a href="{{ route('index.post.view', ['submenu' => $submenu, 'slug' => $rPost->slug]) }}">{{ $rPost->title }}</a>
                    <p>{{ \Carbon\Carbon::parse($rPost->createdAt)->format('d M Y')}}</p>
                </div>
            </div>
        @endforeach
    </aside>

    <div class="col-sm-12" style="display: none;">
                            <nav class="pagination">
                                {{ $post->links() }}
                            </nav>
                        </div>
                    </div>
    <!-- Recent Post /- -->  
</div>

<!-- Widget Area /- -->