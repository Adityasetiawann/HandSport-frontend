@extends('layouts.frontend')

@section('content')

<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{ url('http://localhost:8000/storage/gambar/' . $item['barang']['gambar']) }}" alt="{{ $item['barang']['nama_barang'] }}">
                                        <h5>{{ $item['barang']['nama_barang'] }}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        Rp {{ number_format($item['barang']['harga'], 0, ',', '.') }}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{ $item['quantity'] }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        Rp {{ number_format($item['barang']['harga'] * $item['quantity'], 0, ',', '.') }}
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Update Cart</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span></li>
                        <li>Total <span>Rp {{ number_format($total, 0, ',', '.') }}</span></li>
                    </ul>
                    <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
