@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="font-display text-3xl font-bold text-ink">Dashboard Ringkasan</h1>
            <p class="text-xs sm:text-sm text-ink-muted mt-1">Pantau aktivitas pemesanan perlengkapan dan pendapatan acara.</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.bookings.index') }}" class="bg-maroon text-cream px-4 py-2.5 rounded-xl text-xs font-semibold hover:bg-maroon-dark transition-colors">
                Kelola Semua Booking →
            </a>
        </div>
    </div>

    <!-- STAT METRIC CARDS -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        @php
            $cards = [
                ['label' => 'Total Pemesanan', 'value' => $stats['total'], 'icon' => '📋', 'color' => 'border-gold'],
                ['label' => 'Menunggu Konfirmasi', 'value' => $stats['pending'], 'icon' => '⏳', 'color' => 'border-amber-500'],
                ['label' => 'Dikonfirmasi', 'value' => $stats['confirmed'], 'icon' => '✅', 'color' => 'border-sky-500'],
                ['label' => 'Pendapatan Bulan Ini', 'value' => 'Rp ' . number_format($stats['revenue_month'], 0, ',', '.'), 'icon' => '💰', 'color' => 'border-emerald-500'],
            ];
        @endphp
        @foreach ($cards as $card)
            <div class="bg-white rounded-2xl p-6 border-t-4 {{ $card['color'] }} border-x border-b border-gold-light/40 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <span class="text-xs uppercase tracking-wider text-ink-muted font-bold">{{ $card['label'] }}</span>
                    <span class="text-lg opacity-80">{{ $card['icon'] }}</span>
                </div>
                <p class="font-display text-2xl sm:text-3xl font-bold text-ink mt-3">{{ $card['value'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- RECENT BOOKINGS TABLE -->
    <div class="bg-white rounded-2xl border border-gold-light/60 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gold-light/40 flex items-center justify-between bg-[#FAF7F2]/50">
            <div>
                <h2 class="font-display text-lg font-bold text-ink">Booking Terbaru</h2>
                <p class="text-xs text-ink-muted">Pemesanan yang baru saja masuk ke sistem</p>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="text-xs font-semibold text-maroon hover:underline">
                Lihat Semua Booking →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-xs font-semibold text-ink-muted uppercase tracking-wider bg-[#FAF7F2] border-b border-gold-light/40">
                        <th class="px-6 py-3.5">Kode Booking</th>
                        <th class="px-6 py-3.5">Pelanggan</th>
                        <th class="px-6 py-3.5">Tanggal Acara</th>
                        <th class="px-6 py-3.5">Total Harga</th>
                        <th class="px-6 py-3.5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gold-light/20">
                    @forelse ($recentBookings as $booking)
                        <tr class="hover:bg-maroon-50/30 cursor-pointer transition-colors"
                            onclick="window.location='{{ route('admin.bookings.show', $booking) }}'">
                            <td class="px-6 py-4 font-mono font-bold text-maroon-dark text-xs">
                                {{ $booking->code }}
                            </td>
                            <td class="px-6 py-4 font-medium text-ink">
                                {{ $booking->customer->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-xs text-ink-muted">
                                {{ \Carbon\Carbon::parse($booking->event_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 font-mono font-semibold text-ink">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                @include('admin.partials.status-badge', ['status' => $booking->status])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-ink-muted">
                                Belum ada data pemesanan tercatat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
