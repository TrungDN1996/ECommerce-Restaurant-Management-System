<div class="row">
  <div class="col-md-9 col-md-offset-3">
    <h1 class="text-center" style="margin-bottom: 40px;">

        @if(isset($category))
            Category - {{ $category->name }}
        @elseif($posts->total() == 0)
            No Result
        @else
            Found {{ $posts->total() }} Result(s)
        @endif

    </h1>
  </div>
</div>
