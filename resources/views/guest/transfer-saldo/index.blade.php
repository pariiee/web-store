<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Transfer Saldo - PARI ID</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }

        .bottom-nav {
            background: #ffffff;
            box-shadow: 0 14px 40px rgba(0,0,0,0.12);
            transition: transform .35s ease, opacity .25s ease; /* Transisi untuk efek hide */
        }
        
        .bottom-nav.hide {
            transform: translate(-50%, 120%);
            opacity: 0;
            pointer-events: none;
        }
        
        .nav-item { transition: transform .18s ease, background .18s ease; }
        .nav-icon { transition: all .18s ease; }
        .nav-item.active { transform: translateY(-6px); }
        .nav-item.active .nav-icon {
            background: #18181b;
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(0,0,0,0.18);
        }
        .nav-item:active .nav-icon { transform: scale(.96); }
        
        .saldo-card {
            background: #121212;
            color: white;
            padding: 25px;
            border-radius: 18px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        
        .search-results {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .user-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f1f1f1;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .user-item:hover {
            background: #f9fafb;
        }
        
        .user-item:last-child {
            border-bottom: none;
        }
        
        .admin-fee-badge {
            background: #fee2e2;
            color: #dc2626;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        /* Styling untuk header dan footer */
        .mobile-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.6);
        }
        
        /* Flex layout untuk body */
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
    </style>
</head>

<body class="bg-[#F6F8FA] min-h-screen flex flex-col pb-28 md:pb-0 text-zinc-900">

    <!-- Header Mobile -->
    <header class="md:hidden px-5 pt-6 pb-2 mobile-header sticky top-0 z-40 border-b border-zinc-50 shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-[10px] text-zinc-400 font-medium uppercase tracking-wide">Transfer Saldo</p>
                <h2 class="font-bold text-lg text-zinc-900 truncate max-w-[200px]">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </h2>
            </div>
            <a href="/profile"
                class="w-9 h-9 rounded-full overflow-hidden border border-zinc-100 bg-zinc-50 hover:bg-zinc-100 transition flex items-center justify-center">
                <img
                    src="{{ auth()->user()->profile_photo
                        ? asset('storage/profile/' . auth()->user()->profile_photo)
                        : asset('images/default_pp.jpg') }}"
                    alt="Profile"
                    class="w-full h-full object-cover"
                >
            </a>
        </div>
    </header>

    <!-- Navbar Desktop -->
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-zinc-200 hidden md:block">
        <div class="container mx-auto max-w-6xl px-4 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="/home" class="flex items-center gap-2 hover:opacity-80 transition">
                    <img src="{{ asset('images/logo.jpg') }}" alt="PARI ID" class="hidden md:block h-8 w-auto object-contain">
                    <span class="md:hidden font-bold text-xl text-zinc-900">PARI ID X CYAA STORE </span>
                </a>
            </div>

            <div class="flex items-center gap-8">
                <a href="/home" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Home</a>
                <a href="/top-buyers" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Top</a>
                <a href="/riwayat" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Riwayat</a>
                <a href="/redeem" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Redeem</a>
                <a href="/profile" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Akun</a>
                <a href="/information" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Info</a>
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Admin</a>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="text-right hidden lg:block">
                    <p class="text-xs text-zinc-500">Saldo Aktif</p>
                    <p class="font-bold text-sm">Rp {{ number_format(auth()->user()->saldo ?? 0, 0, ',', '.') }}</p>
                </div>

                <a href="/information"
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

    <!-- Main Content -->
    <main class="w-full px-5 py-6 md:py-10 flex-1">
        <div class="container mx-auto max-w-md">
            <!-- Saldo Card -->
            <div class="saldo-card">
                <div class="text-gray-400 text-sm mb-2">Saldo Anda</div>
                <div class="text-3xl font-bold mb-4">
                    Rp {{ number_format($user->saldo, 0, ',', '.') }}
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-300">
                    <span class="iconify" data-icon="lucide:info"></span>
                    Sisa transfer hari ini:
                    <span class="font-bold">
                        @if($transferLimitInfo['limit'] === '∞')
                            ∞ (Tidak terbatas)
                        @else
                            {{ $transferLimitInfo['remaining'] }}/{{ $transferLimitInfo['limit'] }}
                        @endif
                    </span>
                </div>
                @if($user->role !== 'admin')
                    <div class="text-xs text-gray-400 mt-2">
                        Role: {{ ucfirst($user->role) }} • Batas harian: 
                        @if($user->role === 'reseller')
                            10x transfer
                        @else
                            5x transfer
                        @endif
                    </div>
                @endif
            </div>

            <!-- Transfer Form -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h2 class="text-lg font-bold mb-4">Kirim ke Akun Lain</h2>
                
                <!-- Search Input -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Cari Akun Penerima
                    </label>
                    <div class="relative">
                        <input type="text" 
                            id="searchInput" 
                            placeholder="Cari dengan email, username, atau WhatsApp..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            autocomplete="off">
                        <div class="absolute right-3 top-3">
                            <span class="iconify text-gray-400" data-icon="lucide:search"></span>
                        </div>
                    </div>
                    
                    <!-- Search Results -->
                    <div id="searchResults" class="search-results mt-2 hidden"></div>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <span class="iconify text-blue-500 mt-0.5" data-icon="lucide:info"></span>
                        <div class="text-sm text-blue-800">
                            <p class="font-medium mb-1">Informasi Transfer</p>
                            <ul class="space-y-1">
                                <li>• Minimal transfer: <strong>Rp 100</strong></li>
                                <li>• Biaya admin: <strong>0.1%</strong> dari nominal transfer</li>
                                <li>• Batas transfer: 
                                    <strong>
                                        @if($user->role === 'admin')
                                            Tidak terbatas
                                        @elseif($user->role === 'reseller')
                                            10x per hari
                                        @else
                                            5x per hari
                                        @endif
                                    </strong>
                                </li>
                                <li>• Transfer tidak dapat dibatalkan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Transfers -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold mb-4">Transfer Terakhir</h2>
                
                @php
                    $recentTransfers = App\Models\TransferTransaction::where('sender_id', $user->id)
                        ->orWhere('receiver_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->limit(3)
                        ->get();
                @endphp
                
                @if($recentTransfers->count() > 0)
                    <div class="space-y-3">
                        @foreach($recentTransfers as $transfer)
                            <div class="flex items-center justify-between p-3 border border-gray-100 rounded-lg hover:bg-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        @if($transfer->sender_id == $user->id)
                                            <span class="iconify text-gray-600" data-icon="lucide:arrow-up-right"></span>
                                        @else
                                            <span class="iconify text-gray-600" data-icon="lucide:arrow-down-left"></span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-medium text-sm">
                                            @if($transfer->sender_id == $user->id)
                                                Ke {{ $transfer->receiver->name }}
                                            @else
                                                Dari {{ $transfer->sender->name }}
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $transfer->created_at->format('d M, H:i') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-sm @if($transfer->sender_id == $user->id) text-red-600 @else text-green-600 @endif">
                                        @if($transfer->sender_id == $user->id)
                                            - Rp {{ number_format($transfer->total_deducted, 0, ',', '.') }}
                                        @else
                                            + Rp {{ number_format($transfer->amount, 0, ',', '.') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <a href="{{ route('transfer.history') }}" class="block text-center mt-4 text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Semua Riwayat
                    </a>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <span class="iconify text-4xl mx-auto mb-3" data-icon="lucide:send"></span>
                        <p>Belum ada transaksi transfer</p>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer id="footer" class="bg-zinc-900 text-zinc-400 py-12 border-t border-zinc-800">
        <div class="container mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
                <div class="md:col-span-3">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="h-10 w-auto rounded-xl hover:scale-105 transition">
                        <span class="font-bold text-xl tracking-tight text-white">PARI ID X CYAA STORE</span>
                    </div>
                    <p class="text-sm leading-relaxed mb-6 max-w-3xl">
                        PARI ID adalah Web platform terpercaya yang menyediakan berbagai produk digital dengan harga kompetitif. 
                        Kami berkomitmen memberikan pelayanan terbaik kepada seluruh pelanggan dengan sistem yang aman, 
                        transaksi cepat, dan dukungan pelanggan 24/7. Dapatkan kemudahan dalam pembelian pulsa, paket data, 
                        token listrik, top up game, dan berbagai produk digital lainnya hanya dalam beberapa klik.
                    </p>

                    <div class="flex gap-4">
                        <a href="https://t.me/heyiniaya" target="_blank"
                           class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-sky-500 hover:text-white transition"
                           aria-label="Telegram">
                            <span class="iconify text-lg" data-icon="lucide:send"></span>
                        </a>
                        <a href="https://wa.me/+6283129320041?text=Halo+Admin+CYAA+STORE%2C+saya+butuh+bantuan." target="_blank"
                           class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-green-500 hover:text-white transition"
                           aria-label="WhatsApp">
                            <span class="iconify text-lg" data-icon="lucide:message-circle"></span>
                        </a>
                    </div>
                </div>

                <div class="bg-zinc-800/50 p-6 rounded-2xl border border-zinc-700">
                    <h4 class="font-bold text-white mb-6 text-lg flex items-center gap-2">
                        <span class="iconify" data-icon="lucide:shield"></span>
                        Legal & Informasi
                    </h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="information" class="hover:text-white transition flex items-center gap-3 p-3 bg-zinc-900/50 rounded-xl hover:bg-zinc-800">
                                <span class="iconify text-lg" data-icon="lucide:file-text"></span>
                                <div>
                                    <p class="font-medium text-sm">Syarat & Ketentuan</p>
                                    <p class="text-xs text-zinc-500 mt-0.5">Ketentuan penggunaan layanan</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/information" class="hover:text-white transition flex items-center gap-3 p-3 bg-zinc-900/50 rounded-xl hover:bg-zinc-800">
                                <span class="iconify text-lg" data-icon="lucide:shield-check"></span>
                                <div>
                                    <p class="font-medium text-sm">Kebijakan Privasi</p>
                                    <p class="text-xs text-zinc-500 mt-0.5">Data dan keamanan pengguna</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/information" class="hover:text-white transition flex items-center gap-3 p-3 bg-zinc-900/50 rounded-xl hover:bg-zinc-800">
                                <span class="iconify text-lg" data-icon="lucide:help-circle"></span>
                                <div>
                                    <p class="font-medium text-sm">FAQ</p>
                                    <p class="text-xs text-zinc-500 mt-0.5">Pertanyaan umum</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-zinc-800 pt-8 text-center md:text-left flex flex-col md:flex-row justify-between items-center text-xs">
                <p class="mb-4 md:mb-0">&copy; 2025 PARI ID. Hak Cipta Dilindungi Undang-Undang. Seluruh konten dan layanan merupakan properti dari PARI ID.</p>
                <p class="text-zinc-500">v1.0</p>
            </div>
        </div>
    </footer>

    <!-- Bottom Navigation Mobile -->
    <nav class="fixed bottom-4 left-1/2 -translate-x-1/2 w-[calc(100%-2rem)] max-w-md rounded-3xl h-20 flex items-center justify-around z-50 md:hidden pb-safe bottom-nav">
        <a href="/home" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:home"></span>
            </div>
        </a>

        <a href="/riwayat" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:history"></span>
            </div>
        </a>

        <a href="/top-buyers" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:trophy"></span>
            </div>
        </a>

        @if(auth()->user()->role === 'admin')
            <a href="/admin/dashboard" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
                <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                    <span class="iconify text-xl" data-icon="lucide:shield"></span>
                </div>
            </a>
        @else
            <a href="/bukti-garansi" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
                <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                    <span class="iconify text-xl" data-icon="lucide:clipboard-list"></span>
                </div>
            </a>
        @endif

        <a href="/redeem" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:ticket-percent"></span>
            </div>
        </a>

        <a href="/information" class="nav-item flex items-center justify-center w-14 h-14 rounded-2xl relative">
            <div class="nav-icon w-12 h-12 rounded-2xl flex items-center justify-center">
                <span class="iconify text-xl" data-icon="lucide:info"></span>
            </div>
        </a>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bottom Nav Active State
            const normalize = (p) => (p || '/').replace(/\/+$/, '') || '/';
            const currentPath = normalize(window.location.pathname);

            const items = Array.from(document.querySelectorAll('.nav-item'));
            const setActiveByHref = (href) => {
                items.forEach(i => i.classList.remove('active'));
                const el = document.querySelector(`.nav-item[href="${href}"]`);
                if (el) el.classList.add('active');
            };

            let matched = false;
            items.forEach(item => {
                const href = normalize(item.getAttribute('href'));
                if (currentPath === href) {
                    item.classList.add('active');
                    matched = true;
                }
            });

            if (!matched) {
                const map = [
                    { prefix: '/home', href: '/home' },
                    { prefix: '/bukti-garansi', href: '/bukti-garansi' },
                    { prefix: '/riwayat', href: '/riwayat' },
                    { prefix: '/top-buyers', href: '/top-buyers' },
                    { prefix: '/redeem', href: '/redeem' },
                    { prefix: '/information', href: '/information' },
                    { prefix: '/profile', href: '/profile' },
                    { prefix: '/admin', href: '/admin/dashboard' },
                ];

                for (const m of map) {
                    if (currentPath.startsWith(m.prefix)) {
                        setActiveByHref(m.href);
                        break;
                    }
                }
            }

            items.forEach(item => {
                item.addEventListener('click', () => {
                    items.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                });
            });

            // Search Functionality
            let searchTimeout;
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.getElementById('searchResults');

            searchInput.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                const query = e.target.value.trim();
                
                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    return;
                }

                searchTimeout = setTimeout(() => {
                    fetch(`/transfer/search?search=${encodeURIComponent(query)}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.length === 0) {
                                searchResults.innerHTML = `
                                    <div class="p-4 text-center text-gray-500">
                                        <span class="iconify text-2xl mb-2 inline-block" data-icon="lucide:user-x"></span>
                                        <p>Akun tidak ditemukan</p>
                                    </div>
                                `;
                                searchResults.classList.remove('hidden');
                                return;
                            }

                            let html = '';
                            data.forEach(user => {
                                const displayName = user.username || user.email || 'Tidak ada nama';
                                html += `
                                    <div class="user-item" onclick="selectUser(${user.id})">
                                        <div class="flex items-center gap-3">
                                            <img src="${user.profile_photo || '/images/default-avatar.png'}" 
                                                alt="${user.name}" 
                                                class="w-10 h-10 rounded-full object-cover bg-gray-200">
                                            <div class="flex-1">
                                                <p class="font-medium text-gray-900">${user.name}</p>
                                                <p class="text-xs text-gray-500">${displayName}</p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });

                            searchResults.innerHTML = html;
                            searchResults.classList.remove('hidden');
                        })
                        .catch(error => {
                            console.error('Search error:', error);
                            searchResults.innerHTML = `
                                <div class="p-4 text-center text-red-500">
                                    <span class="iconify text-2xl mb-2 inline-block" data-icon="lucide:alert-circle"></span>
                                    <p>Terjadi kesalahan saat mencari</p>
                                </div>
                            `;
                            searchResults.classList.remove('hidden');
                        });
                }, 300);
            });

            // Close search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });

            // Intersection Observer untuk footer dan bottom-nav
            const bottomNav = document.querySelector('.bottom-nav');
            const footer = document.querySelector('#footer');

            if (bottomNav && footer) {
                const observer = new IntersectionObserver(
                    ([entry]) => {
                        if (entry.isIntersecting) {
                            bottomNav.classList.add('hide');
                        } else {
                            bottomNav.classList.remove('hide');
                        }
                    },
                    {
                        root: null,
                        threshold: 0.05
                    }
                );

                observer.observe(footer);
            }
        });

        function selectUser(userId) {
            window.location.href = `/transfer/${userId}`;
        }
    </script>
</body>
</html>