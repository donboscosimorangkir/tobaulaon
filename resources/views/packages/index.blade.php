@extends('layouts.app')

@section('title', 'Paket Acara & Bundling — TobaUlaon')

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
    
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
        <span class="text-xs font-bold tracking-[0.2em] uppercase text-maroon">Solusi Hemat & Praktis</span>
        <h1 class="font-display text-3xl sm:text-5xl font-bold text-ink">Paket Acara Pernikahan</h1>
        <p class="text-ink-muted text-sm sm:text-base leading-relaxed">
            Bundel lengkap sortali, dekorasi, dan perlengkapan pesta — disusun terpadu untuk memberikan penghematan maksimal.
        </p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($packages as $package)
            @php $savings = $package->savings(); @endphp
            <div class="group bg-white rounded-3xl overflow-hidden border border-gold-light/60 shadow-sm hover:shadow-2xl hover:border-gold hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                
                <div>
                    <!-- IMAGE PREVIEW -->
                    <div class="aspect-[4/3] bg-gradient-to-br from-maroon-50 via-[#FAF7F2] to-gold-muted relative overflow-hidden">
                        @if($package->image)
                            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-maroon/20">
                                <span class="font-display italic text-6xl">✦</span>
                            </div>
                        @endif

                        <div class="batak-motif-strip-sm absolute bottom-0 left-0 right-0 opacity-80"></div>

                        @if($savings > 0)
                            <span class="absolute top-4 right-4 bg-ink text-gold-light text-[11px] font-bold px-3 py-1.5 rounded-full tracking-wider shadow-md border border-gold/40">
                                HEMAT Rp {{ number_format($savings, 0, ',', '.') }}
                            </span>
                        @endif
                    </div>

                    <!-- PACKAGE INFO -->
                    <div class="p-7">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-semibold text-maroon uppercase tracking-wider bg-maroon-50 px-2.5 py-1 rounded-md">
                                {{ $package->items->count() }} Item Termasuk
                            </span>
                        </div>
                        <h3 class="font-display text-2xl font-bold text-ink group-hover:text-maroon transition-colors leading-snug">
                            {{ $package->name }}
                        </h3>
                        <p class="text-xs sm:text-sm text-ink-muted mt-2 line-clamp-2 leading-relaxed">
                            {{ $package->description }}
                        </p>
                    </div>
                </div>

                <!-- PACKAGE PRICE & CTA -->
                <div class="px-7 pb-7 pt-4 border-t border-gold-light/30 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] uppercase text-ink-muted tracking-wider block font-medium">Harga Paket</span>
                        <span class="font-display text-xl sm:text-2xl font-bold text-maroon-dark">
                            Rp {{ number_format($package->price, 0, ',', '.') }}
                        </span>
                    </div>
                    <a href="{{ route('package.show', $package) }}"
                       class="inline-flex items-center gap-1.5 text-xs font-semibold text-cream bg-ink px-5 py-3 rounded-full hover:bg-maroon-dark transition-colors shadow-sm">
                        <span>Lihat Detail</span>
                        <span>→</span>
                    </a>
                </div>

            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl p-16 text-center border border-gold-light/40">
                <span class="font-display text-5xl text-gold block mb-3">✦</span>
                <h3 class="font-display text-2xl font-bold text-ink">Belum Ada Paket Tersedia</h3>
                <p class="text-sm text-ink-muted mt-2 max-w-md mx-auto">Paket acara bundling akan ditampilkan di sini saat dikonfigurasi melalui panel admin.</p>
            </div>
        @endforelse
    </div>
</section>
@endsection
