@extends('admin.layout')
@section('title', 'Detail Booking')

@section('content')
    <a href="{{ route('admin.bookings.index') }}" class="text-sm text-ink/50 hover:text-maroon">← Kembali</a>

    <div class="flex items-center justify-between mt-3 mb-8 flex-wrap gap-3">
        <div>
            <h1 class="font-display text-2xl sm:text-3xl font-semibold text-ink font-mono">{{ $booking->code }}</h1>
            <p class="text-ink/60 mt-1">Dibuat {{ $booking->created_at->translatedFormat('d F Y, H:i') }}</p>
        </div>
        @include('admin.partials.status-badge', ['status' => $booking->status])
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-xl border border-gold-light/60 p-5">
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-semibold text-ink">Item Dipesan</h2>
        @if($booking->package)
            <span class="text-xs bg-gold-light/50 text-maroon-dark px-2.5 py-1 rounded-full font-semibold">
                Paket: {{ $booking->package->name }}
            </span>
        @endif
    </div>
    <table class="w-full text-sm">
        <tbody>
            @foreach ($booking->items as $item)
                <tr class="border-b border-gold-light/30 last:border-0">
                    <td class="py-2.5">{{ $item->product->name }}</td>
                    <td class="py-2.5 text-right {{ $booking->package ? 'text-ink/40 italic' : '' }}">
                        {{ $booking->package ? 'termasuk paket' : 'Rp ' . number_format($item->price, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            @foreach ($booking->services as $bookingService)
                <tr class="border-b border-gold-light/30 last:border-0">
                    <td class="py-2.5">{{ $bookingService->service->name }} <span class="text-xs text-ink/40">(layanan)</span></td>
                    <td class="py-2.5 text-right {{ $booking->package ? 'text-ink/40 italic' : '' }}">
                        {{ $booking->package ? 'termasuk paket' : 'Rp ' . number_format($bookingService->price, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="py-2.5 font-semibold">Total {{ $booking->package ? '(Harga Paket)' : '' }}</td>
                <td class="py-2.5 text-right font-semibold text-maroon-dark">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</div>

            <div class="bg-white rounded-xl border border-gold-light/60 p-5">
                <h2 class="font-semibold text-ink mb-4">Pembayaran</h2>
                @forelse ($booking->payments as $payment)
                    <div class="flex items-center justify-between py-2 border-b border-gold-light/30 last:border-0 text-sm">
                        <span>{{ strtoupper($payment->type) }} — Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                        @include('admin.partials.status-badge', ['status' => $payment->status === 'verified' ? 'confirmed' : 'pending'])
                    </div>
                @empty
                    <p class="text-sm text-ink/50 mb-3">Belum ada pembayaran tercatat.</p>
                @endforelse

                <form method="POST" action="{{ route('admin.bookings.payment', $booking) }}" class="grid sm:grid-cols-4 gap-2 mt-4">
                    @csrf
                    <input type="number" name="amount" placeholder="Jumlah" required class="border border-gold-light/70 rounded-lg px-3 py-2 text-sm sm:col-span-1">
                    <select name="type" class="border border-gold-light/70 rounded-lg px-3 py-2 text-sm">
                        <option value="dp">DP</option>
                        <option value="lunas">Lunas</option>
                    </select>
                    <select name="status" class="border border-gold-light/70 rounded-lg px-3 py-2 text-sm">
                        <option value="pending">Belum Diverifikasi</option>
                        <option value="verified">Terverifikasi</option>
                    </select>
                    <button class="bg-ink text-cream rounded-lg text-sm font-semibold py-2">Catat</button>
                </form>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-gold-light/60 p-5">
                <h2 class="font-semibold text-ink mb-3">Pelanggan</h2>
                <p class="text-sm"><span class="text-ink/50">Nama:</span> {{ $booking->customer->name }}</p>
                <p class="text-sm mt-1"><span class="text-ink/50">WA:</span> {{ $booking->customer->phone }}</p>
                @if($booking->customer->address)
                    <p class="text-sm mt-1"><span class="text-ink/50">Alamat:</span> {{ $booking->customer->address }}</p>
                @endif
                <a href="https://wa.me/{{ ltrim($booking->customer->phone, '0') }}" target="_blank"
                   class="block text-center mt-4 bg-maroon text-cream py-2 rounded-full text-sm font-semibold hover:bg-maroon-dark">
                    Chat WhatsApp
                </a>
            </div>

            <div class="bg-white rounded-xl border border-gold-light/60 p-5">
                <h2 class="font-semibold text-ink mb-3">Tanggal</h2>
                <p class="text-sm"><span class="text-ink/50">Acara:</span> {{ \Carbon\Carbon::parse($booking->event_date)->translatedFormat('d F Y') }}</p>
                <p class="text-sm mt-1"><span class="text-ink/50">Ambil:</span> {{ \Carbon\Carbon::parse($booking->pickup_date)->translatedFormat('d F Y') }}</p>
                <p class="text-sm mt-1"><span class="text-ink/50">Kembali:</span> {{ \Carbon\Carbon::parse($booking->return_date)->translatedFormat('d F Y') }}</p>
                @if($booking->notes)
                    <p class="text-sm mt-3 pt-3 border-t border-gold-light/30 text-ink/70">{{ $booking->notes }}</p>
                @endif
            </div>

            <div class="bg-white rounded-xl border border-gold-light/60 p-5">
                <h2 class="font-semibold text-ink mb-3">Ubah Status</h2>
                <form method="POST" action="{{ route('admin.bookings.status', $booking) }}" class="space-y-3">
                    @csrf @method('PATCH')
                    <select name="status" class="w-full border border-gold-light/70 rounded-lg px-3 py-2 text-sm">
                        @foreach (['pending' => 'Menunggu', 'confirmed' => 'Dikonfirmasi', 'picked_up' => 'Diambil', 'returned' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $val => $label)
                            <option value="{{ $val }}" @selected($booking->status === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <button class="w-full bg-ink text-cream py-2 rounded-full text-sm font-semibold hover:bg-maroon-dark">
                        Perbarui
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
