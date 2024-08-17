@extends('layouts.frontend')

@section('content')
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        {{-- <form id="updateForm" action="{{ route('update.pesan', $barang['id']) }}" method="POST"> --}}
                            @csrf
                            <table>
                                <thead>
                                    <tr>
                                        <th class="shoping__product">Barang</th>
                                        <th>Harga</th>
                                        <th>Quantity</th>
                                        <th>Ukuran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ url('http://localhost:8000/storage/gambar/' . $barang['gambar']) }}" alt="{{ $barang['nama_barang'] }}" style="width: 150px; height: auto;">
                                            <h5>{{ $barang['nama_barang'] }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            Rp {{ number_format($barang['harga'], 0, ',', '.') }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <input type="number" id="quantity" name="quantity" value="{{ $quantity ?? 1 }}" min="1" max="{{ $barang['stok'] }}" style="width: 50px;">
                                        </td>
                                        <td class="shoping__cart__size">
                                            <input type="text" name="ukuran" placeholder="Ukuran" style="width: 80px;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="shoping__cart__btns">
                                <!-- Tombol untuk Lanjut Belanja -->
                                <a href="{{ route('shop.index') }}" class="primary-btn cart-btn cart-btn-right">Lanjut Belanja</a>
                                <!-- Jika ingin menggunakan tombol submit -->
                                <!-- <button type="submit" class="primary-btn cart-btn cart-btn-right">Pesan</button> -->
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Total <span id="subtotal">Rp {{ number_format(($barang['harga'] * ($quantity ?? 1)), 0, ',', '.') }}</span></li>
                            {{-- <li>Total <span id="total">Rp {{ number_format(($barang['harga'] * ($quantity ?? 1)), 0, ',', '.') }}</span></li> --}}
                        </ul>
                        <a href="#" class="primary-btn">Pesan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->


    <script>
        document.getElementById('quantity').addEventListener('input', function() {
            var quantity = parseInt(this.value);
            var harga = {{ $barang['harga'] }};
            var subtotal = quantity * harga;

            document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString();
            document.getElementById('total').textContent = 'Rp ' + subtotal.toLocaleString();
        });
    </script>


@endsection
