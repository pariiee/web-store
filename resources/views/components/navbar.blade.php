<!DOCTYPE html> 
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PARI ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
    </style>
</head>
<body class="bg-[#F6F8FA] min-h-screen flex flex-col pb-24 md:pb-0 text-zinc-900">

    <!-- Header Mobile -->
    <header class="md:hidden px-5 pt-6 pb-2 bg-white sticky top-0 z-40 border-b border-zinc-50 shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-[10px] text-zinc-400 font-medium uppercase tracking-wide">Selamat Datang,</p>
                <h2 class="font-bold text-lg text-zinc-900 truncate max-w-[200px]">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </h2>
            </div>
            <a href="/profile" class="w-9 h-9 bg-zinc-50 rounded-full flex items-center justify-center text-zinc-600 border border-zinc-100 hover:bg-zinc-100 transition">
                <span class="iconify text-lg" data-icon="lucide:user"></span>
            </a>
        </div>
    </header>

    <!-- NAVBAR DESKTOP UPDATED -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-zinc-200 hidden md:block">
        <div class="container mx-auto max-w-6xl px-4 h-16 flex items-center justify-between">
            
            <div class="flex items-center gap-2">
                <a href="/" class="flex items-center gap-2 hover:opacity-80 transition">
                    <span class="font-bold text-xl text-zinc-900">PARI ID X CYAA STORE </span>
                </a>
            </div>

            <!-- MENU DESKTOP + ROLE ADMIN -->
            <div class="flex items-center gap-8">
                <a href="/" class="text-sm font-medium {{ request()->is('/') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Home</a>

                <a href="/riwayat" class="text-sm font-medium {{ request()->is('riwayat') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Riwayat</a>

                <a href="/redeem" class="text-sm font-medium {{ request()->is('redeem') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Redeem</a>

                <a href="/profile" class="text-sm font-medium {{ request()->is('profile') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Akun</a>

                @if(auth()->user()->role === 'admin')
                <a href="/admin/dashboard" class="text-sm font-medium {{ request()->is('admin/*') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Admin</a>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden lg:block">
                    <p class="text-xs text-zinc-500">Saldo Aktif</p>
                    <p class="font-bold text-sm">Rp {{ number_format(auth()->user()->saldo ?? 0, 0, ',', '.') }}</p>
                </div>
                <a href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="px-4 py-2 bg-zinc-100 text-zinc-700 rounded-lg text-xs font-bold hover:bg-red-50 hover:text-red-600 transition">
                    Keluar
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>

        </div>
    </nav>

    <main class="container mx-auto max-w-6xl px-5 py-5 space-y-6">
        
        <!-- (ISI HALAMAN — TIDAK DIUBAH) -->
        {{--------- CONTENT TETAP SAMA SEPERTI SEBELUMNYA ---------}}

        <!-- Produk Digital + List Produk tetap sama -->
        
    </main>

    <!-- BOTTOM NAV MOBILE UPDATED -->
    <nav class="fixed bottom-0 left-0 w-full bg-white/95 backdrop-blur border-t border-zinc-200 h-16 flex justify-around items-center z-50 md:hidden pb-safe">

        <!-- HOME -->
        <a href="/" class="flex flex-col items-center gap-1 p-2 w-full {{ request()->is('/') ? 'text-zinc-900' : 'text-zinc-400 hover:text-zinc-600' }}">
            <span class="iconify text-xl" data-icon="lucide:home"></span>
            <span class="text-[10px] font-medium">Home</span>
        </a>

        <!-- RIWAYAT -->
        <a href="/riwayat" class="flex flex-col items-center gap-1 p-2 w-full {{ request()->is('riwayat') ? 'text-zinc-900' : 'text-zinc-400 hover:text-zinc-600' }}">
            <span class="iconify text-xl" data-icon="lucide:history"></span>
            <span class="text-[10px] font-medium">Riwayat</span>
        </a>

        <!-- TOMBOL + KHUSUS ADMIN -->
        @if(auth()->user()->role === 'admin')
        <div class="relative -top-6">
            <a href="/admin/dashboard"
               class="w-14 h-14 bg-zinc-900 rounded-full flex items-center justify-center text-white shadow-xl hover:scale-105 transition border-4 border-zinc-50 ring-1 ring-zinc-100">
                <span class="iconify text-2xl" data-icon="lucide:plus"></span>
            </a>
        </div>
        @endif

        <!-- redeem -->
        <a href="/redeem" class="flex flex-col items-center gap-1 p-2 w-full {{ request()->is('redeem') ? 'text-zinc-900' : 'text-zinc-400 hover:text-zinc-600' }}">
            <span class="iconify text-xl" data-icon="lucide:wallet-cards"></span>
            <span class="text-[10px] font-medium">Redeem</span>
        </a>

        <!-- ACCOUNT -->
        <a href="/profile" class="flex flex-col items-center gap-1 p-2 w-full {{ request()->is('profile') ? 'text-zinc-900' : 'text-zinc-400 hover:text-zinc-600' }}">
            <span class="iconify text-xl" data-icon="lucide:user"></span>
            <span class="text-[10px] font-medium">Akun</span>
        </a>

    </nav>

</body>
</html>
