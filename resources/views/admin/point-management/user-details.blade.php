<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Poin Pengguna - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
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

        body {
            background-color: #f5f7fa;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .page {
            padding: 28px 20px 24px;
        }

        @media (min-width: 768px){
            .page { padding-top: 48px; }
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header & Breadcrumb */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-content h1 {
            font-size: 24px;
            color: var(--dark-color);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-content h1 i {
            color: var(--info-color);
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item {
            color: var(--gray-color);
            font-size: 14px;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb-item a:hover {
            color: #3a56d4;
            text-decoration: underline;
        }

        .breadcrumb-item.active {
            color: var(--dark-color);
            font-weight: 500;
        }

        .breadcrumb-separator {
            color: var(--gray-color);
        }

        /* Action Buttons */
        .header-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
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
            font-size: 14px;
        }

        .btn-secondary {
            background-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
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

        /* User Info Section */
        .user-info-section {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        @media (max-width: 1024px) {
            .user-info-section {
                grid-template-columns: 1fr;
            }
        }

        /* User Profile Card */
        .profile-card {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 30px;
            text-align: center;
        }

        .user-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            border: 4px solid var(--light-color);
        }

        .user-name {
            font-size: 22px;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 5px;
        }

        .user-contact {
            color: var(--gray-color);
            margin-bottom: 15px;
            font-size: 14px;
        }

        .user-badges {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-admin {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }

        .badge-user {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .badge-deleted {
            background-color: var(--dark-color);
            color: white;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 20px;
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

        .stat-primary .stat-icon {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .stat-success .stat-icon {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .stat-content h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-content p {
            color: var(--dark-color);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .stat-content small {
            color: var(--gray-color);
            font-size: 12px;
        }

        /* Quick Adjust Form */
        .adjust-form-container {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 30px;
        }

        .adjust-form-header {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .adjust-form-header i {
            color: var(--warning-color);
        }

        .adjust-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            font-size: 14px;
            transition: all 0.3s;
            background-color: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }

        select.form-control {
            cursor: pointer;
        }

        .form-group-full {
            grid-column: 1 / -1;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            grid-column: 1 / -1;
        }

        .btn-save {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 30px;
        }

        .btn-save:hover {
            background-color: #3a56d4;
        }

        /* History Table */
        .table-container {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: var(--light-color);
            border-bottom: 1px solid var(--border-color);
        }

        .table-header h3 {
            font-size: 18px;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-header h3 i {
            color: var(--primary-color);
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

        th.text-center {
            text-align: center;
        }

        td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
        }

        td.text-center {
            text-align: center;
        }

        tbody tr {
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        .period-badge {
            display: inline-block;
            padding: 6px 12px;
            background-color: var(--light-color);
            color: var(--dark-color);
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 14px;
        }

        .current-badge {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
            margin-left: 10px;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 10px;
        }

        .points-badge {
            display: inline-block;
            padding: 6px 12px;
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 15px;
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
            font-size: 14px;
        }

        .btn-edit {
            background-color: var(--warning-color);
        }

        .btn-icon:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        /* Empty State */
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

        /* Pagination */
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .pagination {
            display: flex;
            gap: 5px;
        }

        .pagination a,
        .pagination span {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--dark-color);
            transition: all 0.3s;
            font-size: 14px;
        }

        .pagination a.active {
            background-color: var(--primary-color);
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: var(--border-color);
        }

        .pagination span {
            color: var(--gray-color);
        }

        /* Modal Styles */
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
            padding: 20px;
        }

        .modal-content {
            background-color: white;
            border-radius: var(--radius);
            padding: 30px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .modal-header h3 {
            font-size: 20px;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-header h3 i {
            color: var(--warning-color);
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            color: var(--gray-color);
            cursor: pointer;
            transition: color 0.3s;
        }

        .close-modal:hover {
            color: var(--danger-color);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn-cancel {
            background-color: #f3f4f6;
            color: var(--dark-color);
        }
        .btn-cancel:hover { background-color: #e5e7eb; }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .breadcrumb {
                flex-wrap: wrap;
            }

            .adjust-form {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .table-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 800px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar/Navbar -->
    <x-sidebar />

    <!-- Main Content -->
    <main class="page">
        <div class="container">
            <!-- Header -->
            <div class="header">
                <div class="header-content">
                    <h1><i class="fas fa-user-circle"></i> Detail Poin Pengguna</h1>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.point-management.index') }}">Manajemen Poin</a>
                            </li>
                            <li class="breadcrumb-separator">/</li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.point-management.users') }}">Pengguna</a>
                            </li>
                            <li class="breadcrumb-separator">/</li>
                            <li class="breadcrumb-item active">{{ $user->name }}</li>
                        </ul>
                    </nav>
                </div>
                <div class="header-actions">
                    <a href="{{ route('admin.point-management.users') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Pengguna
                    </a>
                    <a href="{{ route('admin.manage-users') }}?search={{ $user->email }}" 
                       class="btn btn-primary">
                        <i class="fas fa-user-cog"></i> Kelola Pengguna
                    </a>
                </div>
            </div>

            <!-- User Info Section -->
            <div class="user-info-section">
                <!-- Profile Card -->
                <div class="profile-card">
                    <img src="{{ $user->profile_photo ? asset('storage/profile/' . $user->profile_photo) : asset('images/default_pp.jpg') }}" 
                         alt="{{ $user->name }}"
                         class="user-avatar"
                         onerror="this.onerror=null; this.src='{{ asset('images/default_pp.jpg') }}'">
                    <div class="user-name">{{ $user->name }}</div>
                    <div class="user-contact">
                        <div>{{ $user->email }}</div>
                        <div>{{ $user->whatsapp }}</div>
                    </div>
                    <div class="user-badges">
                        @if($user->role == 'admin')
                        <span class="badge badge-admin">Admin</span>
                        @else
                        <span class="badge badge-user">Pengguna</span>
                        @endif
                        @if($user->deleted_at)
                        <span class="badge badge-deleted">Dihapus</span>
                        @endif
                    </div>
                </div>

                <!-- Stats & Quick Adjust -->
                <div>
                    <!-- Stats Grid -->
                    <div class="stats-grid">
                        <div class="stat-card stat-primary">
                            <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                            <div class="stat-content">
                                <h3>{{ number_format($currentPoints->points ?? 0) }}</h3>
                                <p>Poin Bulan Ini</p>
                                <small>Item: {{ number_format($currentPoints->total_items ?? 0) }}</small>
                            </div>
                        </div>

                        <div class="stat-card stat-success">
                            <div class="stat-icon"><i class="fas fa-trophy"></i></div>
                            <div class="stat-content">
                                <h3>{{ number_format($lifetimePoints) }}</h3>
                                <p>Poin Seumur Hidup</p>
                                <small>Total Item: {{ number_format($totalItems) }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Adjust Form -->
                    <div class="adjust-form-container">
                        <div class="adjust-form-header">
                            <i class="fas fa-edit"></i> Sesuaikan Poin dengan Cepat
                        </div>
                        <form action="{{ route('admin.point-management.user.adjust', $user) }}" method="POST" class="adjust-form">
                            @csrf
                            <div class="form-group">
                                <label>Aksi</label>
                                <select name="action" class="form-control" required>
                                    <option value="add">Tambah Poin</option>
                                    <option value="subtract">Kurangi Poin</option>
                                    <option value="set">Atur Poin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bulan</label>
                                <select name="month" class="form-control" required>
                                    @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ now()->month == $m ? 'selected' : '' }}>
                                        {{ $bulanIndonesia[$m] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" name="year" class="form-control" 
                                       value="{{ now()->year }}" required min="2023">
                            </div>
                            <div class="form-group">
                                <label>Poin</label>
                                <input type="number" name="points" class="form-control" 
                                       required min="0" value="0">
                            </div>
                            <div class="form-group-full">
                                <div class="form-actions">
                                    <input type="number" name="items" class="form-control" 
                                           min="0" placeholder="Item (opsional)" style="flex: 1;">
                                    <input type="text" name="note" class="form-control" 
                                           placeholder="Catatan (opsional)" style="flex: 1;">
                                    <button type="submit" class="btn btn-save">
                                        <i class="fas fa-save"></i> Terapkan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Points History -->
            <div class="table-container">
                <div class="table-header">
                    <h3><i class="fas fa-history"></i> Riwayat Poin</h3>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th class="text-center">Poin</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Terakhir Diperbarui</th>
                            <th class="text-center">Diperbarui Oleh</th>
                            <th>Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pointHistory as $point)
                        <tr>
                            <td>
                                <span class="period-badge">{{ $bulanIndonesia[$point->month] }} {{ $point->year }}</span>
                                @if($point->month == now()->month && $point->year == now()->year)
                                <span class="current-badge">Sekarang</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="points-badge">{{ number_format($point->points) }}</span>
                            </td>
                            <td class="text-center">
                                {{ number_format($point->total_items) }}
                            </td>
                            <td class="text-center">
                                {{ $point->updated_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="text-center">
                                @if($point->updatedBy)
                                {{ $point->updatedBy->name }}
                                @else
                                <span class="text-muted">System</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $point->adjustment_note }}</small>
                            </td>
                            <td>
                                <div class="actions" style="justify-content: center;">
                                    <button type="button" class="btn-icon btn-edit edit-point-btn"
                                            data-point-id="{{ $point->id }}"
                                            data-month="{{ $point->month }}"
                                            data-year="{{ $point->year }}"
                                            data-points="{{ $point->points }}"
                                            data-items="{{ $point->total_items }}"
                                            data-note="{{ $point->adjustment_note }}"
                                            title="Edit Poin">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-history"></i>
                                    <p>Tidak ada riwayat poin tersedia</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                @if($pointHistory->hasPages())
                <div class="pagination-container">
                    <div class="pagination">
                        {{ $pointHistory->links('pagination::simple') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Edit Point Modal -->
    <div id="editPointModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Edit Poin</h3>
                <button type="button" class="close-modal">&times;</button>
            </div>
            <form id="editPointForm" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="month" id="editMonth">
                    <input type="hidden" name="year" id="editYear">
                    <input type="hidden" name="action" value="set">
                    
                    <div id="modalPeriodInfo" style="margin-bottom: 20px; padding: 15px; background-color: var(--light-color); border-radius: var(--radius);">
                        Periode: <strong id="displayPeriod"></strong>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Poin</label>
                            <input type="number" name="points" id="editPoints" class="form-control" required min="0">
                        </div>
                        <div class="form-group">
                            <label>Item</label>
                            <input type="number" name="items" id="editItems" class="form-control" min="0">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="note" id="editNote" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel close-modal">Batal</button>
                    <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editPointModal = document.getElementById('editPointModal');
            const closeButtons = document.querySelectorAll('.close-modal');
            const editPointButtons = document.querySelectorAll('.edit-point-btn');
            const editPointForm = document.getElementById('editPointForm');
            const displayPeriodElement = document.getElementById('displayPeriod');
            const editMonthInput = document.getElementById('editMonth');
            const editYearInput = document.getElementById('editYear');
            const editPointsInput = document.getElementById('editPoints');
            const editItemsInput = document.getElementById('editItems');
            const editNoteInput = document.getElementById('editNote');

            // Month names in Indonesian
            const monthNames = @json($bulanIndonesia);

            // Handle edit button click
            editPointButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const pointId = this.getAttribute('data-point-id');
                    const month = this.getAttribute('data-month');
                    const year = this.getAttribute('data-year');
                    const points = this.getAttribute('data-points');
                    const items = this.getAttribute('data-items');
                    const note = this.getAttribute('data-note');
                    
                    // Set modal content
                    displayPeriodElement.textContent = `${monthNames[month]} ${year}`;
                    editMonthInput.value = month;
                    editYearInput.value = year;
                    editPointsInput.value = points;
                    editItemsInput.value = items;
                    editNoteInput.value = note;
                    
                    // Set form action
                    editPointForm.action = `/admin/point-management/user/{{ $user->id }}/adjust`;
                    
                    // Show modal
                    editPointModal.style.display = 'flex';
                });
            });

            // Close modal
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    editPointModal.style.display = 'none';
                });
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === editPointModal) {
                    editPointModal.style.display = 'none';
                }
            });

            // Handle quick adjust form submission
            const quickAdjustForm = document.querySelector('.adjust-form');
            quickAdjustForm.addEventListener('submit', function(e) {
                const pointsInput = this.querySelector('input[name="points"]');
                const actionSelect = this.querySelector('select[name="action"]');
                
                if (parseInt(pointsInput.value) <= 0) {
                    e.preventDefault();
                    alert('Poin harus lebih dari 0');
                    return;
                }
            });

            // Add hover effects to table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = 'var(--shadow)';
                    this.style.transition = 'all 0.3s ease';
                });
                
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                });
            });

            // Handle breadcrumb hover effects
            const breadcrumbLinks = document.querySelectorAll('.breadcrumb-item a');
            breadcrumbLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    this.style.textDecoration = 'underline';
                });
                
                link.addEventListener('mouseleave', function() {
                    this.style.textDecoration = 'none';
                });
            });
        });
    </script>
</body>
</html>