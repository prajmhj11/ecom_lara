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
            <div class="col-md-2 sidebar text-center text-md-left">
                <ul>
                    <li><a href="{{ route('users.edit') }}">My Profile</a></li>
                    <li class="active"><a href="{{route('orders.index')}}">My orders</a></li>
                </ul>

            </div> <!-- end sidebar -->
            <div class="col-md-10 my-2 border-md-left">
                <div class="my-profile-header d-flex flex-column flex-md-row justify-content-between mb-5 pb-2 border-bottom">
                    <h3 class="stylish-heading">My Orders</h3>
                </div>
                <div class="my-orders">
                @foreach ($orders as $order)
                    <div class="order-container">
                        <div class="order-header">
                            <div class="order-header-items">
                                <div>
                                    <div class="text-uppercase text-bold">Order Placed</div>
                                    <div>{{ presentDate($order->created_at) }}</div>
                                </div>
                                <div>
                                    <div class="text-uppercase text-bold">Order ID</div>
                                    <div>{{ $order->id }}</div>
                                </div><div>
                                    <div class="text-uppercase text-bold">Total</div>
                                    <div>{{ presentPrice($order->billing_total) }}</div>
                                </div>
                            </div>
                            <div>
                                <div class="order-header-items">
                                    <div><a href="{{ route('orders.show', $order->id) }}">Order Details</a></div>
                                    <div>|</div>
                                    <div><a href="#">Invoice</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="order-products">
                            @foreach ($order->products as $product)
                                <div class="order-product-item">
                                    <div><img src="{{ asset('storage/'.$product->image) }}" alt="Product Image"></div>
                                    <div>
                                        <div>
                                            <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                                        </div>
                                        <div>{{ presentPrice($product->price) }}</div>
                                        <div>Quantity: {{ $product->pivot->quantity }}</div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div> <!-- end order-container -->
                @endforeach
                {{ $orders->links() }}
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
