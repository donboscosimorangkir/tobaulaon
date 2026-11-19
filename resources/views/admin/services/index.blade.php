@extends('admin.layout')
@section('title', 'Layanan')

@section('content')
    <div class="flex items-center justify-between mb-8 flex-wrap gap-3">
        <div>
            <h1 class="font-display text-3xl font-semibold text-ink">Layanan</h1>
            <p class="text-ink/60">Jasa yang ditawarkan — milik sendiri atau lewat vendor mitra.</p>
        </div>
        <a href="{{ route('admin.layanan.create') }}" class="bg-maroon text-cream px-5 py-2.5 rounded-full font-semibold text-sm hover:bg-maroon-dark transition-colors">
            + Tambah Layanan
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gold-light/60 overflow-hidden overflow-x-auto">
        <table class="w-full text-sm min-w-[700px]">
            <thead>
                <tr class="text-left text-ink/50 text-xs uppercase tracking-wider border-b border-gold-light/40">
                    <th class="px-5 py-3">Layanan</th>
                    <th class="px-5 py-3">Penyedia</th>
                    <th class="px-5 py-3">Harga</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr class="border-b border-gold-light/30 last:border-0 hover:bg-ivory/60">
                        <td class="px-5 py-3 font-medium">{{ $service->name }}</td>
                        <td class="px-5 py-3">
                            @if($service->vendor)
                                <span class="text-xs bg-gold-light/50 text-maroon-dark px-2 py-1 rounded-full">{{ $service->vendor->name }}</span>
                            @else
                                <span class="text-xs bg-ink/10 text-ink px-2 py-1 rounded-full">TobaDecor</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">Rp {{ number_format($service->price, 0, ',', '.') }} <span class="text-ink/40 text-xs">/ {{ str_replace('per_', 'per ', $service->unit) }}</span></td>
                        <td class="px-5 py-3">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $service->status === 'available' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-600' }}">
                                {{ $service->status === 'available' ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.layanan.edit', $service) }}" class="text-maroon font-semibold hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.layanan.destroy', $service) }}" class="inline" onsubmit="return confirm('Hapus layanan ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 font-semibold hover:underline ml-3">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-ink/50">Belum ada layanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
