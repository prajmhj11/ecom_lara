@extends('layouts.ecom.layout')

@section('title', 'Search Results')

@section('extra-css')
<link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section('content')
    @component('layouts.ecom.components.breadcrumbs')
    <a href="/">Home</a>
    <i class="fa fa-chevron-right breadcrumb-separator"></i>
    <span>Search</span>
    <!-- end breadcrumbs component -->
    @endcomponent
    <div class="search-container container my-2">
    @include('layouts.ecom.partials.alert')
        <h1>Search Results</h1>
        <p>{{ $products->count() }} results found for "<strong>{{request()->input('query')}}</strong>"</p>
            @if($products->count() > 0)
            <table class="table">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Detail</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Product Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                    <td><a href="{{route('shop.show', $product->slug)}}" class="link">{{ $product->name }}</a></td>
                    <td>{{ $product->details }}</td>
                    <td>{!! $product->description !!}</td>
                    <td>{{ $product->presentPrice() }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                {{ $products->appends(request()->input())->links() }}
            @else
                <h3 class="text-center">No results found</h3>
            @endif
    </div>
    <!-- end search container -->

@endsection

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@3/dist/algoliasearchLite.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{asset('js/algolia.js')}}"></script>
@endsection
