<header>
    <div class="top-nav container-fluid">
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-4 top-nav-left">
                    <div class="logo">
                        <a href="/" class="pl-0">Laravel Example</a>
                    </div>
                </div>
                <div class="col-lg-8 top-nav-right">
                    <div class="row text-uppercase justify-content-between">
                        <ul class="col-md-5">
                            <div class="d-flex">
                                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Blog</a></li>
                            </div>
                        </ul>

                        @if(Route::currentRouteName() != 'checkout.index')

                        <ul class="col-md-7">
                            <div class="d-flex justify-content-end">
                                @guest
                                    <li><a href="{{ route('register') }}">Sign Up</a></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                @endguest
                                <li>
                                    <a href="{{ route('cart.index') }}">Cart
                                        <span class="cart-count">
                                            @if((\Cart::instance('default')->content()->count()) > 0)
                                            <span>{{ \Cart::instance('default')->content()->count() }} </span>
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                @if(Auth::User())
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle p-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endif
                            </div>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- end top-nav -->
</header>
