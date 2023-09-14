<div class="cart-items">
    <a href="javascript:void(0)" class="main-btn">
        <i class="lni lni-cart"></i>
        <span class="total-items">{{ $carts->count() }}</span>
    </a>
    <!-- Shopping Item -->
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $carts->count() }} Items</span>
            <a href="{{ route('cart') }}">View Cart</a>
        </div>
        <ul class="shopping-list">

            @isset($carts)
            @foreach ($carts as $cart)
            <li>
                <a href="javascript:void(0)" class="remove" title="Remove this item"><i
                        class="lni lni-close"></i></a>
                <div class="cart-img-head">
                    <a class="cart-img" href="product-details.html"><img
                            src={{asset('assets/images/header/cart-items/item1.jpg" alt="#')}}></a>
                </div>

                <div class="content">
                    <h4><a href="product-details.html">
                            {{ $cart->product->name }}</a></h4>
                    <p class="quantity">{{ $cart->quantity }}- <span class="amount">{{ $cart->product->price??$cart->product->compare_price }}</span></p>
                </div>
            </li>

            @endforeach
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">{{ $carts->sum('net_price') }}</span>
            </div>
            <div class="button">
                <a href="checkout.html" class="btn animate">Checkout</a>
            </div>
        </div>

            @endisset
    </div>
    <!--/ End Shopping Item -->
</div>
