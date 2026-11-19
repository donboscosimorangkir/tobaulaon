<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator — TobaUlaon</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { 
            theme: { 
                extend: {
                    colors: { 
                        maroon: { DEFAULT: '#6B1D2F', dark: '#4A121F', 50: '#FDF2F4' }, 
                        gold: { DEFAULT: '#C5A059', light: '#EEDCBA' }, 
                        linen: '#FAF7F2', cream: '#FFFBF7', ink: '#1A1615' 
                    },
                    fontFamily: { display: ['"Playfair Display"', 'serif'], body: ['"Plus Jakarta Sans"', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        body { background-color: #1A1615; color: #FAF7F2; font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .batak-motif-strip {
            height: 10px;
            background-color: #4A121F;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='10' viewBox='0 0 24 10'%3E%3Cpath fill='%23C5A059' d='M12 0L24 10H18L12 5L6 10H0z'/%3E%3C/svg%3E");
            background-repeat: repeat-x;
        }
    </style>
</head>
<body class="font-body text-linen min-h-screen flex items-center justify-center p-4 selection:bg-maroon selection:text-cream">
    
    <div class="w-full max-w-md bg-white text-ink rounded-3xl overflow-hidden border border-gold/30 shadow-2xl relative">
        
        <div class="batak-motif-strip"></div>
        
        <div class="p-8 sm:p-10 space-y-6">
            <div class="text-center space-y-2">
                <div class="w-10 h-10 mx-auto rounded-xl bg-maroon text-gold-light font-display text-lg font-bold flex items-center justify-center shadow-md">
                    ✦
                </div>
                <h1 class="font-display text-3xl font-bold text-maroon-dark tracking-tight">Toba<span class="text-gold">Ulaon</span></h1>
                <p class="text-xs text-ink-muted uppercase tracking-widest font-semibold">Panel Masuk Admin</p>
            </div>

            @if ($errors->any())
                <div class="bg-maroon-50 border-l-4 border-maroon text-maroon-dark p-4 rounded-xl text-xs sm:text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@tobaulaon.com"
                           class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-ink uppercase tracking-wider mb-2">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="••••••••"
                           class="w-full border border-gold-light/80 rounded-xl px-4 py-3 bg-[#FAF7F2]/50 text-sm text-ink focus:bg-white focus:border-maroon focus:ring-1 focus:ring-maroon outline-none transition-all">
                </div>

                <div class="flex items-center justify-between text-xs text-ink-muted pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 accent-maroon rounded border-gold-light">
                        <span>Ingat Sesi Saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-maroon text-cream py-3.5 rounded-full font-semibold text-sm hover:bg-maroon-dark hover:shadow-gold-glow transition-all duration-300 mt-2">
                    Masuk ke Panel Admin →
                </button>
            </form>
        </div>

        <div class="batak-motif-strip"></div>
    </div>

</body>
</html>
