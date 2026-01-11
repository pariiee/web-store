<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0" />
    <title>{{ $product->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            -webkit-tap-highlight-color: transparent;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #555; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fadeIn { animation: fadeIn .3s ease-out; }

        .item-card.checked,
        .item-card-mobile.checked {
            box-shadow: 0 0 0 2px #111827, 0 10px 24px rgba(0,0,0,.08);
            transform: translateY(-2px);
        }

        .focus-ring:focus {
            box-shadow: 0 0 0 3px rgba(17,24,39,.12);
            outline: none;
        }

        .disabled-card { 
            filter: grayscale(100%); 
            opacity: .5;
            pointer-events: none;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            line-clamp: 2;
        }

        .preserve-linebreaks {
            white-space: pre-line;
            line-height: 1.5;
        }

        .card-soft {
            box-shadow: 0 1px 0 rgba(0,0,0,.02), 0 10px 30px rgba(15,23,42,.06);
            transition: all 0.3s ease;
        }
        
        .card-soft:hover {
            box-shadow: 0 1px 0 rgba(0,0,0,.02), 0 14px 40px rgba(15,23,42,.09);
        }

        /* Quantity Stepper */
        .qty-stepper {
            display: flex;
            align-items: center;
            border: 1px solid #D1D5DB;
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
            height: 42px;
            min-width: 140px;
        }
        
        .qty-btn {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            transition: background .15s ease;
            border: none;
            cursor: pointer;
        }
        
        .qty-btn:hover { background: #F9FAFB; }
        .qty-btn:active { background: #F3F4F6; }
        .qty-btn:disabled { opacity: .5; cursor: not-allowed; background: #fff; }
        
        .qty-divider {
            width: 1px;
            height: 100%;
            background: #D1D5DB;
        }
        
        .qty-input {
            width: 50px;
            height: 42px;
            text-align: center;
            font-weight: 700;
            font-size: 14px;
            border: 0;
            outline: none;
            background: transparent;
        }
        
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type=number] { 
            -moz-appearance: textfield; 
            appearance: textfield;
        }

        /* Button States */
        .submit-enabled {
            background: linear-gradient(135deg, #111827 0%, #374151 100%) !important;
            cursor: pointer !important;
        }
        
        .submit-enabled:hover {
            background: linear-gradient(135deg, #374151 0%, #111827 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .submit-disabled {
            opacity: 0.6;
            cursor: not-allowed !important;
            background-color: #9CA3AF !important;
        }
        
        .submit-disabled:hover {
            background-color: #9CA3AF !important;
            transform: none;
            box-shadow: none;
        }

        /* Bottom Navigation */
        .bottom-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            transition: transform 0.35s ease, opacity 0.25s ease;
        }
        
        .bottom-nav.hide {
            transform: translate(-50%, 120%);
            opacity: 0;
            pointer-events: none;
        }
        
        .nav-item { 
            transition: transform 0.18s ease, background 0.18s ease; 
        }
        
        .nav-icon {
            transition: all 0.18s ease;
            background: rgba(255, 255, 255, 0.9);
            color: #18181b;
            border: 1px solid rgba(229, 231, 235, 0.6);
        }
        
        .nav-item.active { transform: translateY(-6px); }
        .nav-item.active .nav-icon {
            background: linear-gradient(135deg, #111827 0%, #374151 100%);
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(0,0,0,0.18);
            border-color: #18181b;
        }
        
        .nav-item:active .nav-icon { transform: scale(.96); }

        /* Mobile Header */
        .mobile-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.6);
        }

        /* Safe Area Padding for Modern Mobile Devices */
        .pb-safe {
            padding-bottom: env(safe-area-inset-bottom);
        }

        /* Responsive Grid Adjustments */
        @media (max-width: 640px) {
            .item-grid-mobile {
                grid-template-columns: repeat(2, 1fr) !important;
            }
            
            .product-image-mobile {
                width: 80px !important;
                height: 80px !important;
            }
        }

        @media (min-width: 641px) and (max-width: 768px) {
            .item-grid-tablet {
                grid-template-columns: repeat(3, 1fr) !important;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .item-grid-tablet {
                grid-template-columns: repeat(4, 1fr) !important;
            }
        }

        /* Touch-friendly sizes */
        @media (max-width: 768px) {
            .touch-button {
                min-height: 48px;
                min-width: 48px;
            }
            
            .touch-input {
                font-size: 16px; /* Prevents iOS zoom */
                padding: 12px;
            }
            
            .touch-text {
                font-size: 14px;
            }
        }

        /* Loading State */
        .loading {
            position: relative;
            overflow: hidden;
        }
        
        .loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { left: -100%; }
            100% { left: 100%; }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col text-zinc-900">
    <!-- Mobile Header -->
    <header class="md:hidden px-4 pt-4 pb-2 mobile-header sticky top-0 z-40 shadow-sm">
        <div class="flex justify-between items-center">
            <div class="flex-1 min-w-0">
                <p class="text-[10px] text-zinc-500 font-medium uppercase tracking-wide">Produk Detail</p>
                <h2 class="font-bold text-base sm:text-lg text-zinc-900 truncate pr-2">
                    {{ $product->name }}
                </h2>
            </div>
            <a href="/profile"
               class="w-9 h-9 rounded-full overflow-hidden border border-zinc-200/60 bg-white/80 hover:bg-white transition flex items-center justify-center flex-shrink-0">
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

    <!-- Desktop Navigation -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-zinc-200/80 hidden md:block">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <a href="/home" class="flex items-center gap-2 hover:opacity-80 transition">
                    <img src="{{ asset('images/logo.jpg') }}" alt="PARI ID" class="h-8 w-auto object-contain">
                </a>
            </div>

            <div class="hidden lg:flex items-center gap-6">
                <a href="/home" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition">Home</a>
                <a href="/top-buyers" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition">Top</a>
                <a href="/riwayat" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition">Riwayat</a>
                <a href="/redeem" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition">Redeem</a>
                <a href="/profile" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition">Akun</a>
                <a href="/information" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition">Info</a>
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class="text-sm font-medium text-zinc-500 hover:text-zinc-900 transition">Admin</a>
                @endif
            </div>

            <div class="flex items-center gap-3 sm:gap-4">
                <div class="text-right hidden lg:block">
                    <p class="text-xs text-zinc-500">Saldo Aktif</p>
                    <p class="font-bold text-sm">Rp {{ number_format(auth()->user()->saldo ?? 0, 0, ',', '.') }}</p>
                </div>
                <a href="/information"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="px-3 sm:px-4 py-2 bg-zinc-100 text-zinc-700 rounded-lg text-xs font-bold hover:bg-red-50 hover:text-red-600 transition touch-button">
                    Keluar
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 container mx-auto max-w-7xl px-3 sm:px-4 md:px-6 pt-3 md:pt-5 pb-24 md:pb-10">
        <!-- Mobile View -->
        <div class="block lg:hidden space-y-4 sm:space-y-6">
            <!-- Product Info Card -->
            <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-100 bg-gradient-to-b from-gray-50 to-white">
                    <h3 class="font-bold text-gray-900 text-base sm:text-lg flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-gray-900"></span>
                        Informasi Produk
                    </h3>
                </div>

                <div class="p-4 sm:p-5 space-y-4 sm:space-y-5">
                    <div class="space-y-2">
                        <h3 class="font-bold text-gray-900 text-lg sm:text-xl leading-tight">
                            {{ $product->name }}
                        </h3>
                        <div class="flex items-center gap-2 mt-1 sm:mt-2">
                            <span class="inline-flex items-center gap-1 px-2 sm:px-3 py-1 sm:py-1.5 rounded-full bg-gray-100 text-xs sm:text-sm font-medium text-gray-700">
                                <i class="fas fa-tag text-xs"></i>
                                {{ $product->category->name ?? 'Tidak Berkategori' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex gap-3 sm:gap-4 items-start">
                        <div class="flex-shrink-0">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl sm:rounded-2xl overflow-hidden border border-gray-200 bg-white flex items-center justify-center product-image-mobile">
                                @if($product->thumbnail)
                                    <img src="{{ asset('storage/'.$product->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $product->name }}" loading="lazy">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50">
                                        <i class="fas fa-image text-gray-400 text-xl sm:text-2xl mb-1"></i>
                                        <span class="text-xs text-gray-500">No Image</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="h-px bg-gray-200 mb-3"></div>
                            <ul class="space-y-2 sm:space-y-3">
                                <li class="flex items-center gap-3">
                                    <span class="w-5 flex justify-center text-gray-700"><i class="fas fa-shield-alt text-sm"></i></span>
                                    <span class="text-xs sm:text-sm font-semibold text-gray-900 leading-none">Jaminan Layanan</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="w-5 flex justify-center text-gray-700"><i class="fas fa-headset text-sm"></i></span>
                                    <span class="text-xs sm:text-sm font-semibold text-gray-900 leading-none">Layanan Pelanggan</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="w-5 flex justify-center text-gray-700"><i class="fas fa-lock text-sm"></i></span>
                                    <span class="text-xs sm:text-sm font-semibold text-gray-900 leading-none">Pembayaran Aman</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <span class="w-5 flex justify-center text-gray-700"><i class="fas fa-bolt text-sm"></i></span>
                                    <span class="text-xs sm:text-sm font-semibold text-gray-900 leading-none">Pengiriman Instan</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="pt-1">
                        <h4 class="font-semibold text-xs sm:text-sm text-gray-900 mb-2 sm:mb-3 flex items-center gap-2">
                            <i class="fas fa-align-left"></i> Deskripsi Produk
                        </h4>
                        <div class="text-xs sm:text-sm text-gray-600 preserve-linebreaks bg-gray-50 p-3 sm:p-4 rounded-lg sm:rounded-xl border border-gray-100 max-h-48 overflow-y-auto">
                            {{ trim($product->description ?? 'Tidak ada deskripsi tersedia.') }}
                        </div>
                    </div>

                    <div class="pt-1">
                        <div class="border border-gray-200 rounded-lg sm:rounded-xl overflow-hidden">
                            <details class="group">
                                <summary class="flex items-center justify-between p-3 cursor-pointer bg-gray-50 hover:bg-gray-100 transition touch-button">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-shopping-cart text-gray-700"></i>
                                        <h4 class="font-semibold text-xs sm:text-sm text-gray-900">Cara Pembelian</h4>
                                    </div>
                                    <i class="fas fa-chevron-down text-gray-500 text-xs transition-transform group-open:rotate-180"></i>
                                </summary>
                                <div class="p-3 border-t border-gray-200 bg-white">
                                    <ol class="space-y-2 sm:space-y-3">
                                        @foreach([1 => 'Isi data yang diperlukan', 2 => 'Pilih item yang diinginkan', 3 => 'Atur jumlah pembelian', 4 => 'Klik "Beli Sekarang"', 5 => 'Produk akan dikirim'] as $step => $desc)
                                        <li class="flex items-start gap-3">
                                            <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5">
                                                <span>{{ $step }}</span>
                                            </div>
                                            <div>
                                                <p class="text-xs sm:text-sm font-medium text-gray-900">{{ $desc }}</p>
                                                <p class="text-xs text-gray-500 mt-0.5">Masukkan data dengan benar</p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Input Form -->
            <form action="{{ route('product.checkout', $product->slug) }}" method="POST" id="checkoutFormMobile" class="space-y-4 sm:space-y-6">
                @csrf
                <input type="hidden" id="quantityHiddenMobile" name="quantity" value="1">

                @if(is_array($product->required_fields) && count($product->required_fields))
                <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                    <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-b from-gray-50 to-white">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-black text-white text-xs sm:text-sm flex items-center justify-center font-medium">
                            <i class="fas fa-pen text-xs"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm sm:text-base">Masukkan Data</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Isi data yang diperlukan untuk transaksi</p>
                        </div>
                    </div>
                    <div class="p-4 sm:p-5 space-y-3 sm:space-y-4">
                        @foreach($product->required_fields as $field)
                            <div class="space-y-1">
                                <label class="text-xs sm:text-sm font-medium text-gray-800">
                                    {{ ucfirst(str_replace('_',' ',$field)) }} <span class="text-red-500">*</span>
                                </label>
                                <input name="{{ $field }}" required
                                       class="w-full border border-gray-300 rounded-lg sm:rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-sm focus:ring-2 focus:ring-gray-800 focus:border-transparent focus-ring transition touch-input"
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

                <!-- Items Selection -->
                <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                    <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-b from-gray-50 to-white">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-black text-white text-xs sm:text-sm flex items-center justify-center font-medium">
                            <i class="fas fa-box text-xs"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm sm:text-base">Pilih Item / Nominal</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Pilih produk yang ingin Anda beli</p>
                        </div>
                    </div>

                    <div class="p-4 sm:p-5">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-3 item-grid-mobile">
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
                                       class="itemRadioMobile absolute opacity-0 w-0 h-0"
                                       value="{{ $item->id }}"
                                       data-price="{{ $price }}"
                                       {{ $isOut ? 'disabled' : '' }}>

                                <label for="item_mobile_{{ $item->id }}"
                                       class="item-card-mobile block aspect-square rounded-lg sm:rounded-xl border-2 border-gray-200 bg-white
                                              flex flex-col items-center justify-center gap-1 sm:gap-2
                                              text-center p-2 sm:p-3 cursor-pointer transition-all duration-200 touch-button
                                              {{ $isOut ? 'disabled-card' : 'hover:border-gray-400 hover:shadow-md active:scale-[0.98]' }}">

                                    @if($item->thumbnail)
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center overflow-hidden">
                                            <img src="{{ asset('storage/'.$item->thumbnail) }}" class="w-full h-full object-contain" alt="{{ $item->name }}" loading="lazy">
                                        </div>
                                    @else
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-gray-100">
                                            <i class="fas fa-cube text-gray-500 text-sm"></i>
                                        </div>
                                    @endif

                                    <div class="flex-1 flex flex-col justify-center min-h-0">
                                        <p class="text-xs font-semibold text-gray-900 leading-tight line-clamp-2">{{ $item->name }}</p>
                                        <p class="text-xs sm:text-sm font-bold text-gray-900 mt-1">Rp {{ number_format($price,0,',','.') }}</p>
                                    </div>

                                    <div class="flex items-center justify-between w-full text-[10px] sm:text-xs">
                                        <div class="flex items-center gap-1 {{ $stockCount > 0 ? 'text-green-600' : 'text-red-500' }}">
                                            <i class="fas {{ $stockCount > 0 ? 'fa-check-circle' : 'fa-times-circle' }} text-[10px] sm:text-xs"></i>
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

            <!-- Payment Summary -->
            <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200/70 card-soft overflow-hidden mb-20">
                <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-100 bg-gradient-to-b from-gray-50 to-white">
                    <h3 class="font-bold text-gray-900 text-sm sm:text-base">Ringkasan Pembayaran</h3>
                </div>

                <div class="p-4 sm:p-5 space-y-4 sm:space-y-5">
                    <div id="selectedItemInfoMobile" class="hidden">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg sm:rounded-xl border border-gray-100">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-box text-gray-700 text-sm"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-medium text-gray-900 truncate" id="selectedItemNameMobile">-</p>
                                <p class="text-xs text-gray-500 mt-0.5" id="selectedItemPriceMobile">Rp 0</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-layer-group text-gray-700"></i>
                            <span class="text-xs sm:text-sm font-medium text-gray-900">Jumlah Pembelian</span>
                        </div>

                        <div class="qty-stepper">
                            <button type="button" id="minQtyMobile" class="qty-btn" aria-label="Kurangi">
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <div class="qty-divider"></div>
                            <input type="number" id="quantityInputMobile" value="1" min="1" class="qty-input touch-input">
                            <div class="qty-divider"></div>
                            <button type="button" id="plusQtyMobile" class="qty-btn" aria-label="Tambah">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                        </div>
                    </div>

                    <div class="p-3 bg-gray-50 rounded-lg sm:rounded-xl border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-wallet text-gray-700"></i>
                                <span class="text-xs sm:text-sm font-medium text-gray-900">Saldo Anda</span>
                            </div>
                            <span class="text-xs sm:text-sm font-bold text-gray-900">Rp {{ number_format(auth()->user()->saldo,0,',','.') }}</span>
                        </div>
                    </div>

                    <div class="pt-3 sm:pt-4 border-t border-gray-200">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm sm:text-base font-medium text-gray-900">Total Pembayaran</span>
                            <span id="totalHargaMobile" class="text-lg sm:text-2xl font-bold text-gray-900">Rp 0</span>
                        </div>
                    </div>

                    <button type="button" id="submitBtnMobile"
                            class="w-full bg-gray-400 text-white py-3 sm:py-3.5 rounded-xl font-bold text-sm transition-all duration-200 flex items-center justify-center gap-2 submit-disabled touch-button">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Pilih Item Terlebih Dahulu</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Desktop/Tablet View -->
        <div class="hidden lg:grid lg:grid-cols-1 xl:grid-cols-3 gap-6 xl:gap-8 items-start animate-fadeIn">
            <!-- Left Column (Forms) -->
            <div class="xl:col-span-2 flex flex-col gap-6 xl:gap-8">
                <!-- Data Input Form -->
                <form action="{{ route('product.checkout', $product->slug) }}" method="POST" id="checkoutForm" class="flex flex-col gap-6 xl:gap-8">
                    @csrf

                    @if(is_array($product->required_fields) && count($product->required_fields))
                    <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                        <div class="px-5 xl:px-6 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-b from-gray-50 to-white">
                            <div class="w-8 h-8 rounded-full bg-black text-white text-sm flex items-center justify-center font-medium">
                                <i class="fas fa-pen text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Masukkan Data</h3>
                                <p class="text-sm text-gray-500 mt-0.5">Isi data yang diperlukan untuk transaksi</p>
                            </div>
                        </div>
                        <div class="p-5 xl:p-6 space-y-4">
                            @foreach($product->required_fields as $field)
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-800">
                                        {{ ucfirst(str_replace('_',' ',$field)) }} <span class="text-red-500">*</span>
                                    </label>
                                    <input name="{{ $field }}" required
                                           class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-gray-800 focus:border-transparent focus-ring transition"
                                           placeholder="Masukkan {{ ucfirst(str_replace('_',' ',$field)) }}">
                                </div>
                            @endforeach
                            <div class="flex items-center gap-2 text-sm text-gray-500 pt-2">
                                <i class="fas fa-info-circle"></i>
                                <p>Pastikan data yang Anda masukkan sudah benar dan sesuai.</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Items Selection -->
                    <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                        <div class="px-5 xl:px-6 py-4 border-b border-gray-100 flex items-center gap-3 bg-gradient-to-b from-gray-50 to-white">
                            <div class="w-8 h-8 rounded-full bg-black text-white text-sm flex items-center justify-center font-medium">
                                <i class="fas fa-box text-xs"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg">Pilih Item / Nominal</h3>
                                <p class="text-sm text-gray-500 mt-0.5">Pilih produk yang ingin Anda beli</p>
                            </div>
                        </div>

                        <div class="p-5 xl:p-6">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-3 xl:gap-3.5 auto-rows-fr">
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
                                           class="itemRadio absolute opacity-0 w-0 h-0"
                                           value="{{ $item->id }}"
                                           data-price="{{ $price }}"
                                           {{ $isOut ? 'disabled' : '' }}>

                                    <label for="item_{{ $item->id }}"
                                           class="item-card block aspect-square h-full rounded-xl border-2 border-gray-200 bg-white
                                                  flex flex-col items-center justify-center gap-2
                                                  text-center p-3 cursor-pointer transition-all duration-200
                                                  {{ $isOut ? 'disabled-card' : 'hover:border-gray-400 hover:shadow-md active:scale-[0.98]' }}">

                                        @if($item->thumbnail)
                                            <div class="w-10 h-10 flex items-center justify-center overflow-hidden">
                                                <img src="{{ asset('storage/'.$item->thumbnail) }}" class="w-full h-full object-contain" alt="{{ $item->name }}" loading="lazy">
                                            </div>
                                        @else
                                            <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100">
                                                <i class="fas fa-cube text-gray-500"></i>
                                            </div>
                                        @endif

                                        <div class="flex-1 flex flex-col justify-center min-h-0">
                                            <p class="text-sm font-semibold text-gray-900 leading-tight line-clamp-2">{{ $item->name }}</p>
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

            <!-- Right Column (Product Info & Payment Summary) -->
            <div class="flex flex-col gap-6 xl:gap-8">
                <!-- Product Information -->
                <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden">
                    <div class="px-5 xl:px-6 py-4 border-b border-gray-100 bg-gradient-to-b from-gray-50 to-white">
                        <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-gray-900"></span>
                            Informasi Produk
                        </h3>
                    </div>

                    <div class="p-5 xl:p-6 space-y-5">
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
                                <div class="w-24 h-24 xl:w-28 xl:h-28 rounded-2xl overflow-hidden border border-gray-200 bg-white flex items-center justify-center">
                                    @if($product->thumbnail)
                                        <img src="{{ asset('storage/'.$product->thumbnail) }}" class="w-full h-full object-cover" alt="{{ $product->name }}" loading="lazy">
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
                                        <span class="w-6 flex justify-center text-gray-700"><i class="fas fa-shield-alt"></i></span>
                                        <span class="text-sm font-semibold text-gray-900 leading-none">Jaminan Layanan</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 flex justify-center text-gray-700"><i class="fas fa-headset"></i></span>
                                        <span class="text-sm font-semibold text-gray-900 leading-none">Layanan Pelanggan</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 flex justify-center text-gray-700"><i class="fas fa-lock"></i></span>
                                        <span class="text-sm font-semibold text-gray-900 leading-none">Pembayaran Aman</span>
                                    </li>
                                    <li class="flex items-center gap-3">
                                        <span class="w-6 flex justify-center text-gray-700"><i class="fas fa-bolt"></i></span>
                                        <span class="text-sm font-semibold text-gray-900 leading-none">Pengiriman Instan</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="pt-1">
                            <h4 class="font-semibold text-sm text-gray-900 mb-3 flex items-center gap-2">
                                <i class="fas fa-align-left"></i> Deskripsi Produk
                            </h4>
                            <div class="text-sm text-gray-600 preserve-linebreaks bg-gray-50 p-4 rounded-xl border border-gray-100 max-h-60 overflow-y-auto">
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
                                            @foreach([1 => 'Isi data yang diperlukan', 2 => 'Pilih item yang diinginkan', 3 => 'Atur jumlah pembelian', 4 => 'Klik "Beli Sekarang"', 5 => 'Produk akan dikirim'] as $step => $desc)
                                            <li class="flex items-start gap-3">
                                                <div class="w-6 h-6 rounded-full bg-black text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5"><span>{{ $step }}</span></div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">{{ $desc }}</p>
                                                    <p class="text-xs text-gray-500 mt-0.5">Masukkan data dengan benar</p>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </details>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="bg-white rounded-2xl border border-gray-200/70 card-soft overflow-hidden sticky top-24">
                    <div class="px-5 xl:px-6 py-4 border-b border-gray-100 bg-gradient-to-b from-gray-50 to-white">
                        <h3 class="font-bold text-gray-900 text-lg">Ringkasan Pembayaran</h3>
                    </div>

                    <div class="p-5 xl:p-6 space-y-5">
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
                                <span class="text-base font-medium text-gray-900">Total Pembayaran</span>
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

    <!-- Footer -->
    <footer id="footer" class="bg-zinc-900 text-zinc-400 py-8 md:py-12 border-t border-zinc-800">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-10 mb-8 md:mb-10">
                <div class="md:col-span-3">
                    <div class="flex items-center gap-3 mb-4 md:mb-6">
                        <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="h-8 md:h-10 w-auto rounded-xl hover:scale-105 transition" loading="lazy">
                        <span class="font-bold text-lg md:text-xl tracking-tight text-white">PARI ID X CYAA STORE</span>
                    </div>
                    <p class="text-xs md:text-sm leading-relaxed mb-4 md:mb-6 max-w-3xl">
                        PARI ID adalah Web platform terpercaya yang menyediakan berbagai produk digital dengan harga kompetitif. 
                        Kami berkomitmen memberikan pelayanan terbaik kepada seluruh pelanggan dengan sistem yang aman, 
                        transaksi cepat, dan dukungan pelanggan 24/7.
                    </p>

                    <div class="flex gap-3 md:gap-4">
                        <a href="https://t.me/heyiniaya" target="_blank"
                           class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-sky-500 hover:text-white transition"
                           aria-label="Telegram">
                            <span class="iconify text-base md:text-lg" data-icon="lucide:send"></span>
                        </a>
                        <a href="https://wa.me/+6283129320041?text=Halo+Admin+CYAA+STORE%2C+saya+butuh+bantuan." target="_blank"
                           class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-zinc-800 flex items-center justify-center hover:bg-green-500 hover:text-white transition"
                           aria-label="WhatsApp">
                            <span class="iconify text-base md:text-lg" data-icon="lucide:message-circle"></span>
                        </a>
                    </div>
                </div>

                <div class="bg-zinc-800/50 p-4 md:p-6 rounded-xl md:rounded-2xl border border-zinc-700">
                    <h4 class="font-bold text-white mb-4 md:mb-6 text-base md:text-lg flex items-center gap-2">
                        <span class="iconify" data-icon="lucide:shield"></span>
                        Legal & Informasi
                    </h4>
                    <ul class="space-y-3 md:space-y-4">
                        <li>
                            <a href="/information" class="hover:text-white transition flex items-center gap-3 p-2 md:p-3 bg-zinc-900/50 rounded-lg md:rounded-xl hover:bg-zinc-800">
                                <span class="iconify text-base md:text-lg" data-icon="lucide:file-text"></span>
                                <div>
                                    <p class="font-medium text-xs md:text-sm">Syarat & Ketentuan</p>
                                    <p class="text-xs text-zinc-500 mt-0.5">Ketentuan penggunaan layanan</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="/information" class="hover:text-white transition flex items-center gap-3 p-2 md:p-3 bg-zinc-900/50 rounded-lg md:rounded-xl hover:bg-zinc-800">
                                <span class="iconify text-base md:text-lg" data-icon="lucide:shield-check"></span>
                                <div>
                                    <p class="font-medium text-xs md:text-sm">Kebijakan Privasi</p>
                                    <p class="text-xs text-zinc-500 mt-0.5">Data dan keamanan pengguna</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-zinc-800 pt-6 md:pt-8 text-center md:text-left flex flex-col md:flex-row justify-between items-center text-xs">
                <p class="mb-3 md:mb-0">&copy; 2025 PARI ID. Hak Cipta Dilindungi Undang-Undang.</p>
                <p class="text-zinc-500">v1.0</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 md:hidden pb-safe z-50">
        <div class="bottom-nav w-full h-20 flex items-center justify-around px-4">
            @php
                $navItems = [
                    ['href' => '/home', 'icon' => 'lucide:home', 'label' => 'Home'],
                    ['href' => '/riwayat', 'icon' => 'lucide:history', 'label' => 'Riwayat'],
                    ['href' => '/top-buyers', 'icon' => 'lucide:trophy', 'label' => 'Top'],
                    ['href' => auth()->user()->role === 'admin' ? '/admin/dashboard' : '/bukti-garansi', 
                     'icon' => auth()->user()->role === 'admin' ? 'lucide:shield' : 'lucide:clipboard-list', 
                     'label' => auth()->user()->role === 'admin' ? 'Admin' : 'Garansi'],
                    ['href' => '/redeem', 'icon' => 'lucide:ticket-percent', 'label' => 'Redeem'],
                    ['href' => '/information', 'icon' => 'lucide:info', 'label' => 'Info'],
                ];
            @endphp
            
            @foreach($navItems as $item)
            <a href="{{ $item['href'] }}" class="nav-item flex flex-col items-center justify-center w-14 h-14 relative group">
                <div class="nav-icon w-11 h-11 rounded-2xl flex items-center justify-center mb-1">
                    <span class="iconify text-xl" data-icon="{{ $item['icon'] }}"></span>
                </div>
                <span class="text-[10px] font-medium text-gray-600 group-[.active]:text-black">{{ $item['label'] }}</span>
            </a>
            @endforeach
        </div>
    </nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize both desktop and mobile functionality
    initializeDesktopCheckout();
    initializeMobileCheckout();
    initializeNavigation();
    initializeFooterObserver();
    
    // Initialize active navigation item
    setActiveNavItem();
});

function initializeDesktopCheckout() {
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

    if (!submitBtn) return;

    let selectedPrice = 0;
    let selectedItemId = null;
    let selectedItemStock = 0;

    // Update submit button state
    function updateSubmitButton() {
        const isItemSelected = selectedItemId !== null && selectedPrice > 0;
        const isFormValid = validateRequiredFields('#checkoutForm');
        
        if (isItemSelected && isFormValid) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('submit-disabled');
            submitBtn.classList.add('submit-enabled');
            submitBtn.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Beli Sekarang</span>';
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.remove('submit-enabled');
            submitBtn.classList.add('submit-disabled');
            submitBtn.innerHTML = !isItemSelected 
                ? '<i class="fas fa-shopping-cart"></i><span>Pilih Item Terlebih Dahulu</span>'
                : '<i class="fas fa-shopping-cart"></i><span>Isi Data Terlebih Dahulu</span>';
        }
    }

    // Validate required fields
    function validateRequiredFields(formSelector) {
        @if(is_array($product->required_fields) && count($product->required_fields))
            const requiredFields = document.querySelectorAll(`${formSelector} input[required]`);
            for (const field of requiredFields) {
                if (!field.value.trim()) return false;
            }
        @endif
        return true;
    }

    // Item selection handlers
    document.querySelectorAll('#checkoutForm .itemRadio').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.disabled) return;

            // Update UI
            document.querySelectorAll('#checkoutForm .item-card').forEach(card => {
                card.classList.remove('checked', 'border-black', 'bg-gray-50');
                card.classList.add('border-gray-200');
            });

            const label = this.closest('.relative').querySelector('.item-card');
            label.classList.remove('border-gray-200');
            label.classList.add('checked', 'border-black', 'bg-gray-50');

            // Update selection data
            selectedPrice = parseInt(this.dataset.price || "0", 10);
            selectedItemId = this.value;
            
            updateSelectedItemInfo();
            updateTotal();
            updateSubmitButton();
        });
    });

    // Update selected item info
    function updateSelectedItemInfo() {
        const selectedRadio = document.querySelector('#checkoutForm .itemRadio:checked');
        if (!selectedRadio) return;

        const label = selectedRadio.closest('.relative').querySelector('.item-card');
        const itemName = label.querySelector('.font-semibold').textContent;
        const stockElement = label.querySelector('.text-gray-500.font-medium');
        selectedItemStock = parseInt(stockElement ? stockElement.textContent : "0", 10);

        selectedItemName.textContent = itemName;
        selectedItemPrice.textContent = `Rp ${selectedPrice.toLocaleString('id-ID')}`;
        selectedItemInfo.classList.remove('hidden');

        // Update quantity limits
        quantityInput.max = selectedItemStock;
        if (parseInt(quantityInput.value) > selectedItemStock) {
            quantityInput.value = selectedItemStock;
        }
        
        updateButtonStates();
        quantityHidden.value = parseInt(quantityInput.value || "1", 10);
    }

    // Update total price
    function updateTotal() {
        const quantity = parseInt(quantityInput.value || "1", 10);
        const total = selectedPrice * quantity;
        totalHargaEl.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        
        updateButtonStates();
        quantityHidden.value = quantity;
    }

    // Update button states
    function updateButtonStates() {
        const quantity = parseInt(quantityInput.value || "1", 10);
        minBtn.disabled = quantity <= 1;
        plusBtn.disabled = (selectedItemStock > 0) ? (quantity >= selectedItemStock) : false;
    }

    // Quantity controls
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

    quantityInput?.addEventListener('change', updateTotal);

    // Form submission
    submitBtn?.addEventListener('click', function(e) {
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

        // Show loading state
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Memproses...</span>';
        this.disabled = true;

        // Submit form
        setTimeout(() => {
            checkoutForm.submit();
        }, 500);
    });

    // Required fields validation
    @if(is_array($product->required_fields) && count($product->required_fields))
        document.querySelectorAll('#checkoutForm input[required]').forEach(field => {
            field.addEventListener('input', updateSubmitButton);
            field.addEventListener('blur', updateSubmitButton);
        });
    @endif

    // Initialize
    updateSubmitButton();
}

function initializeMobileCheckout() {
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

    if (!submitBtnMobile) return;

    let selectedPriceMobile = 0;
    let selectedItemIdMobile = null;
    let selectedItemStockMobile = 0;

    // Update submit button state
    function updateSubmitButtonMobile() {
        const isItemSelected = selectedItemIdMobile !== null && selectedPriceMobile > 0;
        const isFormValid = validateRequiredFieldsMobile();
        
        if (isItemSelected && isFormValid) {
            submitBtnMobile.disabled = false;
            submitBtnMobile.classList.remove('submit-disabled');
            submitBtnMobile.classList.add('submit-enabled');
            submitBtnMobile.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Beli Sekarang</span>';
        } else {
            submitBtnMobile.disabled = true;
            submitBtnMobile.classList.remove('submit-enabled');
            submitBtnMobile.classList.add('submit-disabled');
            submitBtnMobile.innerHTML = !isItemSelected 
                ? '<i class="fas fa-shopping-cart"></i><span>Pilih Item Terlebih Dahulu</span>'
                : '<i class="fas fa-shopping-cart"></i><span>Isi Data Terlebih Dahulu</span>';
        }
    }

    // Validate required fields
    function validateRequiredFieldsMobile() {
        @if(is_array($product->required_fields) && count($product->required_fields))
            const requiredFields = document.querySelectorAll('#checkoutFormMobile input[required]');
            for (const field of requiredFields) {
                if (!field.value.trim()) return false;
            }
        @endif
        return true;
    }

    // Item selection handlers
    document.querySelectorAll('#checkoutFormMobile .itemRadioMobile').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.disabled) return;

            // Update UI
            document.querySelectorAll('#checkoutFormMobile .item-card-mobile').forEach(card => {
                card.classList.remove('checked', 'border-black', 'bg-gray-50');
                card.classList.add('border-gray-200');
            });

            const label = this.closest('.relative').querySelector('.item-card-mobile');
            label.classList.remove('border-gray-200');
            label.classList.add('checked', 'border-black', 'bg-gray-50');

            // Update selection data
            selectedPriceMobile = parseInt(this.dataset.price || "0", 10);
            selectedItemIdMobile = this.value;
            
            updateSelectedItemInfoMobile();
            updateTotalMobile();
            updateSubmitButtonMobile();
        });
    });

    // Update selected item info
    function updateSelectedItemInfoMobile() {
        const selectedRadio = document.querySelector('#checkoutFormMobile .itemRadioMobile:checked');
        if (!selectedRadio) return;

        const label = selectedRadio.closest('.relative').querySelector('.item-card-mobile');
        const itemName = label.querySelector('.font-semibold').textContent;
        const stockElement = label.querySelector('.text-gray-500.font-medium');
        selectedItemStockMobile = parseInt(stockElement ? stockElement.textContent : "0", 10);

        selectedItemNameMobile.textContent = itemName;
        selectedItemPriceMobile.textContent = `Rp ${selectedPriceMobile.toLocaleString('id-ID')}`;
        selectedItemInfoMobile.classList.remove('hidden');

        // Update quantity limits
        quantityInputMobile.max = selectedItemStockMobile;
        if (parseInt(quantityInputMobile.value) > selectedItemStockMobile) {
            quantityInputMobile.value = selectedItemStockMobile;
        }
        
        updateButtonStatesMobile();
        quantityHiddenMobile.value = parseInt(quantityInputMobile.value || "1", 10);
    }

    // Update total price
    function updateTotalMobile() {
        const quantity = parseInt(quantityInputMobile.value || "1", 10);
        const total = selectedPriceMobile * quantity;
        totalHargaElMobile.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        
        updateButtonStatesMobile();
        quantityHiddenMobile.value = quantity;
    }

    // Update button states
    function updateButtonStatesMobile() {
        const quantity = parseInt(quantityInputMobile.value || "1", 10);
        minBtnMobile.disabled = quantity <= 1;
        plusBtnMobile.disabled = (selectedItemStockMobile > 0) ? (quantity >= selectedItemStockMobile) : false;
    }

    // Quantity controls
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

    quantityInputMobile?.addEventListener('change', updateTotalMobile);

    // Form submission
    submitBtnMobile?.addEventListener('click', function(e) {
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

        // Show loading state
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Memproses...</span>';
        this.disabled = true;

        // Submit form
        setTimeout(() => {
            checkoutFormMobile.submit();
        }, 500);
    });

    // Required fields validation
    @if(is_array($product->required_fields) && count($product->required_fields))
        document.querySelectorAll('#checkoutFormMobile input[required]').forEach(field => {
            field.addEventListener('input', updateSubmitButtonMobile);
            field.addEventListener('blur', updateSubmitButtonMobile);
        });
    @endif

    // Initialize
    updateSubmitButtonMobile();
}

function initializeNavigation() {
    const navItems = document.querySelectorAll('.nav-item');
    const currentPath = window.location.pathname;
    
    navItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && (currentPath === href || currentPath.startsWith(href + '/'))) {
            item.classList.add('active');
        }
        
        // Add click handler for mobile
        item.addEventListener('click', function() {
            if (window.innerWidth < 768) {
                navItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });
}

function initializeFooterObserver() {
    const bottomNav = document.querySelector('.bottom-nav');
    const footer = document.querySelector('#footer');
    
    if (!bottomNav || !footer) return;
    
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    bottomNav.classList.add('hide');
                } else {
                    bottomNav.classList.remove('hide');
                }
            });
        },
        {
            root: null,
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        }
    );
    
    observer.observe(footer);
}

function setActiveNavItem() {
    const currentPath = window.location.pathname;
    const navItems = document.querySelectorAll('.nav-item');
    
    navItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href) {
            // Remove active class from all items
            item.classList.remove('active');
            
            // Check if current path matches or starts with href
            if (currentPath === href || 
                (href !== '/' && currentPath.startsWith(href)) ||
                (href === '/home' && (currentPath === '/' || currentPath === ''))) {
                item.classList.add('active');
            }
        }
    });
}

function showAlert(title, message, type = 'info') {
    // Remove existing alerts
    const existingAlerts = document.querySelectorAll('.custom-alert');
    existingAlerts.forEach(alert => alert.remove());
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `custom-alert fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg border max-w-sm animate-fadeIn ${
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
            <button class="text-gray-500 hover:text-gray-700 transition" onclick="this.parentElement.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentElement) {
            alertDiv.remove();
        }
    }, 5000);
}

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
    // Ctrl/Cmd + Enter to submit
    if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
        const submitBtn = document.getElementById('submitBtn');
        const submitBtnMobile = document.getElementById('submitBtnMobile');
        
        if (submitBtn && !submitBtn.disabled) submitBtn.click();
        if (submitBtnMobile && !submitBtnMobile.disabled) submitBtnMobile.click();
    }
    
    // Plus/Minus for quantity
    if (e.key === '+' || e.key === '=') {
        e.preventDefault();
        const plusBtn = document.getElementById('plusQty');
        const plusBtnMobile = document.getElementById('plusQtyMobile');
        plusBtn?.click();
        plusBtnMobile?.click();
    }
    
    if (e.key === '-' || e.key === '_') {
        e.preventDefault();
        const minBtn = document.getElementById('minQty');
        const minBtnMobile = document.getElementById('minQtyMobile');
        minBtn?.click();
        minBtnMobile?.click();
    }
});

// Handle form submission on mobile keyboard "Go" button
document.querySelectorAll('input[type="text"], input[type="number"]').forEach(input => {
    input.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && window.innerWidth < 768) {
            e.preventDefault();
            const submitBtnMobile = document.getElementById('submitBtnMobile');
            if (submitBtnMobile && !submitBtnMobile.disabled) {
                submitBtnMobile.click();
            }
        }
    });
});
</script>

</body>
</html>