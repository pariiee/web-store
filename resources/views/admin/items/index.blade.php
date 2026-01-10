<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk - Manage Items</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root{
            --primary:#4361ee;
            --success:#10b981;
            --border:#e5e7eb;
            --text:#1f2937;
            --muted:#6b7280;
            --bg:#f5f7fa;
            --radius:8px;
            --shadow:0 4px 6px rgba(0,0,0,0.05);
        }

        *{ box-sizing:border-box; margin:0; padding:0; }

        /* ✅ body tanpa padding biar tidak nabrak navbar */
        body{
            font-family:'Segoe UI', sans-serif;
            background:var(--bg);
            color:var(--text);
        }

        /* ✅ wrapper konten: bikin isi turun & aman */
        .page{
            padding:28px 20px 24px;
        }
        @media (min-width:768px){
            .page{ padding-top:48px; } /* aman untuk navbar sticky top-4 */
        }

        .container{ max-width:1300px; margin:auto; }

        .header{
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:25px;
            padding-bottom:15px;
            border-bottom:1px solid var(--border);
        }
        .header h1{ font-size:24px; margin:0; }
        .header i{ color:var(--primary); font-size:22px; }

        .search-box{ width:300px; margin-bottom:20px; position:relative; }
        .search-box input{
            width:100%;
            padding:10px 15px 10px 40px;
            border-radius:var(--radius);
            border:1px solid var(--border);
            outline:none;
            background:white;
        }
        .search-box i{
            position:absolute;
            top:50%;
            left:12px;
            transform:translateY(-50%);
            color:var(--muted);
        }

        .table-container{
            background:white;
            border-radius:var(--radius);
            overflow:hidden;
            box-shadow:var(--shadow);
        }
        table{ width:100%; border-collapse:collapse; }
        thead{ background:#eef2ff; }
        th, td{ padding:16px 20px; border-bottom:1px solid var(--border); }

        .badge{
            background:#eef2ff;
            color:#3730a3;
            padding:6px 12px;
            border-radius:6px;
            font-size:12px;
            display:inline-block;
        }

        .actions{ display:flex; gap:10px; justify-content:center; flex-wrap:wrap; }

        .btn-small{
            padding:7px 12px;
            border-radius:var(--radius);
            font-size:12px;
            text-decoration:none;
            color:white;
            display:flex;
            align-items:center;
            gap:6px;
            white-space:nowrap;
        }
        .btn-primary{ background:var(--primary); }
        .btn-success{ background:var(--success); }
        .btn-primary:hover{ background:#3446d4; }
        .btn-success:hover{ background:#0a8d6a; }

        /* ✅ responsive */
        @media (max-width:768px){
            .search-box{ width:100%; }
            .table-container{ overflow-x:auto; }
            table{ min-width:700px; }
        }
    </style>
</head>

<body>
    <!-- ✅ taruh di dalam body -->
    <x-sidebar />

    <!-- ✅ konten aman tidak ketiban -->
    <main class="page">
        <div class="container">

            <div class="header">
                <i class="fas fa-list"></i>
                <h1>Daftar Produk (Manage Items)</h1>
            </div>

            <form method="GET" class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari produk ...">
            </form>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Total Item</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->name }}</td>

                            <td>
                                <span class="badge">{{ $p->items_count }}</span>
                            </td>

                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.items.create', ['product_id' => $p->id]) }}"
                                       class="btn-small btn-primary">
                                        <i class="fas fa-plus"></i> Tambah Item
                                    </a>

                                    <a href="{{ route('admin.items.product.show', $p->id) }}"
                                       class="btn-small btn-success">
                                        <i class="fas fa-eye"></i> Lihat Item
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            <div style="margin-top:20px;">
                {{ $products->links() }}
            </div>

        </div>
    </main>
</body>
</html>
