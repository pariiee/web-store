<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Produk - {{ $product->name }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            max-width:1300px;
            margin:auto;
        }

        /* HEADER */
        .header {
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:25px;
            padding-bottom:15px;
            border-bottom:1px solid var(--border-color);
        }

        .header h1 {
            font-size:24px;
            margin:0;
        }

        .header i {
            font-size:22px;
            color:var(--primary-color);
        }

        .btn-back {
            display:inline-flex;
            align-items:center;
            gap:6px;
            background:#e5e7eb;
            padding:8px 14px;
            border-radius:var(--radius);
            text-decoration:none;
            color:var(--dark-color);
            font-size:14px;
            margin-bottom:20px;
        }

        .btn-back:hover {
            background:#d5d7da;
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

        .badge-stock {
            background:#eef2ff;
            color:#3730a3;
            padding:5px 10px;
            border-radius:6px;
            font-size:12px;
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
            text-decoration:none;
        }

        .btn-edit { background:var(--primary-color); }
        .btn-delete { background:var(--danger-color); }

        .btn-icon:hover {
            opacity:.85;
        }

        .empty {
            text-align:center;
            padding:40px;
            color:var(--gray-color);
        }

        /* MODAL */
        .modal {
            position:fixed;
            left:0; top:0;
            width:100%; height:100%;
            background:rgba(0,0,0,0.5);
            display:none;
            justify-content:center;
            align-items:center;
            z-index:1000;
        }

        .modal-content {
            background:white;
            padding:25px;
            width:450px;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
        }
    </style>

</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <i class="fas fa-box-open"></i>
        <h1>Item pada Produk: {{ $product->name }}</h1>
    </div>

    <!-- BACK BUTTON -->
    <a href="{{ route('admin.items.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <!-- TABLE -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Item</th>
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
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>

                    <td>Rp {{ number_format($item->price_guest,0,',','.') }}</td>
                    <td>Rp {{ number_format($item->price_reseller,0,',','.') }}</td>

                    <td>
                        <span class="badge-stock">{{ $item->stocks_count }}</span>
                    </td>

                    <td style="text-align:center;">
                        <div class="actions">
                            <!-- Edit -->
                            <a href="{{ route('admin.items.edit', $item->id) }}" class="btn-icon btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete -->
                            <button type="button"
                                class="btn-icon btn-delete delete-btn"
                                data-id="{{ $item->id }}"
                                data-name="{{ $item->name }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="6">
                        <div class="empty">
                            <i class="fas fa-inbox" style="font-size:40px;"></i>
                            <p>Belum ada item pada produk ini.</p>
                        </div>
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>

</div>

<!-- MODAL DELETE -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <h3>Konfirmasi Hapus</h3>
        <p>Hapus item <b id="itemName"></b>? Tindakan ini tidak dapat dibatalkan.</p>

        <form id="deleteForm" method="POST" style="margin-top:15px; text-align:right;">
            @csrf
            @method('DELETE')

            <button type="button" onclick="closeModal()" class="btn-back" 
                style="display:inline-flex; background:#e5e7eb; padding:8px 14px;">
                Batal
            </button>

            <button type="submit" 
                style="padding:8px 14px; border-radius:var(--radius); background:var(--danger-color); color:white;">
                Hapus
            </button>
        </form>
    </div>
</div>

<script>
    const deleteModal = document.getElementById("deleteModal");
    const deleteButtons = document.querySelectorAll(".delete-btn");
    const deleteForm = document.getElementById("deleteForm");
    const itemName = document.getElementById("itemName");

    deleteButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const name = btn.dataset.name;

            itemName.textContent = name;
            deleteForm.action = `/admin/items/${id}`;

            deleteModal.style.display = "flex";
        });
    });

    function closeModal() {
        deleteModal.style.display = "none";
    }

    window.addEventListener("click", e => {
        if (e.target === deleteModal) closeModal();
    });
</script>

</body>
</html>
