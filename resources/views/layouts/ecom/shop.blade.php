@extends('layouts.ecom.layout')

@section('title', 'Products')

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs text-center text-md-left">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shop</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="products-section container my-5">
    @include('layouts.ecom.partials.alert')
        <div class="row">
            <div class="col-md-3 sidebar text-center text-md-left border-bottom border-md-bottom-0">
                <h3>By Category</h3>
                <ul>
                    <li class="{{ request()->all_products == 'true' ? 'active' : ''}}"><a href="{{ route('shop.index', ['all_products' => 'true']) }}">All Products</a></li>
                    @foreach($categories as $category)
                    <li class="{{ setActiveCategory($category->slug) }}"><a href="{{ route('shop.index', ['category' => $category->slug ]) }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>

            </div> <!-- end sidebar -->
            <div class="col-md-9 my-2 border-md-left">
                <div class="products-header d-flex flex-column flex-md-row justify-content-between mb-5 pb-2 border-bottom">
                    <h1 class="stylish-heading">{{ $categoryName }}</h1>
                    <div>
                        <strong class="text-bold">Price: </strong>
                        <a href="{{ route('shop.index', ['category' => request()->category, 'all_products' => request()->all_products, 'sort' => 'low_high']) }}">Low to High</a>
                        |
                        <a href="{{ route('shop.index', ['category' => request()->category, 'all_products' => request()->all_products, 'sort' => 'high_low']) }}">High to Low</a>
                    </div>
                </div>
                <div class="products text-center">
                    <div class="row row-cols-2 row-cols-md-3 mx-2">

                        @forelse($products as $product)
                            <div class="product">
                                <a href="{{ route('shop.show', $product->slug) }}"><img src="{{asset('img/products/'.$product->slug.'.jpg')}}" alt="product"></a>
                                <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                                <div class="product-price cursor-default">{{ $product->presentPrice() }}</div>
                                <form action="{{route('cart.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id}}">
                                    <input type="hidden" name="name" value="{{ $product->name}}">
                                    <input type="hidden" name="price" value="{{ $product->price}}">
                                    <button type="submit" class="btn btn-light text-xs mb-2">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        @empty
                        <!-- </div> -->
                        <div class="text-left text-md-center"><h2>No items found</h2></div>
                        @endforelse
                    </div>
                    <div class="pagination my-3 justify-content-center justify-content-md-start">
                        {{ $products->appends(request()->input())->links()}}
                    </div>
                </div> <!-- end products -->
            </div>
        </div>
    </div>


@endsection
