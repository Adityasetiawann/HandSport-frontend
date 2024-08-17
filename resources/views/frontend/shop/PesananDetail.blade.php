// resources/views/pesanan_detail.blade.php

@extends('layouts.frontend')

@section('content')
<section class="pesanan-detail spad" style="margin-top: 0; padding-top: 10px;">
    <div class="container" style="max-width: 1200px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="pesanan__detail__text" style="margin-top: 80px; padding: 30px; background-color: #f9f9f9; border-radius: 10px;">
                    <h3 style="margin-bottom: 20px; font-size: 24px;">Pesanan Anda</h3>
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <p>Terima kasih telah melakukan pemesanan. Pesanan Anda sedang diproses.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
