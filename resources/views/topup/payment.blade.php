<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pembayaran | PARI ID</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
    <style>
        body {
            background: #f7f8fa;
            margin: 0;
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .content-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .badge {
            background: #fff5c2;
            color: #856404;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-block;
            margin: 10px auto 20px;
            text-align: center;
            width: fit-content;
        }

        .card-header {
            background: #111;
            color: #fff;
            text-align: center;
            padding: 25px;
            border-radius: 18px 18px 0 0;
        }

        .nominal-total {
            font-size: 32px;
            font-weight: bold;
            margin: 8px 0;
        }

        .card-body {
            background: #fff;
            padding: 30px;
            border-radius: 0 0 18px 18px;
            text-align: center;
            box-shadow: 0 4px 14px rgba(0,0,0,.08);
            margin-bottom: 20px;
        }

        .qr-wrapper {
            position: relative;
            display: inline-block;
            margin: 15px 0;
        }
        
        .qr-wrapper img {
            width: 240px;
            height: 240px;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
        }
        
        .qr-wrapper.blur img {
            filter: blur(6px);
        }
        
        .qr-success {
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,.85);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            color: #28a745;
            display: none;
            border-radius: 14px;
        }
        
        .qr-wrapper.blur .qr-success {
            display: flex;
        }

        .qr-text {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
            line-height: 1.5;
        }

        .status-text {
            margin: 15px 0;
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 15px;
        }
        
        table td {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        table td:first-child {
            color: #777;
            text-align: left;
        }
        
        table td:last-child {
            text-align: right;
            font-weight: 600;
            color: #333;
        }
        
        table tr:last-child td {
            border-bottom: none;
        }
        
        .red {
            color: #d9534f !important;
        }

        .btn-main {
            width: 100%;
            background: #111;
            color: #fff;
            padding: 16px;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px 0;
            font-weight: 600;
            transition: 0.2s;
        }
        
        .btn-main:hover {
            background: #000;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-download {
            width: 100%;
            background: #28a745;
            color: #fff;
            padding: 16px;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            cursor: pointer;
            margin: 20px 0 10px;
            font-weight: 600;
            transition: 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-download:hover {
            background: #218838;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
        }

        .btn-cancel {
            width: 100%;
            background: #dc3545;
            color: #fff;
            padding: 16px;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            cursor: pointer;
            margin: 10px 0;
            font-weight: 600;
            transition: 0.2s;
        }
        
        .btn-cancel:hover {
            background: #c82333;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
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
            .content-container {
                padding: 15px;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .qr-wrapper img {
                width: 220px;
                height: 220px;
            }
            
            .nominal-total {
                font-size: 28px;
            }
        }
        
        @media (max-width: 400px) {
            .qr-wrapper img {
                width: 200px;
                height: 200px;
            }
            
            .nominal-total {
                font-size: 26px;
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col text-zinc-900">

    <header class="md:hidden px-5 pt-6 pb-2 mobile-header sticky top-0 z-40 shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-[10px] text-zinc-500 font-medium uppercase tracking-wide">Detail Pembayaran</p>
                <h2 class="font-bold text-lg text-zinc-900 truncate max-w-[200px]">
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

    <main class="flex-grow flex items-center justify-center pt-6">
        <div class="content-container">

            <div class="badge" id="badge">⏳ Menunggu Pembayaran</div>

            <div class="card-header">
                <div style="font-size: 15px; opacity: 0.9;">TOTAL TRANSFER</div>
                <div class="nominal-total">
                    Rp {{ number_format($trx->total_amount,0,',','.') }}
                </div>
                <div style="font-size: 13px; color: #ffd700; margin-top: 5px;">
                    *Transfer sesuai nominal hingga 3 digit terakhir
                </div>
            </div>

            <div class="card-body">

                <div class="qr-wrapper" id="qr">
                    <img src="{{ $trx->qr_url }}" alt="QR Code Pembayaran">
                    <div class="qr-success">✅</div>
                </div>

                <div class="qr-text">
                    Scan QRIS menggunakan DANA, OVO, GoPay, ShopeePay, atau Mobile Banking
                </div>

                <div class="status-text">
                    <div>Status: <b id="status">{{ $trx->status }}</b></div>
                    <div>Sisa waktu: <b id="timer"></b></div>
                </div>

                <table>
                    <tr>
                        <td>ID Transaksi</td>
                        <td>#{{ $trx->id }}</td>
                    </tr>
                    <tr>
                        <td>Nominal Request</td>
                        <td>Rp {{ number_format($trx->amount,0,',','.') }}</td>
                    </tr>
                    <tr>
                        <td>Fee </td>
                        <td class="red">+ {{ $trx->unique_code }}</td>
                    </tr>
                    <tr>
                        <td>Batas Waktu</td>
                        <td class="red">{{ $trx->expired_at->format('d M Y, H:i') }} WIB</td>
                    </tr>
                </table>

                <button class="btn-download" id="downloadQR">
                    <span class="iconify" data-icon="lucide:download"></span>
                    Download QR Code
                </button>

                <form action="{{ route('topup.cancel',$trx->id) }}" method="POST">
    @csrf
    <button type="submit" class="btn-cancel">❌ Batalkan Pembayaran</button>
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
                        <span class="font-bold text-xl tracking-tight text-white">PARI ID x CYAA STORE</span>
                    </div>
                    <p class="text-sm leading-relaxed mb-6 max-w-3xl">
                        PARI ID adalah Web platform Web terpercaya yang menyediakan berbagai produk digital dengan harga kompetitif. 
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
    const checkUrl = "{{ route('topup.check',$trx->id) }}";
    const homeUrl  = "{{ route('guest.home') }}";
    const expiredAt = new Date("{{ $trx->expired_at->format('Y-m-d H:i:s') }}").getTime();

    const badge    = document.getElementById('badge');
    const statusEl = document.getElementById('status');
    const timer    = document.getElementById('timer');
    const qr       = document.getElementById('qr');

    let stopped = false;
    let inFlight = false;
    let failCount = 0;

    function setBadge(type) {
        if (type === 'paid') {
            badge.innerText = '✅ Pembayaran Berhasil';
            badge.style.background = '#d4edda';
            badge.style.color = '#155724';
            qr.classList.add('blur');
        } else if (type === 'expired') {
            badge.innerText = '⏰ Expired';
            badge.style.background = '#f8d7da';
            badge.style.color = '#721c24';
        } else if (type === 'cancel') {
            badge.innerText = '❌ Dibatalkan';
            badge.style.background = '#f8d7da';
            badge.style.color = '#721c24';
        } else {
            badge.innerText = '⏳ Menunggu Pembayaran';
            badge.style.background = '#fff5c2';
            badge.style.color = '#856404';
        }
    }

    function stopAll() {
        stopped = true;
        clearInterval(statusInterval);
        clearInterval(timerInterval);
    }

    function timerTick() {
        if (stopped) return;

        let diff = expiredAt - new Date().getTime();
        if (diff <= 0) {
            timer.innerText = '00:00';
            setBadge('expired');
            stopAll();
            setTimeout(() => location.href = homeUrl, 1000);
            return;
        }

        let m = Math.floor(diff / 60000);
        let s = Math.floor((diff % 60000) / 1000);
        timer.innerText = String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
    }

   
    async function checkStatus() {
        if (stopped || inFlight) return;

        inFlight = true;

        try {
            const res = await fetch(checkUrl, {
                method: 'GET',
                headers: { 'Accept': 'application/json' },
                cache: 'no-store'
            });

            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            const d = await res.json();
            const st = (d.status || 'pending').toLowerCase();

            statusEl.innerText = st;

            
            failCount = 0;

            if (st === 'paid' || st === 'expired' || st === 'cancel') {
                setBadge(st);
                stopAll();
                setTimeout(() => location.href = homeUrl, st === 'paid' ? 1200 : 1000);
            } else {
                setBadge('pending');
            }

        } catch (e) {
           
            failCount++;
            
            if (failCount >= 5) {
                
                clearInterval(statusInterval);
                statusInterval = setInterval(checkStatus, 5000);
            }
        } finally {
            inFlight = false;
        }
    }


    document.addEventListener('visibilitychange', () => {
        if (document.hidden) return;
        
        checkStatus();
    });

    const timerInterval = setInterval(timerTick, 1000);
    let statusInterval  = setInterval(checkStatus, 2000);

    timerTick();
    checkStatus();
</script>

</body>
</html>