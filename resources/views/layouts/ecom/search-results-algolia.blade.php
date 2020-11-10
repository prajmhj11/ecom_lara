@extends('layouts.ecom.layout')

@section('title', 'Search Results Algolia')

@section('extra-css')
<link rel="stylesheet" href="{{asset('css/algolia.css')}}">
<link rel="stylesheet" href="{{asset('css/algolia-instantsearch.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/reset-min.css" integrity="sha256-t2ATOGCtAIZNnzER679jwcFcKYfLlw01gli6F6oszk8=" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/algolia-min.css" integrity="sha256-HB49n/BZjuqiCtQQf49OdZn63XuKFaxcIHWf0HNKte8=" crossorigin="anonymous">
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
    <div class="ais-InstantSearch">
        <h1>Search Results</h1>
            <div id="searchbox"></div>
            <div id="stats"></div>
            <div id="hits"></div>
            <div id="pagination"></div>
    </div>
    </div>
    <!-- end search container -->

@endsection

@section('extra-js')
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@4.5.1/dist/algoliasearch-lite.umd.js" integrity="sha256-EXPXz4W6pQgfYY3yTpnDa3OH8/EPn16ciVsPQ/ypsjk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.8.3/dist/instantsearch.production.min.js" integrity="sha256-LAGhRRdtVoD6RLo2qDQsU2mp+XVSciKRC8XPOBWmofM=" crossorigin="anonymous"></script>
<script src="{{asset('js/algolia-instantsearch.js')}}"></script>

<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@3/dist/algoliasearchLite.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{asset('js/algolia.js')}}"></script>
@endsection
