@extends('layouts.app')

@section('title', 'Booking Berhasil — TobaUlaon')

@section('content')
<section class="max-w-xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
    
    <div class="bg-white rounded-3xl overflow-hidden border border-gold-light/60 shadow-2xl relative">
        <div class="batak-motif-strip"></div>

        <div class="p-8 sm:p-10 text-center">
            
            <div class="w-16 h-16 mx-auto rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center text-3xl mb-4 shadow-sm">
                ✓
            </div>

            <h1 class="font-display text-3xl font-bold text-ink">Booking Berhasil Diterima</h1>
            <p class="text-xs sm:text-sm text-ink-muted mt-2">
                Terima kasih! Permohonan booking Anda telah tersimpan. Simpan kode di bawah untuk mengecek status pesanan.
            </p>

            <!-- BOOKING CODE CARD -->
            <div class="my-6 bg-[#FAF7F2] border border-dashed border-gold-dark rounded-2xl p-6 shadow-inner space-y-1">
                <span class="text-[10px] uppercase tracking-[0.2em] text-ink-muted font-bold block">Kode Booking Anda</span>
                <p class="font-mono text-3xl sm:text-4xl font-bold text-maroon-dark tracking-widest">
                    {{ $booking->code }}
                </p>
                @if($booking->package)
                    <span class="text-xs font-semibold text-maroon block pt-1">
                        Paket: {{ $booking->package->name }}
                    </span>
                @endif
            </div>

            <!-- DETAILS SUMMARY -->
            <div class="text-left bg-white p-5 rounded-2xl border border-gold-light/40 space-y-3 text-xs sm:text-sm text-ink-muted">
                <div class="flex justify-between border-b border-gold-light/30 pb-2">
                    <span>Tanggal Acara:</span>
                    <span class="font-semibold text-ink">{{ \Carbon\Carbon::parse($booking->event_date)->translatedFormat('d F Y') }}</span>
                </div>
                <div class="flex justify-between border-b border-gold-light/30 pb-2">
                    <span>Rentang Ambil – Kembali:</span>
                    <span class="font-semibold text-ink">
                        {{ \Carbon\Carbon::parse($booking->pickup_date)->format('d/m/Y') }} – {{ \Carbon\Carbon::parse($booking->return_date)->format('d/m/Y') }}
                    </span>
                </div>
                <div class="flex justify-between border-b border-gold-light/30 pb-2">
                    <span>Total Estimasi:</span>
                    <span class="font-bold text-maroon-dark text-base">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Status Awal:</span>
                    <span class="font-semibold text-ink capitalize bg-gold-muted px-2.5 py-0.5 rounded text-xs">{{ $booking->status }}</span>
                </div>
            </div>

            <!-- ACTIONS -->
            <div class="mt-8 space-y-3">
                <a href="https://wa.me/6281260233474?text=Halo,%20saya%20sudah%20booking%20dengan%20kode%20{{ $booking->code }}"
                   target="_blank" rel="noopener"
                   class="flex items-center justify-center gap-2 bg-maroon text-cream w-full py-4 rounded-full font-semibold text-sm hover:bg-maroon-dark hover:shadow-gold-glow transition-all duration-300">
                    <span>Konfirmasi via WhatsApp Sekarang →</span>
                </a>
                <a href="{{ route('home') }}" class="block text-xs text-ink-muted hover:text-maroon transition-colors py-1">
                    ← Kembali ke Beranda
                </a>
            </div>

        </div>

        <div class="batak-motif-strip"></div>
    </div>

</section>

<!-- CLEAR CART UPON SUCCESSFUL BOOKING -->
<script>
    try {
        localStorage.removeItem('tobaulaon_cart');
    } catch(e) {
        console.error("Cart clear error:", e);
    }
</script>
@endsection
