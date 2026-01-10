<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item Baru</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
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
        }

        .container {
            max-width:800px;
            margin:auto;
        }

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
        }

        .card {
            background:white;
            padding:25px;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
        }

        label {
            font-size:14px;
            font-weight:600;
            display:block;
            margin-bottom:6px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width:100%;
            padding:10px 14px;
            border:1px solid var(--border-color);
            border-radius:var(--radius);
            font-size:14px;
            margin-bottom:15px;
            transition:.3s;
        }

        input:focus, select:focus {
            outline:none;
            border-color:var(--primary-color);
            box-shadow:0 0 0 3px rgba(67,97,238,0.15);
        }

        .btn {
            padding:10px 18px;
            border-radius:var(--radius);
            cursor:pointer;
            text-decoration:none;
            font-size:14px;
            font-weight:500;
            display:inline-flex;
            align-items:center;
            gap:6px;
        }

        .btn-primary {
            background:var(--primary-color);
            color:white;
        }

        .btn-secondary {
            background:#e5e7eb;
            color:var(--dark-color);
        }

        .btn-primary:hover { background:#314ad4; }
        .btn-secondary:hover { background:#d5d7da; }

        .alert-danger {
            background:#fee2e2;
            padding:12px 16px;
            border-left:4px solid var(--danger-color);
            border-radius:var(--radius);
            margin-bottom:20px;
            color:#991b1b;
        }
    </style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <i class="fas fa-plus-circle"></i>
        <h1>Tambah Item Baru</h1>
    </div>

    <!-- ERROR VALIDATION (JIKA ADA) -->
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

    <!-- FORM -->
    <div class="card">
        <form action="{{ route('admin.items.store') }}" method="POST">
            @csrf

            <!-- PILIH PRODUK -->
            <label>Produk</label>

            @if(isset($selectedProduct))
                <input type="hidden" name="product_id" value="{{ $selectedProduct->id }}">
                <div style="padding:10px 0; font-weight:bold;">
                    {{ $selectedProduct->name }}
                </div>
            @else
                <select name="product_id" required>
                    <option value="" disabled selected>-- Pilih Produk --</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            @endif

            <!-- NAMA ITEM -->
            <label>Nama Item</label>
            <input type="text" name="name" required placeholder="Contoh: Item Premium">

            <!-- HARGA GUEST -->
            <label>Harga Guest</label>
            <input type="number" name="price_guest" required placeholder="Contoh: 20000">

            <!-- HARGA RESELLER -->
            <label>Harga Reseller</label>
            <input type="number" name="price_reseller" required placeholder="Contoh: 15000">

            <!-- BUTTON ACTION -->
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>

                <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

        </form>
    </div>

</div>

</body>
</html>
