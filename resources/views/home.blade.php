@extends('layouts.app')

@section('title', 'TobaUlaon — Paket Sortali, Dekorasi & Pernikahan Adat Batak')

@section('content')

    <!-- HERO SECTION -->
    <section class="relative overflow-hidden pt-12 pb-20 sm:pt-20 sm:pb-28 bg-gradient-to-b from-[#FAF7F2] via-[#FAF7F2] to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- HERO LEFT TEXT -->
                <div class="md:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 text-xs font-bold tracking-[0.2em] uppercase text-maroon bg-maroon-50 border border-maroon-100 px-3.5 py-1.5 rounded-full">
                        <span class="text-gold font-serif">✦</span>
                        <span>Perlengkapan Acara & Adat Batak</span>
                    </div>

                    <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl leading-[1.12] font-bold text-ink tracking-tight">
                        Satu paket untuk acara yang <span class="text-maroon italic font-serif relative inline-block">sakral<svg class="absolute bottom-0 left-0 w-full h-2 text-gold/40" viewBox="0 0 100 20" preserveAspectRatio="none"><path d="M0,15 Q50,5 100,15" stroke="currentColor" stroke-width="4" fill="none"/></svg></span> & tak terulang.
                    </h1>

                    <p class="text-base sm:text-lg text-ink-muted leading-relaxed max-w-xl font-normal">
                        Sortali premium, dekorasi adat, dan peralatan pesta — disiapkan terpadu dalam satu sistem rapi, agar Anda dapat fokus sepenuhnya pada momen berharga hari pernikahan Anda.
                    </p>

                    <div class="pt-4 flex flex-wrap gap-4 items-center">
                        <a href="#katalog" class="inline-flex items-center gap-2 bg-maroon text-cream px-7 py-4 rounded-full font-semibold text-sm hover:bg-maroon-dark hover:shadow-gold-glow transition-all duration-300">
                            <span>Eksplorasi Katalog</span>
                            <span>→</span>
                        </a>
                        <a href="#cara-sewa" class="inline-flex items-center gap-2 bg-white text-ink border border-gold-light/80 px-7 py-4 rounded-full font-semibold text-sm hover:border-maroon/40 hover:bg-gold-muted/50 transition-all duration-300">
                            <span>Cara Pemesanan</span>
                        </a>
                    </div>

                    <!-- HIGHLIGHT MINI FEATS -->
                    <div class="pt-6 border-t border-gold-light/40 grid grid-cols-3 gap-4 text-xs">
                        <div>
                            <span class="block font-bold text-maroon-dark text-base font-display">100% Authentic</span>
                            <span class="text-ink-muted">Sortali & Ornamen Adat</span>
                        </div>
                        <div>
                            <span class="block font-bold text-maroon-dark text-base font-display">Paket Hemat</span>
                            <span class="text-ink-muted">Diskon Bundling</span>
                        </div>
                        <div>
                            <span class="block font-bold text-maroon-dark text-base font-display">Respon Cepat</span>
                            <span class="text-ink-muted">Konfirmasi WA Instant</span>
                        </div>
                    </div>
                </div>

                <!-- HERO RIGHT CARD SHOWCASE -->
                <div class="md:col-span-5 relative">
                    <div class="absolute -inset-2 rounded-3xl bg-gradient-to-tr from-gold/30 to-maroon/20 blur-xl opacity-70"></div>
                    <div class="relative bg-maroon-dark text-linen rounded-3xl overflow-hidden shadow-2xl border border-gold/30 p-8 sm:p-10 text-center flex flex-col justify-between aspect-[4/5] sm:aspect-auto sm:min-h-[440px]">
                        
                        <!-- BATAK TOP MOTIF -->
                        <div class="batak-motif-strip absolute top-0 left-0 right-0"></div>

                        <div class="my-auto space-y-6 relative z-10 py-6">
                            <div class="w-12 h-12 mx-auto rounded-full bg-gold/20 border border-gold/40 flex items-center justify-center text-gold text-2xl font-serif">
                                ✦
                            </div>
                            
                            <blockquote class="space-y-3">
                                <p class="font-display text-2xl sm:text-3xl italic text-gold-light font-medium leading-snug">
                                    "Marsipature hutana be"
                                </p>
                                <p class="text-xs sm:text-sm text-linen/70 uppercase tracking-widest font-medium">
                                    Saling Menjaga, Saling Merawat Adat
                                </p>
                            </blockquote>

                            <div class="w-16 h-0.5 bg-gold/40 mx-auto"></div>

                            <p class="text-xs text-linen/60 leading-relaxed max-w-xs mx-auto">
                                Koleksi perlengkapan adat siap pakai dengan standar estetika tertinggi dari TobaUlaon.
                            </p>
                        </div>

                        <!-- BATAK BOTTOM MOTIF -->
                        <div class="batak-motif-strip absolute bottom-0 left-0 right-0"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- CARA SEWA SECTION -->
    <section id="cara-sewa" class="py-20 bg-white border-y border-gold-light/40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold tracking-[0.2em] uppercase text-gold-dark">Alur Pemesanan</span>
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-ink">Empat Langkah Pemesanan</h2>
                <p class="text-ink-muted text-sm sm:text-base">Proses mudah dan transparan dari awal hingga hari pelaksanaan acara Anda.</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $steps = [
                        ['no' => '01', 'title' => 'Pilih Perlengkapan', 'desc' => 'Pilih produk satuan atau paket bundling hemat sesuai skala acaramu.'],
                        ['no' => '02', 'title' => 'Isi Tanggal Acara', 'desc' => 'Tentukan tanggal acara, pengambilan, dan pengembalian barang.'],
                        ['no' => '03', 'title' => 'Dapatkan Kode Booking', 'desc' => 'Simpan kode booking unik untuk melacak status pemesanan secara real-time.'],
                        ['no' => '04', 'title' => 'Konfirmasi WA & DP', 'desc' => 'Tim kami langsung menghubungi Anda via WhatsApp untuk detail penyerahan.'],
                    ];
                @endphp

                @foreach ($steps as $step)
                    <div class="group relative bg-[#FAF7F2] rounded-2xl p-7 border border-gold-light/50 hover:border-gold hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        <span class="font-display text-4xl font-bold text-gold opacity-60 group-hover:opacity-100 transition-opacity">{{ $step['no'] }}</span>
                        <h3 class="font-display text-xl font-bold text-ink mt-4 mb-2">{{ $step['title'] }}</h3>
                        <p class="text-xs sm:text-sm text-ink-muted leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- KATALOG PRODUK SECTION -->
    <section id="katalog" class="py-24 bg-[#FAF7F2]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6 border-b border-gold-light/40 pb-8">
                <div>
                    <span class="text-xs font-bold tracking-[0.2em] uppercase text-maroon">Koleksi Terpilih</span>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold text-ink mt-1">Katalog Perlengkapan</h2>
                    <p class="mt-2 text-ink-muted text-sm sm:text-base">Sortali, ornamen dekorasi, dan kelengkapan busana pesta adat Batak.</p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('package.index') }}" class="inline-flex items-center gap-2 bg-white text-maroon border border-maroon-100 px-5 py-2.5 rounded-full font-semibold text-xs sm:text-sm hover:bg-maroon-50 transition-colors">
                        <span>Lihat Paket Bundling</span>
                        <span>→</span>
                    </a>
                    <a href="{{ route('booking.create') }}" class="inline-flex items-center gap-2 bg-maroon text-cream px-5 py-2.5 rounded-full font-semibold text-xs sm:text-sm hover:bg-maroon-dark transition-colors">
                        <span>Buat Booking</span>
                    </a>
                </div>
            </div>

            <!-- PRODUCT GRID -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($products ?? [] as $product)
                    <div class="group bg-white rounded-2xl overflow-hidden border border-gold-light/50 shadow-sm hover:shadow-2xl hover:border-gold hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                        
                        <div>
                            <!-- IMAGE PREVIEW -->
                            <div class="aspect-[4/3] bg-gradient-to-br from-maroon-50 via-[#FAF7F2] to-gold-muted relative overflow-hidden">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-maroon/20">
                                        <span class="font-display italic text-6xl">✦</span>
                                    </div>
                                @endif

                                @if($product->category)
                                    <span class="absolute top-4 left-4 bg-ink/80 backdrop-blur-md text-gold-light text-[10px] font-bold tracking-widest uppercase px-3 py-1 rounded-full border border-gold/30">
                                        {{ $product->category }}
                                    </span>
                                @endif

                                <div class="batak-motif-strip-sm absolute bottom-0 left-0 right-0 opacity-80"></div>
                            </div>

                            <!-- CARD CONTENT -->
                            <div class="p-6">
                                <h3 class="font-display text-xl font-bold text-ink group-hover:text-maroon transition-colors leading-snug">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-xs sm:text-sm text-ink-muted mt-2 line-clamp-2 leading-relaxed">
                                    {{ $product->description ?: 'Sortali adat Batak kualitas premium untuk melengkapi momen spesial pernikahan Anda.' }}
                                </p>
                            </div>
                        </div>

                        <!-- CARD FOOTER -->
                        <div class="px-6 pb-6 pt-4 border-t border-gold-light/30 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase text-ink-muted tracking-wider block">Harga Sewa</span>
                                <span class="font-display text-lg sm:text-xl font-bold text-maroon-dark">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('product.show', $product) }}"
                               class="inline-flex items-center gap-1.5 text-xs font-semibold text-cream bg-ink px-4 py-2.5 rounded-full hover:bg-maroon-dark transition-colors">
                                <span>Detail</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl p-12 text-center border border-gold-light/40">
                        <span class="font-display text-4xl text-gold block mb-3">✦</span>
                        <h3 class="font-display text-xl font-bold text-ink">Katalog Produk Masih Kosong</h3>
                        <p class="text-sm text-ink-muted mt-2 max-w-md mx-auto">Tambahkan produk pertama melalui panel admin untuk menampilkannya di halaman ini.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>

@endsection
