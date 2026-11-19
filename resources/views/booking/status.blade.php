@extends('layouts.app')

@section('title', 'Status Pesanan — TobaUlaon')

@section('content')
<section class="max-w-xl mx-auto px-4 sm:px-6 py-12 sm:py-16">
    
    <div class="bg-white rounded-3xl overflow-hidden border border-gold-light/60 shadow-2xl relative">
        
        <!-- TOP BATAK MOTIF STRIP -->
        <div class="batak-motif-strip"></div>

        <div class="p-8 sm:p-10">
            
            <!-- CODE & BADGE HEADER -->
            <div class="text-center pb-6 border-b border-gold-light/40 space-y-3">
                <span class="text-[10px] uppercase tracking-[0.2em] text-ink-muted font-bold block">Kode Booking Anda</span>
                <p class="font-mono text-3xl font-bold text-maroon-dark tracking-widest bg-gold-muted/50 inline-block px-4 py-1.5 rounded-xl border border-gold-light/60">
                    {{ $booking->code }}
                </p>
                <div class="mt-3">
                    @include('admin.partials.status-badge', ['status' => $booking->status])
                </div>
            </div>

            <!-- ITEMS BREAKDOWN -->
            <div class="py-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-display text-base font-bold text-ink">Rincian Item Pesanan</h3>
                    @if($booking->package)
                        <span class="text-[10px] font-bold uppercase tracking-wider text-maroon bg-maroon-50 px-2.5 py-1 rounded-md">
                            Paket: {{ $booking->package->name }}
                        </span>
                    @endif
                </div>

                <div class="space-y-2.5 text-sm">
                    @foreach ($booking->items as $item)
                        <div class="flex justify-between items-center border-b border-gold-light/30 pb-2 text-ink/80">
                            <span>{{ $item->product->name }}</span>
                            <span class="font-mono font-medium {{ $booking->package ? 'text-ink-muted italic text-xs' : 'text-maroon-dark' }}">
                                {{ $booking->package ? 'termasuk paket' : 'Rp ' . number_format($item->price, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach

                    @foreach ($booking->services as $bookingService)
                        <div class="flex justify-between items-center border-b border-gold-light/30 pb-2 text-ink/80">
                            <span>{{ $bookingService->service->name }} <span class="text-xs text-ink-muted">(Layanan)</span></span>
                            <span class="font-mono font-medium {{ $booking->package ? 'text-ink-muted italic text-xs' : 'text-maroon-dark' }}">
                                {{ $booking->package ? 'termasuk paket' : 'Rp ' . number_format($bookingService->price, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach

                    <div class="flex justify-between items-center pt-2 text-base font-bold">
                        <span class="font-display text-ink">Total Pembayaran</span>
                        <span class="font-display text-maroon-dark text-lg">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- DATE & DETAILS -->
            <div class="bg-[#FAF7F2] rounded-2xl p-5 border border-gold-light/40 space-y-3 text-xs sm:text-sm text-ink-muted">
                <div class="flex justify-between border-b border-gold-light/30 pb-2">
                    <span>Tanggal Acara:</span>
                    <span class="font-semibold text-ink">{{ \Carbon\Carbon::parse($booking->event_date)->translatedFormat('d F Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Rentang Ambil – Kembalikan:</span>
                    <span class="font-semibold text-ink">
                        {{ \Carbon\Carbon::parse($booking->pickup_date)->format('d/m/Y') }} – {{ \Carbon\Carbon::parse($booking->return_date)->format('d/m/Y') }}
                    </span>
                </div>
            </div>

            <!-- PAYMENT HISTORY IF ANY -->
            @if ($booking->payments->isNotEmpty())
                <div class="mt-6 pt-4 border-t border-gold-light/40 space-y-2">
                    <p class="text-xs font-bold text-ink uppercase tracking-wider mb-2">Riwayat Pembayaran</p>
                    @foreach ($booking->payments as $payment)
                        <div class="flex justify-between text-xs text-ink-muted bg-white p-3 rounded-xl border border-gold-light/30">
                            <span>{{ strtoupper($payment->type) }} — Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                            <span class="{{ $payment->status === 'verified' ? 'text-emerald-700 font-bold' : 'text-gold-dark font-bold' }}">
                                {{ $payment->status === 'verified' ? 'Terverifikasi ✓' : 'Menunggu Verifikasi' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- ACTION BUTTONS -->
            <div class="mt-8 space-y-3">
                <a href="https://wa.me/6281260233474?text=Halo,%20saya%20mau%20tanya%20soal%20booking%20{{ $booking->code }}"
                   target="_blank" rel="noopener"
                   class="flex items-center justify-center gap-2 bg-maroon text-cream w-full py-3.5 rounded-full font-semibold text-sm hover:bg-maroon-dark hover:shadow-gold-glow transition-all duration-300">
                    <span>Konfirmasi via WhatsApp</span>
                </a>
                <a href="{{ route('booking.check') }}" class="block text-center text-xs text-ink-muted hover:text-maroon transition-colors py-1">
                    ← Cek Kode Booking Lain
                </a>
            </div>

        </div>
        
        <!-- BOTTOM BATAK MOTIF STRIP -->
        <div class="batak-motif-strip"></div>
    </div>

</section>
@endsection
