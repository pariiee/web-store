<!DOCTYPE html> 
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up Saldo | PARI ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #121212;
            --secondary-color: #f4f6fa;
            --accent-color: #4a6cf7;
            --text-color: #333;
            --light-text: #888;
            --border-radius: 16px;
            --box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .main-container {
            max-width: 550px;
            margin: 20px auto;
            padding: 20px;
        }

        @media (max-width: 600px) {
            .main-container {
                padding: 15px;
                margin: 10px auto;
            }
        }
        
        .saldo-card {
            background: var(--primary-color);
            color: white;
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .saldo-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .saldo-title {
            font-size: 15px;
            opacity: .7;
            margin-bottom: 8px;
        }

        .saldo-amount {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .form-card {
            background: white;
            padding: 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 30px;
        }

        .form-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .label {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: var(--primary-color);
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group::before {
            content: 'Rp';
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-text);
            font-weight: bold;
        }

        input[type=text] {
            width: 100%;
            padding: 14px 14px 14px 40px;
            border: 1px solid #ddd;
            border-radius: 12px;
            font-size: 16px;
            outline: none;
            transition: var(--transition);
        }

        input[type=text]:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(74, 108, 247, 0.2);
        }

        .nominal-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin: 20px 0;
        }

        @media (min-width: 480px) {
            .nominal-buttons {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        .nominal-btn {
            background: #f8f9fa;
            padding: 14px 5px;
            text-align: center;
            border-radius: 12px;
            font-weight: bold;
            border: 1px solid #e1e5e9;
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-color);
            font-size: 14px;
        }

        .nominal-btn:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .nominal-btn.active {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: var(--primary-color);
            border: none;
            color: white;
            border-radius: 14px;
            font-size: 17px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
            transition: var(--transition);
        }

        .submit-btn:hover {
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .error-msg {
            color: #e74c3c;
            background: #ffeaea;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #e74c3c;
        }

        .success-msg {
            color: #27ae60;
            background: #eafaf1;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #27ae60;
        }

        .min-amount {
            font-size: 13px;
            color: var(--light-text);
            margin-top: -15px;
            margin-bottom: 15px;
        }

        .bottom-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: transform .35s ease, opacity .25s ease;
        }
        
        .bottom-nav.hide {
            transform: translate(-50%, 120%);
            opacity: 0;
            pointer-events: none;
        }
        
        .nav-item { transition: transform .18s ease, background .18s ease; }
        .nav-icon {
            transition: all .18s ease;
            background: rgba(255, 255, 255, 0.9);
            color: #18181b;
            border: 1px solid rgba(229, 231, 235, 0.6);
        }
        .nav-item.active { transform: translateY(-6px); }
        .nav-item.active .nav-icon {
            background: #18181b;
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(0,0,0,0.18);
            border-color: #18181b;
        }
        .nav-item:active .nav-icon { transform: scale(.96); }
        
        .mobile-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.6);
        }

        @media (max-width: 600px) {
            .saldo-card, .form-card {
                padding: 20px;
            }
            
            .saldo-amount {
                font-size: 30px;
            }
            
            .nominal-btn {
                font-size: 13px;
                padding: 12px 5px;
            }
        }

        @media (max-width: 380px) {
            .nominal-buttons {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .nominal-btn {
                font-size: 12px;
                padding: 10px 5px;
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col text-zinc-900">

    <header class="md:hidden px-5 pt-6 pb-2 mobile-header sticky top-0 z-40 shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-[10px] text-zinc-500 font-medium uppercase tracking-wide">Selamat Datang,</p>
                <h2 class="font-bold text-lg text-zinc-900 truncate max-w-[200px]">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </h2>
            </div>
            <a href="/profile"
               class="w-9 h-9 rounded-full overflow-hidden border border-zinc-200/60 bg-white/80 hover:bg-white transition flex items-center justify-center">
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

    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-zinc-200/80 hidden md:block">
        <div class="container mx-auto max-w-6xl px-4 h-16 flex items-center justify-between">
            
            <div class="flex items-center gap-2">
                <a href="/home" class="flex items-center gap-2 hover:opacity-80 transition">
                    <img src="{{ asset('images/logo.jpg') }}" alt="PARI ID" class="hidden md:block h-8 w-auto object-contain">
                    <span class="md:hidden font-bold text-xl text-zinc-900">PARI ID X CYAA STORE </span>
                </a>
            </div>

            <div class="flex items-center gap-8">
                <a href="/home" class="text-sm font-medium {{ request()->is('/home') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Home</a>

                <a href="/riwayat" class="text-sm font-medium {{ request()->is('riwayat') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Riwayat</a>

                <a href="/redeem" class="text-sm font-medium {{ request()->is('redeem') ? 'text-zinc-500' : 'text-zinc-500 hover:text-zinc-900' }}">Redeem</a>

                <a href="/profile" class="text-sm font-medium {{ request()->is('profile') ? 'text-zinc-500' : 'text-zinc-500 hover:text-zinc-900' }}">Akun</a>
                
                <a href="/information" class="text-sm font-medium {{ request()->is('information') ? 'text-zinc-500' : 'text-zinc-500 hover:text-zinc-900' }}">Info</a>

                @if(auth()->user()->role === 'admin')
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

    <main class="flex-grow">
        <div class="main-container">

            {{-- SALDO CARD --}}
            <div class="saldo-card">
                <div class="saldo-title">Sisa Saldo Anda</div>
                <div class="saldo-amount">
                    Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}
                </div>
            </div>

            {{-- ERROR --}}
            @if(session('error'))
                <div class="error-msg">{{ session('error') }}</div>
            @endif

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="success-msg">{{ session('success') }}</div>
            @endif

            {{-- FORM TOP UP --}}
            <div class="form-card">
                <h2 class="form-title">Top Up Saldo</h2>
                
                <form id="topupForm" action="{{ route('topup.create') }}" method="POST">
                    @csrf

                    <label class="label">Nominal Top Up</label>
                    <div class="input-group">
                        <input type="text" id="customAmount" name="custom_amount" placeholder="Min. 5.000">
                    </div>
                    <div class="min-amount">Minimum top up: Rp 5.000</div>

                    {{-- TOMBOL NOMINAL DENGAN TAMBAHAN 70.000 DAN 80.000 --}}
                    <div class="nominal-buttons">
                        {{-- Baris 1 --}}
                        <div class="nominal-btn" data-amount="10000">10.000</div>
                        <div class="nominal-btn" data-amount="20000">20.000</div>
                        <div class="nominal-btn" data-amount="25000">25.000</div>
                        
                        {{-- Baris 2 --}}
                        <div class="nominal-btn" data-amount="30000">30.000</div>
                        <div class="nominal-btn" data-amount="35000">35.000</div>
                        <div class="nominal-btn" data-amount="40000">40.000</div>
                        
                        {{-- Baris 3 --}}
                        <div class="nominal-btn" data-amount="50000">50.000</div>
                        <div class="nominal-btn" data-amount="55000">55.000</div>
                        <div class="nominal-btn" data-amount="60000">60.000</div>
                        
                        {{-- Baris 4 (DITAMBAH 70.000 DAN 80.000) --}}
                        <div class="nominal-btn" data-amount="70000">70.000</div>
                        <div class="nominal-btn" data-amount="80000">80.000</div>
                        <div class="nominal-btn" data-amount="100000">100.000</div>
                    </div>

                    <input type="hidden" id="selectedAmount" name="amount" value="">

                    <button type="submit" class="submit-btn">
                        Lanjut Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </main>

    <footer id="footer" class="bg-zinc-900 text-zinc-400 py-12 border-t border-zinc-800 mt-16">
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
                            <a href="#" class="hover:text-white transition flex items-center gap-3 p-3 bg-zinc-900/50 rounded-xl hover:bg-zinc-800">
                                <span class="iconify text-lg" data-icon="lucide:shield-check"></span>
                                <div>
                                    <p class="font-medium text-sm">Kebijakan Privasi</p>
                                    <p class="text-xs text-zinc-500 mt-0.5">Data dan keamanan pengguna</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-white transition flex items-center gap-3 p-3 bg-zinc-900/50 rounded-xl hover:bg-zinc-800">
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
                <p class="text-zinc-500">v2.1.0</p>
            </div>
        </div>
    </footer>

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
            const nominalButtons = document.querySelectorAll('.nominal-btn');
            const customAmountInput = document.getElementById('customAmount');
            const selectedAmountInput = document.getElementById('selectedAmount');
            const form = document.getElementById('topupForm');
            
            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            
            function parseFormattedNumber(str) {
                return parseInt(str.replace(/,/g, '')) || 0;
            }
            
            customAmountInput.addEventListener('input', function() {
                let value = this.value.replace(/\D/g, '');
                
                if (value === '') {
                    this.value = '';
                    selectedAmountInput.value = '';
                    nominalButtons.forEach(btn => btn.classList.remove('active'));
                    return;
                }
                
                let numValue = parseInt(value);
                
                this.value = formatNumber(numValue);
                
                nominalButtons.forEach(btn => btn.classList.remove('active'));
                
                selectedAmountInput.value = numValue;
            });
            
            nominalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    nominalButtons.forEach(btn => btn.classList.remove('active'));
                    
                    this.classList.add('active');
                    
                    const amount = this.getAttribute('data-amount');
                    selectedAmountInput.value = amount;
                    
                    customAmountInput.value = formatNumber(amount);
                });
            });
            
            form.addEventListener('submit', function(e) {
                const amount = selectedAmountInput.value;
                
                if (!amount || amount < 5000) {
                    e.preventDefault();
                    alert('Masukkan nominal top up minimal Rp 5.000');
                    customAmountInput.focus();
                }
            });
            
            if (customAmountInput.value) {
                let value = customAmountInput.value.replace(/\D/g, '');
                if (value) {
                    customAmountInput.value = formatNumber(value);
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
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
                    { prefix: '/redeem', href: '/redeem' },
                    { prefix: '/information', href: '/information' },
                    { prefix: '/profile', href: '/profile' },
                    { prefix: '/admin', href: '/admin/dashboard' },
                    { prefix: '/topup', href: '/topup' },
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
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const bottomNav = document.querySelector('.bottom-nav');
            const footer = document.querySelector('#footer');

            if (!bottomNav || !footer) return;

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
        });
    </script>

</body>
</html>