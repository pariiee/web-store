<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>

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
            color:var(--dark-color);
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

        .header h1 {
            font-size:24px;
        }

        .header i {
            color:var(--primary-color);
            font-size:22px;
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
            margin-bottom:6px;
            display:block;
        }

        input[type="text"],
        input[type="number"] {
            width:100%;
            padding:10px 14px;
            border:1px solid var(--border-color);
            border-radius:var(--radius);
            font-size:14px;
            margin-bottom:15px;
            transition:.3s;
        }

        input:focus {
            outline:none;
            border-color:var(--primary-color);
            box-shadow:0 0 0 3px rgba(67,97,238,0.15);
        }

        .read-only-box {
            padding:10px 14px;
            background:#f3f4f6;
            border-radius:var(--radius);
            font-weight:600;
            margin-bottom:15px;
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
        <i class="fas fa-edit"></i>
        <h1>Edit Item</h1>
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

    <!-- FORM CARD -->
    <div class="card">
        <form action="{{ route('admin.items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- PRODUK (READ ONLY) -->
            <label>Produk</label>
            <div class="read-only-box">
                {{ $item->product->name }}
            </div>
            <input type="hidden" name="product_id" value="{{ $item->product_id }}">

            <!-- NAMA ITEM -->
            <label>Nama Item</label>
            <input type="text" name="name" required value="{{ $item->name }}">

            <!-- HARGA GUEST -->
            <label>Harga Guest</label>
            <input type="number" name="price_guest" required value="{{ $item->price_guest }}">

            <!-- HARGA RESELLER -->
            <label>Harga Reseller</label>
            <input type="number" name="price_reseller" required value="{{ $item->price_reseller }}">

            <!-- ACTION BUTTONS -->
            <div style="margin-top:20px; display:flex; gap:10px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
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
