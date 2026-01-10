<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Konfirmasi Transfer - PARI ID</title>

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
        
        .amount-input {
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            border: none;
            outline: none;
            width: 100%;
            background: transparent;
        }
        
        .quick-amount {
            border: 1px solid #e5e7eb;
            padding: 8px 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            background: white;
        }
        
        .quick-amount:hover {
            background: #f3f4f6;
            border-color: #d1d5db;
        }
        
        .quick-amount.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
        
        .back-btn {
            transition: all 0.2s ease;
        }
        
        .back-btn:hover {
            background-color: #f3f4f6;
            transform: translateX(-2px);
        }

        /* Modal Styles - UPDATED */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 380px;
            transform: translateY(20px);
            transition: transform 0.3s ease;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0);
        }

        .modal-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-body {
            padding: 16px;
            overflow-y: visible;
        }

        .modal-footer {
            padding: 12px 20px 16px;
            border-top: 1px solid #f3f4f6;
            display: flex;
            gap: 12px;
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
        
        /* Footer Styles */
        .footer-link {
            color: #a1a1aa;
            transition: color 0.2s;
        }
        
        .footer-link:hover {
            color: white;
        }
    </style>
</head>

<body class="bg-[#F6F8FA] min-h-screen flex flex-col text-zinc-900">

    <!-- Header Mobile -->
    <header class="md:hidden px-5 pt-6 pb-2 mobile-header sticky top-0 z-40 border-b border-zinc-50 shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-[10px] text-zinc-400 font-medium uppercase tracking-wide">Konfirmasi Transfer</p>
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
            <!-- Header dengan Tombol Kembali -->
            <div class="flex items-center mb-6">
                <!-- Tombol Kembali -->
                <button type="button" 
                        onclick="goBack()" 
                        class="back-btn flex items-center gap-2 px-4 py-3 rounded-xl bg-white shadow-sm hover:shadow-md">
                    <span class="iconify text-xl" data-icon="lucide:arrow-left"></span>
                    <span class="font-medium hidden sm:inline">Kembali</span>
                </button>
                
                <!-- Judul Halaman -->
                <div class="flex-1 text-center">
                    <h1 class="text-xl font-bold text-gray-800">Konfirmasi Transfer</h1>
                    <p class="text-gray-600 text-sm mt-1">Periksa kembali sebelum mengirim</p>
                </div>
                
                <!-- Spacer untuk penyeimbang -->
                <div class="w-16 sm:w-24"></div>
            </div>

            <form action="{{ route('transfer.process') }}" method="POST" id="transferForm">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                <!-- Receiver Info -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <div class="flex items-center gap-4 mb-6">
                        <img src="{{ $receiver->profile_photo ? asset('storage/profile/' . $receiver->profile_photo) : asset('images/default_pp.jpg') }}" 
                             alt="{{ $receiver->name }}" 
                             class="w-16 h-16 rounded-full object-cover border-2 border-blue-100">
                        <div>
                            <h2 class="font-bold text-lg">{{ $receiver->name }}</h2>
                            <p class="text-gray-600 text-sm">
                                {{ $receiver->nama_tele ? '@' . $receiver->nama_tele : $receiver->email }}
                            </p>
                        </div>
                    </div>

                    <!-- Amount Input -->
                    <div class="mb-6">
                        <label class="block text-center text-gray-600 mb-2">Masukkan Nominal</label>
                        <div class="border-2 border-blue-100 bg-blue-50 rounded-xl p-4 mb-2">
                            <div class="flex items-center justify-center">
                                <span class="text-gray-700 mr-2">Rp</span>
                                <input type="number" 
                                       name="amount" 
                                       id="amountInput"
                                       min="100"
                                       max="1000000"
                                       value="100"
                                       class="amount-input"
                                       required
                                       oninput="calculateTotal()">
                            </div>
                            <p class="text-center text-sm text-gray-500 mt-2">Minimal Rp 100</p>
                        </div>

                        <!-- Quick Amounts -->
                        <div class="grid grid-cols-4 gap-2 mt-4">
                            @php 
                                $quickAmounts = [1000, 5000, 10000, 50000]; 
                            @endphp
                            
                            @foreach($quickAmounts as $amount)
                                <button type="button" 
                                        onclick="setAmount({{ $amount }})"
                                        class="quick-amount text-center"
                                        data-amount="{{ $amount }}">
                                    <span class="text-sm">{{ number_format($amount, 0, ',', '.') }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Transfer Details -->
                    <div class="space-y-3 border-t pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Nominal Transfer</span>
                            <span id="amountDisplay" class="font-medium">Rp 100</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Biaya Admin (0.5%)</span>
                            <span id="feeDisplay" class="text-red-600 font-medium">Rp 1</span>
                        </div>
                        
                        <div class="flex justify-between items-center border-t pt-3">
                            <span class="text-gray-700 font-medium">Total Dipotong</span>
                            <span id="totalDisplay" class="font-bold text-lg text-red-600">Rp 101</span>
                        </div>
                    </div>
                </div>

                <!-- Note Input -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                    <label class="block text-gray-700 mb-2">Catatan (Opsional)</label>
                    <input type="text" 
                           name="note" 
                           id="noteInput"
                           placeholder="Contoh: Untuk jajan, bayar hutang, dll."
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                           maxlength="255">
                    <p class="text-xs text-gray-500 mt-1">Maksimal 255 karakter</p>
                </div>

                <!-- Transfer Limit -->
                <div class="bg-yellow-50 border border-yellow-100 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-2">
                        <span class="iconify text-yellow-500 mt-0.5" data-icon="lucide:shield-alert"></span>
                        <div class="text-sm text-yellow-800">
                            <p class="font-medium">Batas Transfer Harian</p>
                            @if($user->role === 'admin')
                                <p>Anda memiliki <strong>transfer tidak terbatas</strong> sebagai Admin.</p>
                            @else
                                <p>Anda telah melakukan <strong>{{ $transferLimitInfo['used'] }}</strong> transfer hari ini.</p>
                                <p class="mt-1">Sisa transfer: 
                                    <strong>
                                        @if($user->role === 'reseller')
                                            {{ $transferLimitInfo['remaining'] }}/10
                                        @else
                                            {{ $transferLimitInfo['remaining'] }}/5
                                        @endif
                                    </strong>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="button" 
                        id="submitBtn"
                        onclick="showConfirmationModal()"
                        class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <div class="flex items-center justify-center gap-2">
                        <span class="iconify" data-icon="lucide:send"></span>
                        <span>Transfer Sekarang</span>
                    </div>
                </button>

                <!-- Saldo Warning -->
                <div id="insufficientWarning" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center gap-2 text-red-700">
                        <span class="iconify" data-icon="lucide:alert-circle"></span>
                        <div>
                            <span class="text-sm font-medium">Saldo tidak mencukupi!</span>
                            <p class="text-xs mt-1">Saldo Anda: Rp {{ number_format($user->saldo, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Daily Limit Warning -->
                <div id="dailyLimitWarning" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center gap-2 text-red-700">
                        <span class="iconify" data-icon="lucide:alert-circle"></span>
                        <span class="text-sm font-medium" id="dailyLimitMessage">Batas transfer harian telah tercapai!</span>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <!-- Footer Lengkap -->
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

    <!-- Konfirmasi Transfer Modal - UPDATED -->
    <div class="modal-overlay" id="confirmationModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="font-bold text-lg text-gray-900">Konfirmasi Transfer</h3>
                <button type="button" onclick="hideConfirmationModal()" class="text-gray-400 hover:text-gray-600">
                    <span class="iconify text-xl" data-icon="lucide:x"></span>
                </button>
            </div>
            
            <!-- MODAL BODY DIUBAH AGAR TIDAK SCROLL DAN TAMPILAN LEBIH SINGKAT -->
            <div class="modal-body p-4">
                <!-- Info Penerima (diperkecil) -->
                <div class="flex items-center gap-2 mb-4 p-2 bg-blue-50 rounded-lg">
                    <div class="w-8 h-8 rounded-full overflow-hidden">
                        <img src="{{ $receiver->profile_photo ? asset('storage/profile/' . $receiver->profile_photo) : asset('images/default_pp.jpg') }}" 
                             alt="{{ $receiver->name }}"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-sm text-gray-900 truncate">{{ $receiver->name }}</p>
                    </div>
                </div>

                <!-- Detail Transfer (sesuai permintaan) -->
                <div class="space-y-3 text-sm">
                    <!-- Baris 1: Nominal Transfer -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Nominal Transfer</span>
                        <span id="modalAmount" class="font-semibold text-gray-900">Rp 100</span>
                    </div>
                    
                    <!-- Baris 2: Biaya Admin -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Biaya Admin (0.5%)</span>
                        <span id="modalFee" class="font-semibold text-red-600">Rp 1</span>
                    </div>
                    
                    <!-- Baris 3: Saldo Anda -->
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Saldo Anda</span>
                        <span class="font-semibold text-green-600">Rp {{ number_format($user->saldo, 0, ',', '.') }}</span>
                    </div>
                    
                    <!-- Garis pemisah -->
                    <hr class="my-2 border-gray-300">
                    
                    <!-- Baris 4: Total Dipotong -->
                    <div class="flex justify-between items-center pt-1">
                        <span class="text-gray-900 font-bold">Total Dipotong</span>
                        <span id="modalTotal" class="font-bold text-lg text-red-600">Rp 101</span>
                    </div>
                </div>
                
                <!-- Catatan (jika ada) -->
                <div id="modalNoteContainer" class="mt-3 hidden">
                    <div class="flex items-start gap-2 p-2 bg-gray-50 rounded">
                        <span class="iconify text-gray-500 text-sm mt-0.5" data-icon="lucide:message-square"></span>
                        <p class="text-xs text-gray-600">
                            <span class="font-medium">Catatan:</span> <span id="modalNoteText"></span>
                        </p>
                    </div>
                </div>
                
                <!-- Peringatan (dipersingkat) -->
                <div class="mt-4 p-2 bg-yellow-50 rounded-lg">
                    <p class="text-xs text-yellow-800 text-center">
                        ⚠️ Transfer tidak dapat dibatalkan
                    </p>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" 
                        onclick="hideConfirmationModal()" 
                        class="flex-1 py-2 px-4 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition text-sm">
                    Batal
                </button>
                <button type="button" 
                        onclick="submitTransfer()" 
                        id="modalConfirmBtn"
                        class="flex-1 py-2 px-4 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-1 text-sm">
                    <span class="iconify" data-icon="lucide:send"></span>
                    Transfer
                </button>
            </div>
        </div>
    </div>

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

            // Initialize calculation
            calculateTotal();
            
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

        const userSaldo = {{ $user->saldo }};
        const userRole = "{{ $user->role }}";
        const transferLimitInfo = @json($transferLimitInfo);
        
        const amountInput = document.getElementById('amountInput');
        const noteInput = document.getElementById('noteInput');
        const submitBtn = document.getElementById('submitBtn');
        const insufficientWarning = document.getElementById('insufficientWarning');
        const dailyLimitWarning = document.getElementById('dailyLimitWarning');
        const dailyLimitMessage = document.getElementById('dailyLimitMessage');
        const quickAmountButtons = document.querySelectorAll('.quick-amount');
        const confirmationModal = document.getElementById('confirmationModal');
        let currentAmount = 100;

        function calculateTotal() {
            let amount = parseInt(amountInput.value) || 0;
            
            // Validate amount range
            if (amount < 100) amount = 100;
            if (amount > 1000000) amount = 1000000; // Max 1 miliar
            
            amountInput.value = amount;
            currentAmount = amount;

            // Calculate admin fee (0.5%)
            const adminFee = Math.ceil(amount * 0.5 / 100);
            const totalDeducted = amount + adminFee;

            // Update displays
            document.getElementById('amountDisplay').textContent = formatCurrency(amount);
            document.getElementById('feeDisplay').textContent = formatCurrency(adminFee);
            document.getElementById('totalDisplay').textContent = formatCurrency(totalDeducted);

            // Update quick amount buttons state
            updateQuickAmountButtons(amount);

            // Validate transfer
            validateTransfer(amount, totalDeducted);
        }

        function setAmount(amount) {
            amountInput.value = amount;
            amountInput.focus();
            calculateTotal();
        }

        function formatCurrency(amount) {
            return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function updateQuickAmountButtons(amount) {
            quickAmountButtons.forEach(button => {
                const buttonAmount = parseInt(button.dataset.amount);
                if (buttonAmount === amount) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
        }

        function validateTransfer(amount, totalDeducted) {
            let isValid = true;
            let errorMessage = '';

            // Check daily limit (only for non-admin users)
            if (userRole !== 'admin') {
                const dailyRemaining = transferLimitInfo.remaining;
                
                if (dailyRemaining <= 0) {
                    dailyLimitWarning.classList.remove('hidden');
                    isValid = false;
                    
                    // Set appropriate message based on user role
                    if (userRole === 'reseller') {
                        dailyLimitMessage.textContent = 'Batas transfer harian untuk reseller (10x) telah tercapai.';
                    } else {
                        dailyLimitMessage.textContent = 'Batas transfer harian untuk guest (5x) telah tercapai.';
                    }
                } else {
                    dailyLimitWarning.classList.add('hidden');
                }
            } else {
                // Admin has unlimited transfers
                dailyLimitWarning.classList.add('hidden');
            }

            // Check balance
            if (totalDeducted > userSaldo) {
                insufficientWarning.classList.remove('hidden');
                isValid = false;
                errorMessage = errorMessage ? errorMessage + '\nSaldo tidak mencukupi.' : 'Saldo tidak mencukupi.';
            } else {
                insufficientWarning.classList.add('hidden');
            }

            // Check minimum amount
            if (amount < 100) {
                isValid = false;
                errorMessage = errorMessage ? errorMessage + '\nMinimal transfer adalah Rp 100.' : 'Minimal transfer adalah Rp 100.';
            }

            // Update submit button
            submitBtn.disabled = !isValid;
            
            return isValid;
        }

        function showConfirmationModal() {
            // Get current values
            const amount = parseInt(amountInput.value) || 100;
            const adminFee = Math.ceil(amount * 0.5 / 100);
            const totalDeducted = amount + adminFee;
            const note = noteInput.value.trim();
            
            // Validate before showing modal
            if (!validateTransfer(amount, totalDeducted)) {
                return;
            }
            
            // Update modal content sesuai format baru
            document.getElementById('modalAmount').textContent = formatCurrency(amount);
            document.getElementById('modalFee').textContent = formatCurrency(adminFee);
            document.getElementById('modalTotal').textContent = formatCurrency(totalDeducted);
            
            // Tampilkan catatan hanya jika ada
            const noteContainer = document.getElementById('modalNoteContainer');
            const noteText = document.getElementById('modalNoteText');
            
            if (note) {
                noteContainer.classList.remove('hidden');
                noteText.textContent = note.length > 50 ? note.substring(0, 50) + '...' : note;
            } else {
                noteContainer.classList.add('hidden');
            }
            
            // Show modal
            confirmationModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideConfirmationModal() {
            confirmationModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        function submitTransfer() {
            // Disable confirm button to prevent double click
            const confirmBtn = document.getElementById('modalConfirmBtn');
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = '<span class="iconify animate-spin" data-icon="lucide:loader-2"></span><span>Memproses...</span>';
            
            // Submit the form
            document.getElementById('transferForm').submit();
        }

        // Fungsi untuk kembali ke halaman sebelumnya
        function goBack() {
            if (document.referrer && document.referrer !== window.location.href) {
                window.history.back();
            } else {
                // Fallback ke halaman transfer atau dashboard
                window.location.href = '/transfer'; // Ganti dengan URL halaman transfer Anda
            }
        }

        // Keyboard shortcut untuk tombol back (Escape)
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !amountInput.matches(':focus')) {
                if (confirmationModal.classList.contains('active')) {
                    hideConfirmationModal();
                } else {
                    goBack();
                }
            }
        });

        // Close modal when clicking outside
        confirmationModal.addEventListener('click', function(e) {
            if (e.target === confirmationModal) {
                hideConfirmationModal();
            }
        });

        // Input validation with debounce
        let inputTimeout;
        amountInput.addEventListener('input', function(e) {
            clearTimeout(inputTimeout);
            
            inputTimeout = setTimeout(() => {
                let value = e.target.value.replace(/[^0-9]/g, '');
                if (value) {
                    value = parseInt(value);
                    e.target.value = value;
                } else {
                    e.target.value = 100;
                }
                calculateTotal();
            }, 300);
        });

        // Prevent form submission on Enter in amount input
        amountInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                showConfirmationModal();
            }
        });

        // Form submission validation
        document.getElementById('transferForm').addEventListener('submit', function(e) {
            // Form akan di-submit melalui submitTransfer() function
            return true;
        });
    </script>
</body>
</html>