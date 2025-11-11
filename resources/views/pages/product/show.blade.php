@extends('layouts.app')

@section('content')
<form method="GET" action="{{ route('products.index') }}" class="row mb-4">
    <div class="col-md-8">
        <input type="text" name="search" class="form-control" placeholder="Cari alat kesehatan..."
            value="{{ request('search') }}">
    </div>
    <div class="col-md-1">
        <button class="btn btn-DC143C w-100">Cari</button>
    </div>
</form>
<div class="container py-4">
    <div class="row">
        <div class="col-md-5">
            @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}"
                alt="{{ $product->name }}"
                class="img-fluid rounded shadow-sm">
            @else
            <div class="bg-light text-center py-5 rounded border">
                <p class="text-muted">Tidak ada gambar</p>
            </div>
            @endif
        </div>
        <div class="col-md-7">
            <h3 class="mb-2">{{ $product->name }}</h3>
            <p class="text-muted mb-1">Kategori: {{ $product->category_name ?? '-' }}</p>
            <h4 class="text-danger mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>

            <p><strong>Deskripsi:</strong> {{ $product->description}}</p>
            <p><strong>Brand:</strong> {{ $product->brand ?? '-' }}</p>
            <p><strong>Stok:</strong> {{ $product->quantity ?? '0' }}</p>

            <div class="mt-3">
                @auth
                <button class="btn btn-f75270 btn-lg add-to-cart" data-id="{{ $product->id }}">
                    Tambah ke Keranjang
                </button>
                @else
                <a href="{{ route('login') }}" class="btn btn-f75270 btn-lg">
                    Login untuk beli
                </a>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
    .btn-f75270 {
        background-color: #F75270;
        border-color: #F75270;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-f75270:hover {
        background-color: white;
        color: #F75270;
        border-color: #F75270;
    }
</style>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            var deviceId = $(this).data('id');
            $.post("/cart/add/" + deviceId, {
                _token: '{{ csrf_token() }}'
            }, function(response) {
                alert('Produk berhasil ditambahkan ke keranjang');
            }).fail(function() {
                alert('Gagal menambahkan ke keranjang');
            });
        });
    });
</script>
@endpush
<style>
    .btn-f75270 {
        background-color: #F75270;
        border-color: #F75270;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-f75270:hover {
        background-color: white;
        color: #F75270;
        border-color: #F75270;
    }

    .btn-DC143C {
        background-color: #DC143C;
        border-color: #DC143C;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-DC143C:hover {
        background-color: white;
        color: #DC143C;
        border-color: #DC143C;
    }

    .product-card:hover {
        transform: scale(1.02);
        transition: all 0.2s ease;
    }
</style>
@endsection