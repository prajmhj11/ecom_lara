@extends('layouts.ecom.layout')

@section('title', $product->name)

@section('extra-css')

@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="/">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <a href="{{ route('shop.index')}}">Shop</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>{{ $product->name }}</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="product-section container my-2">
    @include('layouts.ecom.partials.alert')
        <div class="row">
            <div class="col-md-4 product-section-image d-flex align-items-center justify-content-center">
                <img src="{{asset('img/products/'.$product->slug.'.jpg') }}" alt="product">
            </div>
            <div class="col-md-8 product-section-information">
                <h1 class="product-section-title">{{$product->name}}</h1>
                <div class="product-section-subtitle cursor-default">{{ $product->details }}</div>
                <div class="product-section-price cursor-default">{{ $product->presentPrice() }}</div>
                <div class="product-section-description"><p>{!! $product->description !!}</p></div>
                <!-- <a href="#" class="button">Add to Cart</a> -->
                <form action="{{route('cart.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id}}">
                    <input type="hidden" name="name" value="{{ $product->name}}">
                    <input type="hidden" name="price" value="{{ $product->price}}">
                    <button type="submit" class="button">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div> <!-- end product-section -->

    @include('layouts.ecom.partials.might-like')


@endsection
