<div class="row" style="margin-bottom: 120px;">
	<div class="col-md-6 col-md-push-8">

		<form action="{{ route('menu.filter') }}" method="get" accept-charset="utf-8"> 

			<button type="submit" class="btn btn-primary" style="font-size: 18px;">
				<a><i class="fas fa-search-dollar" style="font-size: 2.5rem;"></i></a>Filter Price
			</button>

			<input style="width: 100px;" type="number" name="min" placeholder="Min" value="{{Request('min') }}">

			<span>To</span>

			<input style="width: 100px;" type="number" name="max" placeholder="Max" value="{{ Request('max') }}"> 

		</form>

	</div>
</div>