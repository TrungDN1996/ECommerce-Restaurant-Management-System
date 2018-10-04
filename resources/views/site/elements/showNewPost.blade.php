<div class="image">
    <div class="image-post">
	@if($post->thumbnail == null)
        <img src="{{ asset('images/about01.jpg') }}" alt="">
    @else
    	<img src="#" alt="{{ $post->thumbnail->url }}">
    @endif
    </div>
</div>
<div class="product-content">
    <div class="product-title">
        <h3>{{ $post->title }}</h3>
        Post by:  <span class="subtitle">{{ $post->user->name}}</span>
    </div>
    <p>{{ $post->content }}</p>
</div>
