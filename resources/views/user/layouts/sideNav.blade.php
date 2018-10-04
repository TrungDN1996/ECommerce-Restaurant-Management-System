<ul class="nav flex-column nav-pills nav-fill">

    @component('user.layouts.navItemCollapse')
        @slot('item')
            Profile
        @endslot
        @slot('link')
            {{ route('user.profile') }}
        @endslot
        @slot('collapse')
            profileCollapse
        @endslot
        @slot('subItems')
            @component('user.layouts.navItem')
                @slot('item')
                    Edit Profile
                @endslot
                @slot('link')
                    {{ route('user.profile.edit') }}
                @endslot
            @endcomponent
        @endslot
    @endcomponent

    @component('user.layouts.navItemCollapse')
        @slot('item')
           Cart
        @endslot
        @slot('link')
            {{ route('user.cart.index') }}
        @endslot
        @slot('collapse')
            cartCollapse
        @endslot
        @slot('subItems')
            @component('user.layouts.navItem')
                @slot('item')
                    Shopping
                @endslot
                @slot('link')
                    {{ route('user.cart.index') }}
                @endslot
            @endcomponent
            @component('user.layouts.navItem')
                @slot('item')
                    Favorite
                @endslot
                @slot('link')
                    {{ route('user.cart.indexFavorite') }}
                @endslot
            @endcomponent
        @endslot
    @endcomponent
</ul>
