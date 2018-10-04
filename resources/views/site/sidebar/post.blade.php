<div class="side-bar">
     <!-- Categories -->
     <div class="news-letters">
        <h4>Categories</h4>
        <div class="archives-list">
            <ul>
                @foreach($postCates as $postCate)
                <li>
                    <a href="{{ route('blog.category.show', $postCate->slug) }}" style="text-decoration: none;">
                        <i class="fas fa-chevron-right"></i>{{ $postCate->name}}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- End Categories --> 

</div>