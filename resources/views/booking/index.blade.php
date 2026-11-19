@extends('admin.layout')
@section('title', 'Booking')

@section('content')
    <h1 class="font-display text-3xl font-semibold text-ink mb-1">Booking</h1>
    <p class="text-ink/60 mb-6">Semua pesanan perlengkapan acara.</p>

    <form method="GET" class="flex flex-wrap gap-3 mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, HP, atau kode..."
               class="border border-gold-light/70 rounded-lg px-4 py-2 text-sm bg-white focus:border-maroon outline-none flex-1 min-w-[200px]">
        <select name="status" onchange="this.form.submit()" class="border border-gold-light/70 rounded-lg px-4 py-2 text-sm bg-white focus:border-maroon outline-none">
            <option value="">Semua Status</option>
            @foreach (['pending' => 'Menunggu', 'confirmed' => 'Dikonfirmasi', 'picked_up' => 'Diambil', 'returned' => 'Selesai', 'cancelled' => 'Dibatalkan'] as $val => $label)
                <option value="{{ $val }}" @selected(request('status') === $val)>{{ $label }}</option>
            @endforeach
        </select>
        <button class="bg-ink text-cream px-5 py-2 rounded-lg text-sm font-semibold">Cari</button>
    </form>

    <div class="bg-white rounded-xl border border-gold-light/60 overflow-hidden overflow-x-auto">
        <table class="w-full text-sm min-w-[700px]">
            <thead>
                <tr class="text-left text-ink/50 text-xs uppercase tracking-wider border-b border-gold-light/40">
                    <th class="px-5 py-3">Kode</th>
                    <th class="px-5 py-3">Pelanggan</th>
                    <th class="px-5 py-3">Tanggal Acara</th>
                    <th class="px-5 py-3">Total</th>
                    <th class="px-5 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr class="border-b border-gold-light/30 last:border-0 hover:bg-ivory/60 cursor-pointer"
                        onclick="window.location='{{ route('admin.bookings.show', $booking) }}'">
                        <td class="px-5 py-3 font-mono text-xs text-maroon-dark">{{ $booking->code }}</td>
                        <td class="px-5 py-3">
                            {{ $booking->customer->name }}
                            <span class="block text-xs text-ink/40">{{ $booking->customer->phone }}</span>
                        </td>
                        <td class="px-5 py-3">{{ \Carbon\Carbon::parse($booking->event_date)->format('d M Y') }}</td>
                        <td class="px-5 py-3">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td class="px-5 py-3">@include('admin.partials.status-badge', ['status' => $booking->status])</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-ink/50">Tidak ada booking.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">{{ $bookings->links() }}</div>
@endsection
