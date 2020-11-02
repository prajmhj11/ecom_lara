<header>
    <div class="top-nav container d-flex flex-column flex-lg-row text-center text-lg-left justify-content-between pt-2">
        <div class="logo"><a href="/">CSS Grid Example</a></div>
        <ul class="p-0 pt-2 w-75 w-lg-50 m-auto m-lg-0">
            <div class="d-flex text-uppercase justify-content-between">
                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="{{ route('cart.index') }}">Cart<span class="cart-count">
                    @if(\Cart::instance('default')->count() > 0 )
                    <span>{{ \Cart::instance('default')->content()->count() }} </span></span></a></li>
                    @endif
            </div>
        </ul>
    </div>
    <!-- end top-nav -->
</header>
