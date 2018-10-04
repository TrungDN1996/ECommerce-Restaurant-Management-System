<div class="search-box">
	<div class="row">
        <div class="col-md-6 col-md-offset-3">

            <form action="{{ route('menu.search') }}" method="get" accept-charset="utf-8">
            	<input type="text" name="search" value="{{ request('search')}}" placeholder="search here!!" id="search">
            </form>
        
        </div>
	</div>
</div>

