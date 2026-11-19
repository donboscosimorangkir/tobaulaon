@extends('admin.layout')
@section('title', 'Paket')

@section('content')
    <div class="flex items-center justify-between mb-8 flex-wrap gap-3">
        <div>
            <h1 class="font-display text-3xl font-semibold text-ink">Paket</h1>
            <p class="text-ink/60">Bundel produk & layanan siap pakai untuk pelanggan.</p>
        </div>
        <a href="{{ route('admin.paket.create') }}" class="bg-maroon text-cream px-5 py-2.5 rounded-full font-semibold text-sm hover:bg-maroon-dark transition-colors">
            + Tambah Paket
        </a>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse ($packages as $package)
            <div class="bg-white rounded-xl border border-gold-light/60 overflow-hidden">
                <div class="aspect-[4/3] bg-gradient-to-br from-maroon-50 to-gold-light/40 flex items-center justify-center">
                    @if($package->image)
                        <img src="{{ asset('storage/' . $package->image) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-maroon/30 font-display text-3xl">✦</span>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-display font-semibold text-ink">{{ $package->name }}</h3>
                    <p class="text-sm text-ink/60 mt-0.5">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                    <p class="text-xs text-ink/40 mt-1">{{ $package->items->count() }} item di dalamnya</p>
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('admin.paket.edit', $package) }}" class="flex-1 text-center text-sm font-semibold border border-ink/20 rounded-full py-2 hover:bg-ink hover:text-cream transition-colors">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.paket.destroy', $package) }}" onsubmit="return confirm('Hapus paket ini?')">
                            @csrf @method('DELETE')
                            <button class="text-sm font-semibold text-red-600 border border-red-200 rounded-full py-2 px-4 hover:bg-red-50 transition-colors">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-ink/50 col-span-full text-center py-12">Belum ada paket.</p>
        @endforelse
    </div>
@endsection
