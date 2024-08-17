@extends('layouts.frontend')

@section('content')
<!-- Product Details Section Begin -->
<section class="product-details spad" style="margin-top: 0; padding-top: 10px;">
    <div class="container" style="max-width: 1200px;">
        <div class="row" style="display: flex; align-items: flex-start;">
            <!-- Image Section -->
            <div class="col-lg-6 col-md-6" style="display: flex; justify-content: center; align-items: flex-start; padding: 0 50px;">
                <div class="product__details__pic">
                    <div class="product__details__pic__item" style="max-width: 100%; max-height: 100%; display: flex; justify-content: center;">
                        <img class="product__details__pic__item--large"
                            src="{{ asset('frontend/img/foto-produk/' . $barang['gambar']) }}"
                            alt="{{ $barang['nama_barang'] }}" style="width: 100%; height: auto; max-width: 400px;">
                    </div>
                </div>
            </div>
            <!-- Details Section -->
            <div class="col-lg-6 col-md-6" style="padding: 0 50px;">
                <div class="product__details__text" style="margin-top: 80px; padding: 30px; background-color: #f9f9f9; border-radius: 10px;">
                    <h3 style="margin-bottom: 20px; font-size: 24px;">{{ $barang['nama_barang'] }}</h3>
                    <div class="product__details__price" style="margin-bottom: 20px; font-size: 24px; color: #e53637;">Rp {{ number_format($barang['harga'], 0, ',', '.') }}</div>
                    <div class="product__details__availability" style="margin-bottom: 20px; font-size: 16px;"><b>Availability:</b> {{ $barang['stok'] }}</div>
                    <div class="tab-content" style="margin-bottom: 20px;">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6 style="margin-bottom: 10px; font-size: 16px;"><b>Product Information</b></h6>
                                <p style="font-size: 20px; color: #555;">{{ $barang['keterangan'] }}</p>
                            </div>
                        </div>
                    </div>

                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    

                    <form action="{{ route('addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="barang_id" value="{{ $barang['id'] }}">
                        <input type="hidden" name="gambar" value="{{ $barang['gambar'] }}">
                        <div class="shoping__cart__quantity" style="margin-bottom: 10px;">
                            <label for="quantity" style="font-size: 16px; display: block; margin-bottom: 5px;"><b>Quantity:</b></label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $barang['stok'] }}" style="width: 100px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>
                        <div class="shoping__cart__size" style="margin-bottom: 20px;">
                            <label for="size" style="font-size: 16px; display: block; margin-bottom: 5px;"><b>Size:</b></label>
                            <input type="text" id="size" name="ukuran" placeholder="Enter size" style="width: 100px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>
                        <div class="product__details__price" style="margin-bottom: 20px; font-size: 24px; color: #e53637;">
                            Total: <span id="subtotal">Rp {{ number_format($barang['harga'] * old('quantity', 1), 0, ',', '.') }}</span>
                        </div>
                        <input type="hidden" name="total" value="{{ $barang['harga'] * old('quantity', 1) }}">
                        <button type="submit" class="primary-btn" style="background-color: #e53637; color: #fff; padding: 10px 20px; border-radius: 5px; text-transform: uppercase;">Pesan</button>
                    </form>




                    {{-- <form action="{{ route('pesananDetail') }}" method="POST">
                        @csrf
                        <input type="hidden" name="barang_id" value="{{ $barang['id'] }}">
                        <input type="hidden" name="gambar" value="{{ $barang['gambar'] }}">
                        <div class="shoping__cart__quantity" style="margin-bottom: 10px;">
                            <label for="quantity" style="font-size: 16px; display: block; margin-bottom: 5px;"><b>Quantity:</b></label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $barang['stok'] }}" style="width: 100px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>
                        <div class="shoping__cart__size" style="margin-bottom: 20px;">
                            <label for="size" style="font-size: 16px; display: block; margin-bottom: 5px;"><b>Size:</b></label>
                            <input type="text" id="size" name="ukuran" placeholder="Enter size" style="width: 100px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>
                        <div class="product__details__price" style="margin-bottom: 20px; font-size: 24px; color: #e53637;">
                            Total: <span id="subtotal">Rp {{ number_format($barang['harga'], 0, ',', '.') }}</span>
                        </div>
                        <input type="hidden" name="total" value="{{ $barang['harga'] }}">
                        <button type="submit" class="primary-btn" style="background-color: #e53637; color: #fff; padding: 10px 20px; border-radius: 5px; text-transform: uppercase;">Pesan</button>
                    </form> --}}

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Script to update subtotal dynamically -->
<script>
    document.getElementById('quantity').addEventListener('input', function() {
        var quantity = parseInt(this.value);
        var harga = {{ $barang['harga'] }};
        var subtotal = quantity * harga;

        document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        document.querySelector('input[name="total"]').value = subtotal;
    });
</script>
@endsection
