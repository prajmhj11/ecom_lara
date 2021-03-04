@extends('layouts.ecom.layout')

@section('title', $product->name)

@section('extra-css')
<link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section('content')

    @component('layouts.ecom.components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <a href="{{ route('shop.index')}}">Shop</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>{{ $product->name }}</span>
    @endcomponent
    <!-- end breadcrumbs -->


    <div class="product-section container my-2">
    @include('layouts.ecom.partials.alert')
        <div class="row">
            <div class="col-md-5 row d-flex align-items-center justify-content-center">
                <div class="product-section-image col-12 text-center border d-flex justify-content-center align-items-center">
                    <img src="{{ Voyager::image($product->image) }}" alt="{{ $product->slug }}"
                        id="currentImage" class="active" onerror="this.onerror=null;this.src=`{{asset('img/not-found.jpg')}}`;">
                </div>
                <div class="product-section-images col-12">
                    @if($product->images)
                        <div class="product-section-thumbnail d-flex align-items-center cursor-pointer border selected">
                            <img src="{{presentImage($product->image)}}" alt="product">
                        </div>
                        @foreach(json_decode($product->images) as $image)
                        <div class="product-section-thumbnail d-flex align-items-center cursor-pointer border">
                            <img src="{{presentImage($image)}}" alt="product">
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-7 product-section-information">
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

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@3/dist/algoliasearchLite.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{asset('js/algolia.js')}}"></script>
<script>
        $(function(){
            // console.log($('#currentImage')[0]);
            // const currentImage = document.querySelector('#currentImage');
            // console.log($('.product-section-thumbnail')[0]);
            // console.log(document.querySelectorAll('.product-section-thumbnail')[0]);

            // const images = document.querySelectorAll('.product-section-thumbnail');

            // images.forEach((e)=>e.addEventListener('click', thumbnailClick));

            const currentImage = $('#currentImage');
            const images = $('.product-section-thumbnail');

            images.each(function(){
                $(this).on('click', thumbnailClick);
            });

            function thumbnailClick(){
                currentImage.removeClass("active");
                currentImage.on('transitionend', ()=>{
                    currentImage.attr('src', this.querySelector('img').src);
                    currentImage.addClass("active");
                });
                images.each((index,element)=>{
                    element.classList.remove("selected");
                });
                $(this).addClass("selected");
            }
        });
</script>
@endsection
