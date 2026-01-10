<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
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

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background:#f5f7fa;
            color:var(--dark-color);
        }

        .page{
            padding: 28px 20px 24px;
        }
        
        @media (min-width:768px){
            .page{ padding-top: 48px; }
        }

        .container {
            max-width:1300px;
            margin:auto;
        }

        .header {
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding-bottom:15px;
            border-bottom:1px solid var(--border-color);
            margin-bottom:25px;
        }

        .header h1 {
            font-size:24px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .header h1 i { color:var(--primary-color); }

        .btn {
            padding:10px 16px;
            border-radius:var(--radius);
            cursor:pointer;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            gap:7px;
            font-size:14px;
            border: none;
        }

        .btn-primary {
            background:var(--primary-color);
            color:white;
        }

        .btn-primary:hover { background:#314ad4; }

        .notification {
            background:#d1fae5;
            color:#065f46;
            padding:12px 16px;
            border-left:4px solid var(--success-color);
            border-radius:var(--radius);
            margin-bottom:25px;
            display:flex;
            gap:10px;
            align-items:center;
        }

        .table-container {
            background:white;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
            overflow:hidden;
        }

        table { width:100%; border-collapse:collapse; }
        thead { background:var(--primary-light); }

        th, td {
            padding:16px 18px;
            border-bottom:1px solid var(--border-color);
            font-size:14px;
            vertical-align: middle;
        }

        tbody tr:hover { background:#f9fafb; }

        .actions {
            display:flex;
            gap:10px;
            justify-content:center;
            flex-wrap: wrap;
        }

        .btn-icon {
            width:36px;
            height:36px;
            border-radius:var(--radius);
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            border: none;
            cursor: pointer;
        }

        .btn-edit { background:var(--primary-color); }
        .btn-delete { background:var(--danger-color); }

        .btn-edit:hover { background:#314ad4; }
        .btn-delete:hover { background:#dc2626; }

        .badge {
            background:#eef2ff;
            color:#4338ca;
            padding:4px 8px;
            border-radius:5px;
            font-size:12px;
            margin-right:4px;
            margin-bottom:4px;
            display:inline-block;
        }

        .badge-inactive {
            background:#fee2e2;
            color:#991b1b;
        }

        /* Thumbnail dengan crop persegi */
        .thumbnail-square {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }

        .no-thumbnail {
            width: 55px;
            height: 55px;
            background: #f3f4f6;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-color);
            font-size: 12px;
        }

        /* Responsive table */
        @media (max-width: 768px){
            .table-container{ overflow-x:auto; }
            table{ min-width: 900px; }
        }

        /* Modal */
        .modal {
            position:fixed;
            left:0;top:0;
            width:100%;height:100%;
            background:rgba(0,0,0,0.5);
            display:none;
            align-items:center;
            justify-content:center;
            z-index: 999;
        }

        .modal-content {
            background:white;
            width:400px;
            max-width:90%;
            padding:25px;
            border-radius:var(--radius);
        }

        .modal h3 {
            margin-bottom: 15px;
            color: var(--dark-color);
        }

        .modal p {
            margin-bottom: 20px;
            color: var(--gray-color);
        }

        .status-active {
            color: var(--success-color);
            font-weight: 600;
        }

        .status-inactive {
            color: var(--danger-color);
            font-weight: 600;
        }
    </style>
</head>

<body>
    <x-sidebar />

    <main class="page">
        <div class="container">

            <div class="header">
                <h1><i class="fas fa-box"></i> Manajemen Produk</h1>
                <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
            </div>

            @if(session('success'))
            <div class="notification">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thumbnail</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Field Dibutuhkan</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>

                            <td>
                                @if($product->thumbnail)
                                <img src="{{ asset('storage/'.$product->thumbnail) }}" 
                                     class="thumbnail-square"
                                     alt="{{ $product->name }}">
                                @else
                                <div class="no-thumbnail">
                                    <i class="fas fa-image"></i>
                                </div>
                                @endif
                            </td>

                            <td>
                                <div style="font-weight: 600; margin-bottom: 4px;">{{ $product->name }}</div>
                                @if($product->description)
                                <div style="font-size: 12px; color: var(--gray-color);">
                                    {{ Str::limit($product->description, 50) }}
                                </div>
                                @endif
                            </td>
                            
                            <td>{{ $product->category->name ?? '-' }}</td>
                            
                            <td>
                                @if($product->is_active)
                                    <span class="status-active">Aktif</span>
                                @else
                                    <span class="status-inactive">Nonaktif</span>
                                @endif
                            </td>

                            <td>
                                @if(is_array($product->required_fields) && count($product->required_fields) > 0)
                                    @foreach(array_slice($product->required_fields, 0, 3) as $f)
                                        <span class="badge">{{ $f }}</span>
                                    @endforeach
                                    @if(count($product->required_fields) > 3)
                                        <span class="badge">+{{ count($product->required_fields) - 3 }}</span>
                                    @endif
                                @else
                                    <span style="color: var(--gray-color); font-size: 12px;">-</span>
                                @endif
                            </td>

                            <td style="text-align:center;">
                                <div class="actions">
                                    <a class="btn-icon btn-edit"
                                       href="{{ route('admin.products.edit', $product) }}"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <button class="btn-icon btn-delete delete-btn"
                                        data-id="{{ $product->slug }}"
                                        data-name="{{ $product->name }}"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="7" style="text-align:center;padding:40px;">
                                <i class="fas fa-inbox" style="font-size:45px;color:var(--gray-color)"></i>
                                <p style="margin-top: 10px;">Belum ada produk.</p>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary" style="margin-top: 15px;">
                                    <i class="fas fa-plus"></i> Tambah Produk Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
            <div style="margin-top:20px; display: flex; justify-content: center;">
                {{ $products->links() }}
            </div>
            @endif

        </div>
    </main>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Konfirmasi Hapus</h3>
            <p>Hapus produk <b id="prodName"></b>? Tindakan ini tidak dapat dibatalkan.</p>

            <form id="deleteForm" method="POST" style="margin-top:15px;text-align:right;">
                @csrf
                @method('DELETE')

                <button type="button" onclick="closeModal()" class="btn"
                    style="background:#e5e7eb; margin-right: 10px;">Batal</button>

                <button type="submit" class="btn"
                    style="background:var(--danger-color);color:white;">Hapus</button>
            </form>
        </div>
    </div>

   <script>
    const modal = document.getElementById("deleteModal");
    const deleteButtons = document.querySelectorAll(".delete-btn");
    const deleteForm = document.getElementById("deleteForm");
    const prodName = document.getElementById("prodName");

    // URL untuk delete
    const destroyUrlTemplate = @json(route('admin.products.destroy', '__ID__'));

    deleteButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const name = btn.dataset.name;

            prodName.textContent = name;
            deleteForm.action = destroyUrlTemplate.replace('__ID__', id);
            modal.style.display = "flex";
        });
    });

    function closeModal() {
        modal.style.display = "none";
    }

    window.onclick = e => {
        if (e.target === modal) closeModal();
    };
    
    // Close modal dengan ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });
</script>

</body>
</html>