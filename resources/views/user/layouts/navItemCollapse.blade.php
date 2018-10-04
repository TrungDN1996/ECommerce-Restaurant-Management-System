<li class="nav-item">
    <span class="nav-link">
       <div class="row">
            <a href="{{ $link }}" class="col-auto p-0">{{ $item }}</a>
            <a class="ml-auto p-0" href="#{{  $collapse }}" data-toggle="collapse" aria-expanded="false" aria-conteoller="{{ $collapse }}" ><i class="fas fa-chevron-down"></i></a>
       </div>
    </span>
    <div class="collapse pl-3" id="{{ $collapse }}">
        <ul class="nav flex-column nav-pulls nav-fill">
            {{ $subItems }}
        </ul>
    </div>
</li>
