<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeem - PARI ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            background: #f4f6fa;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        
        .code-box {
            width: 56px;
            height: 66px;
            border-radius: 8px;
            border: 2px solid #d4d4d4;
            text-align: center;
            font-size: 26px;
            font-weight: 600;
            color: #000;
            transition: all 0.2s ease;
            font-family: 'Outfit', monospace;
            background: #fff;
        }
        
        .code-box:focus {
            border-color: #000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
            outline: none;
        }
        
        .code-box.filled {
            border-color: #000;
            background-color: #fafafa;
        }
        
        .history-item {
            display: flex;
            align-items: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            border: 1px solid #e5e5e5;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        
        .history-item:before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #000;
        }
        
        .history-item:hover {
            transform: translateX(4px);
            border-color: #d4d4d4;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        
        @media (max-width: 768px) {
            .code-box {
                width: 50px;
                height: 58px;
                font-size: 24px;
            }
        }
        
        @media (max-width: 640px) {
            .code-box {
                width: 44px;
                height: 52px;
                font-size: 22px;
            }
        }
        
        @media (max-width: 480px) {
            .code-box {
                width: 40px;
                height: 48px;
                font-size: 20px;
            }
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

<body class="bg-[#F6F8FA] min-h-screen flex flex-col text-zinc-900">

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
                <a href="/home" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Home</a>
                <a href="/top-buyers" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Top</a>
                <a href="/riwayat" class="text-sm font-medium text-zinc-500 hover:text-zinc-900">Riwayat</a>
                <a href="/redeem" class="text-sm font-medium text-zinc-900">Redeem</a>
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

    <main class="container mx-auto max-w-6xl px-5 py-5 space-y-6">
        
        @if(session('error'))
            <script>
                Swal.fire({
                    title: "Gagal",
                    text: "{{ session('error') }}",
                    icon: "error",
                    confirmButtonColor: "#000000",
                    confirmButtonText: "OK",
                    background: "#ffffff",
                    color: "#000000"
                });
            </script>
        @endif

        @if(session('success'))
            <script>
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonColor: "#000000",
                    confirmButtonText: "Lanjutkan",
                    background: "#ffffff",
                    color: "#000000"
                });
            </script>
        @endif

        @if(session('success_stock'))
            <script>
                Swal.fire({
                    title: "Berhasil!",
                    html: `
                        <div style="text-align:center;">
                            <div style="font-size:48px; color:#000000; margin-bottom:15px;">
                                <i class="fas fa-box-check"></i>
                            </div>
                            <h3 style="margin-bottom:10px; color:#000000;">Anda Mendapatkan 1 Stock!</h3>
                            <p style="color:#525252; margin-bottom:20px;">Detail stock telah disalin ke clipboard</p>
                            <textarea id="copyText" style="width:100%;height:100px;margin-top:10px;border-radius:8px;padding:12px;border:1px solid #d4d4d4;font-family:monospace;background:#fafafa;color:#000000;">{{ session('success_stock') }}</textarea>
                            <button onclick="copyNow()" style="margin-top:15px;padding:12px 25px;background:#000000;color:white;border-radius:8px;border:none;cursor:pointer;font-weight:600;width:100%;">
                                <i class="fas fa-copy"></i> Salin Kembali
                            </button>
                        </div>
                    `,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    background: "#ffffff",
                    color: "#000000"
                });
            </script>
        @endif

        <script>
            function copyNow() {
                let t = document.getElementById("copyText");
                t.select();
                t.setSelectionRange(0, 99999);
                navigator.clipboard.writeText(t.value);
                
                Swal.fire({
                    title: "Tersalin!",
                    text: "Detail stock berhasil disalin ke clipboard",
                    icon: "success",
                    timer: 1500,
                    showConfirmButton: false,
                    background: "#ffffff",
                    color: "#000000"
                });
            }
        </script>
        
        <div class="bg-white rounded-2xl shadow-lg border border-zinc-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-zinc-200">
                <h2 class="font-bold text-lg text-zinc-900 flex items-center gap-3">
                    <span class="iconify text-xl" data-icon="lucide:key-square"></span>
                    INPUT KODE REDEEM
                </h2>
            </div>
            
            <div class="p-6">
                <form method="POST" action="{{ route('redeem.store') }}" id="redeemForm">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-zinc-800 mb-3">Masukkan 6 digit kode:</label>
                        <div class="flex justify-center gap-3 mb-6">
                            <input type="text" maxlength="1" class="code-box" id="c1" oninput="nextBox(1)" onkeydown="handleKeyDown(1, event)">
                            <input type="text" maxlength="1" class="code-box" id="c2" oninput="nextBox(2)" onkeydown="handleKeyDown(2, event)">
                            <input type="text" maxlength="1" class="code-box" id="c3" oninput="nextBox(3)" onkeydown="handleKeyDown(3, event)">
                            <input type="text" maxlength="1" class="code-box" id="c4" oninput="nextBox(4)" onkeydown="handleKeyDown(4, event)">
                            <input type="text" maxlength="1" class="code-box" id="c5" oninput="nextBox(5)" onkeydown="handleKeyDown(5, event)">
                            <input type="text" maxlength="1" class="code-box" id="c6" oninput="nextBox(6)" onkeydown="handleKeyDown(6, event)">
                        </div>
                        
                        <div class="text-center text-sm text-zinc-500 bg-zinc-50 p-3 rounded-lg border border-dashed border-zinc-300 flex items-center justify-center gap-2">
                            <span class="iconify" data-icon="lucide:lightbulb"></span>
                            <span>Tips: Tempelkan seluruh 6 digit kode sekaligus dengan Ctrl+V</span>
                        </div>
                        
                        <input type="hidden" name="code" id="finalCode">
                    </div>
                    
                    <button type="button" onclick="joinCode()" id="redeemBtn" 
                            class="w-full bg-black text-white py-4 rounded-xl font-bold text-lg flex items-center justify-center gap-3 hover:bg-zinc-800 transition-all shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="iconify text-xl" data-icon="lucide:gift"></span>
                        TUKARKAN REDEEM
                    </button>
                </form>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg border border-zinc-200 overflow-hidden">
            <div class="px-6 py-5">
                <div class="font-bold text-lg text-zinc-900 flex items-center gap-3 mb-6 pb-4 border-b border-zinc-200">
                    <span class="iconify text-xl" data-icon="lucide:history"></span>
                    RIWAYAT REDEEM
                </div>
                
                <div class="space-y-4">
                    @if(count($claims) > 0)
                        @foreach($claims as $log)
                            <div class="history-item">
                                <div class="w-11 h-11 rounded-full bg-zinc-100 border border-zinc-300 flex items-center justify-center text-zinc-800 mr-4 flex-shrink-0">
                                    @if($log->reward_type === 'saldo')
                                        <span class="iconify" data-icon="lucide:wallet"></span>
                                    @else
                                        <span class="iconify" data-icon="lucide:package"></span>
                                    @endif
                                </div>
                                
                                <div class="flex-1">
                                    <div class="font-semibold text-zinc-900 mb-1">
                                        @if($log->reward_type === 'saldo')
                                            Saldo Berhasil Diklaim
                                        @else
                                            Stock Berhasil Diklaim
                                        @endif
                                </div>
                                    
                                    <div class="text-zinc-700 mb-2 {{ $log->reward_type === 'saldo' ? 'font-semibold' : '' }}">
                                        @if($log->reward_type === 'saldo')
                                            Rp {{ number_format($log->saldo_awarded, 0, ',', '.') }}
                                        @else
                                            1 Item Stock
                                        @endif
                                    </div>
                                    
                                    <div class="text-sm text-zinc-500 flex items-center gap-4">
                                        <span class="flex items-center gap-1">
                                            <span class="iconify text-sm" data-icon="lucide:calendar"></span>
                                            {{ $log->created_at->format('d M Y') }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <span class="iconify text-sm" data-icon="lucide:clock"></span>
                                            {{ $log->created_at->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12 border-2 border-dashed border-zinc-300 rounded-xl bg-zinc-50">
                            <span class="iconify text-5xl text-zinc-400 mb-4 inline-block" data-icon="lucide:inbox"></span>
                            <p class="font-semibold text-zinc-700 mb-2">Belum ada riwayat redeem</p>
                            <p class="text-sm text-zinc-500">Kode Redeem yang berhasil diredeem akan muncul di sini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

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
        function nextBox(n) {
            let box = document.getElementById("c" + n);
            box.value = box.value.replace(/[^A-Za-z0-9]/g, '').toUpperCase();
            
            if (box.value.length > 0) {
                box.classList.add('filled');
            } else {
                box.classList.remove('filled');
            }
            
            if (box.value.length === 1 && n < 6) {
                document.getElementById("c" + (n + 1)).focus();
            }
            
            validateRedeemButton();
        }
        
        function handleKeyDown(n, e) {
            let box = document.getElementById("c" + n);
            
            if (e.key === 'Backspace' && box.value.length === 0 && n > 1) {
                document.getElementById("c" + (n - 1)).focus();
            }
            
            if (e.key === 'ArrowLeft' && n > 1) {
                document.getElementById("c" + (n - 1)).focus();
            }
            
            if (e.key === 'ArrowRight' && n < 6) {
                document.getElementById("c" + (n + 1)).focus();
            }
        }
        
        function validateRedeemButton() {
            let code = c1.value + c2.value + c3.value + c4.value + c5.value + c6.value;
            let btn = document.getElementById('redeemBtn');
            
            if (code.length === 6) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        }
        
        function joinCode() {
            event.preventDefault();
            
            let code = c1.value + c2.value + c3.value + c4.value + c5.value + c6.value;
            
            if (code.length < 6) {
                Swal.fire({
                    title: "Kode Tidak Lengkap",
                    text: "Harap masukkan semua 6 digit kode",
                    icon: "warning",
                    confirmButtonColor: "#000000",
                    background: "#ffffff",
                    color: "#000000"
                });
                return;
            }
            
            document.getElementById("finalCode").value = code;
            document.getElementById("redeemForm").submit();
        }
        
        document.querySelectorAll('.code-box').forEach((box, index) => {
            box.addEventListener('paste', function(e) {
                const paste = (e.clipboardData || window.clipboardData).getData('text').toUpperCase();
                if (paste.length === 6 && /^[A-Z0-9]{6}$/.test(paste)) {
                    for (let i = 0; i < 6; i++) {
                        let inputBox = document.getElementById("c" + (i + 1));
                        inputBox.value = paste[i];
                        inputBox.classList.add('filled');
                    }
                    document.getElementById("c6").focus();
                    
                    validateRedeemButton();
                    
                    setTimeout(() => {
                        Swal.fire({
                            title: "Kode Berhasil Ditempel",
                            text: "Klik tombol Redeem untuk melanjutkan",
                            icon: "info",
                            timer: 2000,
                            showConfirmButton: false,
                            background: "#ffffff",
                            color: "#000000"
                        });
                    }, 300);
                }
                e.preventDefault();
            });
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('c1').focus();
            validateRedeemButton();
            
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