<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') — TobaUlaon</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: { DEFAULT: '#6B1D2F', dark: '#4A121F', 50: '#FDF2F4' },
                        gold: { DEFAULT: '#C5A059', light: '#EEDCBA', dark: '#9B7936' },
                        linen: '#FAF7F2', cream: '#FFFBF7', ink: '#1A1615',
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"Space Mono"', 'monospace'],
                    },
                }
            }
        }
    </script>
    <style>
        body { background-color: #FAF7F2; color: #1A1615; }
        .font-display { font-family: 'Playfair Display', serif; }
        .batak-motif-sm {
            height: 6px;
            background-color: #6B1D2F;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='6' viewBox='0 0 16 6'%3E%3Cpath fill='%23C5A059' d='M8 0L16 6H12L8 3L4 6H0z'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
        }
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
            outline: 2px solid #C5A059; outline-offset: 2px;
        }
    </style>
</head>
<body class="font-body text-ink antialiased">
<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-ink text-linen flex-shrink-0 hidden md:flex md:flex-col justify-between border-r border-gold/20 shadow-xl">
        <div>
            <div class="batak-motif-sm"></div>
            <div class="px-6 py-6 border-b border-white/10">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded bg-gold flex items-center justify-center text-maroon-dark font-display font-bold text-xs">✦</div>
                    <span class="font-display text-xl font-bold text-cream tracking-tight">Toba<span class="text-gold">Ulaon</span></span>
                </div>
                <span class="text-[10px] text-gold-light/60 tracking-widest uppercase mt-1 block">Panel Administrasi</span>
            </div>

            <nav class="px-4 py-6 space-y-1.5 text-sm font-medium">
                @php
                    $current = match(true) {
                        request()->routeIs('admin.dashboard') => 'dashboard',
                        request()->routeIs('admin.products.*') => 'products',
                        request()->routeIs('admin.bookings.*') => 'bookings',
                        request()->routeIs('admin.vendor.*') => 'vendor',
                        request()->routeIs('admin.layanan.*') => 'layanan',
                        request()->routeIs('admin.paket.*') => 'paket',
                        default => '',
                    };
                @endphp

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $current === 'dashboard' ? 'bg-maroon text-cream font-semibold shadow-md border-l-4 border-gold' : 'text-linen/70 hover:bg-white/5 hover:text-linen' }}">
                    <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $current === 'products' ? 'bg-maroon text-cream font-semibold shadow-md border-l-4 border-gold' : 'text-linen/70 hover:bg-white/5 hover:text-linen' }}">
                    <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    Produk & Sortali
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $current === 'bookings' ? 'bg-maroon text-cream font-semibold shadow-md border-l-4 border-gold' : 'text-linen/70 hover:bg-white/5 hover:text-linen' }}">
                    <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Data Booking
                </a>

                <a href="{{ route('admin.paket.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $current === 'paket' ? 'bg-maroon text-cream font-semibold shadow-md border-l-4 border-gold' : 'text-linen/70 hover:bg-white/5 hover:text-linen' }}">
                    <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Paket Acara
                </a>

                <a href="{{ route('admin.layanan.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $current === 'layanan' ? 'bg-maroon text-cream font-semibold shadow-md border-l-4 border-gold' : 'text-linen/70 hover:bg-white/5 hover:text-linen' }}">
                    <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Layanan Adat
                </a>

                <a href="{{ route('admin.vendor.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ $current === 'vendor' ? 'bg-maroon text-cream font-semibold shadow-md border-l-4 border-gold' : 'text-linen/70 hover:bg-white/5 hover:text-linen' }}">
                    <svg class="w-4 h-4 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Vendor Partner
                </a>
            </nav>
        </div>

        <div class="px-4 pb-6">
            <div class="border-t border-white/10 pt-4 px-3 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-cream">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-linen/40">Administrator</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="p-2 rounded-lg bg-white/5 hover:bg-maroon text-linen/60 hover:text-white transition-colors" title="Keluar">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT CONTAINER -->
    <div class="flex-1 min-w-0 flex flex-col">
        
        <!-- MOBILE HEADER -->
        <header class="bg-ink text-linen border-b border-gold/20 px-5 py-4 flex items-center justify-between md:hidden">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 rounded bg-gold flex items-center justify-center text-maroon-dark font-display font-bold text-xs">✦</div>
                <span class="font-display text-lg font-bold text-cream">Toba<span class="text-gold">Ulaon</span> Admin</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-xs text-gold-light hover:underline font-medium">Keluar</button>
            </form>
        </header>

        <!-- CONTENT AREA -->
        <main class="p-6 sm:p-10 flex-1">
            @if (session('success'))
                <div class="bg-white border-l-4 border-gold text-maroon-dark px-5 py-4 rounded-xl shadow-sm mb-8 flex items-center gap-3">
                    <span class="text-gold">✦</span>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
