<div id="main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.PNG') }}" title="Logo" alt="Lava Restaurant Logo" width="120px;" height="70px;" >
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-menu">
                    <ul>
                        <li><a href="{{ route('home') }}" style="text-decoration: none;">Home</a></li>
                        <li><a href="{{ route('page.about') }}" style="text-decoration: none;">About</a></li>
                        <li><a href="{{ route('menu') }}"  style="text-decoration: none;">Menu</a></li>
                        <li><a href="{{ route('blog') }}" style="text-decoration: none;">Blog</a></li>
                        <li><a href="{{ route('page.contact') }}" style="text-decoration: none;">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
