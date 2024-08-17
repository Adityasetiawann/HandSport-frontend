@extends('layouts.frontend')

@section('content')
<section class="payment spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Halaman Pembayaran</h2>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Isi halaman pembayaran di sini -->
            </div>
        </div>
    </div>
</section>
@endsection
