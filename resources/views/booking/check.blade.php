@extends('layouts.app')

@section('title', 'Cek Status Pesanan — TobaUlaon')

@section('content')
<section class="max-w-lg mx-auto px-4 sm:px-6 py-16 sm:py-24">
    
    <div class="text-center mb-10 space-y-2">
        <div class="w-12 h-12 mx-auto rounded-full bg-gold-muted border border-gold-light flex items-center justify-center text-maroon text-xl font-serif mb-3">
            ✦
        </div>
        <h1 class="font-display text-3xl font-bold text-ink">Cek Status Pesanan</h1>
        <p class="text-xs sm:text-sm text-ink-muted leading-relaxed">
            Masukkan kode booking unik dan nomor WhatsApp yang digunakan saat memesan.
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-maroon-50 border-l-4 border-maroon text-maroon-dark p-4 rounded-xl mb-6 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-white rounded-3xl p-8 border border-gold-light/60 shadow-xl relative overflow-hidden">
        <div class="batak-motif-strip-sm absolute top-0 left-0 right-0"></div>

        <form method="POST" action="{{ route('booking.check.submit') }}" class="space-y-5 pt-2">
            @csrf
            
            <div>
                <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Kode Booking *</label>
                <input type="text" name="code" value="{{ old('code') }}" required placeholder="Contoh: SRT-20260725-001"
                       class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm font-mono text-ink tracking-wider uppercase focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Nomor WhatsApp *</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="Contoh: 0812xxxxxxx"
                       class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
            </div>

            <button type="submit" class="w-full bg-maroon text-cream py-3.5 rounded-full font-semibold text-sm hover:bg-maroon-dark hover:shadow-gold-glow transition-all duration-300">
                Lacak Status Pesanan →
            </button>
        </form>
    </div>

</section>
@endsection
