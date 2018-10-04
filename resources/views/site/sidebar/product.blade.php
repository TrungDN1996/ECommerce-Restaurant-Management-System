<div class="row" style="padding-left: 12px;">
	<h2>
		<a href="{{ route('menu') }}"><i class="fas fa-th-list"></i>Categories</a>
	</h2>
</div>

<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

	@foreach($productCates as $productCate)

		<div class="row" style="width: 250px;">
			<div class="col-md-10 col-md-push-1" style="padding: 0;">
				<a class="nav-link" href="{{ route('menu.category.show', $productCate->slug)  }}">
					<i class="fas fa-chevron-right"></i>{{ $productCate->name }}
				</a>
			</div>
		</div>

	@endforeach

</div>
