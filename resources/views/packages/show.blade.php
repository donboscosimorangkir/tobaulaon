@extends('layouts.app')

@section('title', $package->name . ' — TobaUlaon')

@section('content')
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
    
    <a href="{{ route('package.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-ink-muted hover:text-maroon transition-colors mb-8">
        <span>←</span>
        <span>Kembali ke Daftar Paket Acara</span>
    </a>

    <div class="grid md:grid-cols-12 gap-10 lg:gap-14 items-start">
        
        <!-- PACKAGE IMAGE PREVIEW -->
        <div class="md:col-span-5 relative rounded-3xl overflow-hidden bg-gradient-to-br from-maroon-50 via-[#FAF7F2] to-gold-muted border border-gold-light/60 shadow-xl aspect-square">
            @if($package->image)
                <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-maroon/20">
                    <span class="font-display italic text-8xl">✦</span>
                </div>
            @endif
            <div class="batak-motif-strip absolute bottom-0 left-0 right-0"></div>
        </div>

        <!-- PACKAGE DETAILS & ITEMS -->
        <div class="md:col-span-7 space-y-6">
            <h1 class="font-display text-3xl sm:text-4xl font-bold text-ink leading-tight">
                {{ $package->name }}
            </h1>

            <p class="text-sm sm:text-base text-ink-muted leading-relaxed">
                {{ $package->description }}
            </p>

            <!-- ITEM BREAKDOWN BOX -->
            <div class="bg-white rounded-2xl border border-gold-light/60 p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-gold-light/40 pb-3">
                    <span class="text-xs uppercase tracking-widest font-bold text-maroon">Rincian Kelengkapan Paket</span>
                    <span class="text-xs text-ink-muted font-medium">{{ $package->items->count() }} Item</span>
                </div>

                <ul class="space-y-3 divide-y divide-gold-light/20 text-sm">
                    @foreach ($package->items as $item)
                        <li class="flex justify-between items-center pt-2.5 first:pt-0">
                            <div class="flex items-center gap-2.5">
                                <span class="w-2 h-2 rounded-full bg-gold"></span>
                                <span class="font-medium text-ink">{{ $item->itemable->name }}</span>
                            </div>
                            <span class="text-xs text-ink-muted font-mono">
                                Rp {{ number_format($item->itemable->price, 0, ',', '.') }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- PRICE SUMMARY CARD -->
            <div class="p-6 rounded-2xl bg-gradient-to-r from-maroon-dark to-maroon text-linen border border-gold/40 shadow-lg space-y-2">
                @php $savings = $package->savings(); @endphp

                <div class="flex items-baseline justify-between">
                    <div>
                        @if($savings > 0)
                            <span class="text-xs text-gold-light/70 line-through block">
                                Rp {{ number_format($package->individualPriceTotal(), 0, ',', '.') }}
                            </span>
                        @endif
                        <span class="font-display text-3xl sm:text-4xl font-bold text-gold-light">
                            Rp {{ number_format($package->price, 0, ',', '.') }}
                        </span>
                    </div>

                    @if($savings > 0)
                        <span class="bg-gold/20 text-gold-light border border-gold/40 text-xs font-bold px-3 py-1.5 rounded-full">
                            Hemat Rp {{ number_format($savings, 0, ',', '.') }}
                        </span>
                    @endif
                </div>

                @if($savings > 0)
                    <p class="text-xs text-linen/70 pt-1">
                        Lebih hemat disbanding memesan item perlengkapan secara terpisah.
                    </p>
                @endif
            </div>

            <!-- BOOKING CTA -->
            <a href="{{ route('booking.create', ['package' => $package->id]) }}"
               class="block text-center bg-maroon text-cream px-8 py-4 rounded-full font-semibold text-sm hover:bg-maroon-dark hover:shadow-gold-glow transition-all duration-300">
                Pesan Paket Ini Sekarang
            </a>
        </div>
    </div>
</section>
@endsection
