
@extends('layouts.ecom.layout')

@section('title', 'Home')

@section('extra-css')

@endsection
@section('content')
    <div class="aside">
        <div class="hero container pt-5 pb-5">
            <div class="row">
                <div class="hero-copy col-12 col-md-6 text-center text-lg-left">
                    <h1>Laravel Ecommerce Demo</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, neque aliquam molestiae unde facere nobis quia excepturi labore pariatur ipsum nulla doloremque ducimus ab. Blanditiis soluta dolore perspiciatis corporis officiis.</p>
                    <div class="hero-buttons">
                        <a href="#" class="button button-white">Blog Post</a>
                        <a href="#" class="button button-white">GitHub</a>
                    </div>
                    <!-- end hero-copy -->
                </div>

                <div class="hero-image col-12 col-md-6 text-center">
                        <img src="{{asset('img/macbook-pro-laravel.png')}}" alt="hero-img">
                </div>
            </div>
        </div>
        <!-- end hero -->
    </div>

    <div class="featured-section mt-3 mb-3">
        <div class="container">
            <h1 class="text-center">CSS Grid Example</h1>

            <p class="section-description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nulla natus labore nam laborum pariatur, tenetur velit provident, in doloremque molestias optio minima a accusamus adipisci blanditiis atque numquam ullam aliquam.</p>

            <div class="text-center button-container">
                <a href="/" class="button">Featured</a>
                <a href="#" class="button">On Sale</a>
            </div>

            <div class="products text-center">
            @include('layouts.ecom.partials.alert')
                <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-1">
                    @foreach ($products as $product)
                    <div class="product">
                        <a href="{{ route('shop.show', $product->slug) }}"><img src="{{asset('img/products/'.$product->slug.'.jpg')}}" alt="product"></a>
                        <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                        <div class="product-price cursor-default">{{ $product->presentPrice() }}</div>
                        <form action="{{route('cart.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id}}">
                            <input type="hidden" name="name" value="{{ $product->name}}">
                            <input type="hidden" name="price" value="{{ $product->price}}">
                            <button type="submit" class="btn btn-light">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>

            </div>
            <!-- end products -->

            <div class="text-center button-container">
                <a href="{{ route('shop.index') }}" class="button">View More products</a>
            </div>
        </div>
        <!-- end container -->
    </div>
    <!-- end featured-section -->

    <div class="blog-section">
        <div class="container">
            <h1 class="text-center">From Our Blog</h1>
            <p class="section-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta, quasi cum! Ducimus, error voluptas. Libero maxime expedita nisi odit fugit reprehenderit, quibusdam delectus ad saepe soluta, eos eligendi consequuntur doloribus.</p>

            <div class="blog-posts text-center text-xl-left my-5">
                <div class="row row-cols-1 row-cols-xl-3">
                    <div class="blog-post">
                        <a href="#"><img src="{{asset('img/blog1.png')}}" alt=""></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title 1</h2></a>
                        <div class="blog-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea veritatis tenetur odio voluptatum dignissimos facilis, itaque cumque aspernatur ab iure sapiente iste laborum asperiores ducimus odit eos, tempora fugiat est.
                        </div>
                    </div>
                    <div class="blog-post">
                        <a href="#"><img src="{{asset('img/blog2.png')}}" alt=""></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title 2</h2></a>
                        <div class="blog-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea veritatis tenetur odio voluptatum dignissimos facilis, itaque cumque aspernatur ab iure sapiente iste laborum asperiores ducimus odit eos, tempora fugiat est.
                        </div>
                    </div>
                    <div class="blog-post">
                        <a href="#"><img src="{{asset('img/blog3.png')}}" alt=""></a>
                        <a href="#"><h2 class="blog-title">Blog Post Title 3</h2></a>
                        <div class="blog-description">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea veritatis tenetur odio voluptatum dignissimos facilis, itaque cumque aspernatur ab iure sapiente iste laborum asperiores ducimus odit eos, tempora fugiat est.
                        </div>
                    </div>
                </div>
            </div>
            <!-- end blog-posts -->
        </div>
        <!-- end container -->
    </div>
    <!-- end blog-section -->
@endsection
