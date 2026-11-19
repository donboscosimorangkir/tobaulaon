@extends('admin.layout')
@section('title', $package->exists ? 'Edit Paket' : 'Tambah Paket')

@section('content')
    <div class="max-w-2xl mx-auto">
        <a href="{{ route('admin.paket.index') }}" class="text-sm text-ink/50 hover:text-maroon">← Kembali</a>
        <h1 class="font-display text-3xl font-semibold text-ink mt-3 mb-8">
            {{ $package->exists ? 'Edit Paket' : 'Tambah Paket' }}
        </h1>

        @if ($errors->any())
            <div class="bg-maroon-50 border border-maroon/30 text-maroon-dark px-4 py-3 rounded-lg mb-6 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $package->exists ? route('admin.paket.update', $package) : route('admin.paket.store') }}"
              enctype="multipart/form-data"
              x-data="packageForm(@js($products->pluck('price', 'id')), @js($services->pluck('price', 'id')))"
              class="space-y-6 bg-white p-6 sm:p-8 rounded-xl border border-gold-light/60 shadow-sm">
            @csrf
            @if($package->exists) @method('PUT') @endif

            <div>
                <label class="block text-sm font-medium mb-1.5">Nama Paket</label>
                <input type="text" name="name" value="{{ old('name', $package->name) }}" required
                       class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Deskripsi</label>
                <textarea name="description" rows="3"
                          class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">{{ old('description', $package->description) }}</textarea>
            </div>

            <!-- Pilih item paket -->
            <div>
                <h2 class="font-semibold text-ink mb-1">Isi Paket</h2>
                <p class="text-xs text-ink/50 mb-3">Centang produk & layanan yang termasuk dalam paket ini.</p>

                <p class="text-xs font-bold uppercase tracking-wider text-maroon/70 mb-2">Produk</p>
                <div class="grid sm:grid-cols-2 gap-2 mb-4">
                    @foreach ($products as $product)
                        <label class="flex items-center gap-2 border border-gold-light/60 rounded-lg px-3 py-2 cursor-pointer text-sm"
                               :class="items.includes('product-{{ $product->id }}') ? 'border-maroon bg-maroon-50' : ''">
                            <input type="checkbox" name="items[]" value="product-{{ $product->id }}"
                                   x-model="items" class="accent-maroon">
                            <span>{{ $product->name }} <span class="text-ink/40">— Rp {{ number_format($product->price, 0, ',', '.') }}</span></span>
                        </label>
                    @endforeach
                </div>

                <p class="text-xs font-bold uppercase tracking-wider text-maroon/70 mb-2">Layanan</p>
                <div class="grid sm:grid-cols-2 gap-2">
                    @foreach ($services as $service)
                        <label class="flex items-center gap-2 border border-gold-light/60 rounded-lg px-3 py-2 cursor-pointer text-sm"
                               :class="items.includes('service-{{ $service->id }}') ? 'border-maroon bg-maroon-50' : ''">
                            <input type="checkbox" name="items[]" value="service-{{ $service->id }}"
                                   x-model="items" class="accent-maroon">
                            <span>{{ $service->name }} <span class="text-ink/40">— Rp {{ number_format($service->price, 0, ',', '.') }}</span></span>
                        </label>
                    @endforeach
                </div>

                <p class="text-sm text-ink/60 mt-3">
                    Total harga satuan: <span class="font-semibold text-ink" x-text="'Rp ' + individualTotal.toLocaleString('id-ID')"></span>
                </p>
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1.5">Harga Paket (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $package->price) }}" required min="0"
                           x-model.number="packagePrice"
                           class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
                    <p class="text-xs mt-1" :class="savings > 0 ? 'text-emerald-600' : 'text-ink/40'">
                        <span x-show="savings > 0" x-text="'Hemat Rp ' + savings.toLocaleString('id-ID') + ' dari harga satuan'"></span>
                        <span x-show="savings <= 0">Masukkan harga paket lebih murah dari total satuan untuk menarik pelanggan.</span>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1.5">Status</label>
                    <select name="status" class="w-full border border-gold-light/70 rounded-lg px-4 py-2.5 focus:border-maroon outline-none">
                        <option value="available" @selected(old('status', $package->status) === 'available')>Aktif</option>
                        <option value="inactive" @selected(old('status', $package->status) === 'inactive')>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Foto Paket</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full border border-gold-light/70 rounded-lg px-3 py-2 bg-ivory/40 text-sm">
                @if($package->image)
                    <img src="{{ asset('storage/' . $package->image) }}" class="w-16 h-16 object-cover rounded-lg mt-2">
                @endif
            </div>

            <div class="flex gap-3 pt-2 border-t border-gold-light/40">
                <button type="submit" class="bg-maroon text-cream px-6 py-2.5 rounded-full font-semibold hover:bg-maroon-dark transition-colors mt-4">
                    Simpan
                </button>
                <a href="{{ route('admin.paket.index') }}" class="px-6 py-2.5 rounded-full font-semibold border border-ink/20 hover:bg-ink/5 transition-colors mt-4">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function packageForm(productPrices, servicePrices) {
            return {
                items: @json($selectedItems),
                packagePrice: {{ old('price', $package->price ?? 0) }},
                get individualTotal() {
                    return this.items.reduce((sum, item) => {
                        const [type, id] = item.split('-');
                        const price = type === 'product' ? productPrices[id] : servicePrices[id];
                        return sum + Number(price || 0);
                    }, 0);
                },
                get savings() {
                    return Math.max(0, this.individualTotal - this.packagePrice);
                }
            }
        }
    </script>
@endsection
