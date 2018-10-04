<div class="agile-blog-grid" >

	{{-- category title --}}
	@if (isset($category))

		<div class="row" style="margin-bottom: 50px;">
			<h2 class="text-center">Category - {{ $category->name }}</h2>
		</div>

	@endif

	{{-- list all post in category --}}
	@foreach ($posts as $post)

		{{-- post thumbnail --}}
		<div class="agile-blog-grid-left-img">
			@if ($post->thumbnail == null)
				<a href="#"><img src="{{ asset('images/about01.jpg') }}" alt="" /></a>
			@else
				<a href="#"><img src="#" alt="{{ $post->thumbnail->url }}" /></a>
			@endif
		</div>

		<div class="blog-left-grids">

			{{-- Edit Icon --}}
			<div class="blog-left-left" style="margin-bottom: 150px;">
				<a href="#"><i class="fas fa-pencil-alt" style="font-size: 6rem;"></i></a>
			</div>

			{{-- Post Content --}}
			<div class="blog-left-right">

				{{-- Post Title --}}
				<div class="blog-left-right-top">
					<h4>{{ $post->title }}</h4>

					<p>
						Posted By:&nbsp;&nbsp;&nbsp;
						<span class="text-info">{{ $post->user->name }}</span>&nbsp;&nbsp;&nbsp;
						On {{ $post->created_at }}</p>

				</div>

				{{-- Post Excerpt --}}
				<div class="blog-left-right-bottom">
					<p>{{ $post->excerpt}}</p>
					<a href="{{ route('blog.post.show', $post->slug) }}" style="text-decoration: none;">More</a>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	@endforeach

</div>

<nav class="pagination-blog">
	{{ $posts->links() }}
</nav>
