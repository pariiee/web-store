<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Item</title>

    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --gray-color: #6b7280;
            --border-color: #e5e7eb;
            --radius: 8px;
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background:#f5f7fa;
            padding:20px;
            color:var(--dark-color);
        }

        .container {
            max-width:900px;
            margin:auto;
        }

        /* HEADER */
        .header {
            display:flex;
            align-items:center;
            gap:10px;
            padding-bottom:15px;
            border-bottom:1px solid var(--border-color);
            margin-bottom:25px;
        }

        .header i {
            font-size:22px;
            color:var(--primary-color);
        }

        .header h1 {
            font-size:24px;
            margin:0;
        }

        /* CARD */
        .card {
            background:white;
            padding:25px;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            margin-bottom:25px;
        }

        .card h3 {
            font-size:18px;
            margin-bottom:15px;
            font-weight:600;
        }

        .info-row {
            display:flex;
            margin-bottom:10px;
            padding-bottom:10px;
            border-bottom:1px solid var(--border-color);
        }

        .info-row:last-child {
            border-bottom:none;
        }

        .info-row strong {
            min-width:140px;
            color:var(--gray-color);
        }

        textarea {
            width:100%;
            padding:12px 14px;
            border-radius:var(--radius);
            border:1px solid var(--border-color);
            font-family:monospace;
            min-height:250px;
            resize:vertical;
            transition:.3s;
            line-height:1.5;
            font-size:14px;
        }

        textarea:focus {
            outline:none;
            border-color:var(--primary-color);
            box-shadow:0 0 0 3px rgba(67,97,238,0.2);
        }

        .example-box {
            padding:15px;
            background:#eef2ff;
            border-radius:var(--radius);
            margin-bottom:15px;
            font-size:13px;
            font-family:monospace;
            white-space:pre-line;
            line-height:1.6;
            border-left:4px solid var(--primary-color);
        }

        .info-box {
            padding:12px;
            background:#fffbeb;
            border-radius:var(--radius);
            border-left:4px solid #f59e0b;
            margin-bottom:15px;
            font-size:13px;
            line-height:1.5;
        }

        .btn {
            padding:10px 18px;
            border-radius:var(--radius);
            cursor:pointer;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            font-size:14px;
            font-weight:500;
        }

        .btn-primary {
            background:var(--primary-color);
            color:white;
        }

        .btn-primary:hover {
            background:#314ad4;
        }

        .btn-secondary {
            background:#e5e7eb;
            color:var(--dark-color);
        }

        .btn-secondary:hover {
            background:#d5d7da;
        }

        .button-group {
            display:flex;
            gap:10px;
            margin-top:20px;
        }

        /* Error */
        .alert-danger {
            background:#fee2e2;
            padding:12px 14px;
            border-radius:var(--radius);
            border-left:4px solid var(--danger-color);
            margin-bottom:20px;
            color:#991b1b;
        }

        .alert-danger ul {
            margin:0;
            padding-left:20px;
        }

        .counter {
            text-align:right;
            font-size:12px;
            color:var(--gray-color);
            margin-top:5px;
        }

        .format-hint {
            display:flex;
            gap:10px;
            margin-bottom:10px;
            font-size:13px;
        }

        .format-badge {
            padding:4px 10px;
            background:#d1fae5;
            color:#065f46;
            border-radius:4px;
            font-size:12px;
            font-weight:500;
        }
    </style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <i class="fas fa-boxes-stacked"></i>
        <h1>Tambah Stok Item</h1>
    </div>

    <!-- ERROR VALIDATION -->
    @if($errors->any())
        <div class="alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- INFO ITEM -->
    <div class="card">
        <h3>Informasi Item</h3>

        <div class="info-row">
            <strong>Produk</strong>
            <span>{{ $item->product->name }}</span>
        </div>

        <div class="info-row">
            <strong>Nama Item</strong>
            <span>{{ $item->name }}</span>
        </div>

        <div class="info-row">
            <strong>ID Item</strong>
            <span>#{{ $item->id }}</span>
        </div>

        <div class="info-row">
            <strong>Stok Saat Ini</strong>
            <span>{{ $item->stocks_count ?? $item->stocks()->count() }}</span>
        </div>
    </div>

    <!-- FORM -->
    <div class="card">
        <form action="{{ route('admin.stocks.store', $item->id) }}" method="POST">
            @csrf

            <div class="info-box">
                <strong><i class="fas fa-lightbulb"></i> CARA KERJA:</strong> 
                Sistem akan otomatis mendeteksi format:
                <ul style="margin:8px 0 0 0; padding-left:20px;">
                    <li><strong>Dengan nomor (1., 2., 3.)</strong> → Multi stok (setiap nomor = stok terpisah)</li>
                    <li><strong>Tanpa nomor</strong> → Single stok (semua teks = 1 stok utuh)</li>
                </ul>
            </div>

            <div class="format-hint">
                <span class="format-badge">Format Auto-Detect</span>
                <span id="detectedFormat">Sistem akan mendeteksi saat Anda mengetik</span>
            </div>

            <div class="example-box">
<strong>Contoh 1 (Multi Stok):</strong>
1. example.com passwordku
2. example.id sandisusah
3. contoh.net user:admin

<strong>Contoh 2 (Single Stok):</strong>
example.com
username: user@mail.com
password: rahasia123
expired: 30 hari
            </div>

            <label><strong>Data Stok</strong></label>
            <textarea 
                name="data" 
                required 
                placeholder="Masukkan data stok di sini...
Contoh multi stok:
1. example.com password123
2. example.id sandi456

Atau single stok:
example.com
username: admin
password: rahasia"
                oninput="detectFormat(this)"
                id="dataInput">{{ old('data') }}</textarea>
            
            <div class="counter" id="counter">-</div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Stok
                </button>

                <a href="{{ route('admin.stocks.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </form>
    </div>

</div>

<script>
    // Deteksi format saat user mengetik
    function detectFormat(textarea) {
        const text = textarea.value.trim();
        let format = '';
        let count = 0;
        
        if (text) {
            // Cek apakah ada pola: angka dengan titik di awal baris
            if (text.match(/^\s*\d+\./m)) {
                format = 'MULTI STOK';
                // Hitung jumlah nomor
                const matches = text.match(/^\d+\./gm);
                count = matches ? matches.length : 1;
            } else {
                format = 'SINGLE STOK';
                count = 1;
            }
            
            document.getElementById('detectedFormat').textContent = 
                `Terdeteksi: ${format} (${count} stok akan dibuat)`;
            document.getElementById('counter').textContent = 
                `${count} stok akan dibuat`;
        } else {
            document.getElementById('detectedFormat').textContent = 
                'Sistem akan mendeteksi saat Anda mengetik';
            document.getElementById('counter').textContent = '-';
        }
    }

    // Auto-detect saat load
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('dataInput');
        detectFormat(textarea);
    });
</script>

</body>
</html>