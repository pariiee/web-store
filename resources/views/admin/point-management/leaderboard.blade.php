<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard Poin - Admin Panel</title>
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
            color: var(--warning-color);
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

        /* Filter Section */
        .filter-container {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 30px;
        }

        .filter-header {
            font-size: 16px;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-header i {
            color: var(--primary-color);
        }

        .filter-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
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

        .btn-filter {
            align-self: flex-end;
        }

        .btn-filter .btn {
            width: 100%;
        }

        /* Quick Period Links */
        .quick-periods {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .quick-periods small {
            color: var(--gray-color);
            font-size: 13px;
            margin-right: 10px;
        }

        .period-badge {
            display: inline-block;
            padding: 4px 12px;
            background-color: var(--light-color);
            color: var(--dark-color);
            border-radius: 20px;
            font-size: 13px;
            margin: 0 5px 5px 0;
            text-decoration: none;
            transition: all 0.3s;
            border: 1px solid var(--border-color);
        }

        .period-badge:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-1px);
        }

        /* Leaderboard Table */
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

        .total-users {
            background-color: var(--primary-color);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
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

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* Rank Badges */
        .rank-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-weight: 700;
            font-size: 14px;
        }

        .rank-1 {
            background-color: rgba(245, 158, 11, 0.2);
            color: #d97706;
        }

        .rank-2 {
            background-color: rgba(107, 114, 128, 0.2);
            color: #4b5563;
        }

        .rank-3 {
            background-color: rgba(239, 68, 68, 0.2);
            color: #dc2626;
        }

        .rank-other {
            background-color: var(--light-color);
            color: var(--gray-color);
        }

        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--light-color);
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 2px;
        }

        .user-email {
            color: var(--gray-color);
            font-size: 13px;
        }

        /* Points Badges */
        .points-badge {
            display: inline-block;
            padding: 6px 12px;
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 15px;
        }

        .lifetime-badge {
            display: inline-block;
            padding: 6px 12px;
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 14px;
        }

        /* Actions */
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
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-view {
            background-color: var(--info-color);
        }

        .btn-adjust {
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

        .alert-info {
            background-color: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
            color: var(--info-color);
            padding: 12px 15px;
            border-radius: var(--radius);
            margin-top: 20px;
            font-size: 14px;
        }

        .alert-info i {
            margin-right: 8px;
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

        .btn-save {
            background-color: var(--primary-color);
            color: white;
        }
        .btn-save:hover { background-color: #3a56d4; }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .filter-form {
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

            .user-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .user-avatar {
                width: 40px;
                height: 40px;
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
            <div class="header">
                <h1><i class="fas fa-trophy"></i> Leaderboard Poin</h1>
                <a href="{{ route('admin.point-management.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>

            <!-- Filter Section -->
            <div class="filter-container">
                <div class="filter-header">
                    <i class="fas fa-filter"></i> Filter Periode
                </div>
                <form action="{{ route('admin.point-management.leaderboard') }}" method="GET" class="filter-form">
                    <div class="form-group">
                        <label>Bulan</label>
                        <select name="month" class="form-control">
                            @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                {{ $bulanIndonesia[$month] }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <select name="year" class="form-control">
                            @foreach(range(now()->year, 2023) as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group btn-filter">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </form>

                <!-- Quick Period Links -->
                @if($availablePeriods->count() > 0)
                <div class="quick-periods">
                    <small>Pilih Cepat:</small>
                    @foreach($availablePeriods->take(6) as $period)
                    <a href="?month={{ $period->month }}&year={{ $period->year }}" class="period-badge">
                        {{ $bulanIndonesia[$period->month] }} {{ $period->year }}
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Leaderboard Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3><i class="fas fa-list-ol"></i> Leaderboard untuk {{ $bulanIndonesia[$selectedMonth] }} {{ $selectedYear }}</h3>
                    <div class="total-users">{{ $leaderboard->total() }} pengguna</div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th width="80">Peringkat</th>
                            <th>Pengguna</th>
                            <th class="text-center">Poin</th>
                            <th class="text-center">Item</th>
                            <th class="text-center">Poin Seumur Hidup</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaderboard as $index => $point)
                        @php
                            $rank = $index + 1 + (($leaderboard->currentPage() - 1) * $leaderboard->perPage());
                            $user = $point->user;
                            $lifetimePoints = $user->getLifetimePoint();
                        @endphp
                        <tr>
                            <td class="text-center">
                                <div class="rank-badge {{ $rank <= 3 ? 'rank-' . $rank : 'rank-other' }}">
                                    #{{ $rank }}
                                </div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <img src="{{ $user->profile_photo ? asset('storage/profile/' . $user->profile_photo) : asset('images/default_pp.jpg') }}" 
                                         alt="{{ $user->name }}"
                                         class="user-avatar"
                                         onerror="this.onerror=null; this.src='{{ asset('images/default_pp.jpg') }}'">
                                    <div class="user-details">
                                        <div class="user-name">{{ $user->name }}</div>
                                        <div class="user-email">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="points-badge">{{ number_format($point->points) }}</span>
                            </td>
                            <td class="text-center">
                                {{ number_format($point->total_items) }}
                            </td>
                            <td class="text-center">
                                <span class="lifetime-badge">{{ number_format($lifetimePoints) }}</span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('admin.point-management.user.details', $user) }}" 
                                       class="btn-icon btn-view" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn-icon btn-adjust adjust-btn"
                                            data-user-id="{{ $user->id }}"
                                            data-user-name="{{ $user->name }}"
                                            data-current-points="{{ $point->points }}"
                                            title="Sesuaikan Poin">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-trophy"></i>
                                    <p>Tidak ada data poin untuk periode ini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                @if($leaderboard->hasPages())
                <div class="pagination-container">
                    <div class="pagination">
                        {{ $leaderboard->appends(request()->query())->links('pagination::simple') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Adjust Points Modal -->
    <div id="adjustModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Sesuaikan Poin</h3>
                <button type="button" class="close-modal">&times;</button>
            </div>
            <form id="adjustForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div id="modalUserInfo" style="margin-bottom: 20px; padding: 15px; background-color: var(--light-color); border-radius: var(--radius);">
                        <strong id="userName"></strong><br>
                        <small id="currentPoints"></small>
                    </div>
                    
                    <div class="form-group">
                        <label>Aksi</label>
                        <select name="action" class="form-control" required>
                            <option value="add">Tambah Poin</option>
                            <option value="subtract">Kurangi Poin</option>
                            <option value="set">Atur Poin</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select name="month" class="form-control" required>
                                @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                    {{ $bulanIndonesia[$m] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" name="year" class="form-control" 
                                   value="{{ $selectedYear }}" required min="2023">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Poin</label>
                            <input type="number" name="points" class="form-control" 
                                   required min="0" value="0">
                        </div>
                        <div class="form-group">
                            <label>Item (Opsional)</label>
                            <input type="number" name="items" class="form-control" 
                                   min="0" placeholder="Kosongkan untuk mengikuti poin">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Catatan (Opsional)</label>
                        <textarea name="note" class="form-control" rows="2" 
                                  placeholder="Alasan penyesuaian..."></textarea>
                    </div>

                    <div class="alert-info">
                        <i class="fas fa-info-circle"></i>
                        Poin saat ini untuk {{ $bulanIndonesia[$selectedMonth] }} {{ $selectedYear }}: 
                        <strong id="displayCurrentPoints"></strong>
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
            const modal = document.getElementById('adjustModal');
            const closeButtons = document.querySelectorAll('.close-modal');
            const adjustButtons = document.querySelectorAll('.adjust-btn');
            const adjustForm = document.getElementById('adjustForm');
            const userNameElement = document.getElementById('userName');
            const currentPointsElement = document.getElementById('currentPoints');
            const displayCurrentPointsElement = document.getElementById('displayCurrentPoints');

            // Handle adjust button click
            adjustButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const userName = this.getAttribute('data-user-name');
                    const currentPoints = this.getAttribute('data-current-points');
                    
                    // Set modal content
                    userNameElement.textContent = userName;
                    currentPointsElement.textContent = `Poin saat ini: ${parseInt(currentPoints).toLocaleString()}`;
                    displayCurrentPointsElement.textContent = parseInt(currentPoints).toLocaleString();
                    
                    // Set form action
                    adjustForm.action = `/admin/point-management/user/${userId}/adjust`;
                    
                    // Show modal
                    modal.style.display = 'flex';
                });
            });

            // Close modal
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    modal.style.display = 'none';
                });
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Handle form submission
            adjustForm.addEventListener('submit', function(e) {
                const pointsInput = this.querySelector('input[name="points"]');
                const actionSelect = this.querySelector('select[name="action"]');
                
                if (parseInt(pointsInput.value) <= 0) {
                    e.preventDefault();
                    alert('Poin harus lebih dari 0');
                    return;
                }
                
                if (actionSelect.value === 'subtract') {
                    const currentPoints = parseInt(displayCurrentPointsElement.textContent.replace(/,/g, ''));
                    const subtractPoints = parseInt(pointsInput.value);
                    
                    if (subtractPoints > currentPoints) {
                        e.preventDefault();
                        alert('Poin yang dikurangi tidak boleh lebih dari poin saat ini');
                        return;
                    }
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

            // Handle period badge clicks
            const periodBadges = document.querySelectorAll('.period-badge');
            periodBadges.forEach(badge => {
                badge.addEventListener('click', function(e) {
                    // Add loading effect
                    const container = document.querySelector('.table-container');
                    container.style.opacity = '0.7';
                    container.style.transition = 'opacity 0.3s';
                    
                    setTimeout(() => {
                        container.style.opacity = '1';
                    }, 300);
                });
            });
        });
    </script>
</body>
</html>