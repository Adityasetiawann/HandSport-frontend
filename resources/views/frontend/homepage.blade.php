@extends('layouts.default')

@section('content')

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <!-- Add any controls or filters here if needed -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @if (count($barang) > 0)
                    @foreach ($barang as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                            <div class="featured__item">
                                <a href="{{ route('detail', ['id' => $item['id']]) }}">
                                    <div class="featured__item__pic" style="background-image: url('{{ asset('frontend/img/foto-produk/' . $item['gambar']) }}'); background-size: cover; background-position: center; height: 300px;">
                                        <div class="featured__item__pic__hover">
                                         
                                            <a href="{{ route('login') }}" style="background-color: white; color: black; padding: 5px 15px; display: inline-block; border-radius: 20px;">Detail</a>
                                            
                                        </div>
                                    </div>
                                </a>
                                <div class="featured__item__text">
                                    <h6><a href="{{ route('detail', ['id' => $item['id']]) }}">{{ $item['nama_barang'] }}</a></h6>
                                    <h5>Rp {{ number_format($item['harga'], 0, ',', '.') }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No products found.</p>
                @endif
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

@endsection
