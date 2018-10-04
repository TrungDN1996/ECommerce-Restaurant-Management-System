<div id="top-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="home-account">
                    <a href="{{ route('home') }}" style="text-decoration: none;"><i class="fas fa-home" style="font-size: 2rem; margin-right: 10px;"></i>Home</a>
                    @if (Auth::check())
                        @if (Auth::user()->role == 'user' )
                            <a href="{{ route('user.home') }}" style="text-decoration: none;"><i class="fas fa-user" style="font-size: 2rem; margin-right: 10px;"></i>My account</a>
                        @else
                            <a href="{{ route('admin.home') }}" style="text-decoration: none;"><i class="fas fa-user" style="font-size: 2rem; margin-right: 10px;"></i>My account</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"><i class="fas fa-user" style="font-size: 2rem; margin-right: 10px;"></i>Login</a>
                    @endif
                </div>
            </div>

            <!-- Cart Button -->
            <div class="col-md-2 col-md-offset-4 text-right">
                <a href="{{ route('user.cart.index') }}" class="notification">
                    <i class="fas fa-shopping-cart" style="font-size: 3rem;"></i>
                    <span class="badge">{{ Cart::instance('shopping')->count() }}</span>
                </a>
            </div>
            <!-- End Cart Button -->

        </div>
    </div>
</div>
