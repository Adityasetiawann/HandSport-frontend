@extends('layouts.frontend')

@section('content')
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="shoping__product">Gambar</th>
                                <th class="shoping__product">Nama Barang</th>
                                <th>Quantity</th>
                                <th>Ukuran</th>
                                <th>Total</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($cartItems) && count($cartItems) > 0)
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <!-- Gambar dengan style CSS untuk ukuran maksimal dan pusatkan -->
                                            <div style="display: flex; justify-content: left; align-items: center;">
                                                <img src="{{ url('http://localhost:8000/storage/gambar/' . $item['barang']['gambar']) }}" alt="{{ $item['barang']['nama_barang'] }}"
                                                    style="max-width: 100px; max-height: 200px; object-fit: cover; display: block;">
                                            </div>
                                        </td>
                                        <td class="shoping__cart__product">
                                            <h5>{{ $item['barang']['nama_barang'] }}</h5>
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            {{ $item['quantity'] }}
                                        </td>
                                        <td class="shoping__cart__size">
                                            {{ $item['ukuran'] }}
                                        </td>
                                        <td class="shoping__cart__total">
                                            Rp {{ number_format($item['total'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Keranjang Anda kosong.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 text-right">
                <form action="{{ route('storePesanan') }}" method="POST">
                    @csrf
                    <button type="submit" class="primary-btn cart-btn cart-btn-right">
                        Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
