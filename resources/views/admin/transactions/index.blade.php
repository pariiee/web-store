<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi Semua User</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --danger-color: #ef4444;
            --dark-color: #1f2937;
            --gray-color: #6b7280;
            --border-color: #e5e7eb;
            --radius: 8px;
            --shadow: 0 4px 6px rgba(0,0,0,0.08);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        /* ✅ body tanpa padding biar nggak nabrak navbar */
        body {
            background:#f5f7fa;
            font-family:'Segoe UI',sans-serif;
            color:var(--dark-color);
        }

        /* ✅ wrapper konten (yang bikin turun & aman) */
        .page{
            padding: 28px 20px 24px;
        }
        @media (min-width:768px){
            .page{ padding-top: 48px; } /* aman utk navbar desktop sticky top-4 */
        }

        .container {
            max-width:1200px;
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

        .table-container {
            background:white;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            overflow:hidden;
            margin-bottom:20px;

            /* ✅ biar aman di HP */
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width:100%;
            border-collapse:collapse;
            min-width: 900px; /* ✅ biar kolom ga mepet di mobile */
        }

        thead {
            background:var(--primary-light);
        }

        th, td {
            padding:16px 20px;
            border-bottom:1px solid var(--border-color);
            font-size:14px;
            text-align:left;
            white-space: nowrap;
        }

        th.sticky {
            position:sticky;
            top:0;
            z-index:2;
        }

        tbody tr:hover { background:#f9fafb; }

        .minus {
            color:var(--danger-color);
            font-weight:600;
        }

        .pagination {
            display:flex;
            justify-content:center;
            gap:6px;
            margin-top:20px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding:8px 12px;
            border-radius:var(--radius);
            background:white;
            border:1px solid var(--border-color);
            text-decoration:none;
            color:var(--primary-color);
            font-size:14px;
            min-width: 40px;
            text-align: center;
        }

        .pagination a:hover {
            background:var(--primary-color);
            color:white;
            border-color:var(--primary-color);
        }

        .active-page {
            background:var(--primary-color) !important;
            color:white !important;
            border-color:var(--primary-color) !important;
            font-weight:600;
        }

        @media (max-width: 768px){
            .page{ padding-left: 14px; padding-right: 14px; }
            .header h1{ font-size: 20px; }
        }
    </style>
</head>

<body>
    <!-- ✅ taruh di DALAM body -->
    <x-sidebar />

    <!-- ✅ konten dibungkus biar turun & aman -->
    <main class="page">
        <div class="container">

            <div class="header">
                <i class="fas fa-history"></i>
                <h1>Riwayat Transaksi Pembelian Item (Semua User)</h1>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th class="sticky">ID TX</th>
                            <th class="sticky">Tanggal</th>
                            <th class="sticky">User</th>
                            <th class="sticky">Email</th>
                            <th class="sticky">Item</th>
                            <th class="sticky">Qty</th>
                            <th class="sticky">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transactions as $tx)
                            @php
                                $firstItem = $tx->items->first();
                            @endphp

                            <tr>
                                <td>#{{ $tx->id }}</td>
                                <td>{{ $tx->created_at->translatedFormat('d F Y') }}</td>
                                <td>{{ $tx->user->name ?? '-' }}</td>
                                <td>{{ $tx->user->email ?? '-' }}</td>
                                <td>{{ $firstItem->item->name ?? '-' }}</td>
                                <td>{{ $firstItem->quantity ?? 0 }}</td>
                                <td class="minus">- Rp {{ number_format($tx->total_amount,0,',','.') }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center; padding:25px; color:var(--gray-color); white-space: normal;">
                                    <i class="fas fa-inbox" style="font-size:36px; margin-bottom:10px;"></i><br>
                                    Belum ada transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                @if ($transactions->onFirstPage())
                    <span>«</span>
                @else
                    <a href="{{ $transactions->previousPageUrl() }}">«</a>
                @endif

                @foreach(range(1, $transactions->lastPage()) as $page)
                    @if ($page == $transactions->currentPage())
                        <span class="active-page">{{ $page }}</span>
                    @else
                        <a href="{{ $transactions->url($page) }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($transactions->hasMorePages())
                    <a href="{{ $transactions->nextPageUrl() }}">»</a>
                @else
                    <span>»</span>
                @endif
            </div>

        </div>
    </main>
</body>
</html>
