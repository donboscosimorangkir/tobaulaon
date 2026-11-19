@extends('admin.layout')
@section('title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan')

@section('content')
    <div class="max-w-xl mx-auto">
        <a href="{{ route('admin.layanan.index') }}" class="text-sm text-ink/50 hover:text-maroon">← Kembali</a>
        <h1 class="font-display text-3xl font-semibold text-ink mt-3 mb-8">
            {{ $service->exists ? 'Edit Layanan' : 'Tambah Layanan' }}
        </h1>

        @if ($errors->any())
            <div class="bg-maroon-50 border border-maroon/30 text-maroon-dark px-4 py-3 rounded-lg mb-6 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $service->exists ? route('admin.layanan.update', $service) : route('admin.layanan.store') }}"
              class="space-y-5 bg-white p-6 sm:p-8 rounded-xl border border-gold-light/60 shadow-sm">
            @csrf
            @if($service->exists) @method('PUT') @endif

            <div>
                <label class="block text-sm font-medium mb-1.5">Nama Layanan</label>
                <input type="text" name="name" value="{{ old('name', $service->name) }}" required
                       class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1.5">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $service->price) }}" required min="0"
                           class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1.5">Satuan</label>
                    <select name="unit" class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
                        @foreach (['per_acara' => 'Per Acara', 'per_jam' => 'Per Jam', 'per_hari' => 'Per Hari'] as $val => $label)
                            <option value="{{ $val }}" @selected(old('unit', $service->unit) === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1.5">Penyedia</label>
                    <select name="vendor_id" class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
                        <option value="">TobaDecor (milik sendiri)</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}" @selected(old('vendor_id', $service->vendor_id) == $vendor->id)>{{ $vendor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1.5">Status</label>
                    <select name="status" class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
                        <option value="available" @selected(old('status', $service->status) === 'available')>Aktif</option>
                        <option value="inactive" @selected(old('status', $service->status) === 'inactive')>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-3 pt-2 border-t border-gold-light/40">
                <button type="submit" class="bg-maroon text-cream px-6 py-2.5 rounded-full font-semibold hover:bg-maroon-dark transition-colors mt-4">
                    Simpan
                </button>
                <a href="{{ route('admin.layanan.index') }}" class="px-6 py-2.5 rounded-full font-semibold border border-ink/20 hover:bg-ink/5 transition-colors mt-4">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
