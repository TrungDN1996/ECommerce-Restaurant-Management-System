<div class="row m-0" id="post-product-wrap">
    <div class="col-12 col-sm-4 p-0" id="post-product-img-wrap">
        @if (empty($post->thumbnail))
            <img src="{{ asset('/media/image/post_product_default.jpg') }}" alt="No Image" title="Product image" class="img-responsive">
        @else
            <img src="{{ asset($post->thumbnail) }}" alt="">
        @endif
    </div>
    <div class="col-12 col-sm-8 p-0" id="post-product-content">
        <div class="row m-0 product-name-wrap">
            <h2 class="product-name">{{ $post->product->name }}</h2>
        </div>
        <div class="row m-0">
            <strong class="mr-4">Type:</strong>
            <span class="product-type">{{ $post->product->type }}</span>
        </div>
        <div class="row m-0">
            <strong class="mr-4">Price:</strong>
            <span class="product-price">{{ $post->product->price }}</span>
        </div>
        <div class="row m-0">
            <strong class="mr-4">Category:</strong>
            <span class="product-category">{{ $post->product->category->name }}</span>
        </div>
        <div class="row m-0">
            <strong class="mr-4">Status:</strong>
            @if ($post->product->status == 0)
                <span class="product-out-stock">Out of Stock</span>
            @else
                <span class="product-in-stock">In Stock</span>
            @endif
        </div>
        <div class="row m-0">
            <strong class="mr-4">Description</strong>
            <div class="product-description w-100">{{ $post->product->description }}</div>
        </div>
        <div class="row m-0 add-to-cart">
            <form action="{{ route('user.cart.store') }}" method="POST" accept-charset="utf-8">
                {{ csrf_field() }}

                <input type="hidden" name="id" value="{{ $post->id }}">
                <input type="hidden" name="name" value="{{ $post->product->name }}">
                <input type="hidden" name="price" value="{{ $post->product->price }}">
                <button type="submit" class="btn btn-primary">Add To Cart</button>
            </form>
        </div>
    </div>
</div>
