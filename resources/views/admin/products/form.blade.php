@extends('admin.layout')
@section('title', $product->exists ? 'Edit Produk' : 'Tambah Produk')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">
        <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-ink-muted hover:text-maroon transition-colors">
            <span>←</span>
            <span>Kembali ke Katalog Produk</span>
        </a>

        <div class="border-b border-gold-light/40 pb-4">
            <h1 class="font-display text-3xl font-bold text-ink">
                {{ $product->exists ? 'Edit Data Produk' : 'Tambah Produk Baru' }}
            </h1>
            <p class="text-xs sm:text-sm text-ink-muted mt-1">Isi rincian informasi item perlengkapan acara di bawah ini.</p>
        </div>

        @if ($errors->any())
            <div class="bg-maroon-50 border-l-4 border-maroon text-maroon-dark p-4 rounded-xl text-xs sm:text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
              enctype="multipart/form-data" 
              class="bg-white p-6 sm:p-8 rounded-3xl border border-gold-light/60 shadow-sm space-y-6">
            @csrf
            @if($product->exists) @method('PUT') @endif

            <div>
                <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required placeholder="Contoh: Sortali Pria Premium Motif Gorga"
                       class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Kategori *</label>
                    <select name="category" class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                        @foreach (['Pria', 'Wanita', 'Paket', 'Aksesoris'] as $cat)
                            <option value="{{ $cat }}" @selected(old('category', $product->category) === $cat)>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Harga Sewa (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" placeholder="250000"
                           class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink font-mono focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Deskripsi Produk</label>
                <textarea name="description" rows="4" placeholder="Jelaskan detail bahan, kelengkapan, dan kondisi barang..."
                          class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="grid sm:grid-cols-2 gap-5 items-start">
                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Status Produk *</label>
                    <select name="status" class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                        @foreach (['available' => 'Tersedia', 'maintenance' => 'Dalam Perawatan', 'retired' => 'Tidak Aktif'] as $val => $label)
                            <option value="{{ $val }}" @selected(old('status', $product->status) === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Unggah Foto Produk</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full border border-gold-light/80 rounded-xl p-2 bg-[#FAF7F2]/50 text-xs text-ink">
                    @if($product->image)
                        <div class="mt-3 flex items-center gap-3">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 object-cover rounded-xl border border-gold-light/60">
                            <span class="text-xs text-ink-muted">Foto saat ini</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gold-light/40">
                <button type="submit" class="bg-maroon text-cream px-7 py-3.5 rounded-full font-semibold text-sm hover:bg-maroon-dark transition-all duration-300">
                    Simpan Data Produk
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3.5 rounded-full font-semibold text-sm text-ink border border-gold-light/80 hover:bg-gold-muted transition-all duration-300">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
