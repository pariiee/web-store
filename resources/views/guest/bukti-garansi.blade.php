<!DOCTYPE html> 
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Bukti Login & Klaim Garansi - PARI ID</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

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

    :root{
      --input-focus:#2d8cf0;
      --font-color:#323232;
      --font-color-sub:#666;
      --bg-color:#fff;
      --main-color:#323232;
      --card-bg:#e5e7eb;
    }
    *{ box-sizing:border-box; margin:0; padding:0; }

    .garansi-container{ width:100%; max-width:900px; margin:0 auto; }
    h1{ font-size:22px; font-weight:900; margin-bottom:6px; color:var(--font-color); }
    .hint{ font-size:13px; color:#6b7280; margin-bottom:12px; }

    .wrapper{ width:100%; display:flex; justify-content:center; align-items:flex-start; }
    .card-switch{ width:100%; display:flex; justify-content:center; }

    .switch{
      width:100%;
      display:flex;
      flex-direction:column;
      align-items:center;
      gap:10px;
      margin-top:14px;
    }

    .toggle{ position:absolute; opacity:0; width:0; height:0; }

    .card-side{
      width:100%;
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin: 10px 0 10px;
      padding: 0 2px;
    }
    .card-side span{
      font-weight:900;
      font-size:14px;
      cursor:pointer;
      user-select:none;
      color:var(--font-color);
      padding:6px 10px;
      border-radius:10px;
      transition:.15s;
      opacity:.6;
    }
    .card-side span:active{ transform:translateY(1px); }

    /* ✅ underline aktif tergantung state */
    #flip:not(:checked) ~ .card-side .left{
      text-decoration: underline;
      opacity: 1;
    }
    #flip:checked ~ .card-side .right{
      text-decoration: underline;
      opacity: 1;
    }

    .slider-wrap{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      cursor:pointer;
      user-select:none;
      margin-bottom:4px;
    }
    .slider{
      width:60px;
      height:22px;
      border-radius:6px;
      border:2px solid var(--main-color);
      box-shadow:4px 4px var(--main-color);
      background:var(--bg-color);
      position:relative;
      display:inline-block;
      transition: background .25s ease;
    }
    .slider:before{
      content:"";
      position:absolute;
      height:20px;
      width:20px;
      left:-2px;
      top:-2px;
      border:2px solid var(--main-color);
      border-radius:6px;
      background:var(--bg-color);
      box-shadow:0 3px 0 var(--main-color);
      transition: transform .25s ease;
    }

    /* ✅ slider gerak saat checked */
    #flip:checked ~ .slider-wrap .slider{
      background:#18181b;
    }
    #flip:checked ~ .slider-wrap .slider:before{
      transform: translateX(38px);
    }

    .card-scene{
      width:100%;
      position:relative;
      perspective:1200px;
      will-change: height;
      transition: height .25s ease;
    }

    .card{
      position:absolute;
      inset:0;
      width:100%;
      transform-style:preserve-3d;
      transition: transform .7s cubic-bezier(.2,.8,.2,1);

      background:var(--card-bg);
      border:2px solid var(--main-color);
      border-radius:12px;
      box-shadow:6px 6px var(--main-color);

      transform: rotateY(0deg);
      will-change: transform;
    }

    /* ✅ INI yang bikin card bisa flip */
    #flip:checked ~ .card-scene .card{
      transform: rotateY(180deg);
    }

    .panel{
      position:absolute;
      inset:0;
      backface-visibility:hidden;
      -webkit-backface-visibility:hidden;
      pointer-events:none; /* default nonaktif */
    }
    .panel.back{ transform: rotateY(180deg); }

    /* ✅ hanya panel aktif yang bisa diklik */
    #flip:not(:checked) ~ .card-scene .panel.front{ pointer-events:auto; }
    #flip:checked ~ .card-scene .panel.back{ pointer-events:auto; }

    .panel-content{
      padding:24px;
      display:flex;
      flex-direction:column;
      gap:14px;
    }

    .title{ font-size:20px; font-weight:900; margin-bottom:2px; color:var(--font-color); }
    .subtitle{ font-size:13px; color:var(--font-color-sub); margin-bottom:6px; }

    form{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:14px;
      width:100%;
    }
    .full{ grid-column:1 / -1; }

    label.field-label{
      font-size:13px;
      font-weight:900;
      margin-bottom:6px;
      display:block;
      color:var(--font-color);
    }

    input, select, textarea{
      width:100%;
      padding:10px 12px;
      border-radius:8px;
      border:2px solid var(--main-color);
      background:var(--bg-color);
      box-shadow:4px 4px var(--main-color);
      font-size:14px;
      font-weight:700;
      color:var(--font-color);
      outline:none;
    }
    input:focus, select:focus, textarea:focus{ border-color:var(--input-focus); }
    textarea{ min-height:100px; resize:vertical; }

    .radio{
      display:flex;
      gap:16px;
      flex-wrap:wrap;
      padding-top:6px;
    }
    .radio label{
      font-weight:900;
      font-size:13px;
      display:flex;
      align-items:center;
      gap:8px;
    }
    .radio input{ width:auto; height:auto; padding:0; box-shadow:none; }

    .actions{
      grid-column:1 / -1;
      display:flex;
      justify-content:flex-end;
      margin-top:6px;
    }

    button{
      padding:12px 22px;
      font-weight:900;
      border:2px solid var(--main-color);
      background:var(--bg-color);
      border-radius:10px;
      box-shadow:4px 4px var(--main-color);
      cursor:pointer;
      transition:.15s;
    }
    button:active{ box-shadow:0 0 var(--main-color); transform:translate(3px,3px); }

    .actions button{
      font-size: 12px;
      padding: 10px 18px;
      border-radius: 9px;
      letter-spacing: .2px;
    }

    select[name="transaction_item_id"],
    select[name="bukti_login_id"]{
      font-size: 13px;
      padding: 9px 10px;
    }

    @media (max-width: 720px){
      form{ grid-template-columns:1fr; }
      .card-side span{ font-size:13px; }
      .panel-content{ padding:16px; }
      .title{ font-size:18px; }
    }
    @media (prefers-reduced-motion: reduce){
      .card, .card-scene, .slider, .slider:before{ transition:none; }
    }
  </style>
</head>

<body class="bg-[#F6F8FA] min-h-screen flex flex-col pb-28 md:pb-0 text-zinc-900">

  <header class="md:hidden px-5 pt-6 pb-2 bg-white sticky top-0 z-40 border-b border-zinc-50 shadow-sm">
    <div class="flex justify-between items-center">
      <div>
        <p class="text-[10px] text-zinc-400 font-medium uppercase tracking-wide">Bukti Garansi</p>
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

  <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-zinc-200 hidden md:block">
    <div class="container mx-auto max-w-6xl px-4 h-16 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <a href="/home" class="flex items-center gap-2 hover:opacity-80 transition">
          <img src="{{ asset('images/logo.jpg') }}" alt="PARI ID" class="hidden md:block h-8 w-auto object-contain">
          <span class="md:hidden font-bold text-xl text-zinc-900">PARI ID X CYAA STORE </span>
        </a>
      </div>

      <div class="flex items-center gap-8">
        <a href="/home" class="text-sm font-medium {{ request()->is('/home') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Home</a>
        <a href="/top-buyers" class="text-sm font-medium {{ request()->is('top-buyers') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Top</a>
        <a href="/riwayat" class="text-sm font-medium {{ request()->is('riwayat') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Riwayat</a>
        <a href="/redeem" class="text-sm font-medium {{ request()->is('redeem') ? 'text-zinc-500' : 'text-zinc-500 hover:text-zinc-900' }}">Redeem</a>
        <a href="/profile" class="text-sm font-medium {{ request()->is('profile') ? 'text-zinc-500' : 'text-zinc-500 hover:text-zinc-900' }}">Akun</a>
        <a href="/information" class="text-sm font-medium {{ request()->is('information') ? 'text-zinc-500' : 'text-zinc-500 hover:text-zinc-900' }}">Info</a>
        <a href="/bukti-garansi" class="text-sm font-bold {{ request()->is('bukti-garansi') ? 'text-zinc-900' : 'text-zinc-500 hover:text-zinc-900' }}">Bukti Garansi</a>
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

  <main class="w-full px-5 py-6 md:py-10">
    <div class="garansi-container">
      <h1>Bukti Login & Klaim Garansi</h1>
      <div class="hint">Semua data otomatis & hanya bisa dikirim 1x</div>

      <div class="mt-4 mb-6 bg-white border-2 border-zinc-900 rounded-xl shadow-[4px_4px_0_#18181b]">
        <button
          type="button"
          onclick="toggleContoh()"
          class="w-full flex items-center justify-between px-4 py-3 font-extrabold text-sm text-zinc-900"
        >
          <span>📌 CONTOH PENGISIAN FORM (WAJIB DIBACA)</span>
          <span id="iconContoh" class="transition-transform duration-300">›</span>
        </button>

        <div id="contohContent" class="hidden px-4 pb-4">
          <div class="space-y-3 text-sm font-semibold text-zinc-700">
            <div>
              <b>Upload Bukti / Bukti Masalah</b><br>
              Contoh: screenshot halaman login akun / error akun (gambar jelas, tidak blur)
            </div>
            <div>
              <b>Item</b><br>
              Contoh: <code>Netflix Premium</code>, <code>Spotify Family</code>, <code>Canva Pro</code>
            </div>
            <div>
              <b>Email Akun</b><br>
              Contoh: <code>example@gmail.com</code>
            </div>
            <div>
              <b>Password Akun</b> <span class="text-red-600">(khusus klaim garansi)</span><br>
              Contoh: <code>example123</code>
            </div>
            <div>
              <b>Nama Buyer</b> <span class="text-zinc-500">(bukti login)</span><br>
              Contoh: <code>Andi Pratama</code>
            </div>
            <div>
              <b>Durasi</b><br>
              Contoh: <code>30 Hari</code> / <code>1 Bulan</code>
            </div>
            <div>
              <b>Sisa Durasi</b> <span class="text-zinc-500">(klaim garansi)</span><br>
              Contoh: <code>18 Hari</code>
            </div>
            <div>
              <b>Device</b><br>
              Contoh: <code>Android</code>, <code>iPhone</code>, <code>Windows</code>, <code>MacBook</code>
            </div>
            <div>
              <b>Lokasi</b><br>
              Contoh: <code>Indonesia</code>, <code>Jakarta</code>
            </div>
            <div>
              <b>Tipe Akun</b> <span class="text-zinc-500">(bukti login)</span><br>
              Contoh: <code>Private</code> atau <code>Sharing</code>
            </div>
            <div>
              <b>Penggunaan</b><br>
              Contoh: <code>Pribadi</code> / <code>Cust</code>
            </div>
            <div>
              <b>Permasalahan</b> <span class="text-zinc-500">(klaim garansi)</span><br>
              Contoh:<br>
              <code>
                Akun logout sendiri dan tidak bisa login kembali,<br>
                muncul notifikasi email/password salah
              </code>
            </div>

            <div class="pt-2 text-red-600 font-extrabold">
              ⚠️ Pastikan semua data sesuai & benar sebelum klik KIRIM
            </div>
          </div>
        </div>
      </div>

      <div class="wrapper">
        <div class="card-switch">
          <div class="switch">

            <input type="checkbox" class="toggle" id="flip">

            <div class="card-side">
              <span class="left" onclick="setFlip(false)">Bukti Login</span>
              <span class="right" onclick="setFlip(true)">Klaim Garansi</span>
            </div>

            <label class="slider-wrap" for="flip" aria-label="Ganti form">
              <span class="slider"></span>
            </label>

            <div class="card-scene" id="scene">
              <div class="card" id="card">

                <div class="panel front" id="frontPanel">
                  <div class="panel-content" id="frontContent">
                    <div>
                      <div class="title">Bukti Login</div>
                      <div class="subtitle">Upload bukti login pembelian</div>
                    </div>

                    <form method="POST" action="{{ route('bukti-login.store') }}" enctype="multipart/form-data">
                      @csrf

                      <div class="full">
                        <label class="field-label">Upload Bukti</label>
                        <input type="file" name="image" required>
                      </div>

                      <div class="full">
                        <label class="field-label">Item (24 Jam)</label>
                        <select name="transaction_item_id" required>
                          <option value="">-- Pilih Item --</option>
                          @foreach($transactionItems as $ti)
                            <option value="{{ $ti->id }}" {{ old('transaction_item_id') == $ti->id ? 'selected' : '' }}>
                              {{ $ti->item->name }} ({{ $ti->created_at->format('d M Y') }})
                            </option>
                          @endforeach
                        </select>
                      </div>

                      <div>
                        <label class="field-label">Email Akun</label>
                        <input name="email_akun" value="{{ old('email_akun') }}" required>
                      </div>

                      <div>
                        <label class="field-label">Nama Buyer</label>
                        <input name="nama_buyer" value="{{ old('nama_buyer') }}" required>
                      </div>

                      <div class="full">
                        <label class="field-label">Durasi</label>
                        <input name="durasi" value="{{ old('durasi') }}" required>
                      </div>

                      <div>
                        <label class="field-label">Device</label>
                        <input name="device" value="{{ old('device') }}" required>
                      </div>

                      <div>
                        <label class="field-label">Lokasi</label>
                        <input name="lokasi" value="{{ old('lokasi') }}" required>
                      </div>

                      <div class="full">
                        <label class="field-label">Tipe Akun</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="tipe_akun" value="private" required
                              {{ old('tipe_akun') === 'private' ? 'checked' : '' }}>
                            Private
                          </label>
                          <label>
                            <input type="radio" name="tipe_akun" value="sharing" required
                              {{ old('tipe_akun') === 'sharing' ? 'checked' : '' }}>
                            Sharing
                          </label>
                        </div>
                      </div>

                      <div class="full">
                        <label class="field-label">Penggunaan</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="penggunaan" value="pribadi" required
                              {{ old('penggunaan') === 'pribadi' ? 'checked' : '' }}>
                            Pribadi
                          </label>
                          <label>
                            <input type="radio" name="penggunaan" value="cust" required
                              {{ old('penggunaan') === 'cust' ? 'checked' : '' }}>
                            Cust
                          </label>
                        </div>
                      </div>

                      <div class="actions">
                        <button type="submit">KIRIM</button>
                      </div>
                    </form>
                  </div>
                </div>

                <div class="panel back" id="backPanel">
                  <div class="panel-content" id="backContent">
                    <div>
                      <div class="title">Klaim Garansi</div>
                      <div class="subtitle">Item dari bukti login</div>
                    </div>

                    <form method="POST" action="{{ route('klaim-garansi.store') }}" enctype="multipart/form-data">
                      @csrf

                      <div class="full">
                        <label class="field-label">Upload Bukti Masalah</label>
                        <input type="file" name="image" required>
                      </div>

                      <div class="full">
                        <label class="field-label">Item</label>
                        <select name="bukti_login_id" required>
                          <option value="">-- Pilih Item --</option>
                          @foreach($itemsForGaransi as $b)
                            <option value="{{ $b->id }}" {{ old('bukti_login_id') == $b->id ? 'selected' : '' }}>
                              {{ $b->transactionItem->item->name }}
                            </option>
                          @endforeach
                        </select>
                      </div>

                      <div>
                        <label class="field-label">Tanggal Order</label>
                        <input type="date" value="{{ now()->toDateString() }}" readonly>
                      </div>

                      <div>
                        <label class="field-label">Tanggal Bermasalah</label>
                        <input type="date" value="{{ now()->toDateString() }}" readonly>
                      </div>

                      <div class="full">
                        <label class="field-label">Sisa Durasi</label>
                        <input name="sisa_durasi" value="{{ old('sisa_durasi') }}" required>
                      </div>

                      <div>
                        <label class="field-label">Email Akun</label>
                        <input name="email_akun" value="{{ old('email_akun') }}" required>
                      </div>

                      <div>
                        <label class="field-label">Password Akun</label>
                        <input name="password_akun" value="{{ old('password_akun') }}" required>
                      </div>

                      <div>
                        <label class="field-label">Device</label>
                        <input name="device" value="{{ old('device') }}" required>
                      </div>

                      <div>
                        <label class="field-label">Lokasi</label>
                        <input name="lokasi" value="{{ old('lokasi') }}" required>
                      </div>

                      <div class="full">
                        <label class="field-label">Penggunaan</label>
                        <div class="radio">
                          <label>
                            <input type="radio" name="penggunaan" value="pribadi" required
                              {{ old('penggunaan') === 'pribadi' ? 'checked' : '' }}>
                            Pribadi
                          </label>
                          <label>
                            <input type="radio" name="penggunaan" value="cust" required
                              {{ old('penggunaan') === 'cust' ? 'checked' : '' }}>
                            Cust
                          </label>
                        </div>
                      </div>

                      <div class="full">
                        <label class="field-label">Permasalahan</label>
                        <textarea name="permasalahan" required>{{ old('permasalahan') }}</textarea>
                      </div>

                      <div class="actions">
                        <button type="submit">KIRIM</button>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>

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
    function setFlip(state){
      const t = document.getElementById('flip');
      if (!t) return;

      t.checked = state;

      // biar konsisten dengan listener 'change'
      t.dispatchEvent(new Event('change', { bubbles: true }));
      syncHeight(true);
    }

    const flip = document.getElementById('flip');
    const scene = document.getElementById('scene');
    const frontContent = document.getElementById('frontContent');
    const backContent  = document.getElementById('backContent');

    function syncHeight(withDelay = false){
      if(!scene || !frontContent || !backContent || !flip) return;

      const activeContent = flip.checked ? backContent : frontContent;

      const apply = () => {
        const h = activeContent.offsetHeight;
        scene.style.height = h + "px";
      };

      requestAnimationFrame(apply);

      if(withDelay){
        setTimeout(apply, 350);
        setTimeout(apply, 750);
      }
    }

    flip?.addEventListener('change', () => syncHeight(true));
    window.addEventListener('load', () => syncHeight(true));

    window.addEventListener('resize', () => {
      clearTimeout(window.__rsz);
      window.__rsz = setTimeout(() => syncHeight(false), 80);
    });

    document.addEventListener('input', (e) => {
      if (e.target && (e.target.tagName === 'TEXTAREA' || e.target.tagName === 'SELECT' || e.target.tagName === 'INPUT')) {
        syncHeight(false);
      }
    });

    function toggleContoh() {
      const content = document.getElementById('contohContent');
      const icon = document.getElementById('iconContoh');

      content.classList.toggle('hidden');

      if (!content.classList.contains('hidden')) {
        icon.style.transform = 'rotate(90deg)';
      } else {
        icon.style.transform = 'rotate(0deg)';
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
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
</body>
</html>
