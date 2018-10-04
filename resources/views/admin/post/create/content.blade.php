{{-- Post Title --}}
<div class="form-group post-title-wrap">

	<label for="postTitle"><strong>Title*:</strong></label>

	<input type="text" name="title" id="postTitle" class="form-control" required>

</div>

{{-- Post Slug --}}
<div class="form-group post-slug-wrap">

	<strong>Slug:&nbsp;&nbsp;</strong>

	<span id="postSlugSpan">No value</span>

	<input type="hidden" name="slug" value="" id="postSlug">

	<div class="col-auto d-inline">
		<a href="#" id="editPostSlugButton">Edit</a>

		<span id="postSlugActionWrap" class="d-none">

			<a href="#" id="cancelEditPostSlug">Cancel</a>

			&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;

			<a href="#" id="saveEditPostSlug">Save</a>

		</span>
	</div>

</div>

<div class="row m-0">
	<button class="btn btn-info" type="button" id="addMediaButton">Add Media</button>
</div>


{{-- Post Content --}}
<div class="form-group post-content-wrap">

	<label for="postContent"><strong>Content*:</strong></label>

	<textarea name="content" id="postContent" rows="15" class="form-control p-0" required>
	</textarea>

</div>

{{-- Post Excerpt --}}
<div class="form-group">

	<label for="postExcept"><strong>Except:</strong></label>

	<textarea name="except" id="postExcept" rows="3" class="form-control"></textarea>

</div>
