<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun - PARI ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            background: #f4f6fa;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .pb-safe { padding-bottom: env(safe-area-inset-bottom); }
        
        .profile-frame {
            position: relative;
            animation: pulse-border 3s ease-in-out infinite;
        }
        @keyframes pulse-border {
            0%, 100% { box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.1); }
            50% { box-shadow: 0 0 0 8px rgba(0, 0, 0, 0.05); }
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.12);
        }
        
        .file-input-hidden {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .camera-icon-container {
            position: absolute;
            bottom: 0;
            right: 0;
            transform: translate(25%, 25%);
            z-index: 10;
        }
        
        .camera-icon {
            width: 45px;     
            height: 45px;        
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            border-radius: 50%;   
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .camera-icon:hover {
            transform: scale(1.1);
        }
        
        .profile-image-container {
            position: relative;
            display: inline-block;
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert-slide-in {
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Status Badge Styles */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-badge.ready {
            background: rgba(34, 197, 94, 0.1);
            color: #16a34a;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }
        
        .status-badge.waiting {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .status-badge.admin {
            background: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        /* NAVBAR STYLES - Konsisten */
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

        .nav-desktop a.active {
            color: #18181b;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-zinc-900">

    <!-- MOBILE HEADER -->
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

    <!-- DESKTOP NAVIGATION -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-zinc-200/80 hidden md:block">
        <div class="container mx-auto max-w-6xl px-4 h-16 flex items-center justify-between">
            
            <div class="flex items-center gap-2">
                <a href="/home" class="flex items-center gap-2 hover:opacity-80 transition">
                    <img src="{{ asset('images/logo.jpg') }}" alt="PARI ID" class="hidden md:block h-8 w-auto object-contain">
                    <span class="md:hidden font-bold text-xl text-zinc-900">PARI ID X CYAA STORE</span>
                </a>
            </div>

            <div class="flex items-center gap-8 nav-desktop">
                <a href="/home" class="text-sm font-medium {{ request()->is('home') ? 'text-zinc-900 active' : 'text-zinc-500 hover:text-zinc-900' }}">Home</a>
                <a href="/top-buyers" class="text-sm font-medium {{ request()->is('top-buyers') ? 'text-zinc-900 active' : 'text-zinc-500 hover:text-zinc-900' }}">Top</a>
                <a href="/riwayat" class="text-sm font-medium {{ request()->is('riwayat') ? 'text-zinc-900 active' : 'text-zinc-500 hover:text-zinc-900' }}">Riwayat</a>
                <a href="/redeem" class="text-sm font-medium {{ request()->is('redeem') ? 'text-zinc-900 active' : 'text-zinc-500 hover:text-zinc-900' }}">Redeem</a>
                <a href="/profile" class="text-sm font-medium {{ request()->is('profile') ? 'text-zinc-900 active' : 'text-zinc-500 hover:text-zinc-900' }}">Akun</a>
                <a href="/information" class="text-sm font-medium {{ request()->is('information') ? 'text-zinc-900 active' : 'text-zinc-500 hover:text-zinc-900' }}">Info</a>
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class="text-sm font-medium {{ request()->is('admin*') ? 'text-zinc-900 active' : 'text-zinc-500 hover:text-zinc-900' }}">Admin</a>
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

    <!-- MAIN CONTENT -->
    <main class="container mx-auto max-w-6xl px-5 py-5 space-y-6">
        
        @if(session('success'))
            <div class="bg-white border-l-4 border-green-500 rounded-xl p-4 mb-6 shadow-md alert-slide-in max-w-3xl mx-auto" role="alert">
                <div class="flex items-center">
                    <div class="bg-green-100 rounded-full p-2 mr-3">
                        <span class="iconify text-sm text-green-600" data-icon="lucide:check"></span>
                    </div>
                    <p class="font-medium text-zinc-900 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-white border-l-4 border-red-500 rounded-xl p-4 mb-6 shadow-md alert-slide-in max-w-3xl mx-auto" role="alert">
                <div class="flex items-center">
                    <div class="bg-red-100 rounded-full p-2 mr-3">
                        <span class="iconify text-sm text-red-600" data-icon="lucide:alert-circle"></span>
                    </div>
                    <p class="font-medium text-zinc-900 text-sm">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- LEFT SIDEBAR - Profile Info -->
            <div class="lg:col-span-1 order-1 lg:order-1">
                <div class="bg-white rounded-2xl shadow-lg border border-zinc-200 overflow-hidden card-hover fade-in">
                    <div class="p-6 sm:p-8">
                        <div class="flex flex-col items-center">
                            <div class="profile-image-container mb-6">
                                <div class="profile-frame rounded-full p-1 bg-gradient-to-br from-zinc-900 to-zinc-600">
                                    @if($user->profile_photo)
                                        <img id="profile-image" class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-white" src="{{ asset('storage/profile/'.$user->profile_photo) }}" alt="Foto Profil">
                                    @else
                                        <img id="profile-image" class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover bg-zinc-200 border-4 border-white" src="{{ asset('images/default_pp.jpg') }}" alt="Foto Profil Default">
                                    @endif
                                </div>
                                
                                <form id="photo-form" action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" id="file-input" name="photo" accept="image/*" class="file-input-hidden">
                                    <div class="camera-icon-container">
                                        <label for="file-input" class="camera-icon">
                                            <span class="iconify text-white" data-icon="lucide:camera"></span>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            
                            <h2 class="text-xl sm:text-2xl font-semibold text-zinc-900 mb-1 text-center">{{ $user->name }}</h2>
                            <p class="text-zinc-600 text-xs sm:text-sm mb-6">
                                Member sejak {{ $user->created_at->translatedFormat('d F Y') }}
                            </p>
                            
                            <!-- Status Perubahan -->
                            <div class="w-full mb-6 space-y-3">
                                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-zinc-50 to-zinc-100 rounded-xl">
                                    <div class="flex items-center gap-2">
                                        <span class="iconify text-zinc-600" data-icon="lucide:user-cog"></span>
                                        <span class="text-xs font-medium text-zinc-700">Status Username:</span>
                                    </div>
                                    @if($user->role === 'admin')
                                        <span class="status-badge admin">
                                            <span class="iconify mr-1" data-icon="lucide:crown"></span>
                                            Admin - Bebas
                                        </span>
                                    @elseif($user->can_change_username)
                                        <span class="status-badge ready">
                                            <span class="iconify mr-1" data-icon="lucide:check"></span>
                                            Bisa ganti
                                        </span>
                                    @else
                                        <span class="status-badge waiting">
                                            <span class="iconify mr-1" data-icon="lucide:clock"></span>
                                            {{ $user->next_username_change }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center justify-between p-3 bg-gradient-to-r from-zinc-50 to-zinc-100 rounded-xl">
                                    <div class="flex items-center gap-2">
                                        <span class="iconify text-zinc-600" data-icon="lucide:lock-keyhole"></span>
                                        <span class="text-xs font-medium text-zinc-700">Status Password:</span>
                                    </div>
                                    @if($user->role === 'admin')
                                        <span class="status-badge admin">
                                            <span class="iconify mr-1" data-icon="lucide:crown"></span>
                                            Admin - Bebas
                                        </span>
                                    @elseif($user->can_change_password)
                                        <span class="status-badge ready">
                                            <span class="iconify mr-1" data-icon="lucide:check"></span>
                                            Bisa ganti
                                        </span>
                                    @else
                                        <span class="status-badge waiting">
                                            <span class="iconify mr-1" data-icon="lucide:clock"></span>
                                            {{ $user->next_password_change }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="w-full space-y-3">
                                <!-- Email section -->
                                <div class="flex items-center p-3 sm:p-4 bg-gradient-to-r from-zinc-50 to-zinc-100 
                                            rounded-xl hover:shadow-md transition-shadow duration-200">
                                    <div class="bg-white rounded-lg p-2 sm:p-2.5 mr-3 shadow-sm">
                                        <span class="iconify text-zinc-700" data-icon="lucide:mail"></span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-zinc-500 font-medium">Email</p>
                                        <p class="font-medium text-zinc-900 text-sm truncate">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <!-- WhatsApp section -->
                                <div class="flex items-center p-3 sm:p-4 bg-gradient-to-r from-zinc-50 to-zinc-100 
                                            rounded-xl hover:shadow-md transition-shadow duration-200">
                                    <div class="bg-white rounded-lg p-2 sm:p-2.5 mr-3 shadow-sm">
                                        <span class="iconify text-green-600" data-icon="lucide:message-circle"></span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-zinc-500 font-medium">WhatsApp</p>
                                        <p class="font-medium text-zinc-900 text-sm truncate">{{ $user->whatsapp }}</p>
                                    </div>
                                </div>

                                <!-- Telegram Username section -->
                                <div class="flex items-center p-3 sm:p-4 bg-gradient-to-r from-zinc-50 to-zinc-100 
                                            rounded-xl hover:shadow-md transition-shadow duration-200">
                                    <div class="bg-white rounded-lg p-2 sm:p-2.5 mr-3 shadow-sm">
                                        <span class="iconify text-blue-600" data-icon="lucide:send"></span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs text-zinc-500 font-medium">Username Telegram</p>
                                        <p class="font-medium text-zinc-900 text-sm truncate">
                                            @if($user->nama_tele)
                                                {{ '@' . $user->nama_tele }}
                                            @else
                                                <span class="text-zinc-400 text-xs">Belum diatur</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Role section -->
                               <div class="flex items-center p-3 sm:p-4 bg-gradient-to-r from-zinc-50 to-zinc-100 
            rounded-xl hover:shadow-md transition-shadow duration-200">
    <div class="bg-white rounded-lg p-2 sm:p-2.5 mr-3 shadow-sm">
        <span class="iconify text-indigo-600" data-icon="lucide:shield"></span>
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-xs text-zinc-500 font-medium">Role Akun</p>
        <p class="font-medium text-zinc-900 text-sm capitalize">
            {{ $user->role }}
        </p>
    </div>
</div>

                            </div>
                        </div>
                    </div>
                    
                    <!-- Saldo Section -->
                    <div class="border-t border-zinc-100 p-6 sm:p-8 bg-gradient-to-r from-zinc-900 to-zinc-800">
                        <div class="text-center">
                            <p class="text-zinc-300 text-sm font-medium">Saldo Anda</p>
                            <h3 class="text-2xl sm:text-3xl font-bold text-white mt-2">Rp {{ number_format($user->saldo, 0, ',', '.') }}</h3>
                            <a href="/topup" class="inline-flex items-center justify-center w-full mt-5 bg-white hover:bg-zinc-100 text-zinc-900 py-3.5 rounded-xl font-semibold transition-all duration-200 shadow-md hover:shadow-xl">
                                <span class="iconify mr-2" data-icon="lucide:wallet"></span>
                                Isi Saldo
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT CONTENT - Edit Forms -->
            <div class="lg:col-span-2 space-y-6 lg:space-y-8 order-2 lg:order-2">
                <!-- Edit Profile Form -->
                <div class="bg-white rounded-2xl shadow-lg border border-zinc-200 p-6 sm:p-8 card-hover fade-in">
                    <div class="flex items-center mb-6 sm:mb-8">
                        <div class="bg-gradient-to-r from-zinc-900 to-zinc-800 rounded-xl p-3 mr-3 sm:mr-4 shadow-md">
                            <span class="iconify text-white text-lg sm:text-xl" data-icon="lucide:user-pen"></span>
                        </div>
                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-zinc-900">Edit Data Profil</h3>
                            <p class="text-zinc-600 text-xs sm:text-sm mt-1">Perbarui informasi profil Anda</p>
                        </div>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="space-y-5 sm:space-y-6">
                            <div>
                                <label class="block text-zinc-700 font-semibold mb-2 sm:mb-3 text-sm">Nama Lengkap</label>
                                <div class="relative">
                                    <span class="iconify absolute left-4 top-1/2 transform -translate-y-1/2 text-zinc-400" data-icon="lucide:user"></span>
                                    <input type="text" name="name" value="{{ $user->name }}" required 
                                        class="w-full pl-11 sm:pl-12 pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-all duration-200 bg-white">
                                </div>
                            </div>
                            
                            <!-- Telegram Username Input -->
                            <div class="bg-zinc-50/80 p-4 rounded-xl border border-zinc-200">
                                <label class="block text-zinc-700 font-semibold mb-2 text-sm">
                                    Username Telegram <span class="text-blue-500 text-xs">(tanpa @)</span>
                                    @if(!$user->can_change_username)
                                        <span class="ml-2 text-xs font-normal text-red-600">
                                            ⚠️ Bisa diganti: {{ $user->next_username_change }}
                                        </span>
                                    @else
                                        <span class="ml-2 text-xs font-normal text-green-600">
                                            ✓ Bisa diganti sekarang
                                        </span>
                                    @endif
                                </label>
                                <div class="relative">
                                    <span class="iconify absolute left-4 top-1/2 transform -translate-y-1/2 text-zinc-400" data-icon="lucide:send"></span>
                                    <input type="text" 
                                           name="nama_tele" 
                                           value="{{ $user->nama_tele }}" 
                                           required 
                                           class="w-full pl-11 sm:pl-12 pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 
                                                  @if(!$user->can_change_username) border-red-300 bg-red-50/50 
                                                  @else border-zinc-200 bg-white @endif
                                                  rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-all duration-200"
                                           @if(!$user->can_change_username) disabled @endif>
                                </div>
                                <small class="text-xs text-zinc-500 mt-1 ml-1 block">
                                    @if($user->role === 'admin')
                                        Admin bisa ganti username kapan saja
                                    @elseif($user->role === 'reseller')
                                        Reseller bisa ganti username setiap 7 hari sekali
                                    @else
                                        Guest bisa ganti username setiap 14 hari sekali
                                    @endif
                                </small>
                                @error('nama_tele')
                                    <small class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-zinc-700 font-semibold mb-2 sm:mb-3 text-sm">Nomor WhatsApp</label>
                                <div class="relative">
                                    <span class="iconify absolute left-4 top-1/2 transform -translate-y-1/2 text-zinc-400" data-icon="lucide:message-circle"></span>
                                    <input type="text" name="whatsapp" value="{{ $user->whatsapp }}" required 
                                        class="w-full pl-11 sm:pl-12 pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 border-zinc-200 rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-all duration-200 bg-white">
                                </div>
                            </div>
                            
                            <!-- Email Display (readonly) -->
                            <div class="bg-zinc-50/80 p-4 rounded-xl border border-zinc-200">
                                <label class="block text-zinc-700 font-semibold mb-2 text-sm">Email (Otomatis)</label>
                                <div class="flex items-center">
                                    <span class="iconify text-zinc-400 mr-3" data-icon="lucide:mail"></span>
                                    <span class="text-zinc-900 font-medium text-sm">{{ $user->email }}</span>
                                    <span class="ml-auto text-xs text-green-600 font-semibold bg-green-50 px-2 py-1 rounded-full">
                                        Auto Generated
                                    </span>
                                </div>
                                <p class="text-xs text-zinc-500 mt-2">
                                    Email otomatis dibuat dari username Telegram. Akan berubah jika username diubah.
                                </p>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-zinc-900 to-zinc-800 hover:opacity-90 text-white py-3.5 sm:py-4 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-xl text-sm sm:text-base
                                           @if(!$user->can_change_username && $user->nama_tele != old('nama_tele')) opacity-50 cursor-not-allowed @endif"
                                    @if(!$user->can_change_username && $user->nama_tele != old('nama_tele')) disabled @endif>
                                <span class="iconify mr-2" data-icon="lucide:save"></span>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password Form -->
                <div class="bg-white rounded-2xl shadow-lg border border-zinc-200 p-6 sm:p-8 card-hover fade-in">
                    <div class="flex items-center mb-6 sm:mb-8">
                        <div class="bg-gradient-to-r from-zinc-900 to-zinc-800 rounded-xl p-3 mr-3 sm:mr-4 shadow-md">
                            <span class="iconify text-white text-lg sm:text-xl" data-icon="lucide:lock"></span>
                        </div>
                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-zinc-900">Ganti Password</h3>
                            <p class="text-zinc-600 text-xs sm:text-sm mt-1">
                                @if(!$user->can_change_password)
                                    <span class="text-red-600 font-medium">
                                        ⚠️ Bisa diganti: {{ $user->next_password_change }}
                                    </span>
                                @else
                                    <span class="text-green-600 font-medium">
                                        ✓ Bisa diganti sekarang
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        <div class="space-y-5 sm:space-y-6">
                            <div>
                                <label class="block text-zinc-700 font-semibold mb-2 sm:mb-3 text-sm">Password Lama</label>
                                <div class="relative">
                                    <span class="iconify absolute left-4 top-1/2 transform -translate-y-1/2 text-zinc-400" data-icon="lucide:key"></span>
                                    <input type="password" 
                                           name="old_password" 
                                           required 
                                           class="w-full pl-11 sm:pl-12 pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 
                                                  @if(!$user->can_change_password) border-red-300 bg-red-50/50 
                                                  @else border-zinc-200 bg-white @endif
                                                  rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-all duration-200"
                                           @if(!$user->can_change_password) disabled @endif>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-zinc-700 font-semibold mb-2 sm:mb-3 text-sm">Password Baru</label>
                                <div class="relative">
                                    <span class="iconify absolute left-4 top-1/2 transform -translate-y-1/2 text-zinc-400" data-icon="lucide:lock"></span>
                                    <input type="password" 
                                           name="new_password" 
                                           required 
                                           class="w-full pl-11 sm:pl-12 pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 
                                                  @if(!$user->can_change_password) border-red-300 bg-red-50/50 
                                                  @else border-zinc-200 bg-white @endif
                                                  rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-all duration-200"
                                           @if(!$user->can_change_password) disabled @endif>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-zinc-700 font-semibold mb-2 sm:mb-3 text-sm">Konfirmasi Password Baru</label>
                                <div class="relative">
                                    <span class="iconify absolute left-4 top-1/2 transform -translate-y-1/2 text-zinc-400" data-icon="lucide:lock"></span>
                                    <input type="password" 
                                           name="new_password_confirmation" 
                                           required 
                                           class="w-full pl-11 sm:pl-12 pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 
                                                  @if(!$user->can_change_password) border-red-300 bg-red-50/50 
                                                  @else border-zinc-200 bg-white @endif
                                                  rounded-xl focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-all duration-200"
                                           @if(!$user->can_change_password) disabled @endif>
                                </div>
                            </div>
                            
                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-zinc-900 to-zinc-800 hover:opacity-90 text-white py-3.5 sm:py-4 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-xl text-sm sm:text-base
                                           @if(!$user->can_change_password) opacity-50 cursor-not-allowed @endif"
                                    @if(!$user->can_change_password) disabled @endif>
                                <span class="iconify mr-2" data-icon="lucide:key-round"></span>
                                @if($user->can_change_password)
                                    Update Password
                                @else
                                    Tunggu {{ $user->next_password_change }}
                                @endif
                            </button>
                            
                            <div class="text-center">
                                <p class="text-xs text-zinc-500">
                                    @if($user->role === 'admin')
                                        Admin bisa ganti password kapan saja
                                    @elseif($user->role === 'reseller')
                                        Reseller bisa ganti password setiap 7 hari sekali
                                    @else
                                        Guest bisa ganti password setiap 14 hari sekali
                                    @endif
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Last Change Info -->
                <div class="bg-white rounded-2xl shadow-lg border border-zinc-200 p-6 sm:p-8 card-hover fade-in">
                    <div class="flex items-center mb-6 sm:mb-8">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-3 mr-3 sm:mr-4 shadow-md">
                            <span class="iconify text-white text-lg sm:text-xl" data-icon="lucide:history"></span>
                        </div>
                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-zinc-900">Riwayat Perubahan</h3>
                            <p class="text-zinc-600 text-xs sm:text-sm mt-1">Informasi terakhir perubahan username & password</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 bg-blue-50/50 rounded-xl border border-blue-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-blue-100 rounded-lg p-2">
                                    <span class="iconify text-blue-600" data-icon="lucide:user-cog"></span>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-blue-900">Username Terakhir Diubah</p>
                                    @if($user->last_username_change)
                                        <p class="text-xs text-blue-700">
                                            {{ $user->last_username_change->translatedFormat('d F Y H:i') }}
                                        </p>
                                    @else
                                        <p class="text-xs text-blue-700">Belum pernah diubah</p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-xs text-blue-600 bg-blue-100/50 p-2 rounded-lg">
                                @if($user->role === 'admin')
                                    ⚡ Admin bebas mengganti username kapan saja
                                @elseif($user->role === 'reseller')
                                    ⏳ Reseller bisa ganti username setiap 7 hari sekali
                                @else
                                    ⏳ Guest bisa ganti username setiap 14 hari sekali
                                @endif
                            </div>
                        </div>
                        
                        <div class="p-4 bg-green-50/50 rounded-xl border border-green-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-green-100 rounded-lg p-2">
                                    <span class="iconify text-green-600" data-icon="lucide:lock-keyhole"></span>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-green-900">Password Terakhir Diubah</p>
                                    @if($user->last_password_change)
                                        <p class="text-xs text-green-700">
                                            {{ $user->last_password_change->translatedFormat('d F Y H:i') }}
                                        </p>
                                    @else
                                        <p class="text-xs text-green-700">Belum pernah diubah</p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-xs text-green-600 bg-green-100/50 p-2 rounded-lg">
                                @if($user->role === 'admin')
                                    ⚡ Admin bebas mengganti password kapan saja
                                @elseif($user->role === 'reseller')
                                    ⏳ Reseller bisa ganti password setiap 7 hari sekali
                                @else
                                    ⏳ Guest bisa ganti password setiap 14 hari sekali
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
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

    <!-- MOBILE BOTTOM NAVIGATION -->
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

    <!-- SCRIPTS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File input untuk foto profil
            const fileInput = document.getElementById('file-input');
            const photoForm = document.getElementById('photo-form');
            
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profile-image').src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                    photoForm.submit();
                }
            });

            // Preview email otomatis ketika username Telegram diubah
            const namaTeleInput = document.querySelector('input[name="nama_tele"]');
            const emailPreview = document.getElementById('email-preview');
            
            if (namaTeleInput && emailPreview) {
                namaTeleInput.addEventListener('input', function() {
                    const username = this.value.toLowerCase().replace(/[^a-z0-9]/g, '');
                    if (username) {
                        emailPreview.textContent = username + '@ayastore.com';
                    } else {
                        emailPreview.textContent = 'username@ayastore.com';
                    }
                });
                
                // Trigger initial preview jika ada value
                if (namaTeleInput.value) {
                    namaTeleInput.dispatchEvent(new Event('input'));
                }
            }

            // Enable/disable form berdasarkan status
            const namaTeleField = document.querySelector('input[name="nama_tele"]');
            const passwordFields = document.querySelectorAll('input[type="password"]');
            const saveProfileBtn = document.querySelector('button[type="submit"]');
            const updatePasswordBtn = document.querySelector('form[action*="password"] button[type="submit"]');
            
            // Cek jika username tidak berubah, tombol tetap aktif
            if (namaTeleField && saveProfileBtn) {
                namaTeleField.addEventListener('input', function() {
                    const originalValue = '{{ $user->nama_tele }}';
                    const currentValue = this.value;
                    
                    if (currentValue === originalValue) {
                        saveProfileBtn.disabled = false;
                        saveProfileBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    } else {
                        const canChange = '{{ $user->can_change_username }}' === '1';
                        if (!canChange) {
                            saveProfileBtn.disabled = true;
                            saveProfileBtn.classList.add('opacity-50', 'cursor-not-allowed');
                        } else {
                            saveProfileBtn.disabled = false;
                            saveProfileBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                        }
                    }
                });
                
                // Set initial state
                if (namaTeleField.value === '{{ $user->nama_tele }}') {
                    saveProfileBtn.disabled = false;
                    saveProfileBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }

            // Navigation active state
            const normalize = (p) => (p || '/').replace(/\/+$/, '') || '/';
            const currentPath = normalize(window.location.pathname);

            // Mobile bottom navigation active state
            const mobileItems = Array.from(document.querySelectorAll('.nav-item'));
            const setActiveByHref = (href) => {
                mobileItems.forEach(i => i.classList.remove('active'));
                const el = document.querySelector(`.nav-item[href="${href}"]`);
                if (el) el.classList.add('active');
            };

            let matched = false;
            mobileItems.forEach(item => {
                const href = normalize(item.getAttribute('href'));
                if (currentPath === href) {
                    item.classList.add('active');
                    matched = true;
                }
            });

            if (!matched) {
                const pathMap = [
                    { prefix: '/home', href: '/home' },
                    { prefix: '/bukti-garansi', href: '/bukti-garansi' },
                    { prefix: '/riwayat', href: '/riwayat' },
                    { prefix: '/top-buyers', href: '/top-buyers' },
                    { prefix: '/redeem', href: '/redeem' },
                    { prefix: '/information', href: '/information' },
                    { prefix: '/profile', href: '/profile' },
                    { prefix: '/admin', href: '/admin/dashboard' },
                ];

                for (const map of pathMap) {
                    if (currentPath.startsWith(map.prefix)) {
                        setActiveByHref(map.href);
                        break;
                    }
                }
            }

            // Desktop navigation active state
            const desktopLinks = document.querySelectorAll('.nav-desktop a');
            desktopLinks.forEach(link => {
                const href = normalize(link.getAttribute('href'));
                if (currentPath === href || currentPath.startsWith(href + '/')) {
                    link.classList.add('active');
                }
            });

            mobileItems.forEach(item => {
                item.addEventListener('click', () => {
                    mobileItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');
                });
            });
        });

        // Hide bottom nav when scrolling to footer
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