<div class="might-like-section">
    <div class="container">
        <h2>You might also like...</h2>
        <div class="might-like-products row text-center m-0 p-0">
            @foreach($mightAlsoLike as $product)
                <div class="col-4 col-lg-2 m-0 p-0 py-2">
                    <div class="might-like-product col-10 offset-1">
                        <a href="{{ route('shop.show', $product->slug) }}">
                            <img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product">
                            <div>
                            <div class="might-like-product-name">{{ $product->name }}</div>
                            <div class="might-like-product-price">{{ $product->presentPrice() }}</div>
                            </div>
                            <form action="{{route('cart.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id}}">
                                <input type="hidden" name="name" value="{{ $product->name}}">
                                <input type="hidden" name="price" value="{{ $product->price}}">
                                <button type="submit" class="btn btn-light btn-sm text-sm">
                                    Add to Cart
                                </button>
                            </form>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
