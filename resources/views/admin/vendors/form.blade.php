@extends('admin.layout')
@section('title', $vendor->exists ? 'Edit Vendor' : 'Tambah Vendor')

@section('content')
    <div class="max-w-xl mx-auto">
        <a href="{{ route('admin.vendor.index') }}" class="text-sm text-ink/50 hover:text-maroon">← Kembali</a>
        <h1 class="font-display text-3xl font-semibold text-ink mt-3 mb-8">
            {{ $vendor->exists ? 'Edit Vendor' : 'Tambah Vendor' }}
        </h1>

        @if ($errors->any())
            <div class="bg-maroon-50 border border-maroon/30 text-maroon-dark px-4 py-3 rounded-lg mb-6 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $vendor->exists ? route('admin.vendor.update', $vendor) : route('admin.vendor.store') }}"
              class="space-y-5 bg-white p-6 sm:p-8 rounded-xl border border-gold-light/60 shadow-sm">
            @csrf
            @if($vendor->exists) @method('PUT') @endif

            <div>
                <label class="block text-sm font-medium mb-1.5">Nama Vendor</label>
                <input type="text" name="name" value="{{ old('name', $vendor->name) }}" required
                       class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1.5">Nama Kontak</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person', $vendor->contact_person) }}"
                           class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1.5">Nomor HP/WA</label>
                    <input type="text" name="phone" value="{{ old('phone', $vendor->phone) }}"
                           class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Jenis Layanan</label>
                <input type="text" name="service_type" value="{{ old('service_type', $vendor->service_type) }}" placeholder="misal: Katering, Sound System"
                       class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Catatan</label>
                <textarea name="notes" rows="3"
                          class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">{{ old('notes', $vendor->notes) }}</textarea>
            </div>

            <div class="flex gap-3 pt-2 border-t border-gold-light/40">
                <button type="submit" class="bg-maroon text-cream px-6 py-2.5 rounded-full font-semibold hover:bg-maroon-dark transition-colors mt-4">
                    Simpan
                </button>
                <a href="{{ route('admin.vendor.index') }}" class="px-6 py-2.5 rounded-full font-semibold border border-ink/20 hover:bg-ink/5 transition-colors mt-4">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
