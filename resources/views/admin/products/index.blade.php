@extends('admin.layout')
@section('title', 'Kelola Produk')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="font-display text-3xl font-bold text-ink">Katalog Produk & Sortali</h1>
            <p class="text-xs sm:text-sm text-ink-muted mt-1">Kelola daftar perlengkapan, harga sewa, dan foto produk.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-maroon text-cream px-5 py-3 rounded-xl font-semibold text-xs sm:text-sm hover:bg-maroon-dark transition-colors shadow-sm">
            <span>+ Tambah Produk Baru</span>
        </a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($products as $product)
            <div class="bg-white rounded-2xl border border-gold-light/60 overflow-hidden shadow-sm hover:shadow-md transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="aspect-[4/3] bg-gradient-to-br from-maroon-50 via-[#FAF7F2] to-gold-muted relative overflow-hidden flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-maroon/20 font-display text-5xl">✦</span>
                        @endif

                        <div class="absolute top-3 left-3">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-maroon bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-md border border-gold-light/40 shadow-xs">
                                {{ $product->category ?? 'Umum' }}
                            </span>
                        </div>

                        <div class="absolute top-3 right-3">
                            @include('admin.partials.status-badge', ['status' => $product->status === 'available' ? 'confirmed' : 'cancelled'])
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="font-display text-lg font-bold text-ink leading-snug">{{ $product->name }}</h3>
                        <p class="font-mono text-sm font-bold text-maroon-dark mt-1">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-xs text-ink-muted mt-2 line-clamp-2 leading-relaxed">
                            {{ $product->description ?: 'Tidak ada deskripsi singkat.' }}
                        </p>
                    </div>
                </div>

                <div class="p-5 pt-0 flex gap-2">
                    <a href="{{ route('admin.products.edit', $product) }}" 
                       class="flex-1 text-center text-xs font-semibold text-ink border border-gold-light/80 rounded-xl py-2.5 hover:bg-gold-muted transition-colors">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs font-semibold text-rose-700 border border-rose-200 bg-rose-50/50 rounded-xl py-2.5 px-4 hover:bg-rose-100 transition-colors">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl p-12 text-center border border-gold-light/40">
                <span class="font-display text-4xl text-gold block mb-2">✦</span>
                <h3 class="font-display text-xl font-bold text-ink">Belum Ada Produk</h3>
                <p class="text-xs text-ink-muted mt-1">Klik tombol "+ Tambah Produk Baru" di atas untuk menambahkan item pertama.</p>
            </div>
        @endforelse
    </div>
@endsection
