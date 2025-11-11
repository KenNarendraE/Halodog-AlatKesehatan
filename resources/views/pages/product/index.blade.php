@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form method="GET" action="{{ route('products.index') }}" class="row mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Cari alat kesehatan..."
            value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <select name="category" class="form-control">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-DC143C w-100">Cari</button>
    </div>
</form>

<div class="row g-1">
    @forelse($products as $device)
    <div class="col-6 col-md-2 mb-4" style="flex: 0 0 20%; max-width: 20%;">
        <div class="card h-100 product-card"
            data-id="{{ $device->id }}"
            style="border-radius: 3px; margin: 5px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1); cursor: pointer;">

            @if ($device->image)
            <img src="{{ asset('storage/' . $device->image) }}" class="card-img-top img-fluid"
                alt="{{ $device->name }}" style="max-height: 160px; object-fit: cover;">
            @endif

            <div class="card-body p-2">
                <h6 class="card-title text-truncate">{{ $device->name }}</h6>
                <b class="card-text text-danger d-block">Rp {{ number_format($device->price, 0, ',', '.') }}</b>
                <small class="card-text d-block">{{ $device->brand }}</small>
                <small class="card-text d-block">Stok: {{ $device->quantity }}</small>

                @auth
                <button class="btn btn-f75270 btn-sm mt-2 w-100 add-to-cart" data-id="{{ $device->id }}">
                    Tambah
                </button>
                @else
                <a href="{{ route('login') }}" class="btn btn-f75270 btn-sm mt-2 w-100">
                    Login untuk beli
                </a>
                @endauth
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <p class="text-muted">Produk tidak ditemukan.</p>
    </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $products->links('pagination::bootstrap-5') }}
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Klik card ke halaman detail (misal /products/{id})
        $('.product-card').click(function(e) {
            // Jika klik berasal dari tombol, jangan pindah halaman
            if (!$(e.target).hasClass('add-to-cart')) {
                var id = $(this).data('id');
                window.location.href = "/products/" + id;
            }
        });

        // Tambah ke keranjang
        $('.add-to-cart').click(function(e) {
            e.stopPropagation(); // hentikan klik card
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