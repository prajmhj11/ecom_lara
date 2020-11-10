@extends('layouts.ecom.layout')

@section('title', 'Shopping Cart')

@section('extra-css')
<link rel="stylesheet" href="{{asset('css/algolia.css')}}">
@endsection

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <a href="#">Home</a>
            <i class="fa fa-chevron-right breadcrumb-separator"></i>
            <span>Shopping Cart</span>
        </div>
    </div> <!-- end breadcrumbs -->

    <div class="cart-section container">
    @include('layouts.ecom.partials.alert')

        <div class="row">
            <div class="col-lg-9 m-3 p-0">
            @if(\Cart::count() > 0)

                <h2>{{ \Cart::content()->count() }} item(s) in Shopping Cart </h2>

                <div class="cart-table my-2">
                    @foreach(\Cart::content() as $item)
                    <div class="cart-table-row border-bottom py-1">
                        <div class="d-flex flex-column flex-md-row text-center text-md-left justify-content-between">
                            <div class="cart-table-row-left col-md-2">
                                <a href="{{route('shop.show', $item->model->slug)}}">
                                    <img src="{{ Voyager::image($item->model->image) }}" alt="{{ $item->model->slug }}" onerror="this.onerror=null;this.src=`{{asset('img/not-found.jpg')}}`;">
                                </a>
                            </div>
                            <div class="cart-table-row-right col-lg-9">
                                <div class="row">
                                    <div class="cart-item-details col-md-4">
                                        <div class="cart-table-item text-bold"><a href="{{route('shop.show', $item->model->slug)}}">{{ $item->model->name }}</a></div>
                                        <div class="cart-table-description">{{ $item->model->details }}</div>
                                        <div class="cart-table-price">({{ $item->model->presentPrice() }})</div>
                                    </div>
                                    <div class="cart-table-options col-md-8">
                                        <div class="row align-items-center">
                                            <div class="cart-table-actions col-4 col-lg-5 text-right">
                                                <form action="{{route('cart.delete', $item->rowId)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-default btn-sm text-xs row">Remove</button>
                                                </form>
                                                <form action="{{route('cart.switchToSaveForLater', $item->rowId)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-default btn-sm text-xs row">Save for Later</button>
                                                </form>
                                            </div>

                                            <div class="qty col-4 col-lg-4 d-flex">
                                                <button class="qty-up border bg-light" data-id="{{ $item->rowId }}"><i class="fas fa-angle-up"></i></button>
                                                <input type="text" data-id="{{ $item->rowId }}" class="qty_input border w-100 text-center" disabled value="{{ $item->qty }}" placeholder="1">
                                                <button class="qty-down border bg-light" data-id="{{ $item->rowId }}"><i class="fas fa-angle-down"></i></button>
                                            </div>

                                            <div class="cart-item-price col-4 col-lg-3 text-left text-md-right">{{presentPrice($item->subtotal())}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end cart-table-row -->
                    @endforeach
                </div> <!-- end cart-table -->

                <a href="#" class="have-code d-none">Have a Code?</a>

                <div class="have-code-container my-2 d-none">
                    <form action="{{ route('coupon.store') }}" method="POST" class="form-inline">
                        @csrf
                        <div class="p-2 border border-dark form-group">
                            <input type="text" id="discount-coupon" class="form-control mr-2 mb-2">
                            <button type="submit" class="btn btn-lg btn-info mb-2">Apply</button>
                        </div>
                    </form>
                </div> <!-- end have-code-container -->

                <div class="cart-totals row my-3 mx-0">
                    <div class="cart-totals-left col-md-8 py-3 bg-light">
                        Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                    </div>

                    <div class="cart-totals-right col-md-4 bg-dark py-3">
                        <div class="d-flex text-right">
                            <div class="mr-5 mr-md-3 mr-xl-5">
                                Subtotal <br>
                                Tax(13%) <br>
                                <span class="cart-totals-total text-bold text-lg">Total </span>
                            </div>
                            <div class="cart-totals-subtotal">
                                {{ presentPrice(\Cart::subtotal()) }} <br>
                                {{ presentPrice(\Cart::tax()) }} <br>
                                <span class="cart-totals-total text-bold text-lg border-top border-white">{{ presentPrice(\Cart::total()) }}</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- end cart-totals -->

                <div class="cart-buttons my-1 btn-group">
                    <a href="{{ route('shop.index') }}" class="button mr-2">Continue Shopping</a>
                    <a href="{{ route('checkout.index') }}" target="_blank" class="button-primary">Proceed to Checkout</a>
                </div>
            @else
                <h2>No items in Shopping Cart</h2>
                <div class="mb-2">
                    <a href="{{route('shop.index')}}" class="button">Continue Shopping</a>
                </div>
            @endif

            <hr>
            @if(\Cart::instance('saveForLater')->count() > 0)

            <h2>{{ \Cart::instance('saveForLater')->count() }} item(s) Saved for Later </h2>

            <div class="saved-for-later cart-table my-1">
                @foreach(\Cart::instance('saveForLater')->content() as $item)
                <div class="cart-table-row border-bottom py-1">
                        <div class="d-flex flex-column flex-md-row text-center text-md-left justify-content-between">
                            <div class="cart-table-row-left col-md-2">
                                <a href="{{route('shop.show', $item->model->slug)}}">
                                    <img src="{{ asset('img/products/'.$item->model->slug.'.jpg') }}" alt="item" class="cart-table-img">
                                </a>
                            </div>
                            <div class="cart-table-row-right col-lg-9">
                                <div class="row">
                                    <div class="cart-item-details col-md-4">
                                        <div class="cart-table-item text-bold"><a href="{{route('shop.show', $item->model->slug)}}">{{ $item->model->name }}</a></div>
                                        <div class="cart-table-description">{{ $item->model->details }}</div>
                                    </div>
                                    <div class="cart-table-options col-md-8">
                                        <div class="row align-items-center">
                                            <div class="cart-table-actions col-6 col-md-4 text-right">
                                                <form action="{{route('saveForLater.delete', $item->rowId)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-default btn-sm text-xs">Remove</button>
                                                </form>
                                                <form action="{{route('saveForLater.switchToCart', $item->rowId)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-default btn-sm text-xs">Move to Cart</button>
                                                </form>
                                            </div>
                                            <div class="cart-item-price col-6 col-md-4 text-left text-md-right">{{$item->model->presentPrice()}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end cart-table-row -->

                @endforeach
            </div> <!-- end saved-for-later -->
            @else
            <h2>You have no items in Saved For Later</h2>
            @endif
            </div>
        </div>

    </div> <!-- end cart-section -->


    @include('layouts.ecom.partials.might-like')

@endsection

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@3/dist/algoliasearchLite.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{asset('js/algolia.js')}}"></script>
<script type="text/javascript">
    $(function(){
        // product qty section
        let $qty_up = $(".qty .qty-up");
        let $qty_down = $(".qty .qty-down");

        // click on qty-up
        $qty_up.click(function(e){
            let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
            console.log($input);

            if($input.val() >= 1 && $input.val() <= 9 ){
                $input.val(function(i, oldval){
                    return ++oldval;
                });
                changedata($input);
            }


        })
        // click on qty-down
        $qty_down.click(function(e){
            let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
            if($input.val() > 1 && $input.val() <= 10 ){
                $input.val(function(i, oldval){
                    return --oldval;
                });
                changedata($input);
            }


        })
        //eventListener
        function changedata($data){
            axios.patch(`/cart/${$data.attr('data-id')}`, {
                quantity: $data.val(),
            })
            .then(function (response) {
                console.log(response);
                // window.location.href = `{{route('cart.index')}}`;
                location.reload();
            })
            .catch(function (error) {
                console.log(error);
                location.reload();
            });
        }
    });
</script>
@endsection
