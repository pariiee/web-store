<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $product->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        ::-webkit-scrollbar{ width:8px; }
        ::-webkit-scrollbar-track{ background:#f1f1f1; }
        ::-webkit-scrollbar-thumb{ background:#888; border-radius:4px; }
        ::-webkit-scrollbar-thumb:hover{ background:#555; }

        @keyframes fadeIn{
            from{ opacity:0; transform:translateY(10px); }
            to{ opacity:1; transform:translateY(0); }
        }
        .animate-fadeIn{ animation:fadeIn .3s ease-out; }

        .item-card.checked,
        .item-card-mobile.checked{
            box-shadow: 0 0 0 2px #111827, 0 10px 24px rgba(0,0,0,.08);
            transform: translateY(-2px);
        }

        .focus-ring:focus{
            box-shadow: 0 0 0 3px rgba(17,24,39,.12);
            outline:none;
        }

        .disabled-card{ filter: grayscale(100%); opacity: .5; }

        .line-clamp-2{
            overflow:hidden;
            display:-webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .preserve-linebreaks{
            white-space: normal;
            line-height: 1.5;
        }

        .card-soft{
            box-shadow: 0 1px 0 rgba(0,0,0,.02), 0 10px 30px rgba(15,23,42,.06);
        }
        .card-soft:hover{
            box-shadow: 0 1px 0 rgba(0,0,0,.02), 0 14px 40px rgba(15,23,42,.09);
        }

        .qty-stepper{
            display:flex;
            align-items:center;
            border:1px solid #D1D5DB;
            border-radius: 14px;
            overflow:hidden;
            background:#fff;
            height:42px;
        }
        .qty-btn{
            width:48px;
            height:42px;
            display:flex;
            align-items:center;
            justify-content:center;
            background:#fff;
            transition: background .15s ease;
        }
        .qty-btn:hover{ background:#F9FAFB; }
        .qty-btn:active{ background:#F3F4F6; }
        .qty-btn:disabled{ opacity:.5; cursor:not-allowed; background:#fff; }
        .qty-divider{
            width:1px;
            height:100%;
            background:#D1D5DB;
        }
        .qty-input{
            width:60px;
            height:42px;
            text-align:center;
            font-weight:700;
            font-size:14px;
            border:0;
            outline:none;
        }
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button{
            -webkit-appearance:none; margin:0;
        }
        input[type=number]{ -moz-appearance:textfield; }
        
        .submit-disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background-color: #9CA3AF !important;
        }
        .submit-disabled:hover {
            background-color: #9CA3AF !important;
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
    </style>
</head>

<body class="min-h-screen flex flex-col text-zinc-900">

    <header class="md:hidden px-5 pt-6 pb-2 mobile-header sticky top-0 z-40 shadow-sm">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-[10px] text-zinc-500 font-medium uppercase tracking-wide">Produk Detail</p>
                <h2 class="font-bold text-lg text-zinc-900 truncate max-w-[200px]">
                    {{ $product->name }}
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

    <div class="max-w-7xl mx-auto px-4 md:px-6 pt-3 md:pt-5 pb-10 flex-grow">

        <div class="block md:hidden space-y-7">
            <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-b from-gray-50 to-white">
                    <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-gray-900"></span>
                        Informasi Produk
                    </h3>
                </div>

                <div class="p-5 space-y-5">
                    <div class="space-y-2">
                        <div>
                            <h3 class="font-bold text-gray-900 text-xl leading-tight">
                                {{ $product->name }}
                            </h3>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium text-gray-700">
                                    <i class="fas fa-tag text-xs"></i>
                                    {{ $product->category->name ?? 'Tidak Berkategori' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <div class="flex-shrink-0">
                            <div class="w-24 h-24 rounded-2xl overflow-hidden border border-gray-200 bg-white flex items-center justify-center">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/'.$product->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50">
                                        <i class="fas fa-image text-gray-400 text-2xl mb-1"></i>
                                        <span class="text-xs text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="h-px bg-gray-200 mb-3"></div>
                            <ul class="space-y-3">
                                <li class="flex items-center gap-3">
                                    <span class="w-5 flex justify-center text-gray-700"><i class="fas fa-shield-alt text-[15px]"></i></span>
                                    <span class="text-sm font-semibold text-gray-900 leading-none">Jaminan Layanan</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="w-5 flex justify-center text-gray-700"><i class="fas fa-headset text-[15px]"></i></span>
                                    <span class="text-sm font-semibold text-gray-900 leading-none">Layanan Pelanggan</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="w-5 flex justify-center text-gray-700"><i class="fas fa-lock text-[15px]"></i></span>
                                    <span class="text-sm font-semibold text-gray-900 leading-none">Pembayaran Aman</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="w-5 flex justify-center text-gray-700"><i class="fas fa-bolt text-[15px]"></i></span>
                                    <span class="text-sm font-semibold text-gray-900 leading-none">Pengiriman Instan</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-1">
                        <h4 class="font-semibold text-sm text-gray-900 mb-3 flex items-center gap-2">
                            <i class="fas fa-align-left"></i> Deskripsi Produk
                        </h4>
                        <div class="text-sm text-gray-600 preserve-linebreaks bg-gray-50 p-4 rounded-xl border border-gray-100">
                            {{ trim($product->description ?? 'Tidak ada deskripsi tersedia.') }}
                        </div>
                    </div>

                    <div class="pt-1">
                        <div class="border border-gray-200 rounded-xl overflow-hidden">
                            <details class="group">
                                <summary class="flex items-center justify-between p-3 cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-shopping-cart text-gray-700"></i>
                                        <h4 class="font-semibold text-sm text-gray-900">Cara Pembelian</h4>
                                    </div>
                                    <i class="fas fa-chevron-down text-gray-500 text-xs transition-transform group-open:rotate-180"></i>
                                </summary>
                                <div class="p-3 border-t border-gray-200 bg-white">
                                    <ol class="space-y-3">
                                        <li class="flex items-start gap-3">
                                            <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>1</span></div>
                                            <div><p class="text-sm font-medium text-gray-900">Isi data yang diperlukan</p><p class="text-xs text-gray-500 mt-0.5">Masukkan data dengan benar</p></div>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>2</span></div>
                                            <div><p class="text-sm font-medium text-gray-900">Pilih item yang diinginkan</p><p class="text-xs text-gray-500 mt-0.5">Pilih produk dari daftar yang tersedia</p></div>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>3</span></div>
                                            <div><p class="text-sm font-medium text-gray-900">Atur jumlah pembelian</p><p class="text-xs text-gray-500 mt-0.5">Tentukan jumlah item yang dibeli</p></div>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>4</span></div>
                                            <div><p class="text-sm font-medium text-gray-900">Klik "Beli Sekarang"</p><p class="text-xs text-gray-500 mt-0.5">Konfirmasi pembelian Anda</p></div>
                                        </li>
                                        <li class="flex items-start gap-3">
                                            <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>5</span></div>
                                            <div><p class="text-sm font-medium text-gray-900">Produk akan dikirim</p><p class="text-xs text-gray-500 mt-0.5">Pengiriman instan setelah pembayaran</p></div>
                                        </li>
                                    </ol>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('product.checkout', $product->slug) }}" method="POST" id="checkoutFormMobile" class="space-y-7">
                @csrf
                <input type="hidden" id="quantityHiddenMobile" name="quantity" value="1">

                @if(is_array($product->required_fields) && count($product->required_fields))
                <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-b from-gray-50 to-white">
                        <div class="w-8 h-8 rounded-full bg-black text-white text-sm flex items-center justify-center font-medium">
                            <i class="fas fa-pen text-xs"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Masukkan Data</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Isi data yang diperlukan untuk transaksi</p>
                        </div>
                    </div>
                    <div class="p-5 space-y-4">
                        @foreach($product->required_fields as $field)
                            <div class="space-y-1">
                                <label class="text-sm font-medium text-gray-800">
                                    {{ ucfirst(str_replace('_',' ',$field)) }} <span class="text-red-500">*</span>
                                </label>
                                <input name="{{ $field }}" required
                                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gray-800 focus:border-transparent focus-ring transition"
                                       placeholder="Masukkan {{ ucfirst(str_replace('_',' ',$field)) }}">
                            </div>
                        @endforeach
                        <div class="flex items-center gap-2 text-xs text-gray-500 pt-2">
                            <i class="fas fa-info-circle"></i>
                            <p>Pastikan data yang Anda masukkan sudah benar dan sesuai.</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-b from-gray-50 to-white">
                        <div class="w-8 h-8 rounded-full bg-black text-white text-sm flex items-center justify-center font-medium">
                            <i class="fas fa-box text-xs"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Pilih Item / Nominal</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Pilih produk yang ingin Anda beli</p>
                        </div>
                    </div>

                    <div class="p-5">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($product->items as $item)
                            @php
                                $role = auth()->user()->role;
                                $price = ($role === 'admin' || $role === 'reseller')
                                    ? $item->price_reseller
                                    : $item->price_guest;

                                $stockCount = $item->stocks->count();
                                $isOut = ($stockCount <= 0);
                            @endphp

                            <div class="relative">
                                <input type="radio" name="item_id"
                                       id="item_mobile_{{ $item->id }}"
                                       class="itemRadioMobile absolute opacity-0"
                                       value="{{ $item->id }}"
                                       data-price="{{ $price }}"
                                       {{ $isOut ? 'disabled' : '' }}>

                                <label for="item_mobile_{{ $item->id }}"
                                       class="item-card-mobile block aspect-square rounded-xl border-2 border-gray-200 bg-white
                                              flex flex-col items-center justify-center gap-2
                                              text-center p-3 cursor-pointer transition-all duration-200
                                              {{ $isOut ? 'disabled-card cursor-not-allowed' : 'hover:border-gray-400 hover:shadow-md' }}">

                                    @if($item->thumbnail)
                                        <div class="w-10 h-10 flex items-center justify-center overflow-hidden">
                                            <img src="{{ asset('storage/'.$item->thumbnail) }}" class="w-full h-full object-contain" alt="{{ $item->name }}">
                                        </div>
                                    @else
                                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100">
                                            <i class="fas fa-cube text-gray-500"></i>
                                        </div>
                                    @endif

                                    <div class="flex-1 flex flex-col justify-center">
                                        <p class="text-xs font-semibold text-gray-900 leading-tight line-clamp-2">{{ $item->name }}</p>
                                        <p class="text-sm font-bold text-gray-900 mt-1">Rp {{ number_format($price,0,',','.') }}</p>
                                    </div>

                                    <div class="flex items-center justify-between w-full text-xs">
                                        <div class="flex items-center gap-1 {{ $stockCount > 0 ? 'text-green-600' : 'text-red-500' }}">
                                            <i class="fas {{ $stockCount > 0 ? 'fa-check-circle' : 'fa-times-circle' }} text-xs"></i>
                                            <span>{{ $stockCount > 0 ? 'Tersedia' : 'Habis' }}</span>
                                        </div>
                                        <span class="text-gray-500 font-medium">{{ $stockCount }}</span>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>

            <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-b from-gray-50 to-white">
                    <h3 class="font-bold text-gray-900">Ringkasan Pembayaran</h3>
                </div>

                <div class="p-5 space-y-5">
                    <div id="selectedItemInfoMobile" class="hidden">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-box text-gray-700"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate" id="selectedItemNameMobile">-</p>
                                <p class="text-xs text-gray-500 mt-0.5" id="selectedItemPriceMobile">Rp 0</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-layer-group text-gray-700"></i>
                            <span class="text-sm font-medium text-gray-900">Jumlah Pembelian</span>
                        </div>

                        <div class="qty-stepper">
                            <button type="button" id="minQtyMobile" class="qty-btn" aria-label="Kurangi">
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <div class="qty-divider"></div>
                            <input type="number" id="quantityInputMobile" value="1" min="1" class="qty-input">
                            <div class="qty-divider"></div>
                            <button type="button" id="plusQtyMobile" class="qty-btn" aria-label="Tambah">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-wallet text-gray-700"></i>
                                <span class="text-sm font-medium text-gray-900">Saldo Anda</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format(auth()->user()->saldo,0,',','.') }}</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-900">Total Pembayaran</span>
                            <span id="totalHargaMobile" class="text-2xl font-bold text-gray-900">Rp 0</span>
                        </div>
                    </div>

                    <button type="button" id="submitBtnMobile"
                            class="w-full bg-gray-400 text-white py-3.5 rounded-xl font-bold text-sm transition-all duration-200 flex items-center justify-center gap-2 submit-disabled">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Pilih Item Terlebih Dahulu</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden lg:grid lg:grid-cols-3 gap-8 items-start animate-fadeIn">

            <div class="lg:col-span-2 flex flex-col gap-8">
                <form action="{{ route('product.checkout', $product->slug) }}" method="POST" id="checkoutForm" class="flex flex-col gap-8">
                    @csrf

                    @if(is_array($product->required_fields) && count($product->required_fields))
                    <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-b from-gray-50 to-white">
                            <div class="w-8 h-8 rounded-full bg-black text-white text-sm flex items-center justify-center font-medium">
                                <i class="fas fa-pen text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Masukkan Data</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Isi data yang diperlukan untuk transaksi</p>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            @foreach($product->required_fields as $field)
                                <div class="space-y-1">
                                    <label class="text-sm font-medium text-gray-800">
                                        {{ ucfirst(str_replace('_',' ',$field)) }} <span class="text-red-500">*</span>
                                    </label>
                                    <input name="{{ $field }}" required
                                           class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gray-800 focus:border-transparent focus-ring transition"
                                           placeholder="Masukkan {{ ucfirst(str_replace('_',' ',$field)) }}">
                                </div>
                            @endforeach
                            <div class="flex items-center gap-2 text-xs text-gray-500 pt-2">
                                <i class="fas fa-info-circle"></i>
                                <p>Pastikan data yang Anda masukkan sudah benar dan sesuai.</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-b from-gray-50 to-white">
                            <div class="w-8 h-8 rounded-full bg-black text-white text-sm flex items-center justify-center font-medium">
                                <i class="fas fa-box text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">Pilih Item / Nominal</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Pilih produk yang ingin Anda beli</p>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-3.5 auto-rows-fr">
                                @foreach($product->items as $item)
                                @php
                                    $role = auth()->user()->role;
                                    $price = ($role === 'admin' || $role === 'reseller')
                                        ? $item->price_reseller
                                        : $item->price_guest;

                                    $stockCount = $item->stocks->count();
                                    $isOut = ($stockCount <= 0);
                                @endphp

                                <div class="relative">
                                    <input type="radio" name="item_id"
                                           id="item_{{ $item->id }}"
                                           class="itemRadio absolute opacity-0"
                                           value="{{ $item->id }}"
                                           data-price="{{ $price }}"
                                           {{ $isOut ? 'disabled' : '' }}>

                                    <label for="item_{{ $item->id }}"
                                           class="item-card block aspect-square h-full rounded-xl border-2 border-gray-200 bg-white
                                                  flex flex-col items-center justify-center gap-2
                                                  text-center p-3 cursor-pointer transition-all duration-200
                                                  {{ $isOut ? 'disabled-card cursor-not-allowed' : 'hover:border-gray-400 hover:shadow-md' }}">

                                        @if($item->thumbnail)
                                            <div class="w-10 h-10 flex items-center justify-center overflow-hidden">
                                                <img src="{{ asset('storage/'.$item->thumbnail) }}" class="w-full h-full object-contain" alt="{{ $item->name }}">
                                            </div>
                                        @else
                                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100">
                                                <i class="fas fa-cube text-gray-500"></i>
                                            </div>
                                        @endif

                                        <div class="flex-1 flex flex-col justify-center">
                                            <p class="text-xs font-semibold text-gray-900 leading-tight line-clamp-2">{{ $item->name }}</p>
                                            <p class="text-sm font-bold text-gray-900 mt-1">Rp {{ number_format($price,0,',','.') }}</p>
                                        </div>

                                        <div class="flex items-center justify-between w-full text-xs">
                                            <div class="flex items-center gap-1 {{ $stockCount > 0 ? 'text-green-600' : 'text-red-500' }}">
                                                <i class="fas {{ $stockCount > 0 ? 'fa-check-circle' : 'fa-times-circle' }} text-xs"></i>
                                                <span>{{ $stockCount > 0 ? 'Tersedia' : 'Habis' }}</span>
                                            </div>
                                            <span class="text-gray-500 font-medium">{{ $stockCount }}</span>
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="quantityHidden" name="quantity" value="1">
                </form>
            </div>

            <div class="flex flex-col gap-8">
                <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-b from-gray-50 to-white">
                        <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-gray-900"></span>
                            Informasi Produk
                        </h3>
                    </div>

                    <div class="p-6 space-y-5">
                        <div class="space-y-2">
                            <h3 class="font-bold text-gray-900 text-xl leading-tight">{{ $product->name }}</h3>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full bg-gray-100 text-sm font-medium text-gray-700">
                                    <i class="fas fa-tag text-xs"></i>
                                    {{ $product->category->name ?? 'Tidak Berkategori' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-5 items-start">
                            <div class="flex-shrink-0">
                                <div class="w-28 h-28 rounded-2xl overflow-hidden border border-gray-200 bg-white flex items-center justify-center">
                                    @if($product->thumbnail)
                                        <img src="{{ asset('storage/'.$product->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50">
                                            <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                                            <span class="text-xs text-gray-500">No Image</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="h-px bg-gray-200 mb-3"></div>
                                <ul class="space-y-3">
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 flex justify-center text-gray-700"><i class="fas fa-shield-alt text-[16px]"></i></span>
                                        <span class="text-sm font-semibold text-gray-900 leading-none">Jaminan Layanan</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 flex justify-center text-gray-700"><i class="fas fa-headset text-[16px]"></i></span>
                                        <span class="text-sm font-semibold text-gray-900 leading-none">Layanan Pelanggan</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 flex justify-center text-gray-700"><i class="fas fa-lock text-[16px]"></i></span>
                                        <span class="text-sm font-semibold text-gray-900 leading-none">Pembayaran Aman</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 flex justify-center text-gray-700"><i class="fas fa-bolt text-[16px]"></i></span>
                                        <span class="text-sm font-semibold text-gray-900 leading-none">Pengiriman Instan</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="pt-1">
                            <h4 class="font-semibold text-sm text-gray-900 mb-3 flex items-center gap-2">
                                <i class="fas fa-align-left"></i> Deskripsi Produk
                            </h4>
                            <div class="text-sm text-gray-600 preserve-linebreaks bg-gray-50 p-4 rounded-xl border border-gray-100">
                                {{ trim($product->description ?? 'Tidak ada deskripsi tersedia.') }}
                            </div>
                        </div>

                        <div class="pt-1">
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <details class="group">
                                    <summary class="flex items-center justify-between p-3 cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-shopping-cart text-gray-700"></i>
                                            <h4 class="font-semibold text-sm text-gray-900">Cara Pembelian</h4>
                                    </summary>
                                    <div class="p-3 border-t border-gray-200 bg-white">
                                        <ol class="space-y-3">
                                            <li class="flex items-start gap-3">
                                                <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>1</span></div>
                                                <div><p class="text-sm font-medium text-gray-900">Isi data yang diperlukan</p><p class="text-xs text-gray-500 mt-0.5">Masukkan data dengan benar</p></div>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>2</span></div>
                                                <div><p class="text-sm font-medium text-gray-900">Pilih item yang diinginkan</p><p class="text-xs text-gray-500 mt-0.5">Pilih produk dari daftar yang tersedia</p></div>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>3</span></div>
                                                <div><p class="text-sm font-medium text-gray-900">Atur jumlah pembelian</p><p class="text-xs text-gray-500 mt-0.5">Tentukan jumlah item yang dibeli</p></div>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>4</span></div>
                                                <div><p class="text-sm font-medium text-gray-900">Klik "Beli Sekarang"</p><p class="text-xs text-gray-500 mt-0.5">Konfirmasi pembelian Anda</p></div>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>5</span></div>
                                                <div><p class="text-sm font-medium text-gray-900">Produk akan dikirim</p><p class="text-xs text-gray-500 mt-0.5">Pengiriman instan setelah pembayaran</p></div>
                                            </li>
                                        </ol>
                                    </div>
                                </details>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden sticky top-6">
                    <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-b from-gray-50 to-white">
                        <h3 class="font-bold text-gray-900">Ringkasan Pembayaran</h3>
                    </div>

                    <div class="p-6 space-y-5">
                        <div id="selectedItemInfo" class="hidden">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-box text-gray-700"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate" id="selectedItemName">-</p>
                                    <p class="text-xs text-gray-500 mt-0.5" id="selectedItemPrice">Rp 0</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-layer-group text-gray-700"></i>
                                <span class="text-sm font-medium text-gray-900">Jumlah Pembelian</span>
                            </div>

                            <div class="qty-stepper">
                                <button type="button" id="minQty" class="qty-btn" aria-label="Kurangi">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <div class="qty-divider"></div>
                                <input type="number" id="quantityInput" value="1" min="1" class="qty-input">
                                <div class="qty-divider"></div>
                                <button type="button" id="plusQty" class="qty-btn" aria-label="Tambah">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-wallet text-gray-700"></i>
                                    <span class="text-sm font-medium text-gray-900">Saldo Anda</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900">Rp {{ number_format(auth()->user()->saldo,0,',','.') }}</span>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-900">Total Pembayaran</span>
                                <span id="totalHarga" class="text-2xl font-bold text-gray-900">Rp 0</span>
                            </div>
                        </div>

                        <button type="button" id="submitBtn"
                                class="w-full bg-gray-400 text-white py-3.5 rounded-xl font-bold text-sm transition-all duration-200 flex items-center justify-center gap-2 submit-disabled">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Pilih Item Terlebih Dahulu</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

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
                            <a href="/information" class="hover:text-white transition flex items-center gap-3 p-3 bg-zinc-900/50 rounded-xl hover:bg-zinc-800">
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
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantityInput');
    const quantityHidden = document.getElementById('quantityHidden');
    const totalHargaEl = document.getElementById('totalHarga');
    const submitBtn = document.getElementById('submitBtn');
    const plusBtn = document.getElementById('plusQty');
    const minBtn = document.getElementById('minQty');
    const selectedItemInfo = document.getElementById('selectedItemInfo');
    const selectedItemName = document.getElementById('selectedItemName');
    const selectedItemPrice = document.getElementById('selectedItemPrice');
    const checkoutForm = document.getElementById('checkoutForm');

    let selectedPrice = 0;
    let selectedItemId = null;
    let selectedItemStock = 0;
    let selectedItemData = null;

    function updateSubmitButton() {
        const isItemSelected = selectedItemId !== null && selectedPrice > 0;
        const isFormValid = validateRequiredFields();
        
        if (isItemSelected && isFormValid) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('submit-disabled', 'bg-gray-400');
            submitBtn.classList.add('bg-black', 'hover:bg-gray-800');
            submitBtn.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Beli Sekarang</span>';
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('submit-disabled', 'bg-gray-400');
            submitBtn.classList.remove('bg-black', 'hover:bg-gray-800');
            if (!isItemSelected) {
                submitBtn.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Pilih Item Terlebih Dahulu</span>';
            } else {
                submitBtn.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Isi Data Terlebih Dahulu</span>';
            }
        }
    }

    function validateRequiredFields() {
        @if(is_array($product->required_fields) && count($product->required_fields))
            const requiredFields = document.querySelectorAll('#checkoutForm input[required]');
            for (const field of requiredFields) {
                if (!field.value.trim()) {
                    return false;
                }
            }
        @endif
        return true;
    }

    @if(is_array($product->required_fields) && count($product->required_fields))
        document.querySelectorAll('#checkoutForm input[required]').forEach(field => {
            field.addEventListener('input', updateSubmitButton);
        });
    @endif

    document.querySelectorAll('.itemRadio').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.disabled) return;

            document.querySelectorAll('.item-card').forEach(card => {
                card.classList.remove('checked','border-black','bg-gray-50');
                card.classList.add('border-gray-200');
            });

            const label = this.closest('.relative').querySelector('.item-card');
            label.classList.remove('border-gray-200');
            label.classList.add('checked','border-black','bg-gray-50');

            selectedPrice = parseInt(this.dataset.price || "0", 10);
            selectedItemId = this.value;
            selectedItemData = this;

            updateSelectedItemInfo();
            updateTotal();
            updateSubmitButton();
        });
    });

    function updateSelectedItemInfo(){
        if (!selectedItemData) return;

        const label = selectedItemData.closest('.relative').querySelector('.item-card');
        const itemName = label.querySelector('.font-semibold').textContent;
        const stockElement = label.querySelector('.text-gray-500.font-medium');
        selectedItemStock = parseInt(stockElement ? stockElement.textContent : "0", 10);

        selectedItemName.textContent = itemName;
        selectedItemPrice.textContent = `Rp ${selectedPrice.toLocaleString('id-ID')}`;
        selectedItemInfo.classList.remove('hidden');

        quantityInput.max = selectedItemStock;

        if (parseInt(quantityInput.value) > selectedItemStock) {
            quantityInput.value = selectedItemStock;
        }
        minBtn.disabled = parseInt(quantityInput.value) <= 1;
        plusBtn.disabled = parseInt(quantityInput.value) >= selectedItemStock;

        quantityHidden.value = parseInt(quantityInput.value || "1", 10);
    }

    function updateTotal(){
        const quantity = parseInt(quantityInput.value || "1", 10);
        const total = selectedPrice * quantity;
        totalHargaEl.textContent = `Rp ${total.toLocaleString('id-ID')}`;

        minBtn.disabled = quantity <= 1;
        plusBtn.disabled = (selectedItemStock > 0) ? (quantity >= selectedItemStock) : false;

        quantityHidden.value = quantity;
    }

    plusBtn?.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value || "1", 10);
        if (selectedItemStock > 0 && currentValue >= selectedItemStock) return;
        quantityInput.value = currentValue + 1;
        updateTotal();
    });

    minBtn?.addEventListener('click', () => {
        let currentValue = parseInt(quantityInput.value || "1", 10);
        if (currentValue <= 1) return;
        quantityInput.value = currentValue - 1;
        updateTotal();
    });

    quantityInput?.addEventListener('input', () => {
        let value = parseInt(quantityInput.value || "1", 10);
        if (isNaN(value) || value < 1) value = 1;
        if (selectedItemStock > 0 && value > selectedItemStock) value = selectedItemStock;
        quantityInput.value = value;
        updateTotal();
    });

    submitBtn?.addEventListener('click', function(e){
        e.preventDefault();

        if (!selectedItemId) {
            showAlert('Pilih Item', 'Silakan pilih item terlebih dahulu sebelum melanjutkan.', 'warning');
            return;
        }

        const quantity = parseInt(quantityInput.value || "1", 10);
        if (selectedItemStock < quantity) {
            showAlert('Stok Tidak Cukup', `Stok hanya tersedia ${selectedItemStock} item.`, 'error');
            return;
        }

        const total = selectedPrice * quantity;
        const userBalance = {{ auth()->user()->saldo }};

        if (total > userBalance) {
            showAlert('Saldo Tidak Cukup', `Saldo Anda tidak cukup untuk membeli ${quantity} item.`, 'error');
            return;
        }

        checkoutForm.submit();
    });

    const quantityInputMobile = document.getElementById('quantityInputMobile');
    const quantityHiddenMobile = document.getElementById('quantityHiddenMobile');
    const totalHargaElMobile = document.getElementById('totalHargaMobile');
    const submitBtnMobile = document.getElementById('submitBtnMobile');
    const plusBtnMobile = document.getElementById('plusQtyMobile');
    const minBtnMobile = document.getElementById('minQtyMobile');
    const selectedItemInfoMobile = document.getElementById('selectedItemInfoMobile');
    const selectedItemNameMobile = document.getElementById('selectedItemNameMobile');
    const selectedItemPriceMobile = document.getElementById('selectedItemPriceMobile');
    const checkoutFormMobile = document.getElementById('checkoutFormMobile');

    let selectedPriceMobile = 0;
    let selectedItemIdMobile = null;
    let selectedItemStockMobile = 0;
    let selectedItemDataMobile = null;

    function updateSubmitButtonMobile() {
        const isItemSelected = selectedItemIdMobile !== null && selectedPriceMobile > 0;
        const isFormValid = validateRequiredFieldsMobile();
        
        if (isItemSelected && isFormValid) {
            submitBtnMobile.disabled = false;
            submitBtnMobile.classList.remove('submit-disabled', 'bg-gray-400');
            submitBtnMobile.classList.add('bg-black', 'hover:bg-gray-800');
            submitBtnMobile.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Beli Sekarang</span>';
        } else {
            submitBtnMobile.disabled = true;
            submitBtnMobile.classList.add('submit-disabled', 'bg-gray-400');
            submitBtnMobile.classList.remove('bg-black', 'hover:bg-gray-800');
            if (!isItemSelected) {
                submitBtnMobile.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Pilih Item Terlebih Dahulu</span>';
            } else {
                submitBtnMobile.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Isi Data Terlebih Dahulu</span>';
            }
        }
    }

    function validateRequiredFieldsMobile() {
        @if(is_array($product->required_fields) && count($product->required_fields))
            const requiredFields = document.querySelectorAll('#checkoutFormMobile input[required]');
            for (const field of requiredFields) {
                if (!field.value.trim()) {
                    return false;
                }
            }
        @endif
        return true;
    }

    @if(is_array($product->required_fields) && count($product->required_fields))
        document.querySelectorAll('#checkoutFormMobile input[required]').forEach(field => {
            field.addEventListener('input', updateSubmitButtonMobile);
        });
    @endif

    document.querySelectorAll('.itemRadioMobile').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.disabled) return;

            document.querySelectorAll('.item-card-mobile').forEach(card => {
                card.classList.remove('checked','border-black','bg-gray-50');
                card.classList.add('border-gray-200');
            });

            const label = this.closest('.relative').querySelector('.item-card-mobile');
            label.classList.remove('border-gray-200');
            label.classList.add('checked','border-black','bg-gray-50');

            selectedPriceMobile = parseInt(this.dataset.price || "0", 10);
            selectedItemIdMobile = this.value;
            selectedItemDataMobile = this;

            updateSelectedItemInfoMobile();
            updateTotalMobile();
            updateSubmitButtonMobile();
        });
    });

    function updateSelectedItemInfoMobile(){
        if (!selectedItemDataMobile) return;

        const label = selectedItemDataMobile.closest('.relative').querySelector('.item-card-mobile');
        const itemName = label.querySelector('.font-semibold').textContent;
        const stockElement = label.querySelector('.text-gray-500.font-medium');
        selectedItemStockMobile = parseInt(stockElement ? stockElement.textContent : "0", 10);

        selectedItemNameMobile.textContent = itemName;
        selectedItemPriceMobile.textContent = `Rp ${selectedPriceMobile.toLocaleString('id-ID')}`;
        selectedItemInfoMobile.classList.remove('hidden');

        quantityInputMobile.max = selectedItemStockMobile;

        if (parseInt(quantityInputMobile.value) > selectedItemStockMobile) {
            quantityInputMobile.value = selectedItemStockMobile;
        }
        minBtnMobile.disabled = parseInt(quantityInputMobile.value) <= 1;
        plusBtnMobile.disabled = parseInt(quantityInputMobile.value) >= selectedItemStockMobile;

        quantityHiddenMobile.value = parseInt(quantityInputMobile.value || "1", 10);
    }

    function updateTotalMobile(){
        const quantity = parseInt(quantityInputMobile.value || "1", 10);
        const total = selectedPriceMobile * quantity;
        totalHargaElMobile.textContent = `Rp ${total.toLocaleString('id-ID')}`;

        minBtnMobile.disabled = quantity <= 1;
        plusBtnMobile.disabled = (selectedItemStockMobile > 0) ? (quantity >= selectedItemStockMobile) : false;

        quantityHiddenMobile.value = quantity;
    }

    plusBtnMobile?.addEventListener('click', () => {
        let currentValue = parseInt(quantityInputMobile.value || "1", 10);
        if (selectedItemStockMobile > 0 && currentValue >= selectedItemStockMobile) return;
        quantityInputMobile.value = currentValue + 1;
        updateTotalMobile();
    });

    minBtnMobile?.addEventListener('click', () => {
        let currentValue = parseInt(quantityInputMobile.value || "1", 10);
        if (currentValue <= 1) return;
        quantityInputMobile.value = currentValue - 1;
        updateTotalMobile();
    });

    quantityInputMobile?.addEventListener('input', () => {
        let value = parseInt(quantityInputMobile.value || "1", 10);
        if (isNaN(value) || value < 1) value = 1;
        if (selectedItemStockMobile > 0 && value > selectedItemStockMobile) value = selectedItemStockMobile;
        quantityInputMobile.value = value;
        updateTotalMobile();
    });

    submitBtnMobile?.addEventListener('click', function(e){
        e.preventDefault();

        if (!selectedItemIdMobile) {
            showAlert('Pilih Item', 'Silakan pilih item terlebih dahulu sebelum melanjutkan.', 'warning');
            return;
        }

        const quantity = parseInt(quantityInputMobile.value || "1", 10);
        if (selectedItemStockMobile < quantity) {
            showAlert('Stok Tidak Cukup', `Stok hanya tersedia ${selectedItemStockMobile} item.`, 'error');
            return;
        }

        const total = selectedPriceMobile * quantity;
        const userBalance = {{ auth()->user()->saldo }};

        if (total > userBalance) {
            showAlert('Saldo Tidak Cukup', `Saldo Anda tidak cukup untuk membeli ${quantity} item.`, 'error');
            return;
        }

        checkoutFormMobile.submit();
    });

    function showAlert(title, message, type){
        const alertDiv = document.createElement('div');
        alertDiv.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg border max-w-sm animate-fadeIn ${
            type === 'error' ? 'bg-red-50 border-red-200 text-red-800' :
            type === 'warning' ? 'bg-yellow-50 border-yellow-200 text-yellow-800' :
            'bg-blue-50 border-blue-200 text-blue-800'
        }`;

        alertDiv.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="mt-0.5">
                    <i class="fas ${type === 'error' ? 'fa-exclamation-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'}"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-sm">${title}</h4>
                    <p class="text-sm mt-1">${message}</p>
                </div>
                <button class="text-gray-500 hover:text-gray-700" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        document.body.appendChild(alertDiv);

        setTimeout(() => { if (alertDiv.parentElement) alertDiv.remove(); }, 5000);
    }


    document.addEventListener('keydown', (e) => {
        if (e.ctrlKey && e.key === 'Enter') {
            if (!submitBtn.disabled) submitBtn.click();
        }
        if (e.key === '+' || e.key === '=') {
            e.preventDefault();
            plusBtn?.click();
        }
        if (e.key === '-' || e.key === '_') {
            e.preventDefault();
            minBtn?.click();
        }
    });

    updateSubmitButton();
    updateSubmitButtonMobile();
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
                    { prefix: '/top-buyers', href: '/top-buyers' },
                    { prefix: '/redeem', href: '/redeem' },
                    { prefix: '/information', href: '/information' },
                    { prefix: '/profile', href: '/profile' },
                    { prefix: '/admin', href: '/admin/dashboard' },
                    { prefix: '/product/', href: '/home' },
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