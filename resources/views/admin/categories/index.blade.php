<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f9fafb;
            --gray-color: #9ca3af;
            --border-color: #e5e7eb;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --radius: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ✅ body tanpa padding supaya nggak nabrak navbar */
        body {
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;
        }

        /* ✅ ini yang bikin isi halaman turun & aman */
        .page {
            padding: 28px 20px 24px;
        }

        /* karena navbar desktop kamu sticky top-4, kasih jarak aman */
        @media (min-width: 768px){
            .page { padding-top: 48px; }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .header h1 {
            font-size: 24px;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header h1 i {
            color: var(--primary-color);
        }

        /* Notification Styles */
        .notification {
            padding: 12px 16px;
            border-radius: var(--radius);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.5s ease;
        }

        .notification.success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--success-color);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn {
            padding: 10px 18px;
            border-radius: var(--radius);
            font-weight: 500;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a56d4;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            font-size: 14px;
            transition: all 0.3s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
        }

        /* Table Styles */
        .table-container {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: var(--primary-light);
        }

        th {
            padding: 16px 20px;
            text-align: left;
            font-weight: 600;
            color: var(--dark-color);
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        tbody tr {
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .category-name {
            font-weight: 500;
            color: var(--dark-color);
        }

        .category-slug {
            color: var(--gray-color);
            font-size: 13px;
            background-color: #f3f4f6;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-edit { background-color: var(--primary-color); }
        .btn-delete { background-color: var(--danger-color); }

        .btn-icon:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state i {
            font-size: 48px;
            color: var(--gray-color);
            margin-bottom: 15px;
        }

        .empty-state p {
            color: var(--gray-color);
            font-size: 16px;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: white;
            border-radius: var(--radius);
            padding: 20px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .stat-1 .stat-icon {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .stat-content h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-content p {
            color: var(--gray-color);
            font-size: 14px;
        }

        /* Footer */
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            color: var(--gray-color);
            font-size: 14px;
        }

        .pagination {
            display: flex;
            gap: 5px;
        }

        .pagination a {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--dark-color);
            transition: all 0.3s;
        }

        .pagination a.active {
            background-color: var(--primary-color);
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: var(--border-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .action-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box { width: 100%; }

            .table-container { overflow-x: auto; }
            table { min-width: 600px; }

            .stats-container { grid-template-columns: 1fr; }
        }

        /* Modal Confirmation */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            border-radius: var(--radius);
            padding: 30px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .modal-header i {
            color: var(--danger-color);
            font-size: 24px;
        }

        .modal-header h3 { font-size: 20px; }

        .modal-body { margin-bottom: 25px; color: var(--dark-color); }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-cancel {
            background-color: #f3f4f6;
            color: var(--dark-color);
        }
        .btn-cancel:hover { background-color: #e5e7eb; }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }
        .btn-danger:hover { background-color: #dc2626; }
    </style>
</head>

<body>
    <!-- ✅ sidebar/navbar harus di DALAM body -->
    <x-sidebar />

    <!-- ✅ bungkus konten biar turun & aman -->
    <main class="page">
        <div class="container">
            <div class="header">
                <h1><i class="fas fa-tags"></i> Manajemen Kategori</h1>
                <div class="user-info">
                    <span>Admin Panel</span>
                </div>
            </div>

            <div class="stats-container">
                <div class="stat-card stat-1">
                    <div class="stat-icon"><i class="fas fa-tags"></i></div>
                    <div class="stat-content">
                        <h3>{{ count($categories) }}</h3>
                        <p>Total Kategori</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background-color: rgba(16, 185, 129, 0.1); color: var(--success-color);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ count($categories) }}</h3>
                        <p>Kategori Aktif</p>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="notification success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <div class="action-bar">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari kategori...">
                </div>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Kategori Baru
                </a>
            </div>

            <div class="table-container">
                <table id="categoriesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td><div class="category-name">{{ $cat->name }}</div></td>
                            <td><span class="category-slug">{{ $cat->slug }}</span></td>
                            <td>
                                <div class="actions" style="justify-content: center;">
                                    <a href="{{ route('admin.categories.edit', $cat) }}" class="btn-icon btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn-icon btn-delete delete-btn"
                                            data-id="{{ $cat->id }}"
                                            data-name="{{ $cat->name }}"
                                            title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>Belum ada kategori. Mulai dengan menambahkan kategori pertama Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="footer">
                <div class="pagination-info">
                    Menampilkan {{ count($categories) }} dari {{ count($categories) }} kategori
                </div>
                <div class="pagination">
                    <a href="#" class="active">1</a>
                </div>
            </div>
        </div>
    </main>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>Konfirmasi Hapus</h3>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus kategori <strong id="categoryName"></strong>?</p>
                <p style="margin-top: 10px; color: var(--danger-color); font-size: 14px;">
                    <i class="fas fa-info-circle"></i> Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" id="cancelDelete">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Kategori</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#categoriesTable tbody tr');

            rows.forEach(row => {
                const nameEl = row.querySelector('.category-name');
                const slugEl = row.querySelector('.category-slug');
                if (!nameEl || !slugEl) return;

                const name = nameEl.textContent.toLowerCase();
                const slug = slugEl.textContent.toLowerCase();
                row.style.display = (name.includes(searchTerm) || slug.includes(searchTerm)) ? '' : 'none';
            });
        });

                const deleteButtons = document.querySelectorAll('.delete-btn');
        const deleteModal = document.getElementById('deleteModal');
        const cancelDeleteBtn = document.getElementById('cancelDelete');
        const categoryNameSpan = document.getElementById('categoryName');
        const deleteForm = document.getElementById('deleteForm');

        // Handle klik tombol hapus
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');
                
                // Set data pada modal
                categoryNameSpan.textContent = `"${categoryName}"`;
                deleteForm.action = `/admin/categories/${categoryId}`;
                
                // Tampilkan modal
                deleteModal.style.display = 'flex';
            });
        });

        // Handle klik tombol batal
        cancelDeleteBtn.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });

        // Tutup modal jika klik di luar konten modal
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                deleteModal.style.display = 'none';
            }
        });

        // Tambahkan efek untuk baris tabel saat hover
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('#categoriesTable tbody tr');
            
            tableRows.forEach(row => {
                // Skip row yang kosong (empty state)
                if (row.querySelector('.empty-state')) return;
                
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f9fafb';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });

            // Tambahkan animasi untuk notifikasi
            const notification = document.querySelector('.notification');
            if (notification) {
                // Auto-hide notification setelah 5 detik
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(-10px)';
                    notification.style.transition = 'all 0.5s ease';
                    
                    setTimeout(() => {
                        notification.style.display = 'none';
                    }, 500);
                }, 5000);
            }
        });

        // Tambahkan konfirmasi sebelum submit form delete (fallback)
        deleteForm.addEventListener('submit', function(e) {
            if (!confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>