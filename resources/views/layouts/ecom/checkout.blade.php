@extends('layouts.ecom.layout')

@section('title', 'Checkout')

@section('extra-css')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')

    <div class="container my-5">
        @include('layouts.ecom.partials.alert')

        <h1 class="checkout-heading stylish-heading">Checkout</h1>
        <div class="checkout-section row m-0 p-0">
            <div class="checkout-table-details col-md-5 order-1 order-md-0 m-0 border-md-right bg-light pb-2">
                <form action="{{ route('checkout.store') }}" id="payment-form" method="POST">
                    @csrf
                    <h2>Billing Details</h2>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                    </div>

                    <div class="half-form">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <input type="text" class="form-control" id="province" name="province" value="{{ old('province') }}" required>
                        </div>
                    </div> <!-- end half-form -->

                    <div class="half-form">
                        <div class="form-group">
                            <label for="postalcode">Postal Code</label>
                            <input type="text" class="form-control" id="postalcode" name="postalcode" value="{{ old('postalcode') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                        </div>
                    </div> <!-- end half-form -->

                    <h2>Payment Details</h2>
                    <div class="form-group">
                        <label for="name_on_card">Name on Card</label>
                        <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="" required>
                    </div>
                    <div class="form-group">
                        <label for="card-element">
                        Credit or debit card
                        </label>
                        <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <!-- end half-form -->
                    <button type="submit" id="complete-order" class="button-primary form-control">Complete Order</button>
                </form>
            </div>
            <!-- end billing-details -->
            <div class="checkout-table-container col-md-6 col-md-offset-1 order-0 order-md-1 text-center m-0">
                <h2 class="text-left">Your Order</h2>
                @foreach(\Cart::content() as $item)
                <div class="checkout-table">
                    <div class="checkout-table-row border-top border-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="checkout-table-row-left w-25 m-3">
                            <img src="{{ Voyager::image($item->model->image) }}" alt="{{ $item->model->slug }}" onerror="this.onerror=null;this.src=`{{asset('img/not-found.jpg')}}`;">
                        </div> <!-- end checkout-table -->

                        <div class="checkout-table-row-right flex-fill d-flex justify-content-between align-items-center">
                            <div class="checkout-item-details text-center text-md-left">
                                <div class="checkout-table-item">{{ $item->model->name }}</div>
                                <div class="checkout-table-description">{{ $item->model->details }}</div>
                                <div class="checkout-table-price">{{ $item->model->presentPrice() }}</div>
                            </div>
                            <div class="checkout-table-quantity"><span class="border p-2">{{ $item->qty }}</span></div>
                        </div>
                    </div> <!-- end checkout-table-row -->
                </div> <!-- end checkout-table -->
                @endforeach
                <hr>
                <p class="have-code text-left">Have a Code?</p>
                <div class="have-code-container my-2">
                    <form action="{{ route('coupon.store') }}" method="POST" class="form-inline">
                        @csrf
                        <div class="p-2 border border-dark form-group">
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control mr-2 mb-2" required>
                            <button type="submit" class="btn btn-lg btn-info mb-2">Apply</button>
                        </div>
                    </form>
                </div> <!-- end have-code-container -->
                <div class="checkout-totals d-flex justify-content-around">
                    <div class="checkout-totals-left text-right">
                        <span>Subtotal</span> <br>
                        @if(session()->has('coupon'))
                            <span>Discount({{ session()->get('coupon')['name'] ?? '0'}})
                            <form method="POST" action="{{ route('coupon.destroy', 'id = 1') }}" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-default p-0" style="height: 24px;"><i class="fas fa-trash-alt p-0"></i></button>
                            </form>
                            </span> <br>
                            <hr>
                            <span>New SubTotal</span> <br>
                        @endif
                        <span>Tax(13%)</span> <br>
                        <span class="text-bold">Total</span>
                    </div>

                    <div class="checkout-totals-right text-right text-bold">
                        <span>{{ presentPrice(\Cart::priceTotal()) }}</span><br>
                        @if(session()->has('coupon'))
                        <span>-{{ presentPrice($discount) }}</span> <br>
                        <hr>
                        <span>{{ presentPrice($newSubtotal) }}</span> <br>
                        @endif
                        <span>+{{ presentPrice($newTax) }}</span> <br>
                        <span class="border-top border-dark">{{ presentPrice($newTotal) }}</span>

                    </div>
                </div> <!-- end checkout-totals -->
                <hr>

            </div>
            <!-- end checkout-table -->
        </div> <!-- end checkout-section -->
    </div>

@endsection

@section('extra-js')
<script type="text/javascript">
   $(function(){
    // Create a Stripe client.
        var stripe = Stripe('pk_test_51HhaTnLKs9laNN1X9xdgQ8zMNsNDUdufeI66JCyxtJj2sA9kGdNH6eZzLpiC2Y4jgU1I5nswJawTsILbKMper4EH00TOOvNTqt');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            document.getElementById('complete-order').disabled = true;

            var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value,
                // address_country: document.getElementById('').value,
            }
            stripe.createToken(card, options).then(function(result) {
                if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                document.getElementById('complete-order').disabled = false;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
   });
</script>
@endsection
