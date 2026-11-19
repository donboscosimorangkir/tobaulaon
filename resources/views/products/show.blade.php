@extends('layouts.app')

@section('title', $product->name . ' — TobaUlaon')

@section('content')
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    
    <a href="{{ route('home') }}#katalog" class="inline-flex items-center gap-2 text-xs font-semibold text-ink-muted hover:text-maroon transition-colors mb-8">
        <span>←</span>
        <span>Kembali ke Katalog Perlengkapan</span>
    </a>

    <div class="grid md:grid-cols-12 gap-10 lg:gap-14 items-start">
        
        <!-- PRODUCT IMAGE PREVIEW -->
        <div class="md:col-span-6 relative rounded-3xl overflow-hidden bg-gradient-to-br from-maroon-50 via-[#FAF7F2] to-gold-muted border border-gold-light/60 shadow-xl aspect-square">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-maroon/20">
                    <span class="font-display italic text-8xl">✦</span>
                </div>
            @endif
            <div class="batak-motif-strip absolute bottom-0 left-0 right-0"></div>
        </div>

        <!-- PRODUCT DETAILS & ACTIONS -->
        <div class="md:col-span-6 space-y-6">
            @if($product->category)
                <span class="inline-block text-xs font-bold tracking-[0.2em] uppercase text-maroon bg-maroon-50 border border-maroon-100 px-3.5 py-1.5 rounded-full">
                    {{ $product->category }}
                </span>
            @endif

            <h1 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-ink leading-tight">
                {{ $product->name }}
            </h1>

            <div class="p-5 rounded-2xl bg-white border border-gold-light/60 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-xs text-ink-muted uppercase tracking-wider block font-medium">Harga Sewa Acara</span>
                    <span class="font-display text-2xl sm:text-3xl font-bold text-maroon-dark">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                </div>
                <span class="text-xs text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full font-semibold border border-emerald-200">
                    Tersedia
                </span>
            </div>

            <div class="space-y-3 pt-2">
                <h3 class="font-display text-lg font-bold text-ink">Deskripsi Produk</h3>
                <p class="text-sm sm:text-base text-ink-muted leading-relaxed">
                    {{ $product->description ?: 'Sortali dan perlengkapan pesta adat Batak premium, dirawat secara profesional dan siap pakai untuk menyempurnakan hari bahagia pernikahan Anda.' }}
                </p>
            </div>

            <div class="border-t border-gold-light/40 pt-6 space-y-4">
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" id="add-to-cart-btn" onclick="addToCart('{{ $product->id }}')"
                            class="flex-1 bg-maroon text-cream px-7 py-4 rounded-full font-semibold text-sm hover:bg-maroon-dark hover:shadow-gold-glow transition-all duration-300">
                        + Tambah ke Pesanan Saya
                    </button>
                    <a href="{{ route('booking.create') }}"
                       class="flex-1 text-center bg-white border border-gold-light/80 text-ink px-7 py-4 rounded-full font-semibold text-sm hover:border-maroon/40 hover:bg-gold-muted/50 transition-all duration-300">
                        Lihat Pesanan Saya
                    </a>
                </div>

                <div class="flex items-center gap-2 text-xs text-ink-muted bg-gold-muted/40 px-4 py-3 rounded-xl border border-gold-light/40">
                    <span class="text-gold">✦</span>
                    <span>Item tersimpan otomatis di browser hingga Anda mengirimkan formulir booking.</span>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    function addToCart(id) {
        let cart = JSON.parse(localStorage.getItem('tobaulaon_cart') || '[]');
        if (!cart.includes(String(id))) {
            cart.push(String(id));
            localStorage.setItem('tobaulaon_cart', JSON.stringify(cart));
        }
        const btn = document.getElementById('add-to-cart-btn');
        if (btn) {
            const original = btn.textContent;
            btn.textContent = 'Ditambahkan ke Pesanan ✓';
            btn.classList.add('bg-emerald-700');
            setTimeout(() => { 
                btn.textContent = original; 
                btn.classList.remove('bg-emerald-700');
            }, 1800);
        }
        if (typeof updateCartBadge === 'function') updateCartBadge();
    }
</script>
@endsection
