<ul class="nav flex-column nav-pills nav-fill">

    {{-- Home page --}}
    @component('admin.layouts.navItem')
        @slot('item')
            Home
        @endslot
        @slot('link')
            {{ route('admin.home') }}
        @endslot
    @endcomponent

    {{-- Post --}}
    @component('admin.layouts.navItemCollapse')
        @slot('item')
            Post
        @endslot
        @slot('link')
            {{ route('admin.post') }}
        @endslot
        @slot('collapse')
            postCollapse
        @endslot
        @slot('subItems')
            @component('admin.layouts.navItem')
                @slot('item')
                    Create Post
                @endslot
                @slot('link')
                    {{ route('admin.post.create') }}
                @endslot
            @endcomponent
        @endslot
    @endcomponent

    {{-- Product --}}
    @component('admin.layouts.navItemCollapse')
        @slot('item')
            Product
        @endslot
        @slot('link')
            {{ route('admin.product') }}
        @endslot
        @slot('collapse')
            productCollapse
        @endslot
        @slot('subItems')
            @component('admin.layouts.navItem')
                @slot('item')
                    Create product
                @endslot
                @slot('link')
                    {{ route('admin.product.create') }}
                @endslot
            @endcomponent
        @endslot
    @endcomponent

    {{-- Category --}}
    @component('admin.layouts.navItemCollapse')
        @slot('item')
            categories
        @endslot
        @slot('link')
            {{ route('admin.category') }}
        @endslot
        @slot('collapse')
            categoryCollapse
        @endslot
        @slot('subItems')
            @component('admin.layouts.navItem')
                @slot('item')
                    Create category
                @endslot
                @slot('link')
                    {{ route('admin.category.create') }}
                @endslot
            @endcomponent
        @endslot
    @endcomponent

    {{-- Comment --}}
    @component('admin.layouts.navItem')
        @slot('item')
            Comment
        @endslot
        @slot('link')
            #
        @endslot
    @endcomponent

    {{-- order --}}
    @component('admin.layouts.navItemCollapse')
        @slot('item')
            Order
        @endslot
        @slot('link')
            {{ route ('admin.order.index') }}
        @endslot
        @slot('collapse')
            orderCollapse
        @endslot
        @slot('subItems')
            @component('admin.layouts.navItem')
                @slot('item')
                    Confirmed Orders
                @endslot
                @slot('link')
                    {{ route('admin.order.showConfirmedorders') }}
                @endslot
            @endcomponent
            @component('admin.layouts.navItem')
                @slot('item')
                    Analyse
                @endslot
                @slot('link')
                    {{ route('admin.order.getAnalyse') }}
                @endslot
            @endcomponent
        @endslot
    @endcomponent

    {{-- coupon --}}
    @component('admin.layouts.navItemCollapse')
        @slot('item')
            Coupon
        @endslot
        @slot('link')
            #
        @endslot
        @slot('collapse')
            couponCollapse
        @endslot
        @slot('subItems')
            @component('admin.layouts.navItem')
                @slot('item')
                    Create coupon
                @endslot
                @slot('link')
                    #
                @endslot
            @endcomponent
        @endslot
    @endcomponent

    {{-- Service --}}
    @component('admin.layouts.navItemCollapse')
        @slot('item')
            Service
        @endslot
        @slot('link')
            {{ route('admin.service') }}
        @endslot
        @slot('collapse')
            serviceCollapse
        @endslot
        @slot('subItems')
            @component('admin.layouts.navItem')
                @slot('item')
                    Create service
                @endslot
                @slot('link')
                    {{ route('admin.service.create') }}
                @endslot
            @endcomponent
        @endslot
    @endcomponent

    {{-- Media --}}
    @component('admin.layouts.navItem')
        @slot('item')
            Media
        @endslot
        @slot('link')
            {{ route('admin.file') }}
        @endslot
    @endcomponent

    {{-- User --}}
    @component('admin.layouts.navItemCollapse')
        @slot('item')
            User
        @endslot
        @slot('link')
            {{ route('admin.user') }}
        @endslot
        @slot('collapse')
            userCollapse
        @endslot
        @slot('subItems')
            @component('admin.layouts.navItem')
                @slot('item')
                    Create user
                @endslot
                @slot('link')
                    {{ route('admin.user.create') }}
                @endslot
            @endcomponent
        @endslot
    @endcomponent

    {{-- Setting --}}
    @component('admin.layouts.navItem')
        @slot('item')
            Setting
        @endslot
        @slot('link')
            #
        @endslot
    @endcomponent
</ul>
