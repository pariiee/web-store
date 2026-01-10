<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Stok Item</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --gray-color: #9ca3af;
            --border-color: #e5e7eb;
            --radius: 8px;
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        * { box-sizing: border-box; }

        /* ✅ body tanpa padding, padding pindah ke .page */
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
            color: var(--dark-color);
            margin: 0;
        }

        /* ✅ wrapper konten biar turun & nggak nabrak navbar */
        .page{
            padding: 28px 15px 24px;
        }
        @media (min-width:768px){
            .page{ padding-top: 48px; } /* aman untuk navbar desktop sticky top-4 */
        }

        .container {
            max-width: 1300px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
            gap: 15px;
        }

        .header h1 {
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .header h1 i { color: var(--primary-color); }

        .notification.success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px 16px;
            border-left: 4px solid var(--success-color);
            border-radius: var(--radius);
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: 14px;
        }

        .search-box {
            position: relative;
            width: 100%;
            max-width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            font-size: 14px;
            background: white;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67,97,238,0.15);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
        }

        .table-container {
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        thead { background: var(--primary-light); }

        th, td {
            padding: 14px 12px;
            border-bottom: 1px solid var(--border-color);
            text-align: left;
        }

        th { font-weight: 600; font-size: 14px; }
        td { font-size: 14px; }

        tbody tr:hover { background: #f9fafb; }

        .badge-stock {
            background: #eef2ff;
            color: #3730a3;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            display: inline-block;
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            text-decoration: none;
            color: white;
            transition: all 0.2s ease;
            position: relative;
        }

        .btn-icon:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .btn-primary { background: var(--primary-color); }
        .btn-success { background: var(--success-color); }

        .btn-primary:hover { background: #3446d4; }
        .btn-success:hover { background: #0a8d6a; }

        .empty {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-color);
        }

        .empty i { font-size: 40px; margin-bottom: 10px; }

        /* Tooltip desktop */
        .btn-icon::after {
            content: attr(title);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 6px 10px;
            background: var(--dark-color);
            color: white;
            font-size: 12px;
            border-radius: 4px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            pointer-events: none;
            margin-bottom: 8px;
            z-index: 10;
        }

        .btn-icon::before {
            content: '';
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            border: 5px solid transparent;
            border-top-color: var(--dark-color);
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            margin-bottom: -2px;
            z-index: 10;
        }

        .btn-icon:hover::after,
        .btn-icon:hover::before {
            opacity: 1;
            visibility: visible;
        }

        /* Pagination */
        .pagination-container {
            margin-top: 20px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header { flex-direction: column; align-items: flex-start; }
            .header h1 { font-size: 18px; }
            .search-box { max-width: 100%; }
            th, td { padding: 12px 8px; }

            .actions {
                flex-direction: column;
                align-items: center;
                gap: 5px;
            }

            .btn-icon { width: 32px; height: 32px; }
            .btn-icon i { font-size: 14px; }
            .badge-stock { padding: 4px 8px; font-size: 11px; }
        }

        @media (max-width: 480px) {
            /* Hide tooltip on mobile */
            .btn-icon::after,
            .btn-icon::before { display: none; }
        }

        @media print {
            body { background: white; }
            .header,
            .notification.success,
            .search-box,
            .actions { display: none; }
            .table-container {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>

<body>
    <!-- ✅ taruh di DALAM body -->
    <x-sidebar />

    <!-- ✅ konten dibungkus page biar aman -->
    <main class="page">
        <div class="container">

            <div class="header">
                <h1><i class="fas fa-boxes"></i> Manajemen Stok Item</h1>

                <form method="GET" class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" value="{{ $q }}" placeholder="Cari item / produk...">
                </form>
            </div>

            @if(session('success'))
            <div class="notification success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Nama Item</th>
                            <th>Harga Guest</th>
                            <th>Harga Reseller</th>
                            <th>Stok</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>Rp {{ number_format($item->price_guest,0,',','.') }}</td>
                            <td>Rp {{ number_format($item->price_reseller,0,',','.') }}</td>

                            <td>
                                <span class="badge-stock">{{ $item->stocks_count }}</span>
                            </td>

                            <td style="text-align:center;">
                                <div class="actions">
                                    <a href="{{ route('admin.stocks.create', $item->id) }}"
                                       class="btn-icon btn-primary" title="Tambah Stok">
                                        <i class="fas fa-plus"></i>
                                    </a>

                                    <a href="{{ route('admin.stocks.show', $item->id) }}"
                                       class="btn-icon btn-success" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty">
                                    <i class="fas fa-inbox"></i>
                                    <p>Belum ada data stok item.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

            @if($items->hasPages())
            <div class="pagination-container">
                {{ $items->links() }}
            </div>
            @endif

        </div>
    </main>

    <script>
        // Tooltip long-press mobile (tetap aman)
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-icon');

            buttons.forEach(button => {
                let touchTimer;

                button.addEventListener('touchstart', function() {
                    touchTimer = setTimeout(() => {
                        const tooltip = document.createElement('div');
                        tooltip.textContent = this.getAttribute('title');
                        tooltip.style.position = 'absolute';
                        tooltip.style.background = 'var(--dark-color)';
                        tooltip.style.color = 'white';
                        tooltip.style.padding = '6px 10px';
                        tooltip.style.borderRadius = '4px';
                        tooltip.style.fontSize = '12px';
                        tooltip.style.zIndex = '1000';
                        tooltip.style.bottom = '100%';
                        tooltip.style.left = '50%';
                        tooltip.style.transform = 'translateX(-50%)';
                        tooltip.style.marginBottom = '8px';

                        this.appendChild(tooltip);

                        setTimeout(() => {
                            if (this.contains(tooltip)) this.removeChild(tooltip);
                        }, 1500);
                    }, 500);
                });

                button.addEventListener('touchend', () => clearTimeout(touchTimer));
                button.addEventListener('touchmove', () => clearTimeout(touchTimer));
            });
        });
    </script>
</body>
</html>
