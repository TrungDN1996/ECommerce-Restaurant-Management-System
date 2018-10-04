<div class="container">

    <!-- Top Footer -->
    <div class="top-footer">
        <div class="row">
            <div class="col-md-3">
                <div class="social-bottom">
                    <span style="margin-top: 10px;">Follow us:</span>
                    <ul>
                        <li><a href="#"><i class="fab fa-instagram" style="font-size: 5rem; color: black;"></i></a></li>
                        <li><a href="#"><i class="fab fa-facebook-square" style="font-size: 5rem; color: black;"></i></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Footer -->

    <!-- Main footer -->
    <div class="main-footer" style="margin-bottom: 20px;">
        <div class="row">

            <!-- Categories -->
            <div class="col-md-4">
                <div class="shop-list">
                    <h4 class="footer-title">Food Categories</h4>
                    <ul>
                        @foreach($productCates as $productCate)
                            <li>
                                <a href="{{ route('menu.category.show', $productCate->slug) }}">
                                    <i class="fas fa-angle-right"></i>{{ $productCate->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="shop-list">
                    <h4 class="footer-title">Blog Categories</h4>
                    <ul>
                        @foreach($postCates as $postCate)

                            <li>
                                <a href="{{ route('blog.category.show', $postCate->slug) }}">
                                    <i class="fas fa-angle-right"></i>{{ $postCate->name }}
                                </a>
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- End Categories -->

            <!-- Info Contact -->
            <div class="col-md-3">
                <h4 class="footer-title">Contact</h4>
                 @include('site.sidebar.info_contact')
            </div>
            <!-- End Info Contact -->
        </div>
    </div>
    <!-- End Main Footer-->

</div>
