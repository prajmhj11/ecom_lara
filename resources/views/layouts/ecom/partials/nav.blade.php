<header>
    <div class="top-nav container-fluid p-0">
        <div class="container">
        <nav class="navbar navbar-expand-lg row p-0 py-3">
            <div class="col-lg-4 top-nav-left d-flex justify-content-between">
                <a class="logo navbar-brand text-white" href="/">Ecommerce</a>
                @if(Route::currentRouteName() != 'checkout.index')
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars text-white"></i>
                </button>
                @endif
            </div>
            <div class="col-lg-8 top-nav-right">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if(Route::currentRouteName() != 'checkout.index')
                        <ul class="col-lg-5 navbar-nav">
                            <div class="d-flex flex-column flex-lg-row">
                                <li><a href="{{ route('shop.index') }}">Shop</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Blog</a></li>
                            </div>
                        </ul>

                        <ul class="col-lg-7">
                            <div class="d-flex flex-column flex-lg-row justify-content-end">
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

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a href="{{route('users.edit')}}" class="dropdown-item">
                                            My Account
                                        </a>
                                        <a class="dropdown-item" href="{{ route('user.logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                @endif
                            </div>
                        </ul>
                    @endif
                </div>
            </div>
        </nav>
        </div>
    </div>
    <!-- end top-nav -->
</header>
