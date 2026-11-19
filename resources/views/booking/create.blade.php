@extends('layouts.app')

@section('title', 'Form Booking — TobaUlaon')

@section('content')
<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

    <!-- HEADER -->
    <div class="text-center max-w-xl mx-auto mb-12 space-y-2">
        <span class="text-xs font-bold tracking-[0.2em] uppercase text-maroon">Formulir Pemesanan</span>
        <h1 class="font-display text-3xl sm:text-4xl font-bold text-ink">Buat Booking Perlengkapan</h1>
        <p class="text-xs sm:text-sm text-ink-muted">Pilih produk, isi detail acara, dan tim kami akan segera mengonfirmasi via WhatsApp.</p>
    </div>

    <!-- ERROR MESSAGES -->
    @if ($errors->any())
        <div class="bg-maroon-50 border-l-4 border-maroon text-maroon-dark p-5 rounded-2xl mb-8 shadow-sm text-sm">
            <div class="font-semibold mb-1">Mohon periksa kembali isian formulir:</div>
            <ul class="list-disc pl-5 space-y-1 text-xs sm:text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('booking.store') }}"
          x-data="bookingForm(@js($products->pluck('price', 'id')), '{{ request('product') }}')"
          class="space-y-10">
        @csrf

        <!-- STEP 1: PILIH PERLENGKAPAN -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gold-light/60 shadow-sm space-y-6">
            <div class="flex items-center justify-between border-b border-gold-light/40 pb-4">
                <div>
                    <h2 class="font-display text-xl font-bold text-ink">1. Pilih Perlengkapan</h2>
                    <p class="text-xs text-ink-muted mt-0.5">Centang item yang ingin Anda sewa</p>
                </div>
                <button type="button" x-show="selected.length" @click="clearAll()" class="text-xs text-maroon font-semibold hover:underline">
                    Reset Pilihan (<span x-text="selected.length"></span>)
                </button>
            </div>

            <!-- PRODUCT CARDS SELECTION GRID -->
            <div class="grid sm:grid-cols-2 gap-4">
                @foreach ($products as $product)
                    <label class="group relative flex items-stretch gap-0 rounded-2xl overflow-hidden cursor-pointer border transition-all duration-300"
                           :class="selected.includes('{{ $product->id }}')
                                ? 'border-maroon bg-maroon-50/50 shadow-md ring-1 ring-maroon/20'
                                : 'border-gold-light/50 bg-[#FAF7F2]/50 hover:border-gold hover:bg-white'">

                        <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" x-model="selected" class="sr-only">

                        <!-- ACCENT VERTICAL BAR -->
                        <span class="w-1.5 flex-shrink-0 transition-colors"
                              :class="selected.includes('{{ $product->id }}') ? 'bg-maroon' : 'bg-gold-light/60'"></span>

                        <div class="flex-1 flex items-center justify-between gap-3 px-4 py-4">
                            <div class="min-w-0 space-y-1">
                                @if($product->category)
                                    <span class="text-[9px] font-bold uppercase tracking-wider text-maroon/70 bg-maroon-50 px-2 py-0.5 rounded">
                                        {{ $product->category }}
                                    </span>
                                @endif
                                <p class="font-medium text-sm text-ink truncate group-hover:text-maroon transition-colors">{{ $product->name }}</p>
                                <p class="text-xs font-semibold font-mono text-maroon-dark">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="w-6 h-6 rounded-full border flex items-center justify-center flex-shrink-0 transition-all"
                                 :class="selected.includes('{{ $product->id }}') ? 'bg-maroon border-maroon text-cream scale-110' : 'border-gold-light bg-white text-transparent'">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>

            <!-- TOTAL SUMMARY BAR -->
            <div class="bg-ink text-linen rounded-2xl px-6 py-4 flex items-center justify-between shadow-lg">
                <div>
                    <span class="text-xs text-linen/60 uppercase tracking-wider block font-medium">Estimasi Total Sementara</span>
                    <span class="text-xs text-gold-light/80" x-text="selected.length + ' item dipilih'"></span>
                </div>
                <span class="font-display text-2xl font-bold text-gold-light" x-text="'Rp ' + total.toLocaleString('id-ID')"></span>
            </div>
        </div>

        <!-- STEP 2: DATA PEMESAN -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gold-light/60 shadow-sm space-y-6">
            <div class="border-b border-gold-light/40 pb-4">
                <h2 class="font-display text-xl font-bold text-ink">2. Informasi Pemesan</h2>
                <p class="text-xs text-ink-muted mt-0.5">Lengkapi kontak untuk konfirmasi pesanan</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Hotman Paris"
                           class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Nomor WhatsApp *</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="0812xxxxxxx"
                           class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Alamat Pengiriman / Acara (Opsional)</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Contoh: Jl. Sisingamangaraja No. 12, Laguboti"
                           class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                </div>
            </div>
        </div>

        <!-- STEP 3: TANGGAL ACARA -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-gold-light/60 shadow-sm space-y-6">
            <div class="border-b border-gold-light/40 pb-4">
                <h2 class="font-display text-xl font-bold text-ink">3. Tanggal Sewa & Pelaksanaan</h2>
                <p class="text-xs text-ink-muted mt-0.5">Pilih rentang tanggal penggunaan barang</p>
            </div>

            <div class="grid sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Tanggal Acara *</label>
                    <input type="date" name="event_date" value="{{ old('event_date') }}" required
                           class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Tanggal Ambil Barang *</label>
                    <input type="date" name="pickup_date" value="{{ old('pickup_date') }}" required
                           class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Tanggal Kembalikan *</label>
                    <input type="date" name="return_date" value="{{ old('return_date') }}" required
                           class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Catatan Tambahan (Opsional)</label>
                <textarea name="notes" rows="3" placeholder="Tuliskan permintaan khusus atau detail tambahan acara di sini..."
                          class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">{{ old('notes') }}</textarea>
            </div>
        </div>

        <!-- SUBMIT BUTTON -->
        <div class="pt-4">
            <button type="submit" class="w-full bg-maroon text-cream py-4 rounded-full font-semibold text-base shadow-lg hover:bg-maroon-dark hover:shadow-gold-glow transition-all duration-300">
                Kirim Permohonan Booking →
            </button>
            <p class="text-center text-xs text-ink-muted mt-3">
                Dengan menekan tombol di atas, permohonan booking Anda akan tercatat di sistem kami untuk diverifikasi.
            </p>
        </div>

    </form>
</section>

<script>
    function bookingForm(prices, preselected) {
        return {
            selected: [],
            prices: prices,
            init() {
                try {
                    let cart = JSON.parse(localStorage.getItem('tobaulaon_cart') || '[]');
                    if (preselected && !cart.includes(preselected)) {
                        cart.push(preselected);
                    }
                    this.selected = cart.filter(id => Object.prototype.hasOwnProperty.call(this.prices, id));
                    localStorage.setItem('tobaulaon_cart', JSON.stringify(this.selected));
                    this.$watch('selected', value => {
                        localStorage.setItem('tobaulaon_cart', JSON.stringify(value));
                        if (typeof updateCartBadge === 'function') updateCartBadge();
                    });
                } catch(e) {
                    console.error("Booking form init error:", e);
                }
            },
            get total() {
                return this.selected.reduce((sum, id) => sum + Number(this.prices[id] || 0), 0);
            },
            clearAll() {
                this.selected = [];
            }
        }
    }
</script>
@endsection
