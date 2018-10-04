<div id="latest-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section">
                    <h2>Latest blog posts</h2>
                    <img src="images/under-heading.png" alt="" >
                </div>
            </div>
        </div>
        <div class="row">

            @foreach($recentNews as $recentNew)

                <div class="col-md-4 col-sm-6">
                    <div class="blog-post">
                        <div class="blog-thumb">
                        @if($recentNew->thumbnail == null)
                            <img src="{{ asset('images/about02.jpg') }}" alt="" />
                        @else
                            <img src="#" alt="{{ $recentNew->thumbnail->url }}" />
                        @endif
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="{{ route('blog.post.show', $recentNew->slug) }}" style="text-decoration: none;">{{ $recentNew->title }}</a></h4>
                                <span>{{ $recentNew->created_at }}</span>
                            </div>
                            <div class="content-hide">
                                <p>{{ $recentNew->excerpt }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>
