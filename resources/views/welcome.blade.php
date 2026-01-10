<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pari ID</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Outfit', sans-serif; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .loader { border: 3px solid #f3f3f3; border-top: 3px solid #3498db; border-radius: 50%; width: 24px; height: 24px; animation: spin 1s linear infinite; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    .active-tab { background-color: #18181b; color: white; }
    .inactive-tab { background-color: white; color: #52525b; border: 1px solid #e4e4e7; }
    .inactive-tab:hover { background-color: #f4f4f5; }
    .blob { position: absolute; filter: blur(80px); opacity: 0.4; z-index: -1; }

    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    @keyframes blob {
      0% { transform: translate(0px, 0px) scale(1); }
      33% { transform: translate(30px, -50px) scale(1.1); }
      66% { transform: translate(-20px, 20px) scale(0.9); }
      100% { transform: translate(0px, 0px) scale(1); }
    }

    /* ================= PRELOADER (5 DETIK) ================= */
    body.loading { overflow: hidden; }

    #preloader{
      position:fixed;
      inset:0;
      background:#fff;
      z-index:99999;
      display:flex;
      align-items:center;
      justify-content:center;
      transition: opacity .45s ease, transform .45s ease;
    }
    #preloader.hide{
      opacity:0;
      transform:translateY(8px);
      pointer-events:none;
    }
    #preloader.off{ display:none; }

    .pre-stage{
      position:absolute;
      inset:0;
      display:flex;
      align-items:center;
      justify-content:center;
      transition: opacity .35s ease, transform .35s ease;
    }
    .pre-stage.hide{
      opacity:0;
      transform:translateY(8px);
      pointer-events:none;
    }

    .pre-text-wrap{
      display:flex;
      flex-direction:column;
      align-items:center;
      gap:10px;
    }
    .pre-text{
      position:relative;
      height:28px;
      min-width:340px;
      text-align:center;
      font-family:'Poppins',sans-serif;
      font-weight:700;
      letter-spacing:1px;
      font-size:16px;
      text-transform:uppercase;
      color:#000;
    }
    .pre-text span{
      position:absolute;
      inset:0;
      opacity:0;
      transform:translateY(14px);
      animation:preText 1.2s cubic-bezier(.22,.61,.36,1) 1 both;
      animation-delay:calc(var(--i) * 1.2s);
    }

    .pre-line{
      width:160px;
      height:3px;
      background:#e5e5e5;
      border-radius:30px;
      overflow:hidden;
    }
    .pre-line::before{
      content:"";
      display:block;
      height:100%;
      width:0;
      background:#000;
      animation:lineMove .9s cubic-bezier(.22,.61,.36,1) infinite;
    }

    @keyframes preText{
      0%{opacity:0;transform:translateY(14px);}
      20%{opacity:1;transform:translateY(0);}
      75%{opacity:1;}
      100%{opacity:0;transform:translateY(14px);}
    }
    @keyframes lineMove{
      55%{width:100%;}
      100%{width:0;}
    }

    .pre-speeder{
      position:absolute;
      top:50%;
      left:50%;
      margin-left:-50px;
      transform:translate(-50%,-50%);
      animation: pre-speeder 0.4s linear infinite;
    }
    .pre-speeder > span{
      height: 5px;
      width: 35px;
      background: #000;
      position: absolute;
      top: -19px;
      left: 60px;
      border-radius: 2px 10px 1px 0;
    }
    .pre-base span{
      position: absolute;
      width: 0;
      height: 0;
      border-top: 6px solid transparent;
      border-right: 100px solid #000;
      border-bottom: 6px solid transparent;
    }
    .pre-base span:before{
      content: "";
      height: 22px;
      width: 22px;
      border-radius: 50%;
      background: #000;
      position: absolute;
      right: -110px;
      top: -16px;
    }
    .pre-base span:after{
      content: "";
      position: absolute;
      width: 0;
      height: 0;
      border-top: 0 solid transparent;
      border-right: 55px solid #000;
      border-bottom: 16px solid transparent;
      top: -16px;
      right: -98px;
    }
    .pre-face{
      position: absolute;
      height: 12px;
      width: 20px;
      background: #000;
      border-radius: 20px 20px 0 0;
      transform: rotate(-40deg);
      right: -125px;
      top: -15px;
    }
    .pre-face:after{
      content: "";
      height: 12px;
      width: 12px;
      background: #000;
      right: 4px;
      top: 7px;
      position: absolute;
      transform: rotate(40deg);
      transform-origin: 50% 50%;
      border-radius: 0 0 0 2px;
    }

    .pre-longfazers{
      position:absolute;
      width:100%;
      height:100%;
      inset:0;
    }
    .pre-longfazers span{
      position:absolute;
      height:2px;
      width:20%;
      background:#000;
    }
    .pre-longfazers span:nth-child(1){ top:20%; animation: pre-lf 0.6s linear infinite; animation-delay: -0.5s; }
    .pre-longfazers span:nth-child(2){ top:40%; animation: pre-lf2 0.8s linear infinite; animation-delay: -0.2s; }
    .pre-longfazers span:nth-child(3){ top:60%; animation: pre-lf3 0.6s linear infinite; }
    .pre-longfazers span:nth-child(4){ top:80%; animation: pre-lf4 0.5s linear infinite; animation-delay: -0.3s; }

    @keyframes pre-lf { 0% { left: 200%; } 100% { left: -200%; opacity: 0; } }
    @keyframes pre-lf2{ 0% { left: 200%; } 100% { left: -200%; opacity: 0; } }
    @keyframes pre-lf3{ 0% { left: 200%; } 100% { left: -100%; opacity: 0; } }
    @keyframes pre-lf4{ 0% { left: 200%; } 100% { left: -100%; opacity: 0; } }

    /* ====== HARGA BOLD TOTAL ====== */
    .price-value {
      font-weight: 800 !important;
      font-size: 14px;
      letter-spacing: 0.3px;
      display: block;
      line-height: 1.2;
    }
    .price-rp {
      font-weight: 700;
      margin-right: 2px;
    }

    /* ====== RESPONSIVE TABLE MOBILE (NO GESER) ====== */
    @media (max-width: 640px) {
      .price-table th,
      .price-table td {
        padding: 10px !important;
        font-size: 12px;
        white-space: normal;
      }
      .price-table thead th { font-size: 11px; }
      .product-desc { display: none; }
      .status-badge {
        font-size: 11px;
        padding: 4px 8px;
        border-radius: 999px;
        display: inline-block;
      }
    }
    
    /* ====== PAGINATION STYLES ====== */
    .pagination-btn {
      padding: 8px 16px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 14px;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    
    .pagination-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      background-color: #e5e5e5;
      color: #737373;
    }
  </style>
</head>

<body class="bg-zinc-50 text-zinc-900 antialiased loading">

  <!-- ================= SKRIP UNTUK MENCEGAH PRELOADER BERULANG ================= -->
  <script>
    // CEK APAKAH SUDAH PERNAH MASUK DI TAB INI
    const hasVisited = sessionStorage.getItem('hasVisited');

    if (hasVisited) {
      // LANGSUNG MATIKAN PRELOADER
      document.addEventListener("DOMContentLoaded", () => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
          preloader.classList.add('off');
        }
        document.body.classList.remove('loading');
      });
    }
  </script>

  <!-- ================= PRELOADER OVERLAY ================= -->
  <div id="preloader">
    <div id="preStage1" class="pre-stage">
      <div class="pre-text-wrap">
        <div class="pre-text">
          <span style="--i:0">HALOO SELAMAT DATANG</span>
          <span style="--i:1">DI STORE KAMI</span>
          <span style="--i:2">SELAMAT BELANJAA</span>
        </div>
        <div class="pre-line"></div>
      </div>
    </div>

    <div id="preStage2" class="pre-stage hide">
      <div class="pre-speeder">
        <span><span></span><span></span><span></span><span></span></span>
        <div class="pre-base">
          <span></span>
          <div class="pre-face"></div>
        </div>
      </div>

      <div class="pre-longfazers">
        <span></span><span></span><span></span><span></span>
      </div>
    </div>
  </div>
  <!-- ================= END PRELOADER ================= -->


  {{-- ================= NAV ================= --}}
 {{-- ================= NAV ================= --}}
<nav class="fixed top-0 z-50 w-full bg-white/80 backdrop-blur-md border-b border-white/20">
  <div class="container mx-auto max-w-7xl px-6 h-20 flex items-center justify-between">

    <div class="flex items-center gap-3">
      <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-10 w-auto rounded-xl">
      <span class="font-bold text-xl tracking-tight text-zinc-900">Pari ID X CYAA STORE</span>
    </div>

    <!-- DESKTOP: WELCOME 1 -->
    <div class="hidden md:flex items-center">
      <a href="{{ url('/') }}"
         class="text-sm font-bold text-zinc-900 bg-white/60 px-6 py-2 rounded-full border border-zinc-100 hover:bg-white transition shadow-sm">
        WELCOME
      </a>
    </div>

    <div class="flex items-center gap-2">
      @auth
        <a href="{{ url('/home') }}"
           class="hidden md:inline-flex items-center gap-2 px-6 py-2.5 bg-zinc-900 text-white rounded-full text-sm font-bold hover:bg-zinc-800 transition shadow-lg">
          HOME
          <span class="iconify text-base" data-icon="lucide:arrow-right"></span>
        </a>

        {{-- MOBILE: Icon HOME --}}
        <a href="{{ url('/home') }}"
           class="md:hidden p-3 bg-zinc-900 text-white rounded-2xl hover:bg-zinc-800 transition shadow-lg flex items-center justify-center"
           title="Home">
          <span class="iconify text-lg" data-icon="lucide:home"></span>
        </a>
      @else
        {{-- DESKTOP: Teks Masuk dan Daftar --}}
        <a href="{{ route('login') }}" class="hidden md:inline-block text-sm font-bold text-zinc-900 hover:underline">Masuk</a>
        <a href="{{ route('register') }}"
           class="hidden md:inline-block px-6 py-2.5 bg-zinc-900 text-white rounded-full text-sm font-bold hover:bg-zinc-800 transition shadow-lg">
          Daftar
        </a>

        {{-- MOBILE: Icon Login saja --}}
        <a href="{{ route('login') }}"
           class="md:hidden p-3 bg-zinc-900 text-white rounded-2xl hover:bg-zinc-800 transition shadow-lg flex items-center justify-center"
           title="Masuk">
          <span class="iconify text-lg" data-icon="lucide:log-in"></span>
        </a>
      @endauth
    </div>
  </div>
</nav>


  {{-- ================= HERO ================= --}}
  <header id="home" class="relative pt-36 pb-20 md:pt-48 md:pb-32 text-center px-6 overflow-hidden">
    <div class="blob bg-blue-400 w-96 h-96 rounded-full top-0 left-0 mix-blend-multiply animate-blob"></div>
    <div class="blob bg-purple-400 w-96 h-96 rounded-full top-0 right-0 mix-blend-multiply animate-blob animation-delay-2000"></div>

    <div class="relative z-10">
      <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white border border-zinc-200 shadow-sm mb-8">
        <span class="relative flex h-2.5 w-2.5">
          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
        </span>
        <span class="text-xs font-bold text-zinc-600 tracking-wide uppercase">Server Stabil & Cepat</span>
      </div>

      <h1 class="text-5xl md:text-7xl font-extrabold text-zinc-900 mb-6 tracking-tight leading-tight">
        Pari ID <br>
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-zinc-900 via-indigo-800 to-zinc-900">Solusi Digital Anda.</span>
      </h1>
      <p class="text-zinc-600 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
        Platform distributor Pulsa, Paket Data, App Premium termurah.
      </p>
      <div class="flex flex-col md:flex-row justify-center gap-4">
        <a href="{{ route('register') }}" class="px-8 py-4 bg-zinc-900 text-white rounded-full font-bold hover:bg-zinc-800 transition shadow-xl flex items-center justify-center gap-2">
          Mulai Sekarang <span class="iconify" data-icon="lucide:arrow-right"></span>
        </a>
        <a href="{{ url('/#harga') }}" class="px-8 py-4 bg-white border border-zinc-200 text-zinc-900 rounded-full font-bold hover:bg-zinc-50 transition flex items-center justify-center gap-2">
          <span class="iconify" data-icon="lucide:search"></span> Cek Harga
        </a>
      </div>
    </div>
  </header>


  {{-- ================= PRICE SECTION (DENGAN PAGINATION) ================= --}}
  <section id="harga" class="py-16 bg-white">
    <div class="container mx-auto max-w-5xl px-4 sm:px-6">
      <div class="text-center mb-8">
        <h2 class="text-2xl md:text-4xl font-bold text-zinc-900">Daftar Harga Realtime</h2>
        <p class="text-xs md:text-sm text-zinc-500 mt-2">Harga diambil langsung dari database produk</p>
      </div>

      <div class="flex justify-center flex-wrap gap-2 mb-8" id="cat-tabs">
        @forelse($categories as $index => $cat)
          <button
            onclick="loadHarga('{{ $cat->slug }}', this)"
            data-slug="{{ $cat->slug }}"
            class="tab-btn px-4 py-2 rounded-full text-xs font-bold transition shadow-sm
                   {{ $index === 0 ? 'active-tab' : 'inactive-tab' }}">
            {{ $cat->name }}
          </button>
        @empty
          <span class="text-xs text-zinc-400">Belum ada kategori</span>
        @endforelse
      </div>

      <div class="bg-zinc-50 rounded-2xl border border-zinc-100 overflow-hidden relative">
        <div id="loading" class="hidden absolute inset-0 bg-white/80 backdrop-blur-sm flex flex-col items-center justify-center z-10">
          <div class="loader"></div>
          <span class="text-xs text-zinc-500 mt-2 font-medium">Memuat Data...</span>
        </div>

        <table class="price-table w-full text-left">
          <thead class="bg-zinc-100 text-zinc-500 uppercase text-xs font-bold border-b border-zinc-200">
            <tr>
              <th class="px-4 py-3">Produk</th>
              <th class="px-4 py-3">Reseller</th>
              <th class="px-4 py-3">Guest</th>
              <th class="px-4 py-3 text-center">Status</th>
            </tr>
          </thead>

          <tbody id="price-body" class="divide-y divide-zinc-100">
            <!-- Data akan dimuat via JavaScript -->
          </tbody>
        </table>

        {{-- PAGINATION CONTROLS DI TENGAH --}}
        <div id="pagination-controls" class="hidden flex items-center justify-center p-4 border-t border-zinc-200">
          <div class="flex items-center gap-2">
            <button 
              id="prev-btn" 
              onclick="changePage(-1)"
              class="pagination-btn bg-zinc-100 text-zinc-700 hover:bg-zinc-200 disabled:opacity-50 disabled:cursor-not-allowed"
              disabled>
              <span class="iconify" data-icon="lucide:chevron-left"></span>
              Sebelumnya
            </button>
            
            <button 
              id="next-btn" 
              onclick="changePage(1)"
              class="pagination-btn bg-zinc-900 text-white hover:bg-zinc-800 disabled:opacity-50 disabled:cursor-not-allowed">
              Selanjutnya
              <span class="iconify" data-icon="lucide:chevron-right"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>


  {{-- ================= FOOTER BARU ================= --}}
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
                    <a href="https://wa.me/+6282327301015?text=Halo+Admin+Cyaa+Store%2C+saya+butuh+bantuan." target="_blank"
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


  <script>
    const PRICE_URL = "{{ route('public.price-list') }}";
    let currentPage = 1;
    let itemsPerPage = 10;
    let currentItems = [];
    let currentCategory = '';

    document.addEventListener("DOMContentLoaded", function() {
      const firstTab = document.querySelector('.tab-btn');
      if (firstTab) {
        currentCategory = firstTab.getAttribute('data-slug');
        loadHarga(currentCategory, firstTab, false);
      }
    });

    function loadHarga(kategoriSlug, btnElement, showLoader = true) {
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active-tab');
        btn.classList.add('inactive-tab');
      });
      
      if (btnElement) {
        btnElement.classList.remove('inactive-tab');
        btnElement.classList.add('active-tab');
      }

      currentCategory = kategoriSlug;
      currentPage = 1;
      
      const loader = document.getElementById('loading');
      const tbody = document.getElementById('price-body');
      const paginationControls = document.getElementById('pagination-controls');

      if (showLoader) loader.classList.remove('hidden');
      tbody.style.opacity = '0.5';
      paginationControls.classList.add('hidden');

      fetch(PRICE_URL + '?category=' + encodeURIComponent(kategoriSlug))
        .then(res => res.json())
        .then(json => {
          currentItems = json.items || [];
          
          if (currentItems.length > 0) {
            updateTable();
            if (currentItems.length > itemsPerPage) {
              paginationControls.classList.remove('hidden');
            } else {
              paginationControls.classList.add('hidden');
            }
          } else {
            tbody.innerHTML = `
              <tr>
                <td colspan="4" class="px-4 py-8 text-center text-xs text-zinc-400">Belum ada data</td>
              </tr>
            `;
            paginationControls.classList.add('hidden');
          }
        })
        .catch(err => {
          console.error(err);
          tbody.innerHTML = `
            <tr>
              <td colspan="4" class="px-4 py-8 text-center text-xs text-red-500">Gagal memuat data harga.</td>
            </tr>
          `;
          paginationControls.classList.add('hidden');
        })
        .finally(() => {
          loader.classList.add('hidden');
          tbody.style.opacity = '1';
        });
    }

    function updateTable() {
      const startIndex = (currentPage - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
      const pageItems = currentItems.slice(startIndex, endIndex);
      
      let html = '';

      if (pageItems.length === 0) {
        html = `
          <tr>
            <td colspan="4" class="px-4 py-8 text-center text-xs text-zinc-400">Belum ada data</td>
          </tr>
        `;
      } else {
        pageItems.forEach(row => {
          const badgeClass = row.status === 'Ready'
            ? 'bg-green-100 text-green-800'
            : 'bg-zinc-200 text-zinc-700';

          html += `
            <tr>
              <td class="px-4 py-3">
                <div class="font-semibold text-zinc-900">${row.item_name}</div>
                <div class="text-xs text-zinc-500 product-desc">${row.product_name}</div>
              </td>

              <td class="px-4 py-3 text-emerald-700">
                <span class="price-value"><span class="price-rp">Rp</span>${Number(row.price_reseller).toLocaleString('id-ID')}</span>
              </td>

              <td class="px-4 py-3 text-zinc-900">
                <span class="price-value"><span class="price-rp">Rp</span>${Number(row.price_guest).toLocaleString('id-ID')}</span>
              </td>

              <td class="px-4 py-3 text-center">
                <span class="status-badge ${badgeClass} font-bold px-3 py-1 rounded-full">
                  ${row.status}
                </span>
              </td>
            </tr>
          `;
        });
      }

      document.getElementById('price-body').innerHTML = html;
      updatePaginationControls();
    }

    function updatePaginationControls() {
      const prevBtn = document.getElementById('prev-btn');
      const nextBtn = document.getElementById('next-btn');
      
      prevBtn.disabled = currentPage === 1;
      nextBtn.disabled = currentPage * itemsPerPage >= currentItems.length;
    }

    function changePage(direction) {
      const newPage = currentPage + direction;
      const totalPages = Math.ceil(currentItems.length / itemsPerPage);
      
      if (newPage >= 1 && newPage <= totalPages) {
        currentPage = newPage;
        updateTable();
      }
    }

    window.addEventListener('load', () => {
      // JIKA SUDAH PERNAH MASUK, JANGAN JALANKAN ANIMASI
      if (sessionStorage.getItem('hasVisited')) return;

      // TANDAI SUDAH PERNAH MASUK
      sessionStorage.setItem('hasVisited', 'true');

      const preloader = document.getElementById('preloader');
      const s1 = document.getElementById('preStage1');
      const s2 = document.getElementById('preStage2');

      setTimeout(() => {
        s1.classList.add('hide');
        s2.classList.remove('hide');
      }, 3600);

      setTimeout(() => {
        preloader.classList.add('hide');
        document.body.classList.remove('loading');
        setTimeout(() => preloader.classList.add('off'), 500);
      }, 5000);
    });
  </script>

</body>
</html>