@php
    use App\Models\Setting;
    $maintenance = optional(Setting::first())->maintenance ?? false;
@endphp

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Reset dan base styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        html {
            font-size: 16px;
        }
        
        @media (max-width: 640px) {
            html {
                font-size: 15px;
            }
        }
        
        @media (max-width: 360px) {
            html {
                font-size: 14px;
            }
        }
        
        /* Glass effect - Background akrilik HITAM PUTIH */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }
        
        /* Glass effect untuk dropdown - Warna hitam putih pure */
        .glass-dropdown {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.1),
                0 5px 25px rgba(0, 0, 0, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }
        
        .glass-dark {
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }
        
        /* Background body - HITAM PUTIH */
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
            color: #1f2937;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0) scale(1); }
            to { opacity: 0; transform: translateY(-10px) scale(0.98); }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
        
        .fade-out {
            animation: fadeOut 0.3s ease-out forwards;
        }
        
        /* Touch-friendly */
        .touch-target {
            min-height: 44px;
            min-width: 44px;
        }
        
        /* Safe areas */
        .safe-top {
            padding-top: env(safe-area-inset-top);
        }
        
        .safe-bottom {
            padding-bottom: env(safe-area-inset-bottom);
        }
        
        /* Scrollbar hitam putih */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 10px;
        }
        
        /* Responsive utilities */
        @media (max-width: 767px) {
            .mobile-hide {
                display: none !important;
            }
        }
        
        @media (min-width: 768px) {
            .desktop-hide {
                display: none !important;
            }
        }
        
        /* Active state - HITAM PUTIH */
        .active-nav {
            background: rgba(0, 0, 0, 0.05);
            color: #000;
            font-weight: 600;
        }
        
        /* Hover effect */
        .hover-lift:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease;
        }
        
        /* Focus styles for accessibility */
        *:focus {
            outline: 2px solid rgba(0, 0, 0, 0.3);
            outline-offset: 2px;
        }
        
        *:focus:not(:focus-visible) {
            outline: none;
        }

        /* =========================== */
        /* NAVBAR FLOATING AKRILIK     */
        /* =========================== */
        .nav-floating {
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            border: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow:
                0 20px 45px rgba(15, 23, 42, 0.18),
                0 0 0 1px rgba(255, 255, 255, 0.6);
        }
        
        /* ================================================ */
        /* DROPDOWN - DENGAN JARAK DARI PINGGIR */
        /* ================================================ */
        .dropdown-hover-container {
            position: relative;
            display: inline-block;
        }
        
        /* Dropdown itu sendiri - dengan pinggiran bundar ELEGAN */
        .dropdown-hover-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(12px) scale(0.98);
            margin-top: 0.75rem;
            width: 240px; /* Lebih lebar sedikit */
            
            /* Background akrilik hitam putih pure */
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            
            /* Border dengan pinggiran melengkung elegan */
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 20px; /* Lebih melengkung */
            
            /* Shadow yang lebih soft dan elegan */
            box-shadow: 
                0 25px 70px rgba(0, 0, 0, 0.12),
                0 10px 35px rgba(0, 0, 0, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            
            padding: 12px 8px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 100;
            pointer-events: none;
        }
        
        /* Dropdown tidak nempel di pinggir - ada margin */
        .dropdown-hover-menu::after {
            content: '';
            position: absolute;
            top: 0;
            left: -20px;
            right: -20px;
            height: 100%;
            z-index: -1;
        }
        
        /* Class untuk dropdown terbuka */
        .dropdown-open .dropdown-hover-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0) scale(1);
            pointer-events: auto;
        }
        
        /* Hover pada tombol Store */
        .dropdown-open .dropdown-button {
            background-color: rgba(0, 0, 0, 0.05);
            color: #000;
        }
        
        /* Hover pada tombol Store - icon chevron */
        .dropdown-open .dropdown-button .fa-chevron-down {
            transform: rotate(180deg);
            color: #000;
        }
        
        /* Arrow/pointer untuk dropdown - HITAM PUTIH */
        .dropdown-hover-menu::before {
            content: '';
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%) rotate(45deg);
            width: 16px;
            height: 16px;
            
            /* Background akrilik sama dengan dropdown */
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            
            border-left: 1px solid rgba(0, 0, 0, 0.1);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 3px;
        }
        
        /* Item di dalam dropdown - WARNA HITAM PUTIH MURNI */
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            margin: 4px 8px;
            
            /* Warna teks hitam murni */
            color: #000 !important;
            text-decoration: none;
            border-radius: 14px; /* Pinggiran item lebih melengkung */
            
            /* Transisi halus */
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            
            /* Border subtle */
            border: 1px solid transparent;
        }
        
        /* Hover effect pada item - gray subtle */
        .dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.04) !important;
            transform: translateX(6px);
            color: #000 !important;
            border-color: rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }
        
        /* Icon di dalam dropdown item - hitam */
        .dropdown-item i {
            color: #000 !important;
            font-size: 15px;
            width: 20px;
            text-align: center;
            transition: transform 0.2s ease;
        }
        
        .dropdown-item:hover i {
            transform: scale(1.1);
        }
        
        /* Text di dalam dropdown */
        .dropdown-item span {
            font-size: 15px;
            font-weight: 500;
            color: #000;
            letter-spacing: -0.01em;
        }
        
        /* Tombol dropdown - styling khusus HITAM PUTIH */
        .dropdown-button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 11px 18px;
            border-radius: 14px;
            font-weight: 500;
            color: #1f2937;
            transition: all 0.25s ease;
            cursor: default;
            border: 1px solid transparent;
        }
        
        .dropdown-button:hover {
            background-color: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.05);
        }
        
        /* Icon chevron di tombol */
        .dropdown-button .fa-chevron-down {
            font-size: 12px;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            color: #6b7280;
        }
        
        /* Mobile sidebar dropdown */
        details[open] summary i.fa-chevron-down {
            transform: rotate(180deg);
        }
        
        details summary {
            list-style: none;
        }
        
        details summary::-webkit-details-marker {
            display: none;
        }
        
        /* Animation for mobile sidebar dropdown */
        details > div {
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Prevent text selection on dropdown */
        .dropdown-hover-container {
            user-select: none;
        }
        
        /* Container untuk pastikan dropdown tidak nempel pinggir */
        .dropdown-wrapper {
            position: relative;
        }
        
        /* Card styles untuk konten - HITAM PUTIH */
        .card-glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }
        
        /* Divider untuk dropdown */
        .dropdown-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.06);
            margin: 8px 16px;
        }
        
        /* ================================================ */
        /* PROFILE DROPDOWN KHUSUS                          */
        /* ================================================ */
        .profile-dropdown-container {
            position: relative;
            display: inline-block;
        }
        
        .profile-dropdown-button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 14px;
            font-weight: 500;
            color: #1f2937;
            transition: all 0.25s ease;
            cursor: pointer;
            border: 1px solid transparent;
        }
        
        .profile-dropdown-button:hover {
            background-color: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.05);
        }
        
        .profile-dropdown-open .profile-dropdown-button {
            background-color: rgba(0, 0, 0, 0.05);
            color: #000;
        }
        
        .profile-dropdown-open .profile-dropdown-button .fa-chevron-down {
            transform: rotate(180deg);
            color: #000;
        }
        
        .profile-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            transform: translateY(12px) scale(0.98);
            margin-top: 0.75rem;
            width: 200px; /* Lebar disesuaikan untuk 4 item */
            
            /* Background akrilik hitam putih pure dengan efek glass lebih kuat */
            background: rgba(255, 255, 255, 0.99) !important;
            backdrop-filter: blur(35px);
            -webkit-backdrop-filter: blur(35px);
            
            /* Border dengan pinggiran melengkung elegan */
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 18px;
            
            /* Shadow yang lebih soft dan elegan */
            box-shadow: 
                0 25px 70px rgba(0, 0, 0, 0.15),
                0 12px 40px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.95);
            
            padding: 12px 8px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 110;
            pointer-events: none;
        }
        
        .profile-dropdown-open .profile-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }
        
        .profile-dropdown-menu::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 20px;
            transform: rotate(45deg);
            width: 16px;
            height: 16px;
            
            /* Background akrilik sama dengan dropdown */
            background: rgba(255, 255, 255, 0.99);
            backdrop-filter: blur(35px);
            -webkit-backdrop-filter: blur(35px);
            
            border-left: 1px solid rgba(0, 0, 0, 0.1);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 3px;
        }
        
        .profile-dropdown-header {
            padding: 16px;
            margin-bottom: 8px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }
        
        .profile-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .profile-text h3 {
            font-size: 15px;
            font-weight: 600;
            color: #000;
            margin-bottom: 2px;
        }
        
        .profile-text p {
            font-size: 12px;
            color: #666;
        }
        
        .profile-dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin: 4px 8px;
            color: #000 !important;
            text-decoration: none;
            border-radius: 14px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid transparent;
        }
        
        .profile-dropdown-item:hover {
            background-color: rgba(0, 0, 0, 0.04) !important;
            transform: translateX(4px);
            color: #000 !important;
            border-color: rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }
        
        .profile-dropdown-item i {
            color: #000 !important;
            font-size: 15px;
            width: 20px;
            text-align: center;
            transition: transform 0.2s ease;
        }
        
        .profile-dropdown-item:hover i {
            transform: scale(1.1);
        }
        
        .profile-dropdown-item span {
            font-size: 14px;
            font-weight: 500;
            color: #000;
            letter-spacing: -0.01em;
        }
        
        .profile-dropdown-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.06);
            margin: 8px 16px;
        }
        
        .logout-item {
            background-color: rgba(239, 68, 68, 0.05);
        }
        
        .logout-item:hover {
            background-color: rgba(239, 68, 68, 0.1) !important;
        }
        
        .logout-item i {
            color: #ef4444 !important;
        }
        
        .logout-item span {
            color: #ef4444 !important;
        }
        
        /* Profile menu compact - tanpa header */
        .profile-menu-compact {
            padding: 12px 8px !important;
        }
        
        /* ================================================ */
        /* PROFILE DROPDOWN MOBILE KHUSUS                   */
        /* ================================================ */
        .profile-dropdown-mobile-container {
            position: relative;
            display: inline-block;
        }
        
        .profile-dropdown-mobile-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            transition: all 0.25s ease;
            cursor: pointer;
            border: 1px solid transparent;
        }
        
        .profile-dropdown-mobile-button:hover {
            background-color: rgba(0, 0, 0, 0.04);
            border-color: rgba(0, 0, 0, 0.05);
        }
        
        .profile-dropdown-mobile-open .profile-dropdown-mobile-button {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        .profile-dropdown-mobile-menu {
            position: absolute;
            top: 100%;
            right: 0;
            transform: translateY(12px) scale(0.98);
            margin-top: 0.75rem;
            width: 200px; /* Lebar disesuaikan untuk 4 item */
            
            /* Background akrilik hitam putih pure */
            background: rgba(255, 255, 255, 0.99) !important;
            backdrop-filter: blur(35px);
            -webkit-backdrop-filter: blur(35px);
            
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 18px;
            
            box-shadow: 
                0 25px 70px rgba(0, 0, 0, 0.15),
                0 12px 40px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.95);
            
            padding: 12px 8px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 120;
            pointer-events: none;
        }
        
        .profile-dropdown-mobile-open .profile-dropdown-mobile-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }
        
        .profile-dropdown-mobile-menu::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 15px;
            transform: rotate(45deg);
            width: 16px;
            height: 16px;
            
            background: rgba(255, 255, 255, 0.99);
            backdrop-filter: blur(35px);
            -webkit-backdrop-filter: blur(35px);
            
            border-left: 1px solid rgba(0, 0, 0, 0.1);
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 3px;
        }
        
        .profile-dropdown-mobile-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            margin: 4px 8px;
            color: #000 !important;
            text-decoration: none;
            border-radius: 14px;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid transparent;
        }
        
        .profile-dropdown-mobile-item:hover {
            background-color: rgba(0, 0, 0, 0.04) !important;
            transform: translateX(4px);
            color: #000 !important;
            border-color: rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }
        
        .profile-dropdown-mobile-item i {
            color: #000 !important;
            font-size: 15px;
            width: 20px;
            text-align: center;
            transition: transform 0.2s ease;
        }
        
        .profile-dropdown-mobile-item:hover i {
            transform: scale(1.1);
        }
        
        .profile-dropdown-mobile-item span {
            font-size: 14px;
            font-weight: 500;
            color: #000;
            letter-spacing: -0.01em;
        }
        
        .profile-avatar-mobile {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="min-h-screen safe-top">

    <!-- MOBILE SIDEBAR BACKDROP -->
    <div id="sidebar-backdrop"
         class="fixed inset-0 bg-black/20 z-40 hidden glass-dark transition-opacity duration-300"></div>

    <!-- MOBILE SIDEBAR -->
    <div id="mobile-sidebar"
         class="fixed top-0 left-0 w-72 h-full glass-effect shadow-2xl transform -translate-x-full transition-transform duration-300 z-50 custom-scrollbar overflow-y-auto">

        <!-- Sidebar Header -->
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center shadow-md">
                    <i class="fas fa-store text-white"></i>
                </div>
                <div>
                    <h2 class="font-bold text-gray-900">Menu</h2>
                    <p class="text-xs text-gray-600">Navigation</p>
                </div>
            </div>
            <button onclick="toggleSidebar()" class="touch-target w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100">
                <i class="fas fa-times text-gray-700"></i>
            </button>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 p-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'active-nav' : '' }} touch-target">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-900 text-white">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <span class="font-medium flex-1">Dashboard</span>
            </a>

            <!-- Store Dropdown Mobile -->
            <details class="group">
                <summary class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 cursor-pointer touch-target">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-800">
                        <i class="fas fa-store"></i>
                    </div>
                    <span class="font-medium flex-1">Store</span>
                    <i class="fas fa-chevron-down text-xs text-gray-500 transition-transform duration-200"></i>
                </summary>
                <div class="ml-11 mt-2 space-y-1">
                    <a href="{{ route('admin.categories.index') }}" 
                       class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.categories.*') ? 'active-nav' : '' }} touch-target">
                        <i class="fas fa-tag text-xs text-gray-700 w-4"></i>
                        <span class="text-sm text-gray-800">Kategori</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}" 
                       class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.products.*') ? 'active-nav' : '' }} touch-target">
                        <i class="fas fa-box text-xs text-gray-700 w-4"></i>
                        <span class="text-sm text-gray-800">Product</span>
                    </a>
                    <a href="{{ route('admin.items.index') }}" 
                       class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.items.*') ? 'active-nav' : '' }} touch-target">
                        <i class="fas fa-cube text-xs text-gray-700 w-4"></i>
                        <span class="text-sm text-gray-800">Items</span>
                    </a>
                    <a href="{{ route('admin.stocks.index') }}" 
                       class="flex items-center gap-2 p-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.stocks.*') ? 'active-nav' : '' }} touch-target">
                        <i class="fas fa-layer-group text-xs text-gray-700 w-4"></i>
                        <span class="text-sm text-gray-800">Stock</span>
                    </a>
                </div>
            </details>

            <!-- Transaksi -->
            <a href="{{ route('admin.transactions.index') }}" 
               class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 {{ request()->routeIs('admin.transactions.*') ? 'active-nav' : '' }} touch-target">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-800">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <span class="font-medium flex-1">Transaksi</span>
            </a>

            <!-- Redeem -->
            <a href="{{ route('admin.redeem.index') }}" 
               class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 {{ request()->routeIs('admin.redeem.*') ? 'active-nav' : '' }} touch-target">
                <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-800">
                    <i class="fas fa-gift"></i>
                </div>
                <span class="font-medium flex-1">Redeem</span>
            </a>
            
            <!-- Profile Dropdown Mobile - MENJADI 5 ITEM (DITAMBAH MAINTENANCE) -->
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="space-y-1">
                    <a href="/home" 
                       class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 touch-target">
                        <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-800">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="font-medium flex-1">Home</span>
                    </a>
                    
                    <a href="/profile" 
                       class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 touch-target">
                        <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-800">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="font-medium flex-1">Profile</span>
                    </a>
                    
                    <a href="{{ route('admin.manage-users') }}" 
                       class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 {{ request()->routeIs('admin.manage-users') ? 'active-nav' : '' }} touch-target">
                        <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-800">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <span class="font-medium flex-1">Manage User</span>
                    </a>
                    
                    <!-- TOMBOL MAINTENANCE DI SIDEBAR MOBILE -->
                    <button
                        type="button"
                        onclick="toggleMaintenance()"
                        class="w-full flex items-center justify-between gap-3 p-3 rounded-xl hover:bg-gray-50 touch-target text-left">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-800">
                                <i class="fas fa-tools"></i>
                            </div>
                            <span class="font-medium flex-1">Maintenance</span>
                        </div>
                        
                        <span id="maintenanceStatusSidebarMobile"
                            class="text-xs font-semibold px-3 py-1 rounded-full
                            {{ $maintenance ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                            {{ $maintenance ? 'ON' : 'OFF' }}
                        </span>
                    </button>
                    
                    <a href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="flex items-center gap-3 p-3 rounded-xl hover:bg-red-50 touch-target logout-item">
                        <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-100 text-red-600">
                            <i class="fas fa-sign-out-alt"></i>
                        </div>
                        <span class="font-medium flex-1 text-red-600">Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <!-- DESKTOP NAVBAR - FLOATING AKRILIK -->
    <header class="mobile-hide sticky top-4 z-30 px-4">
        <div class="nav-floating max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center shadow-md">
                    <i class="fas fa-store text-white"></i>
                </div>
                <div>
                    <h1 class="font-bold text-gray-900 text-xl">Dashboard</h1>
                    <p class="text-xs text-gray-600 hidden lg:block">Management System</p>
                </div>
            </div>

            <!-- Navigation - DROPDOWN HITAM PUTIH -->
            <nav class="flex items-center gap-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="px-5 py-3 rounded-xl font-medium transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'active-nav' : '' }}">
                    <i class="fas fa-chart-pie mr-2"></i>
                    Dashboard
                </a>
                
                <!-- Store Dropdown - TIDAK NEMPEL PINGGIR -->
                <div class="dropdown-hover-container" id="storeDropdown">
                    <div class="dropdown-button">
                        <i class="fas fa-store mr-2"></i>
                        Store
                        <i class="fas fa-chevron-down ml-1"></i>
                    </div>
                    <div class="dropdown-hover-menu glass-dropdown">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="dropdown-item {{ request()->routeIs('admin.categories.*') ? 'active-nav' : '' }}">
                            <i class="fas fa-tag"></i>
                            <span>Kategori</span>
                        </a>
                        <a href="{{ route('admin.products.index') }}" 
                           class="dropdown-item {{ request()->routeIs('admin.products.*') ? 'active-nav' : '' }}">
                            <i class="fas fa-box"></i>
                            <span>Product</span>
                        </a>
                        <a href="{{ route('admin.items.index') }}" 
                           class="dropdown-item {{ request()->routeIs('admin.items.*') ? 'active-nav' : '' }}">
                            <i class="fas fa-cube"></i>
                            <span>Items</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.stocks.index') }}" 
                           class="dropdown-item {{ request()->routeIs('admin.stocks.*') ? 'active-nav' : '' }}">
                            <i class="fas fa-layer-group"></i>
                            <span>Stock</span>
                        </a>
                    </div>
                </div>
                
                <a href="{{ route('admin.transactions.index') }}" 
                   class="px-5 py-3 rounded-xl hover:bg-gray-100 font-medium transition-colors duration-200 {{ request()->routeIs('admin.transactions.*') ? 'active-nav' : '' }}">
                    <i class="fas fa-exchange-alt mr-2"></i>
                    Transaksi
                </a>
                
                <a href="{{ route('admin.redeem.index') }}" 
                   class="px-5 py-3 rounded-xl hover:bg-gray-100 font-medium transition-colors duration-200 {{ request()->routeIs('admin.redeem.*') ? 'active-nav' : '' }}">
                    <i class="fas fa-gift mr-2"></i>
                    Redeem
                </a>
            </nav>

            <!-- User Profile dengan Dropdown - HITAM PUTIH (5 ITEM) -->
            <div class="profile-dropdown-container" id="profileDropdown">
                <div class="profile-dropdown-button">
                    <div class="w-9 h-9 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                                 alt="Profile"
                                 class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-800 font-bold text-sm">
                                {{ strtoupper(Auth::user()->name[0]) }}
                            </span>
                        @endif
                    </div>
                    <div class="hidden lg:block">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-600">{{ Auth::user()->role }}</p>
                    </div>
                    <i class="fas fa-chevron-down ml-1 text-xs text-gray-500"></i>
                </div>
                <div class="profile-dropdown-menu glass-dropdown profile-menu-compact">
                    <!-- 5 ITEM: BERANDA, PROFILE, MANAGE USER, MAINTENANCE, LOGOUT -->
                    <a href="/home" class="profile-dropdown-item">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                    
                    <a href="/profile" class="profile-dropdown-item">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                    
                    <a href="{{ route('admin.manage-users') }}" 
                       class="profile-dropdown-item {{ request()->routeIs('admin.manage-users') ? 'active-nav' : '' }}">
                        <i class="fas fa-users-cog"></i>
                        <span>Manage User</span>
                    </a>
                    
                    <!-- MAINTENANCE ITEM -->
                    <div class="profile-dropdown-divider"></div>
                    
                    <button
                        type="button"
                        onclick="toggleMaintenance()"
                        class="profile-dropdown-item w-full flex justify-between items-center">
                        
                        <div class="flex items-center gap-3">
                            <i class="fas fa-tools"></i>
                            <span>Maintenance</span>
                        </div>
                        
                        <span id="maintenanceStatus"
                            class="text-xs font-semibold px-3 py-1 rounded-full
                            {{ $maintenance ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                            {{ $maintenance ? 'ON' : 'OFF' }}
                        </span>
                    </button>
                    
                    <a href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="profile-dropdown-item logout-item">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- MOBILE NAVBAR - NOTIFIKASI DIGANTI DENGAN FOTO PROFIL -->
    <header class="desktop-hide glass-effect shadow-sm px-4 py-3 sticky top-0 z-30">
        <div class="flex items-center justify-between">
            <!-- Menu Button -->
            <button onclick="toggleSidebar()" class="touch-target w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100">
                <i class="fas fa-bars text-gray-700"></i>
            </button>

            <!-- Logo -->
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                    <i class="fas fa-store text-white text-sm"></i>
                </div>
                <span class="font-bold text-gray-900">Dashboard</span>
            </div>

            <!-- Profile Dropdown Mobile - MENGGANTIKAN NOTIFIKASI -->
            <div class="profile-dropdown-mobile-container" id="profileDropdownMobile">
                <div class="profile-dropdown-mobile-button">
                    <div class="w-9 h-9 rounded-full overflow-hidden bg-gray-200 flex items-center justify-center">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                                 alt="Profile"
                                 class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-800 font-bold text-sm">
                                {{ strtoupper(Auth::user()->name[0]) }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="profile-dropdown-mobile-menu glass-dropdown">
                    <!-- 5 ITEM: BERANDA, PROFILE, MANAGE USER, MAINTENANCE, LOGOUT -->
                    <a href="/home" class="profile-dropdown-mobile-item">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                    
                    <a href="/profile" class="profile-dropdown-mobile-item">
                        <i class="fas fa-user"></i>
                        <span>Profile</span>
                    </a>
                    
                    <a href="{{ route('admin.manage-users') }}" 
                       class="profile-dropdown-mobile-item {{ request()->routeIs('admin.manage-users') ? 'active-nav' : '' }}">
                        <i class="fas fa-users-cog"></i>
                        <span>Manage User</span>
                    </a>
                    
                    <!-- MAINTENANCE ITEM MOBILE -->
                    <div class="profile-dropdown-divider"></div>
                    
                    <button
                        type="button"
                        onclick="toggleMaintenance()"
                        class="profile-dropdown-mobile-item w-full flex justify-between items-center">
                        
                        <div class="flex items-center gap-3">
                            <i class="fas fa-tools"></i>
                            <span>Maintenance</span>
                        </div>
                        
                        <span id="maintenanceStatusMobile"
                            class="text-xs font-semibold px-3 py-1 rounded-full
                            {{ $maintenance ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' }}">
                            {{ $maintenance ? 'ON' : 'OFF' }}
                        </span>
                    </button>
                    
                    <a href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                       class="profile-dropdown-mobile-item logout-item">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>

    <script>
        // Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById("mobile-sidebar");
            const backdrop = document.getElementById("sidebar-backdrop");
            
            const isOpen = !sidebar.classList.contains("-translate-x-full");
            
            if (isOpen) {
                // Close sidebar
                sidebar.classList.add("-translate-x-full");
                backdrop.classList.add("hidden");
                document.body.style.overflow = 'auto';
            } else {
                // Open sidebar
                sidebar.classList.remove("-translate-x-full");
                backdrop.classList.remove("hidden");
                document.body.style.overflow = 'hidden';
            }
        }
        
        // Close sidebar when clicking backdrop
        document.getElementById('sidebar-backdrop').addEventListener('click', toggleSidebar);
        
        // Close sidebar with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                const sidebar = document.getElementById("mobile-sidebar");
                if (!sidebar.classList.contains("-translate-x-full")) {
                    toggleSidebar();
                }
            }
        });
        
        // Auto-close sidebar on larger screens
        function handleResize() {
            const sidebar = document.getElementById("mobile-sidebar");
            const backdrop = document.getElementById("sidebar-backdrop");
            
            if (window.innerWidth >= 768) {
                if (!sidebar.classList.contains("-translate-x-full")) {
                    sidebar.classList.add("-translate-x-full");
                    backdrop.classList.add("hidden");
                    document.body.style.overflow = 'auto';
                }
            }
        }
        
        // Debounced resize handler
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(handleResize, 250);
        });
        
        // Initialize sidebar state
        window.addEventListener('DOMContentLoaded', () => {
            handleResize();
            initDropdownStayInArea();
            initProfileDropdown();
            initProfileDropdownMobile();
        });
        
        // Fungsi untuk dropdown yang tetap terbuka di area pilihan
        function initDropdownStayInArea() {
            const dropdownContainer = document.querySelector('.dropdown-hover-container');
            const dropdownButton = document.querySelector('.dropdown-button');
            const dropdownMenu = document.querySelector('.dropdown-hover-menu');
            
            if (!dropdownContainer || !dropdownMenu) return;
            
            let isMouseInDropdown = false;
            let hoverTimeout = null;
            
            // Fungsi untuk membuka dropdown
            function openDropdown() {
                clearTimeout(hoverTimeout);
                dropdownContainer.classList.add('dropdown-open');
                isMouseInDropdown = true;
            }
            
            // Fungsi untuk menutup dropdown
            function closeDropdown() {
                hoverTimeout = setTimeout(() => {
                    if (!isMouseInDropdown) {
                        dropdownContainer.classList.remove('dropdown-open');
                    }
                }, 100); // Delay kecil untuk menghindari flicker
            }
            
            // Event listener untuk mouse masuk ke container (tombol Store)
            dropdownContainer.addEventListener('mouseenter', () => {
                isMouseInDropdown = true;
                openDropdown();
            });
            
            // Event listener untuk mouse keluar dari container
            dropdownContainer.addEventListener('mouseleave', (e) => {
                // Cek apakah mouse pindah ke dropdown menu
                const relatedTarget = e.relatedTarget;
                const isGoingToDropdown = dropdownMenu.contains(relatedTarget);
                
                if (!isGoingToDropdown) {
                    isMouseInDropdown = false;
                    closeDropdown();
                }
            });
            
            // Event listener untuk mouse masuk ke dropdown menu
            dropdownMenu.addEventListener('mouseenter', () => {
                isMouseInDropdown = true;
                clearTimeout(hoverTimeout);
                dropdownContainer.classList.add('dropdown-open');
            });
            
            // Event listener untuk mouse keluar dari dropdown menu
            dropdownMenu.addEventListener('mouseleave', (e) => {
                // Cek apakah mouse pindah ke tombol Store
                const relatedTarget = e.relatedTarget;
                const isGoingToButton = dropdownButton.contains(relatedTarget) || 
                                       dropdownContainer.contains(relatedTarget);
                
                if (!isGoingToButton) {
                    isMouseInDropdown = false;
                    closeDropdown();
                }
            });
            
            // Tambahkan event untuk seluruh dokumen untuk memastikan dropdown menutup
            document.addEventListener('mousemove', (e) => {
                if (!dropdownContainer.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    isMouseInDropdown = false;
                    closeDropdown();
                }
            });
        }
        
        // Fungsi untuk menginisialisasi dropdown profile desktop
        function initProfileDropdown() {
            const profileContainer = document.getElementById('profileDropdown');
            if (!profileContainer) return;
            
            const profileButton = profileContainer.querySelector('.profile-dropdown-button');
            const profileMenu = profileContainer.querySelector('.profile-dropdown-menu');
            
            if (!profileMenu) return;
            
            let isProfileDropdownOpen = false;
            let profileHoverTimeout = null;
            
            // Toggle dropdown profile
            function toggleProfileDropdown() {
                isProfileDropdownOpen = !isProfileDropdownOpen;
                if (isProfileDropdownOpen) {
                    profileContainer.classList.add('profile-dropdown-open');
                } else {
                    profileContainer.classList.remove('profile-dropdown-open');
                }
            }
            
            // Fungsi untuk membuka dropdown profile
            function openProfileDropdown() {
                clearTimeout(profileHoverTimeout);
                profileContainer.classList.add('profile-dropdown-open');
                isProfileDropdownOpen = true;
            }
            
            // Fungsi untuk menutup dropdown profile
            function closeProfileDropdown() {
                profileHoverTimeout = setTimeout(() => {
                    if (isProfileDropdownOpen) {
                        profileContainer.classList.remove('profile-dropdown-open');
                        isProfileDropdownOpen = false;
                    }
                }, 100); // Delay kecil untuk menghindari flicker
            }
            
            // Event listener untuk klik pada tombol profile
            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleProfileDropdown();
            });
            
            // Event listener untuk mouse masuk ke container profile
            profileContainer.addEventListener('mouseenter', () => {
                openProfileDropdown();
            });
            
            // Event listener untuk mouse keluar dari container profile
            profileContainer.addEventListener('mouseleave', (e) => {
                // Cek apakah mouse pindah ke dropdown menu
                const relatedTarget = e.relatedTarget;
                const isGoingToDropdown = profileMenu.contains(relatedTarget);
                
                if (!isGoingToDropdown) {
                    closeProfileDropdown();
                }
            });
            
            // Event listener untuk mouse masuk ke dropdown menu profile
            profileMenu.addEventListener('mouseenter', () => {
                clearTimeout(profileHoverTimeout);
                profileContainer.classList.add('profile-dropdown-open');
                isProfileDropdownOpen = true;
            });
            
            // Event listener untuk mouse keluar dari dropdown menu profile
            profileMenu.addEventListener('mouseleave', (e) => {
                // Cek apakah mouse pindah ke tombol profile
                const relatedTarget = e.relatedTarget;
                const isGoingToButton = profileButton.contains(relatedTarget) || 
                                       profileContainer.contains(relatedTarget);
                
                if (!isGoingToButton) {
                    closeProfileDropdown();
                }
            });
            
            // Tutup dropdown profile saat klik di luar
            document.addEventListener('click', (e) => {
                if (!profileContainer.contains(e.target)) {
                    profileContainer.classList.remove('profile-dropdown-open');
                    isProfileDropdownOpen = false;
                }
            });
            
            // Tutup dropdown profile dengan Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && isProfileDropdownOpen) {
                    profileContainer.classList.remove('profile-dropdown-open');
                    isProfileDropdownOpen = false;
                }
            });
            
            // Tutup dropdown profile saat klik item
            profileMenu.querySelectorAll('a, button').forEach(element => {
                element.addEventListener('click', () => {
                    profileContainer.classList.remove('profile-dropdown-open');
                    isProfileDropdownOpen = false;
                });
            });
        }
        
        // Fungsi untuk menginisialisasi dropdown profile MOBILE
        function initProfileDropdownMobile() {
            const profileContainer = document.getElementById('profileDropdownMobile');
            if (!profileContainer) return;
            
            const profileButton = profileContainer.querySelector('.profile-dropdown-mobile-button');
            const profileMenu = profileContainer.querySelector('.profile-dropdown-mobile-menu');
            
            if (!profileMenu) return;
            
            let isProfileDropdownMobileOpen = false;
            
            // Toggle dropdown profile mobile
            function toggleProfileDropdownMobile() {
                isProfileDropdownMobileOpen = !isProfileDropdownMobileOpen;
                if (isProfileDropdownMobileOpen) {
                    profileContainer.classList.add('profile-dropdown-mobile-open');
                } else {
                    profileContainer.classList.remove('profile-dropdown-mobile-open');
                }
            }
            
            // Event listener untuk klik pada tombol profile mobile
            profileButton.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleProfileDropdownMobile();
            });
            
            // Tutup dropdown profile mobile saat klik di luar
            document.addEventListener('click', (e) => {
                if (!profileContainer.contains(e.target) && isProfileDropdownMobileOpen) {
                    profileContainer.classList.remove('profile-dropdown-mobile-open');
                    isProfileDropdownMobileOpen = false;
                }
            });
            
            // Tutup dropdown profile mobile dengan Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && isProfileDropdownMobileOpen) {
                    profileContainer.classList.remove('profile-dropdown-mobile-open');
                    isProfileDropdownMobileOpen = false;
                }
            });
            
            // Tutup dropdown profile mobile saat klik item
            profileMenu.querySelectorAll('a, button').forEach(element => {
                element.addEventListener('click', () => {
                    profileContainer.classList.remove('profile-dropdown-mobile-open');
                    isProfileDropdownMobileOpen = false;
                });
            });
        }
        
        // Active navigation
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                
                // Remove active class from all links
                document.querySelectorAll('nav a').forEach(l => {
                    l.classList.remove('active-nav');
                });
                
                // Add active class to clicked link
                this.classList.add('active-nav');
                
                // Close mobile sidebar if open
                const sidebar = document.getElementById("mobile-sidebar");
                if (!sidebar.classList.contains("-translate-x-full")) {
                    toggleSidebar();
                }
            });
        });
        
        // Touch feedback
        document.querySelectorAll('.touch-target').forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.opacity = '0.8';
            });
            
            element.addEventListener('touchend', function() {
                this.style.opacity = '1';
            });
        });
        
        // Initialize mobile dropdowns
        document.querySelectorAll('details').forEach(detail => {
            const summary = detail.querySelector('summary');
            const icon = summary.querySelector('.fa-chevron-down');
            
            summary.addEventListener('click', () => {
                if (detail.open) {
                    icon.style.transform = 'rotate(180deg)';
                } else {
                    icon.style.transform = 'rotate(0deg)';
                }
            });
        });
    </script>

    <script>
        let maintenanceLoading = false;

        function toggleMaintenance() {
            if (maintenanceLoading) return;

            maintenanceLoading = true;

            fetch("{{ route('admin.maintenance.toggle') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                }
            })
            .then(res => {
                if (!res.ok) throw new Error('Request failed');
                return res.json();
            })
            .then(data => {
                const isOn = data.status === true;

                // Update semua indikator maintenance
                const update = (id) => {
                    const el = document.getElementById(id);
                    if (!el) return;

                    el.textContent = isOn ? 'ON' : 'OFF';
                    el.className =
                        'text-xs font-semibold px-3 py-1 rounded-full ' +
                        (isOn
                            ? 'bg-red-100 text-red-600'
                            : 'bg-green-100 text-green-600');
                };

                // Update semua status indicator
                update('maintenanceStatus');                 // Desktop profile dropdown
                update('maintenanceStatusMobile');           // Mobile navbar dropdown
                update('maintenanceStatusSidebarMobile');    // Mobile sidebar button
            })
            .catch(() => {
                alert('Gagal toggle maintenance');
            })
            .finally(() => {
                maintenanceLoading = false;
            });
        }
    </script>

</body>
</html>