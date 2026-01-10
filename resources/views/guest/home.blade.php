<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PARI ID</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Outfit', sans-serif; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .pb-safe { padding-bottom: env(safe-area-inset-bottom); }

    /* ====== MOBILE BOTTOM NAV ====== */
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

    /* BESTSELLER */
    .bestseller-track { -webkit-overflow-scrolling: touch; scrollbar-width:none; }
    .bestseller-track::-webkit-scrollbar { display:none; }

    /* ====== FAQ STYLES ====== */
    .faq-container {
      max-width: 800px;
      margin: auto;
      padding: 20px;
    }
    .faq-title {
      text-align: center;
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 32px;
      color: #18181b;
    }
    .faq-item {
      border-bottom: 1px solid #e5e7eb;
      margin-bottom: 8px;
    }
    .faq-question {
      width: 100%;
      background: none;
      border: none;
      padding: 20px 0;
      font-size: 16px;
      font-weight: 600;
      text-align: left;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #18181b;
      transition: color 0.2s;
    }
    .faq-question:hover {
      color: #3b82f6;
    }
    .faq-question .icon {
      font-size: 24px;
      transition: transform 0.3s;
      color: #6b7280;
    }
    .faq-answer {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease;
      padding: 0 10px;
    }
    .faq-answer p {
      padding: 10px 0 20px;
      color: #4b5563;
      line-height: 1.6;
      font-size: 15px;
    }
    .faq-item.active .faq-answer {
      max-height: 500px;
    }
    .faq-item.active .icon {
      transform: rotate(45deg);
      color: #3b82f6;
    }
    
    /* Mobile Header Glass Effect */
    .mobile-header {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(229, 231, 235, 0.6);
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

  <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-zinc-200 hidden md:block">
    <div class="container mx-auto max-w-6xl px-4 h-16 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <a href="/home" class="flex items-center gap-2 hover:opacity-80 transition">
          <img src="{{ asset('images/logo.jpg') }}" alt="PARI ID" class="hidden md:block h-8 w-auto object-contain">
          <span class="md:hidden font-bold text-xl text-zinc-900">PARI ID X CYAA STORE </span>
        </a>
      </div>

      <div class="flex items-center gap-8">
        <a href="/home" class="text-sm font-medium text-zinc-900">Home</a>
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

  <!-- MAIN CONTENT -->
  <main class="container mx-auto max-w-6xl px-5 py-5 space-y-6 mb-20 md:mb-0">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Saldo -->
      <div class="md:col-span-1">
        <div class="bg-gradient-to-br from-[#18181b] to-black text-white rounded-[1.25rem] p-5 shadow-xl shadow-zinc-200 relative overflow-hidden">
          <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-[40px]"></div>
          <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full blur-[40px]"></div>

          <div class="relative z-10">
            <div class="flex justify-between items-center mb-2">
              <p class="text-zinc-400 text-xs font-medium">Total Saldo</p>
              <span class="px-2 py-0.5 bg-zinc-800 border border-zinc-700 rounded-full text-[10px] text-zinc-300 font-medium flex items-center gap-1">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span> Active
              </span>
            </div>

            <div class="flex items-baseline gap-1 mb-5">
              <span class="text-sm text-zinc-500 font-medium translate-y-[-2px]">Rp</span>
              <h1 class="text-3xl font-bold tracking-tight text-white">
                {{ number_format(auth()->user()->saldo ?? 0, 0, ',', '.') }}
              </h1>
            </div>

            <div class="grid grid-cols-2 gap-3">
              <a href="/topup"
                 class="group bg-white text-zinc-900 py-2.5 px-4 rounded-xl text-xs font-bold flex items-center justify-center gap-2 shadow-sm hover:bg-zinc-100 transition active:scale-95">
                <div class="w-4 h-4 bg-zinc-200 rounded-full flex items-center justify-center group-hover:bg-zinc-300 transition">
                  <span class="iconify text-[10px]" data-icon="lucide:plus"></span>
                </div>
                Top Up
              </a>

              
              <a href="/transfer"
                 class="bg-white/10 text-white py-2.5 px-4 rounded-xl text-xs font-medium flex items-center justify-center gap-2 border border-white/5 hover:bg-white/15 transition">
                <span class="iconify text-sm" data-icon="lucide:send"></span> Transfer
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="md:col-span-2 hidden md:grid grid-cols-2 gap-4">
        
        <a href="/bukti-garansi"
           class="rounded-[1.25rem] bg-gradient-to-br from-slate-700 to-slate-900 p-6 text-white relative overflow-hidden flex items-center
                  shadow-lg shadow-slate-700/30 hover:shadow-xl transition cursor-pointer group">
          <div class="relative z-10">
            <h3 class="font-bold text-lg mb-1">Bukti Garansi / SS Login</h3>
            <p class="text-xs text-slate-200 leading-relaxed max-w-[95%]">
              Untuk klaim garansi atau upload screenshot login,
              <span class="font-semibold underline underline-offset-2">klik di sini</span>.
            </p>

            <div class="mt-4 inline-flex items-center gap-2 bg-white/15 border border-white/20 px-3 py-2 rounded-xl text-xs font-semibold hover:bg-white/25 transition">
              <span class="iconify text-base" data-icon="lucide:upload"></span>
              Upload Bukti
            </div>
          </div>

          <span class="iconify absolute -right-4 -bottom-4 text-[7rem] text-white/10 rotate-12
                       group-hover:scale-110 transition"
                data-icon="lucide:file-check-2"></span>
        </a>
        
        <a href="/riwayat"
           class="rounded-[1.25rem] bg-gradient-to-br from-white to-zinc-50 border border-zinc-100 p-6 flex items-center justify-between relative overflow-hidden shadow-sm hover:shadow-md hover:border-zinc-300 transition group">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
              <span class="iconify text-2xl" data-icon="lucide:clock"></span>
            </div>
            <div>
              <h3 class="font-bold text-lg text-zinc-900">Riwayat</h3>
              <p class="text-xs text-zinc-500 mt-0.5">Cek status & waktu transaksi</p>
            </div>
          </div>
          <div class="w-10 h-10 bg-zinc-50 rounded-full flex items-center justify-center text-zinc-400 group-hover:bg-zinc-900 group-hover:text-white transition">
            <span class="iconify text-xl" data-icon="lucide:arrow-right"></span>
          </div>
        </a>
      </div>
    </div>

    <!-- Tab Kategori -->
    <div>
      <div class="flex justify-between items-end mb-4 px-1">
        <h3 class="text-sm font-bold text-zinc-900 uppercase tracking-wide">Produk Digital</h3>
      </div>

      <div class="flex overflow-x-auto no-scrollbar mb-4 gap-2 pb-2">
        <button
          class="px-4 py-2 text-xs font-medium rounded-full whitespace-nowrap transition-all {{ $selectedSlug === 'all' ? 'bg-zinc-900 text-white' : 'bg-white text-zinc-600 hover:bg-zinc-100' }}"
          onclick="window.location.href='?category=all'">
          Semua
        </button>

        @foreach($categories as $cat)
          <button
            class="px-4 py-2 text-xs font-medium rounded-full whitespace-nowrap transition-all {{ $selectedSlug === $cat->slug ? 'bg-zinc-900 text-white' : 'bg-white text-zinc-600 hover:bg-zinc-100' }}"
            onclick="window.location.href='?category={{ $cat->slug }}'">
            {{ $cat->name }}
          </button>
        @endforeach
      </div>
    </div>

    @if($selectedSlug === 'all' && $bestSellers->count())
      <div>
        <div class="flex items-center justify-between mb-3">
          <h3 class="text-sm font-bold">🔥 Produk Terlaris</h3>

          <div class="hidden sm:flex gap-2">
            <button type="button" data-bestseller-prev
              class="w-9 h-9 rounded-xl bg-white border border-zinc-100 flex items-center justify-center hover:bg-zinc-50 active:scale-95 transition">
              <span class="iconify text-lg" data-icon="lucide:chevron-left"></span>
            </button>
            <button type="button" data-bestseller-next
              class="w-9 h-9 rounded-xl bg-white border border-zinc-100 flex items-center justify-center hover:bg-zinc-50 active:scale-95 transition">
              <span class="iconify text-lg" data-icon="lucide:chevron-right"></span>
            </button>
          </div>
        </div>

        <div class="relative">
          <div data-bestseller-track class="bestseller-track flex gap-4 overflow-x-auto no-scrollbar pb-2">
            @foreach($bestSellers as $product)
              @php
                $totalStock = $product->items->sum(fn($i) => $i->stocks->count());
                $sold7Days = (int)($product->sold_7_days ?? 0);
              @endphp

              <a href="{{ route('product.show', $product) }}"
                 class="shrink-0 w-[30%] sm:w-[30%] md:w-[16%]
                        bg-white rounded-2xl shadow hover:shadow-lg hover:-translate-y-1 transition-all">
                <div class="p-3">
                  <div class="aspect-square rounded-xl overflow-hidden relative">
                    @if($product->thumbnail)
                      <img src="{{ asset('storage/'.$product->thumbnail) }}" class="w-full h-full object-cover">
                    @endif
                    <span class="absolute top-2 right-2 text-[10px] px-2 py-0.5 rounded-full
                      {{ $totalStock > 0 ? 'bg-green-500' : 'bg-red-500' }} text-white font-semibold">
                      {{ $totalStock > 0 ? 'Ready' : 'Kosong' }}
                    </span>
                  </div>
                </div>

                <div class="px-3 pb-4 text-center">
                  <p class="font-bold text-sm line-clamp-2">{{ $product->name }}</p>
                  <p class="text-[11px] text-zinc-500 mt-1">
                    @if($sold7Days > 0)
                      Terjual {{ $sold7Days }}
                    @else
                      <span class="text-zinc-400">Belum terjual</span>
                    @endif
                  </p>
                </div>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    @endif

    <!-- ===================== PRODUK PER KATEGORI ===================== -->
    @if($products->count())
      @if($selectedSlug === 'all')
        <div class="space-y-10">
          @foreach($categories as $cat)
            @php
              $catProducts = $products->where('category_id', $cat->id)->values();
              $catCount = $catProducts->count();
              $catKey = 'cat-'.$cat->id;
            @endphp

            @if($catCount)
              <section class="space-y-3" data-cat-section="{{ $catKey }}">
                <div class="pt-1 flex items-end justify-between">
                  <div>
                    <h3 class="text-sm font-bold text-zinc-900 uppercase tracking-wide">
                      {{ $cat->name }} 
                      <span class="text-xs font-normal text-zinc-500 ml-2">
                        ({{ $catCount }} produk)
                      </span>
                    </h3>
                  </div>
                </div>

                <div class="grid grid-cols-3 md:grid-cols-6 gap-3 md:gap-4" data-cat-grid="{{ $catKey }}">
                  @foreach($catProducts as $idx => $product)
                    @php
                      $totalStock = $product->items->sum(fn($i) => $i->stocks->count());
                      $sold7Days = (int)($product->sold_7_days ?? 0);
                    @endphp

                    <a href="{{ route('product.show', $product) }}"
                       data-cat-item
                       class="bg-white rounded-2xl shadow hover:shadow-lg hover:-translate-y-1 transition">
                      <div class="p-3">
                        <div class="aspect-square rounded-xl overflow-hidden relative">
                          @if($product->thumbnail)
                            <img src="{{ asset('storage/'.$product->thumbnail) }}" class="w-full h-full object-cover">
                          @endif
                          <span class="absolute top-2 right-2 text-[10px] px-2 py-0.5 rounded-full
                            {{ $totalStock > 0 ? 'bg-green-500' : 'bg-red-500' }} text-white font-semibold">
                            {{ $totalStock > 0 ? 'Ready' : 'Kosong' }}
                          </span>
                        </div>
                      </div>

                      <div class="px-3 pb-4 text-center">
                        <p class="font-bold text-sm line-clamp-2">{{ $product->name }}</p>
                        <p class="text-[11px] text-zinc-500 mt-1">
                          @if($sold7Days > 0)
                            Terjual {{ $sold7Days }}
                          @else
                            <span class="text-zinc-400">Belum terjual</span>
                          @endif
                        </p>
                      </div>
                    </a>
                  @endforeach
                </div>

                {{-- TOMBOL LIHAT SEMUA DI TENGAH BAWAH --}}
                @if($catCount > 6)
                <div class="flex justify-center mt-6">
                  <button
                    type="button"
                    data-cat-more="{{ $catKey }}"
                    data-mode="more"
                    class="px-5 py-2 rounded-full
                           bg-white/60 backdrop-blur-md
                           border border-white/70
                           text-zinc-800 text-xs font-semibold
                           hover:bg-white/80
                           active:scale-95 transition
                           flex items-center gap-1.5
                           shadow-sm">
                    Lihat lainnya
                    <span class="iconify text-sm" data-icon="lucide:chevron-down"></span>
                  </button>
                </div>
                @endif
              </section>
            @endif
          @endforeach
        </div>
      @else
        @php
          $currentCategory = $categories->firstWhere('slug', $selectedSlug);
          $catCount = $products->count();
          $catKey = 'single-'.$selectedSlug;
          $productsList = $products->values();
        @endphp

        @if($currentCategory)
          <div class="mb-2 flex items-end justify-between">
            <div>
              <h3 class="text-sm font-bold text-zinc-900 uppercase tracking-wide">
                {{ $currentCategory->name }} 
                <span class="text-xs font-normal text-zinc-500 ml-2">
                  ({{ $catCount }} produk)
                </span>
              </h3>
              <p class="text-xs text-zinc-500 mt-1">Semua produk terkait kategori ini tersedia untuk Anda</p>
            </div>
          </div>
        @endif

        <div class="grid grid-cols-3 md:grid-cols-6 gap-3 md:gap-4" data-cat-grid="{{ $catKey }}">
          @foreach($productsList as $idx => $product)
            @php
              $totalStock = $product->items->sum(fn($i) => $i->stocks->count());
              $sold7Days = (int)($product->sold_7_days ?? 0);
            @endphp

            <a href="{{ route('product.show', $product) }}"
               data-cat-item
               class="bg-white rounded-2xl shadow hover:shadow-lg hover:-translate-y-1 transition">

              <div class="p-3">
                <div class="aspect-square rounded-xl overflow-hidden relative">
                  @if($product->thumbnail)
                    <img src="{{ asset('storage/'.$product->thumbnail) }}" class="w-full h-full object-cover">
                  @endif
                  <span class="absolute top-2 right-2 text-[10px] px-2 py-0.5 rounded-full
                    {{ $totalStock > 0 ? 'bg-green-500' : 'bg-red-500' }} text-white font-semibold">
                    {{ $totalStock > 0 ? 'Ready' : 'Kosong' }}
                  </span>
                </div>
              </div>

              <div class="px-3 pb-4 text-center">
                <p class="font-bold text-sm line-clamp-2">{{ $product->name }}</p>
                <p class="text-[11px] text-zinc-500 mt-1">
                  @if($sold7Days > 0)
                    Terjual {{ $sold7Days }}
                  @else
                    <span class="text-zinc-400">Belum terjual</span>
                  @endif
                </p>
              </div>
            </a>
          @endforeach
        </div>

        {{-- TOMBOL LIHAT SEMUA UNTUK SINGLE CATEGORY --}}
        @if($catCount > 6)
        <div class="flex justify-center mt-10">
          <button
            type="button"
            data-cat-more="{{ $catKey }}"
            data-mode="more"
            class="px-5 py-2 rounded-full
                   bg-white/60 backdrop-blur-md
                   border border-white/70
                   text-zinc-800 text-xs font-semibold
                   hover:bg-white/80
                   active:scale-95 transition
                   flex items-center gap-1.5
                   shadow-sm">
            Lihat lainnya
            <span class="iconify text-sm" data-icon="lucide:chevron-down"></span>
          </button>
        </div>
        @endif
      @endif
    @else
      <div class="text-center py-12">
        <span class="iconify text-5xl text-zinc-300 mx-auto mb-4" data-icon="lucide:package-open"></span>
        <p class="text-zinc-500 text-sm">Tidak ada produk ditemukan</p>
      </div>
    @endif
    
    <section class="faq-container mt-16">
      <h2 class="faq-title">Kamu Mungkin Bertanya❓</h2>

      <div class="faq-item">
        <button class="faq-question">
          Bagaimana cara sistem web ini bekerja?
          <span class="icon">+</span>
        </button>
        <div class="faq-answer">
          <p>
            Kamu deposit dulu untuk menambah saldo di akun. Nanti pas mau beli item atau produk,
            tinggal pilih yang diinginkan, pastikan saldo cukup, lalu klik beli. Selesai!
          </p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          Apa yang harus dilakukan jika item belum diproses?
          <span class="icon">+</span>
        </button>
        <div class="faq-answer">
          <p>
            Jika item yang kamu beli belum diproses, tunggu saja. Proses paling cepat 15 menit,
            paling lama 2x24 jam tergantung jumlah orderan yang sedang berjalan.
          </p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          Apakah web ini hanya untuk App Premium saja?
          <span class="icon">+</span>
        </button>
        <div class="faq-answer">
          <p>
            Tidak! Web ini bukan untuk beli App Premium doang loh ya. Kami menyediakan berbagai produk digital
            seperti kebsos, paket data, token listrik, e-wallet, dan masih banyak lagi.
          </p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          Apakah PARI ID X CYAA STORE menyediakan garansi untuk produk yang dijual?
          <span class="icon">+</span>
        </button>
        <div class="faq-answer">
          <p>
            Ya, tentu. Semua produk di PARI ID X CYAA STORE dilengkapi dengan garansi sesuai ketentuan. 
            Jika terjadi masalah dengan produk yang Anda beli, seperti item tidak masuk atau masalah teknis lainnya, 
            Anda dapat mengajukan klaim garansi melalui menu Bukti Garansi / SS Login di halaman utama. 
            Tim kami akan memproses klaim Anda dalam waktu 1x24 jam pada hari kerja. 
            Pastikan untuk menyimpan bukti transaksi dan screenshot yang diperlukan untuk proses klaim yang lebih cepat.
          </p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          Kenapa harus menjadi Reseller PARI ID X CYAA STORE dan apa keuntungannya?
          <span class="icon">+</span>
        </button>
        <div class="faq-answer">
          <p>
            Dengan menjadi reseller PARI ID X CYAA STORE, Anda mendapatkan banyak keuntungan: 
            harga lebih murah dari harga normal, prioritas pelayanan dari tim support kami, 
            peluang bisnis untuk menjual kembali produk dengan margin keuntungan yang menarik, 
            akses ke produk eksklusif, dan sistem yang mudah digunakan. 
            Cocok untuk pemakaian pribadi yang lebih hemat maupun untuk membangun bisnis yang menguntungkan.
          </p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-question">
          Bagaimana cara melakukan deposit saldo?
          <span class="icon">+</span>
        </button>
        <div class="faq-answer">
          <p>
            Klik tombol "Top Up" di kartu saldo, pilih nominal, lalu pilih metode pembayaran.
            Kami mendukung transfer bank, e-wallet, dan QRIS untuk kemudahan transaksi.
          </p>
        </div>
      </div>
    </section>
  </main>

  <!-- ===================== FOOTER ===================== -->
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
    // active bottom nav
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

    // ===== BESTSELLER TRUE INFINITE + AUTO =====
    document.addEventListener('DOMContentLoaded', () => {
      const track = document.querySelector('[data-bestseller-track]');
      if (!track) return;

      const originalChildren = Array.from(track.children);
      const minWidth = window.innerWidth * 3;

      let totalWidth = track.scrollWidth;
      while (totalWidth < minWidth) {
        originalChildren.forEach(el => track.appendChild(el.cloneNode(true)));
        totalWidth = track.scrollWidth;
      }

      const getGap = () => parseFloat(getComputedStyle(track).gap || 0) || 0;

      const getSetWidth = () => {
        let width = 0;
        originalChildren.forEach(el => width += el.getBoundingClientRect().width);
        width += getGap() * (originalChildren.length - 1);
        return width;
      };

      let setWidth = 0;
      const recalc = () => setWidth = getSetWidth();
      recalc();
      window.addEventListener('resize', () => requestAnimationFrame(recalc));

      let speed = 0.45;
      let paused = false;

      const animate = () => {
        if (!paused) {
          track.scrollLeft += speed;
          if (track.scrollLeft >= setWidth) track.scrollLeft -= setWidth;
        }
        requestAnimationFrame(animate);
      };
      animate();

      const pause = () => paused = true;
      const resume = () => paused = false;

      track.addEventListener('mouseenter', pause);
      track.addEventListener('mouseleave', resume);
      track.addEventListener('touchstart', pause, { passive: true });
      track.addEventListener('touchend', resume);
      track.addEventListener('touchcancel', resume);

      const nextBtn = document.querySelector('[data-bestseller-next]');
      const prevBtn = document.querySelector('[data-bestseller-prev]');

      const step = () => {
        const first = originalChildren[0];
        if (!first) return 240;
        return first.getBoundingClientRect().width + getGap();
      };

      const tempPause = () => { pause(); setTimeout(resume, 1200); };

      nextBtn?.addEventListener('click', () => { tempPause(); track.scrollBy({ left: step(), behavior: 'smooth' }); });
      prevBtn?.addEventListener('click', () => { tempPause(); track.scrollBy({ left: -step(), behavior: 'smooth' }); });
    });

    // ===== FAQ TOGGLE =====
    document.querySelectorAll(".faq-question").forEach(button => {
      button.addEventListener("click", () => {
        const item = button.parentElement;
        item.classList.toggle("active");
      });
    });

    // ===== LOAD MORE PER KATEGORI (FINAL VERSION) =====
    document.addEventListener('DOMContentLoaded', () => {
      const initLoadMore = () => {
        document.querySelectorAll('[data-cat-more]').forEach(btn => {
          const key = btn.getAttribute('data-cat-more');
          const grid = document.querySelector(`[data-cat-grid="${key}"]`);
          if (!grid) return;

          const items = Array.from(grid.querySelectorAll('[data-cat-item]'));
          const total = items.length;

          const isMobile = window.innerWidth < 768;
          const initialShow = isMobile ? 9 : 12;
          const step = isMobile ? 3 : 6;

          // RESET TAMPILAN
          items.forEach((item, idx) => {
            item.classList.toggle('hidden', idx >= initialShow);
          });

          if (total <= initialShow) {
            btn.classList.add('hidden');
            return;
          } else {
            btn.classList.remove('hidden');
          }

          btn.setAttribute('data-mode', 'more');
          btn.innerHTML = `
            Lihat lainnya
            <span class="iconify text-sm" data-icon="lucide:chevron-down"></span>
          `;

          btn.onclick = () => {
            const mode = btn.getAttribute('data-mode');
            const visible = items.filter(i => !i.classList.contains('hidden')).length;

            if (mode === 'more') {
              const next = Math.min(visible + step, total);
              items.forEach((item, idx) => {
                if (idx < next) item.classList.remove('hidden');
              });

              if (next >= total) {
                btn.setAttribute('data-mode', 'hide');
                btn.innerHTML = `
                  Sembunyikan
                  <span class="iconify text-sm" data-icon="lucide:chevron-up"></span>
                `;
              }
            } else {
              // BALIK KE AWAL
              items.forEach((item, idx) => {
                item.classList.toggle('hidden', idx >= initialShow);
              });

              btn.setAttribute('data-mode', 'more');
              btn.innerHTML = `
                Lihat lainnya
                <span class="iconify text-sm" data-icon="lucide:chevron-down"></span>
              `;

              const section = document.querySelector(`[data-cat-section="${key}"]`);
              section?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
          };
        });
      };

      initLoadMore();

      // RESPONSIVE RELOAD
      let resizeTimer;
      window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(initLoadMore, 300);
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