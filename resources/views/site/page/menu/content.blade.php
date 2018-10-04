<div class="row">
	@foreach($posts as $post)
	    <div class="col-md-6" style="height: 370px; margin-bottom: 220px;">
			<div class="thumbnail ">

				@if($post->thumbnail == null)

					<img src="{{ asset('images/img_4157.jpg') }}" alt="" style="height: 250px; width: 400px;">

				@else

					<img src="{{ $post->thumbnail->url }}" alt="No thumbnail" style="height: 250px; width: 400px;">

				@endif

				<div class="caption">

					<a href="{{ route('menu.post.show', $post->slug) }}" style="text-decoration: none;">
						<h3>{{ $post->title }}</h3>
					</a>

					<h4>{{ $post->product->name }}</h4>

					<h2 style="font-size: 20px; font-weight: bold; color: red;">Price: {{ $post->product->price }} USD/Dish</h2>

					<p>{{ $post->excerpt }}</p>

					<div class="row">

						<div class="col-md-6">

						    <form action="{{ route('user.cart.store') }}" method="POST" accept-charset="utf-8">
								{{ csrf_field() }}

								<input type="hidden" name="id" value="{{ $post->id }}">
								<input type="hidden" name="name" value="{{ $post->product->name }}">
								<input type="hidden" name="price" value="{{ $post->product->price }}">
								<button type="submit" class="btn btn-primary">
									<a href="#"><i class="fas fa-cart-plus" style="font-size: 2rem;"></i></a>Add To Cart
								</button>
						    </form>

						</div>
				  	</div>
		        </div>
	    	</div>
	    </div>
	@endforeach
</div>
<!-- Pagination -->
<div class="row" style="margin-left: 4px;">
	{{ $posts->links() }}
</div>
<!-- End Pagination -->
