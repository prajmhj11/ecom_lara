@extends('layouts.ecom.layout')

@section('title', 'My Profile')

@section('extra-css')
<link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section('content')
    @component('layouts.ecom.components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>My Account</span>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Orders</span>
    @endcomponent
    <div class="container">
        @if(session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
        @endif
        <div class="row my-5">
            <div class="col-4 sidebar text-center text-md-left">
                <ul>
                    <li><a href="{{ route('users.edit') }}">My Profile</a></li>
                    <li class="active"><a href="{{route('orders.index')}}">My orders</a></li>
                </ul>

            </div> <!-- end sidebar -->
            <div class="col-8 my-2 border-left">
                <div class="my-profile-header d-flex flex-column flex-md-row justify-content-between mb-5 pb-2 border-bottom">
                    <h3 class="stylish-heading">My Orders</h3>
                </div>
                <div class="my-profile">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@3/dist/algoliasearchLite.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script type="text/javascript" src="{{asset('js/algolia.js')}}"></script>
@endsection
