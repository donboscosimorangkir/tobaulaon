@extends('admin.layout')
@section('title', 'Vendor')

@section('content')
    <div class="flex items-center justify-between mb-8 flex-wrap gap-3">
        <div>
            <h1 class="font-display text-3xl font-semibold text-ink">Vendor & Mitra</h1>
            <p class="text-ink/60">Kelola mitra kerja sama untuk kebutuhan di luar produk TobaDecor.</p>
        </div>
        <a href="{{ route('admin.vendor.create') }}" class="bg-maroon text-cream px-5 py-2.5 rounded-full font-semibold text-sm hover:bg-maroon-dark transition-colors">
            + Tambah Vendor
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gold-light/60 overflow-hidden overflow-x-auto">
        <table class="w-full text-sm min-w-[600px]">
            <thead>
                <tr class="text-left text-ink/50 text-xs uppercase tracking-wider border-b border-gold-light/40">
                    <th class="px-5 py-3">Nama Vendor</th>
                    <th class="px-5 py-3">Kontak</th>
                    <th class="px-5 py-3">Jenis Layanan</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vendors as $vendor)
                    <tr class="border-b border-gold-light/30 last:border-0 hover:bg-ivory/60">
                        <td class="px-5 py-3 font-medium">{{ $vendor->name }}</td>
                        <td class="px-5 py-3 text-ink/60">{{ $vendor->contact_person }} — {{ $vendor->phone }}</td>
                        <td class="px-5 py-3">{{ $vendor->service_type ?? '—' }}</td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.vendor.edit', $vendor) }}" class="text-maroon font-semibold hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.vendor.destroy', $vendor) }}" class="inline" onsubmit="return confirm('Hapus vendor ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 font-semibold hover:underline ml-3">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-5 py-8 text-center text-ink/50">Belum ada vendor.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
