{{-- Publish block --}}
<div class="row post-sidebar-block" id="publish-block">
	<div class="col-12 block-header">
		<h5>Publish</h5>
	</div>
	<div class="col-12 block-content">
		{{-- Draft and Preview --}}
		<div class="row py-3">
			<button class="btn btn-info col-auto" id="draftPostButton">Draft</button>

			<button class="btn btn-info col-auto ml-auto" id="previewPostButton">Preview</button>
		</div>

		{{-- Post Status Info --}}
		<div class="row flex-column">
			<p class="mb-2"><strong>Status:</strong></p>
			<p class="m-0"><strong>Published on:</strong></p>
		</div>
	</div>
	<div class="col-12 block-footer py-3">

		{{-- Trash and Update and Publish --}}
		<div class="row">
			{{-- <input type="button" value="Move to Trash" name="trash-post" action="trash" class="btn btn-light col-auto"> --}}
			<button class="btn btn-dark col-auto ml-auto" id="publishPostButton">Publish</button>
		</div>

	</div>
</div>

{{-- Option Block --}}
<div class="row post-sidebar-block" id="option-block">
	<div class="col-12 block-header">
		<h5>Options</h5>
	</div>
	<div class="col-12 block-content">
		<div class="row">
			{{-- Select Post Type: post - post_product --}}
			<div class="form-group col-12 py-3">
				<label for="postType">Post Types:</label>
				<select name="type" id="postType" class="col-auto">
					<option value="post">Post</option>
					<option value="post_product">Product</option>
				</select>
			</div>

			{{-- select product when postType = product --}}
			<div class="form-group col-12 py-3 d-none" id="postProductWrap">
				<label for="postProduct">Product ID:</label>
				@if (empty($products->toArray()))
					<span>No Product Available</span>
				@else
					<select name="product_id" id="postProduct" class="custom-select">
						<option value="none">None</option>
						@foreach ($products as $product)
							<option value="{{ $product->id }}">{{ $product->id.' - '.$product->name }}</option>
						@endforeach
					</select>
				@endif
			</div>

			{{-- Allow Comment --}}
			<div class="checkbox col-12 py-3">
				<label><input type="checkbox" name="comment" value="1" checked>&nbsp;&nbsp;&nbsp;Allow comments</label>
			</div>

			{{-- Select Author of Post --}}
			<div class="form-group col-12 py-3">
				<label for="postAuthor">Author:</label>
				<select name="author" id="postAuthor" class="col-auto">
					{!! get_author_option_list(Auth::id()) !!}
				</select>
			</div>
		</div>
	</div>
</div>

{{-- Category Block --}}
<div class="row post-sidebar-block" id="categories-block">
	<div class="col-12 block-header">
		<h5>Select Category</h5>
	</div>
	<div class="col-12 block-content">
		<select name="category_id" class="custom-select" id="postCategory">
			<option value="null">---Select category---</option>
			{!! option_list_cate($categories_post) !!}
		</select>
	</div>
</div>

{{-- Post Thumbnail Block --}}
<div class="row post-sidebar-block" id="thumbnail-block">
	<div class="col-12 block-header">
		<h5>Post Thumbnail</h5>
	</div>
	<div class="col-12 block-content">
		<a href="#" id="postThumbnailButton">Set Feature Image</a>
		<img src="" class="d-none" id="postThumbnailImage">
		<input type="hidden" name="thumbnail" value="" id="postThumbnail">
	</div>
</div>
