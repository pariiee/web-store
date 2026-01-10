<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi | PARI ID</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Outfit', sans-serif;
            background: #F6F8FA;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        
        .bottom-nav {
            background: #ffffff;
            box-shadow: 0 14px 40px rgba(0,0,0,0.12);
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
        }
        .nav-item.active { transform: translateY(-6px); }
        .nav-item.active .nav-icon {
            background: #18181b;
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(0,0,0,0.18);
        }
        .nav-item:active .nav-icon { transform: scale(.96); }
    </style>
</head>

<body class="min-h-screen flex flex-col text-zinc-900">

    <header class="md:hidden px-5 pt-6 pb-2 bg-white sticky top-0 z-40 border-b border-zinc-50 shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-[10px] text-zinc-400 font-medium uppercase tracking-wide">Informasi</p>
                <h2 class="font-bold text-lg text-zinc-900 truncate max-w-[200px]">
                    PARI ID X CYAA STORE
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
                <a href="/information" class="text-sm font-medium text-zinc-900">Info</a>
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
        
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-l-4 border-blue-500 rounded-xl p-5">
            <div class="flex items-start">
                <div class="flex-shrink-0 mr-3 mt-0.5">
                    <span class="iconify text-blue-600 text-lg" data-icon="lucide:info"></span>
                </div>
                <div>
                    <h3 class="font-bold text-blue-800 text-base mb-1">Informasi Penting</h3>
                    <p class="text-sm text-blue-700 leading-relaxed">
                        Semua transaksi masih diproses manual oleh admin.<br>
                        Proses cepat tersedia pada pukul <span class="font-semibold">09.00 - 22.00 WIB</span>.<br>
                        Silakan hubungi admin jika ada pertanyaan atau kebingungan.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 space-y-5">
            <div class="flex items-center mb-2">
                <div class="h-10 w-1 bg-gradient-to-b from-blue-500 to-purple-500 rounded-full mr-3"></div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Selamat Datang di PARI ID x CYAA STORE
                </h1>
            </div>

            <div class="space-y-4">
                <p class="text-gray-700 leading-relaxed">
                    Selamat Datang di <span class="font-semibold text-blue-700">PARI ID X CYAA STORE </span> yang berkolaborasi dengan <span class="font-semibold text-purple-700">CYAA Store</span>, platform digital yang hadir untuk memenuhi semua kebutuhan digital Anda dengan harga kompetitif dan proses yang cepat.
                </p>

                <p class="text-gray-700 leading-relaxed">
                    Kami menyediakan berbagai layanan digital termasuk top up pulsa semua operator, kuota internet, pengisian saldo game, dan berbagai kebutuhan digital lainnya. Semua transaksi diproses dengan aman, mudah, dan real-time.
                </p>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <p class="text-gray-700 leading-relaxed">
                        Dengan harga yang transparan tanpa biaya tersembunyi, sistem yang stabil, dan dukungan pelanggan yang responsif, PARI ID adalah solusi terpercaya untuk kebutuhan digital Anda.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center mb-5">
                <span class="iconify text-blue-600 text-lg mr-3" data-icon="lucide:file-text"></span>
                <h2 class="text-xl font-semibold text-gray-900">Syarat & Ketentuan Pembelian</h2>
            </div>

            <div class="space-y-4">
                <ol class="list-decimal list-inside text-gray-700 space-y-2.5 pl-1">
                    <li class="pl-2"><span class="font-medium">Isi saldo</span> terlebih dahulu di akun Anda</li>
                    <li class="pl-2"><span class="font-medium">Pilih produk</span> yang ingin dibeli</li>
                    <li class="pl-2"><span class="font-medium">Pilih item</span> atau paket yang sesuai</li>
                    <li class="pl-2"><span class="font-medium">Lakukan pembayaran</span> sesuai instruksi</li>
                </ol>

                <div class="mt-6 p-4 bg-amber-50 border-l-4 border-amber-400 rounded-r-lg">
                    <div class="flex items-start">
                        <span class="iconify text-amber-500 mt-0.5 mr-3" data-icon="lucide:alert-triangle"></span>
                        <div>
                            <p class="font-medium text-amber-800 mb-1">Penting untuk Diperhatikan</p>
                            <p class="text-sm text-amber-700 mb-2">
                                Wajib mengirimkan bukti transaksi sukses atau login melalui 
                                <a href="/bukti-garansi" class="font-semibold text-blue-600 hover:underline">tautan ini</a> 
                                maksimal dalam <span class="font-semibold">1x24 jam</span>. 
                                Jika tidak, maka garansi akan hangus.
                            </p>
                            <p class="text-sm text-amber-700">
                                Untuk klaim garansi, silakan 
                                <a href="/bukti-garansi" class="font-semibold text-blue-600 hover:underline">klik di sini</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Reseller - PROFESIONAL -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center mb-6">
                <span class="iconify text-gray-700 text-lg mr-3" data-icon="lucide:badge-dollar-sign"></span>
                <h2 class="text-xl font-semibold text-gray-900">Jadi Reseller PARI ID X CYAA STORE</h2>
            </div>

            <div class="space-y-5">
                <p class="text-gray-700 leading-relaxed">
                    Dengan menjadi reseller PARI ID X CYAA STORE, Anda mendapatkan banyak keuntungan:
                </p>

                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                            <span class="iconify text-gray-600" data-icon="lucide:tag"></span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Harga Lebih Murah</h4>
                            <p class="text-sm text-gray-600 mt-1">Dapatkan harga khusus reseller yang lebih murah dari harga normal.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                            <span class="iconify text-gray-600" data-icon="lucide:zap"></span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Prioritas Pelayanan</h4>
                            <p class="text-sm text-gray-600 mt-1">Dilayani oleh tim support khusus dengan respon lebih cepat.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                            <span class="iconify text-gray-600" data-icon="lucide:trending-up"></span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Peluang Bisnis</h4>
                            <p class="text-sm text-gray-600 mt-1">Jual kembali produk dengan margin keuntungan yang menarik.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                            <span class="iconify text-gray-600" data-icon="lucide:star"></span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Produk Eksklusif</h4>
                            <p class="text-sm text-gray-600 mt-1">Akses ke produk khusus yang hanya tersedia untuk reseller.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                            <span class="iconify text-gray-600" data-icon="lucide:shield"></span>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-900">Sistem Mudah Digunakan</h4>
                            <p class="text-sm text-gray-600 mt-1">Platform yang user-friendly untuk mendukung bisnis Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 mt-4">
                    <p class="text-gray-700">
                        <span class="font-medium">Cocok untuk:</span> Pemakaian pribadi yang lebih hemat maupun untuk membangun bisnis yang menguntungkan.
                    </p>
                </div>
            </div>
        </div>

        <!-- Hubungi Kami - PROFESIONAL -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center mb-6">
                <span class="iconify text-gray-700 text-lg mr-3" data-icon="lucide:phone-call"></span>
                <h2 class="text-xl font-semibold text-gray-900">Hubungi Kami</h2>
            </div>

            <div class="space-y-8">
                <!-- Group Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <span class="iconify text-gray-500 mr-2" data-icon="lucide:users"></span>
                        Group
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <a href="https://www.whatsapp.com/channel/0029Vb6UAPC5K3zS9b4XQc3u"
                           target="_blank"
                           class="group flex items-center justify-between px-4 py-3 rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-3 group-hover:bg-green-200 transition">
                                    <i class="fab fa-whatsapp text-green-600 text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-900">Channel WhatsApp</span>
                            </div>
                            <span class="iconify text-gray-400 text-lg group-hover:text-green-600" data-icon="lucide:external-link"></span>
                        </a>

                        <a href="https://t.me/addlist/hSDrFkXg6uQ1YWM1"
                           target="_blank"
                           class="group flex items-center justify-between px-4 py-3 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3 group-hover:bg-blue-200 transition">
                                    <i class="fab fa-telegram text-blue-600 text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-900">Group Telegram</span>
                            </div>
                            <span class="iconify text-gray-400 text-lg group-hover:text-blue-600" data-icon="lucide:external-link"></span>
                        </a>
                    </div>
                </div>

                <!-- Contact Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <span class="iconify text-gray-500 mr-2" data-icon="lucide:user"></span>
                        Contact
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <a href="https://wa.me/6283129320041"
                           target="_blank"
                           class="group flex items-center justify-between px-4 py-3 rounded-lg border border-gray-200 hover:border-green-500 hover:bg-green-50 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-3 group-hover:bg-green-200 transition">
                                    <i class="fab fa-whatsapp text-green-600 text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-900">WhatsApp Owner</span>
                            </div>
                            <span class="iconify text-gray-400 text-lg group-hover:text-green-600" data-icon="lucide:external-link"></span>
                        </a>

                        <a href="https://t.me/heyiniaya"
                           target="_blank"
                           class="group flex items-center justify-between px-4 py-3 rounded-lg border border-gray-200 hover:border-blue-500 hover:bg-blue-50 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3 group-hover:bg-blue-200 transition">
                                    <i class="fab fa-telegram text-blue-600 text-lg"></i>
                                </div>
                                <span class="font-medium text-gray-900">Telegram Owner</span>
                            </div>
                            <span class="iconify text-gray-400 text-lg group-hover:text-blue-600" data-icon="lucide:external-link"></span>
                        </a>
                    </div>
                </div>

                <!-- Admin Team Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <span class="iconify text-gray-500 mr-2" data-icon="lucide:shield"></span>
                        Para Etmin
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                        <a href="https://t.me/reyyszt"
                           target="_blank"
                           class="group flex flex-col items-center p-4 rounded-lg border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mb-2 group-hover:bg-gray-200 transition">
                                <span class="iconify text-gray-600 text-lg" data-icon="lucide:user"></span>
                            </div>
                            <span class="font-medium text-gray-900 text-sm">Rey</span>
                            <span class="text-xs text-gray-500 mt-1">Admin</span>
                        </a>

                        <a href="https://t.me/pardevv"
                           target="_blank"
                           class="group flex flex-col items-center p-4 rounded-lg border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mb-2 group-hover:bg-gray-200 transition">
                                <span class="iconify text-gray-600 text-lg" data-icon="lucide:user"></span>
                            </div>
                            <span class="font-medium text-gray-900 text-sm">Pari</span>
                            <span class="text-xs text-gray-500 mt-1">Admin</span>
                        </a>

                        <a href="https://t.me/cyieraaya"
                           target="_blank"
                           class="group flex flex-col items-center p-4 rounded-lg border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mb-2 group-hover:bg-gray-200 transition">
                                <span class="iconify text-gray-600 text-lg" data-icon="lucide:user"></span>
                            </div>
                            <span class="font-medium text-gray-900 text-sm">Nara</span>
                            <span class="text-xs text-gray-500 mt-1">Admin</span>
                        </a>

                        <a href="https://t.me/tanzmanuel"
                           target="_blank"
                           class="group flex flex-col items-center p-4 rounded-lg border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mb-2 group-hover:bg-gray-200 transition">
                                <span class="iconify text-gray-600 text-lg" data-icon="lucide:user"></span>
                            </div>
                            <span class="font-medium text-gray-900 text-sm">Tans</span>
                            <span class="text-xs text-gray-500 mt-1">Admin</span>
                        </a>

                        <a href="https://t.me/vkaynia"
                           target="_blank"
                           class="group flex flex-col items-center p-4 rounded-lg border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition-all duration-300">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mb-2 group-hover:bg-gray-200 transition">
                                <span class="iconify text-gray-600 text-lg" data-icon="lucide:user"></span>
                            </div>
                            <span class="font-medium text-gray-900 text-sm">Vika</span>
                            <span class="text-xs text-gray-500 mt-1">Admin</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-5 border-t border-gray-200">
                <p class="text-sm text-gray-500 text-center">
                    <i class="fas fa-clock mr-1"></i>
                    Jam operasional: 09.00 - 22.00 WIB | Respon cepat dalam 15 menit
                </p>
            </div>
        </div>
    </main>

    <footer id="footer" class="bg-zinc-900 text-zinc-400 py-12 border-t border-zinc-800 mt-16">
        <div class="container mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
                <div class="md:col-span-3">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="h-10 w-auto rounded-xl hover:scale-105 transition">
                        <span class="font-bold text-xl tracking-tight text-white">PARI ID X CYAA STORE </span>
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
                        <a href="https://wa.me/+628?text=Halo+Admin+PARI+ID%2C+saya+butuh+bantuan." target="_blank"
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