<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TobaUlaon — Layanan Pernikahan & Acara Adat Batak Premium')</title>
    <meta name="description" content="TobaUlaon — Penyedia perlengkapan acara adat Batak, sortali premium, dekorasi, dan paket pernikahan terpadu. Anggun, sakral, dan profesional.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: {
                            DEFAULT: '#6B1D2F',
                            dark: '#4A121F',
                            deep: '#360C16',
                            light: '#8C2941',
                            50: '#FDF2F4',
                            100: '#F9E2E6',
                        },
                        gold: {
                            DEFAULT: '#C5A059',
                            light: '#EEDCBA',
                            amber: '#D4AF37',
                            dark: '#9B7936',
                            muted: '#FAF3E5',
                        },
                        linen: '#FAF7F2',
                        cream: '#FFFBF7',
                        ink: {
                            DEFAULT: '#1A1615',
                            light: '#423B38',
                            muted: '#786F6B',
                        },
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'Georgia', 'serif'],
                        body: ['"Plus Jakarta Sans"', 'sans-serif'],
                        mono: ['"Space Mono"', 'monospace'],
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(107, 29, 47, 0.06)',
                        'gold-glow': '0 4px 20px -2px rgba(197, 160, 89, 0.25)',
                    }
                }
            }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            background-color: #FAF7F2;
            color: #1A1615;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* SVG Batak Geometric Motif Pattern Strip */
        .batak-motif-strip {
            height: 12px;
            background-color: #4A121F;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='12' viewBox='0 0 24 12'%3E%3Cpath fill='%23C5A059' fill-opacity='0.9' d='M12 0L24 12H18L12 6L6 12H0z'/%3E%3Cpath fill='%236B1D2F' d='M12 4L18 10H14L12 8L10 10H6z'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
            background-position: center;
        }

        .batak-motif-strip-sm {
            height: 6px;
            background-color: #6B1D2F;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='6' viewBox='0 0 16 6'%3E%3Cpath fill='%23C5A059' d='M8 0L16 6H12L8 3L4 6H0z'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
        }

        .font-display {
            font-family: 'Playfair Display', Georgia, serif;
        }

        /* Custom Focus Styles */
        a:focus-visible, button:focus-visible, input:focus-visible, textarea:focus-visible, select:focus-visible {
            outline: 2px solid #C5A059;
            outline-offset: 3px;
        }
    </style>
</head>
<body class="font-body text-ink antialiased selection:bg-maroon-50 selection:text-maroon-dark min-h-screen flex flex-col justify-between">

    <div>
        <!-- TOP BATAK MOTIF ACCENT -->
        <div class="batak-motif-strip"></div>

        <!-- HEADER & NAVIGATION -->
        <header class="sticky top-0 z-50 backdrop-blur-md bg-[#FAF7F2]/90 border-b border-gold-light/40 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex items-center justify-between">
                
                <!-- BRAND LOGO -->
                <a href="{{ route('home') }}" class="group flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-maroon flex items-center justify-center text-gold-light font-display text-lg font-bold shadow-md group-hover:bg-maroon-dark transition-colors duration-300">
                        ✦
                    </div>
                    <div class="flex flex-col">
                        <span class="font-display text-xl sm:text-2xl font-bold tracking-tight text-maroon-dark group-hover:text-maroon transition-colors">
                            Toba<span class="text-gold">Ulaon</span>
                        </span>
                        <span class="text-[9px] uppercase tracking-[0.25em] text-ink-muted -mt-1 font-medium">Modern Cultural Wedding</span>
                    </div>
                </a>

                <!-- NAV LINKS -->
                <nav class="flex items-center gap-5 sm:gap-8 text-sm font-medium">
                    <a href="{{ route('home') }}#katalog" class="text-ink-light hover:text-maroon transition-colors relative py-1 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gold after:transition-all hover:after:w-full">
                        Katalog
                    </a>
                    <a href="{{ route('package.index') }}" class="text-ink-light hover:text-maroon transition-colors relative py-1 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gold after:transition-all hover:after:w-full">
                        Paket
                    </a>
                    <a href="{{ route('booking.check') }}" class="text-ink-light hover:text-maroon transition-colors hidden sm:inline-block relative py-1 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-gold after:transition-all hover:after:w-full">
                        Cek Pesanan
                    </a>

                    <!-- CART / PESANAN SAYA BADGE -->
                    <a href="{{ route('booking.create') }}" class="relative inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-gold-muted/80 text-maroon-dark border border-gold-light/60 hover:bg-gold-light/40 transition-all text-xs font-semibold">
                        <span>Pesanan Saya</span>
                        <span id="cart-badge" class="hidden bg-maroon text-cream text-[10px] font-bold rounded-full w-4 h-4 items-center justify-center animate-pulse">0</span>
                    </a>

                    <!-- WHATSAPP CONTACT CTA -->
                    <a href="https://wa.me/6281260233474" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-1.5 bg-maroon text-cream px-4 py-2 rounded-full text-xs sm:text-sm font-semibold shadow-sm hover:bg-maroon-dark hover:shadow-gold-glow transition-all duration-300">
                        <svg class="w-4 h-4 fill-current text-gold-light" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span class="hidden sm:inline">Chat WhatsApp</span>
                        <span class="sm:hidden">WA</span>
                    </a>
                </nav>
            </div>
        </header>

        <!-- MAIN CONTENT AREA -->
        <main>
            @if (session('success'))
                <div class="max-w-4xl mx-auto mt-6 px-4 sm:px-6">
                    <div class="bg-white border-l-4 border-gold text-maroon-dark px-5 py-4 rounded-xl shadow-glass flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <span class="text-gold text-xl">✦</span>
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- FOOTER -->
    <footer class="bg-ink text-linen mt-24 relative overflow-hidden">
        <div class="batak-motif-strip"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 grid grid-cols-1 md:grid-cols-4 gap-10 text-sm">
            
            <!-- BRAND & BIO -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-7 h-7 rounded-md bg-gold flex items-center justify-center text-maroon-dark font-display text-sm font-bold">
                        ✦
                    </div>
                    <span class="font-display text-2xl font-bold tracking-tight text-cream">
                        Toba<span class="text-gold">Ulaon</span>
                    </span>
                </div>
                <p class="text-linen/70 leading-relaxed max-w-md text-sm">
                    Penyedia perlengkapan acara adat Batak, sortali premium, dekorasi, dan paket pernikahan terpadu — menghadirkan nuansa adat yang sakral, modern, dan penuh kehormatan. Didukung koleksi terbaik dari TobaDecor.
                </p>
            </div>

            <!-- QUICK LINKS / KONTAK -->
            <div>
                <h4 class="font-display text-lg text-gold font-semibold mb-4 tracking-wide">Hubungi Kami</h4>
                <ul class="space-y-2.5 text-linen/70">
                    <li class="flex items-center gap-2">
                        <span class="text-gold/70">📍</span> Laguboti, Toba, Sumatera Utara
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-gold/70">💬</span> WhatsApp: 0812-6023-3474
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="text-gold/70">🕒</span> Senin–Sabtu, 09.00–20.00 WIB
                    </li>
                </ul>
            </div>

            <!-- ADAT PHILOSOPHY -->
            <div>
                <h4 class="font-display text-lg text-gold font-semibold mb-4 tracking-wide">Falsafah Adat</h4>
                <p class="font-display italic text-linen/80 text-sm leading-relaxed mb-2">
                    "Somba marhula-hula, elek marboru, manat mardongan tubu."
                </p>
                <p class="text-xs text-linen/50 leading-relaxed">
                    Menjaga tradisi dan kehormatan dalam setiap tahapan acara pesta adat pernikahan.
                </p>
            </div>
        </div>

        <!-- COPYRIGHT BOTTOM -->
        <div class="border-t border-linen/10 py-6 text-center text-xs text-linen/40">
            <p>© {{ date('Y') }} TobaUlaon. Layanan Acara & Pernikahan Adat Batak Modern. All rights reserved.</p>
        </div>
    </footer>

    <!-- CART BADGE REACTIVITY SCRIPT -->
    <script>
        function updateCartBadge() {
            try {
                const cart = JSON.parse(localStorage.getItem('tobaulaon_cart') || '[]');
                const badge = document.getElementById('cart-badge');
                if (!badge) return;
                if (cart && cart.length > 0) {
                    badge.textContent = cart.length;
                    badge.classList.remove('hidden');
                    badge.classList.add('flex');
                } else {
                    badge.classList.add('hidden');
                    badge.classList.remove('flex');
                }
            } catch(e) {
                console.error("Cart badge update error:", e);
            }
        }
        document.addEventListener('DOMContentLoaded', updateCartBadge);
    </script>

</body>
</html>
