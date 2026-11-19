@extends('layouts.app')

@section('title', $product->name . ' — TobaUlaon')

@section('content')
<section class="max-w-5xl mx-auto px-5 sm:px-8 py-12">
    <a href="{{ route('home') }}#katalog" class="text-sm text-ink/50 hover:text-maroon">← Kembali ke Katalog</a>

    <div class="grid md:grid-cols-2 gap-10 mt-6">
        <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-maroon-50 to-gold-light/40 aspect-square">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-maroon/30 font-display text-6xl">✦</div>
            @endif
            <div class="tumpal-strip absolute bottom-0 left-0 right-0"></div>
        </div>

        <div>
            @if($product->category)
                <span class="inline-block text-[11px] font-bold tracking-widest uppercase text-maroon bg-maroon-50 px-3 py-1.5 rounded-full">
                    {{ $product->category }}
                </span>
            @endif

            <h1 class="font-display text-3xl sm:text-4xl font-semibold text-ink mt-4">{{ $product->name }}</h1>
            <p class="font-display text-2xl text-maroon-dark font-semibold mt-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

            <p class="text-ink/70 leading-relaxed mt-5">
                {{ $product->description ?: 'Sortali adat Batak, dirawat dengan teliti dan siap dipakai untuk hari pernikahanmu.' }}
            </p>

            <div class="mt-8 flex flex-col sm:flex-row gap-3">
                <button type="button" id="add-to-cart-btn" onclick="addToCart('{{ $product->id }}')"
                        class="flex-1 bg-maroon text-cream px-6 py-3.5 rounded-full font-semibold hover:bg-maroon-dark transition-colors">
                    + Tambah ke Pesanan
                </button>
                <a href="{{ route('booking.create') }}"
                   class="flex-1 text-center border-2 border-ink/20 text-ink px-6 py-3.5 rounded-full font-semibold hover:border-maroon/50 transition-colors">
                    Lihat Pesanan Saya
                </a>
            </div>

            <p class="text-xs text-ink/40 mt-3">Barang yang kamu tambahkan akan tersimpan otomatis sampai kamu isi form booking.</p>
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
        const original = btn.textContent;
        btn.textContent = 'Ditambahkan ✓';
        setTimeout(() => { btn.textContent = original; }, 1500);
        if (typeof updateCartBadge === 'function') updateCartBadge();
    }
</script>
@endsection
