<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Item - {{ $item->name }}</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --danger-color: #ef4444;
            --success-color: #10b981;
            --dark-color: #1f2937;
            --gray-color: #6b7280;
            --border-color: #e5e7eb;
            --radius: 8px;
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        body {
            background:#f5f7fa;
            font-family:'Segoe UI',sans-serif;
            padding:20px;
            color:var(--dark-color);
        }

        .container {
            max-width:1200px;
            margin:auto;
        }

        /* HEADER */
        .header {
            display:flex;
            flex-direction:column;
            gap:5px;
            padding-bottom:15px;
            border-bottom:1px solid var(--border-color);
            margin-bottom:25px;
        }

        .header-title {
            display:flex;
            align-items:center;
            gap:10px;
        }

        .header-title i {
            font-size:22px;
            color:var(--primary-color);
        }

        .header-title h1 {
            font-size:24px;
        }

        .sub {
            color:var(--gray-color);
            font-size:14px;
        }

        /* INFO CARD */
        .card {
            background:white;
            padding:25px;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            margin-bottom:25px;
        }

        .info-grid {
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
            gap:20px;
        }

        .info-box strong {
            font-size:13px;
            color:var(--gray-color);
        }

        .info-box div {
            font-size:18px;
            font-weight:600;
            margin-top:3px;
        }

        .badge {
            display:inline-block;
            padding:5px 12px;
            border-radius:var(--radius);
            background:#d1fae5;
            color:#065f46;
            font-size:12px;
        }

        /* TABLE */
        .table-container {
            background:white;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            overflow:hidden;
        }

        table {
            width:100%;
            border-collapse:collapse;
        }

        thead {
            background:var(--primary-light);
        }

        th, td {
            padding:16px 20px;
            border-bottom:1px solid var(--border-color);
            font-size:14px;
        }

        tbody tr:hover {
            background:#f9fafb;
        }

        .data-box {
            background:#f3f4f6;
            padding:10px 14px;
            border-left:4px solid var(--primary-color);
            border-radius:var(--radius);
            font-family:monospace;
            white-space:pre-wrap;
            font-size:13px;
        }

        .actions {
            display:flex;
            gap:10px;
            justify-content:center;
        }

        .btn-icon {
            width:36px;
            height:36px;
            border-radius:var(--radius);
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            cursor:pointer;
        }

        .btn-delete { background:var(--danger-color); }
        .btn-delete:hover { background:#dc2626; }

        /* FOOTER */
        .footer {
            margin-top:20px;
            padding-top:15px;
            border-top:1px solid var(--border-color);
            display:flex;
            justify-content:space-between;
            color:var(--gray-color);
        }

        .btn-back {
            padding:10px 14px;
            background:#e5e7eb;
            text-decoration:none;
            border-radius:var(--radius);
            color:var(--dark-color);
        }

        .btn-back:hover {
            background:#d5d7da;
        }

        /* MODAL */
        .modal {
            position:fixed;
            inset:0;
            background:rgba(0,0,0,0.5);
            display:none;
            justify-content:center;
            align-items:center;
            z-index:9999;
        }

        .modal-content {
            background:white;
            width:380px;
            padding:25px;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
        }

        .modal-header {
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:15px;
        }

        .modal-header i {
            color:var(--danger-color);
            font-size:22px;
        }

        .modal-footer {
            display:flex;
            justify-content:flex-end;
            gap:10px;
            margin-top:20px;
        }

        .btn-cancel {
            background:#e5e7eb;
            padding:8px 12px;
            border-radius:var(--radius);
            cursor:pointer;
        }

        .btn-danger {
            background:var(--danger-color);
            color:white;
            padding:8px 12px;
            border-radius:var(--radius);
        }

        .btn-danger:hover { background:#dc2626; }

    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="header-title">
            <i class="fas fa-boxes-stacked"></i>
            <h1>Stok Item: {{ $item->name }}</h1>
        </div>
        <div class="sub">Manajemen stok untuk item ini</div>
    </div>

    <!-- INFO CARD -->
    <div class="card">
        <div class="info-grid">
            <div class="info-box">
                <strong>Produk</strong>
                <div>{{ $item->product->name }}</div>
            </div>

            <div class="info-box">
                <strong>Total Stok</strong>
                <div>{{ $stocks->count() }}</div>
            </div>

            <div class="info-box">
                <strong>Status</strong>
                <div><span class="badge">Aktif</span></div>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Stok</th>
                    <th>Data Stok</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($stocks as $stock)
                <tr>
                    <td>#{{ $stock->id }}</td>
                    <td>
                        <div class="data-box">{{ $stock->data }}</div>
                    </td>
                    <td>
                        <div class="actions">
                            <button class="btn-icon btn-delete delete-btn"
                                data-id="{{ $stock->id }}"
                                data-text="{{ $stock->data }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center; padding:40px; color:var(--gray-color);">
                        <i class="fas fa-inbox" style="font-size:40px; margin-bottom:10px;"></i><br>
                        Tidak ada stok tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <span>Menampilkan {{ $stocks->count() }} data</span>
        <a href="{{ route('admin.stocks.index') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

</div>

<!-- MODAL DELETE -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <i class="fas fa-exclamation-triangle"></i>
            <h3>Konfirmasi Hapus</h3>
        </div>

        <p>Apakah Anda yakin ingin menghapus data stok ini?</p>

        <form id="deleteForm" method="POST" style="margin-top:20px;">
            @csrf
            @method('DELETE')

            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-danger">Hapus</button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById("deleteModal");
    const deleteForm = document.getElementById("deleteForm");

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.onclick = () => {
            const id = btn.dataset.id;
            deleteForm.action = `/admin/stocks/${id}`;
            modal.style.display = "flex";
        };
    });

    function closeModal() {
        modal.style.display = "none";
    }

    window.onclick = e => {
        if (e.target === modal) closeModal();
    };
</script>

</body>
</html>
