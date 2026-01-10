<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Riwayat Transfer - PARI ID</title>

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
        
        .status-success {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-failed {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .tab-active {
            border-bottom: 2px solid #3b82f6;
            color: #3b82f6;
        }
    </style>
</head>

<body class="bg-[#F6F8FA] min-h-screen flex flex-col pb-28 md:pb-0 text-zinc-900">

    <!-- Header Mobile -->
    <header class="md:hidden px-5 pt-6 pb-2 bg-white sticky top-0 z-40 border-b border-zinc-50 shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-[10px] text-zinc-400 font-medium uppercase tracking-wide">Riwayat Transfer</p>
                <h2 class="font-bold text-lg text-zinc-900 truncate max-w-[200px]">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </h2>
                <p class="text-xs text-zinc-500 mt-1">
                    Role: {{ ucfirst(auth()->user()->role) }}
                </p>
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
        <!-- Judul H1 untuk Desktop -->
        <div class="hidden md:block">
            <div class="container mx-auto max-w-2xl mb-6">
                <h1 class="text-2xl font-bold text-zinc-900">Riwayat Transfer</h1>
                <p class="text-zinc-500 mt-1">Lihat semua riwayat transfer saldo Anda</p>
            </div>
        </div>

        <!-- Judul H1 untuk Mobile -->
        <div class="md:hidden mb-6">
            <div class="px-1">
                <h1 class="text-xl font-bold text-zinc-900">Riwayat Transfer</h1>
                <p class="text-zinc-500 text-sm mt-1">Lihat semua riwayat transfer saldo Anda</p>
            </div>
        </div>

        <div class="container mx-auto max-w-2xl">
            <!-- Tabs -->
            <div class="bg-white rounded-xl shadow-sm p-2 mb-6">
                <div class="flex">
                    <button id="tabAll" 
                            onclick="filterTransfers('all')" 
                            class="flex-1 py-3 text-center font-medium tab-active">
                        Semua
                    </button>
                    <button id="tabSent" 
                            onclick="filterTransfers('sent')" 
                            class="flex-1 py-3 text-center font-medium text-gray-500">
                        Dikirim
                    </button>
                    <button id="tabReceived" 
                            onclick="filterTransfers('received')" 
                            class="flex-1 py-3 text-center font-medium text-gray-500">
                        Diterima
                    </button>
                </div>
            </div>

            <!-- Transfer List -->
            <div id="transferList" class="space-y-4">
                @if($transfers->count() > 0)
                    @foreach($transfers as $transfer)
                        <div class="bg-white rounded-xl shadow-sm p-5 transfer-item" 
                             data-type="{{ $transfer->sender_id == $user->id ? 'sent' : 'received' }}">
                            
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-full 
                                        @if($transfer->sender_id == $user->id) bg-red-100 @else bg-green-100 @endif 
                                        flex items-center justify-center">
                                        @if($transfer->sender_id == $user->id)
                                            <span class="iconify text-red-600 text-xl" data-icon="lucide:arrow-up-right"></span>
                                        @else
                                            <span class="iconify text-green-600 text-xl" data-icon="lucide:arrow-down-left"></span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold">
                                            @if($transfer->sender_id == $user->id)
                                                Ke {{ $transfer->receiver->name }}
                                            @else
                                                Dari {{ $transfer->sender->name }}
                                            @endif
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $transfer->created_at->translatedFormat('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="text-right">
                                    <p class="font-bold text-lg 
                                        @if($transfer->sender_id == $user->id) text-red-600 @else text-green-600 @endif">
                                        @if($transfer->sender_id == $user->id)
                                            - Rp {{ number_format($transfer->total_deducted, 0, ',', '.') }}
                                        @else
                                            + Rp {{ number_format($transfer->amount, 0, ',', '.') }}
                                        @endif
                                    </p>
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-medium 
                                        status-{{ $transfer->status }}">
                                        {{ ucfirst($transfer->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Details -->
                            <div class="border-t pt-3 text-sm text-gray-600">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-gray-500">Nominal Transfer</p>
                                        <p class="font-medium">Rp {{ number_format($transfer->amount, 0, ',', '.') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Biaya Admin</p>
                                        <p class="font-medium">Rp {{ number_format($transfer->admin_fee, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                
                                @if($transfer->note)
                                    <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                        <p class="text-gray-500 mb-1">Catatan</p>
                                        <p="{{ $transfer->note }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $transfers->links() }}
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                        <span class="iconify text-5xl text-gray-300 mx-auto mb-4" data-icon="lucide:send"></span>
                        <h3 class="text-lg font-medium text-gray-700 mb-2">Belum ada riwayat transfer</h3>
                        <p class="text-gray-500">Transfer saldo Anda akan muncul di sini</p>
                        <a href="/transfer" 
                           class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            Buat Transfer
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>

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

            // Initialize tab states on page load
            const activeTab = 'all';
            filterTransfers(activeTab);
        });

        function filterTransfers(type) {
            // Update active tab
            const tabs = ['All', 'Sent', 'Received'];
            
            tabs.forEach(tab => {
                const tabElement = document.getElementById(`tab${tab}`);
                if (tab.toLowerCase() === type) {
                    tabElement.classList.add('tab-active', 'text-blue-600');
                    tabElement.classList.remove('text-gray-500');
                } else {
                    tabElement.classList.remove('tab-active', 'text-blue-600');
                    tabElement.classList.add('text-gray-500');
                }
            });

            // Filter items
            const items = document.querySelectorAll('.transfer-item');
            items.forEach(item => {
                if (type === 'all') {
                    item.style.display = 'block';
                } else {
                    if (item.dataset.type === type) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
            
            // Smooth scroll to top when filtering
            document.getElementById('transferList').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
    </script>
</body>
</html>