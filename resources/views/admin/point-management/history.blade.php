<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penyesuaian Poin - Admin Panel</title>
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
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
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

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a56d4;
            transform: translateY(-2px);
            box-shadow: var(--shadow);
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

        .total-records {
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

        /* Date Column */
        .date-cell {
            min-width: 120px;
        }

        .date-main {
            font-weight: 500;
            color: var(--dark-color);
        }

        .date-time {
            font-size: 12px;
            color: var(--gray-color);
        }

        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 200px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
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
            font-size: 12px;
        }

        /* Period Badge */
        .period-badge {
            display: inline-block;
            padding: 6px 12px;
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
            border-radius: var(--radius);
            font-weight: 500;
            font-size: 13px;
        }

        /* Points Badge */
        .points-badge {
            display: inline-block;
            padding: 8px 14px;
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
            border-radius: var(--radius);
            font-weight: 600;
            font-size: 15px;
        }

        /* Note Column */
        .note-content {
            max-width: 300px;
            color: var(--gray-color);
            font-size: 13px;
            line-height: 1.5;
        }

        /* Updated By */
        .updated-by {
            color: var(--dark-color);
            font-weight: 500;
        }

        .updated-system {
            color: var(--gray-color);
            font-style: italic;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
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

            .table-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 900px;
            }

            .user-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .user-avatar {
                width: 35px;
                height: 35px;
            }

            .note-content {
                max-width: 200px;
            }
        }

        @media (max-width: 480px) {
            .page {
                padding: 20px 15px;
            }

            .header h1 {
                font-size: 20px;
            }

            .btn {
                padding: 8px 14px;
                font-size: 13px;
            }

            .filter-container {
                padding: 20px;
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
                <h1><i class="fas fa-history"></i> Riwayat Penyesuaian Poin</h1>
                <a href="{{ route('admin.point-management.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>

            <!-- Filter Section -->
            <div class="filter-container">
                <div class="filter-header">
                    <i class="fas fa-filter"></i> Filter Data
                </div>
                <form action="{{ route('admin.point-management.history') }}" method="GET" class="filter-form">
                    <div class="form-group">
                        <label>ID Pengguna</label>
                        <input type="number" name="user_id" class="form-control" 
                               placeholder="Filter berdasarkan ID pengguna" 
                               value="{{ request('user_id') }}">
                    </div>
                    <div class="form-group">
                        <label>Bulan</label>
                        <select name="month" class="form-control">
                            <option value="">Semua Bulan</option>
                            @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ $bulanIndonesia[$m] ?? $m }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <select name="year" class="form-control">
                            <option value="">Semua Tahun</option>
                            @foreach(range(now()->year, 2023) as $y)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                {{ $y }}
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
            </div>

            <!-- History Table -->
            <div class="table-container">
                <div class="table-header">
                    <h3><i class="fas fa-list-alt"></i> Riwayat Penyesuaian</h3>
                    <div class="total-records">{{ $history->total() }} data</div>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Pengguna</th>
                            <th>Periode</th>
                            <th class="text-center">Poin</th>
                            <th class="text-center">Item</th>
                            <th>Diperbarui Oleh</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history as $record)
                        <tr>
                            <td class="date-cell">
                                <div class="date-main">{{ $record->updated_at->format('d/m/Y') }}</div>
                                <div class="date-time">{{ $record->updated_at->format('H:i') }}</div>
                            </td>
                            <td>
                                <div class="user-info">
                                    <img src="{{ $record->user->profile_photo ? asset('storage/profile/' . $record->user->profile_photo) : asset('images/default_pp.jpg') }}" 
                                         alt="{{ $record->user->name }}"
                                         class="user-avatar"
                                         onerror="this.onerror=null; this.src='{{ asset('images/default_pp.jpg') }}'">
                                    <div class="user-details">
                                        <div class="user-name">{{ $record->user->name }}</div>
                                        <div class="user-email">{{ $record->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="period-badge">
                                    {{ $bulanIndonesia[$record->month] ?? $record->month }}/{{ $record->year }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="points-badge">{{ number_format($record->points) }}</span>
                            </td>
                            <td class="text-center">
                                {{ number_format($record->total_items) }}
                            </td>
                            <td>
                                @if($record->updatedBy)
                                <span class="updated-by">{{ $record->updatedBy->name }}</span>
                                @else
                                <span class="updated-system">System</span>
                                @endif
                            </td>
                            <td>
                                <div class="note-content">{{ $record->adjustment_note }}</div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-history"></i>
                                    <p>Tidak ada riwayat penyesuaian ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                @if($history->hasPages())
                <div class="pagination-container">
                    <div class="pagination">
                        {{ $history->appends(request()->query())->links('pagination::simple') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effects to table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                // Skip empty state row
                if (row.querySelector('.empty-state')) return;
                
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

            // Handle filter form reset
            const filterForm = document.querySelector('.filter-form');
            const filterInputs = filterForm.querySelectorAll('input, select');
            
            // Add clear filter button functionality
            const clearFilterButton = document.createElement('button');
            clearFilterButton.type = 'button';
            clearFilterButton.className = 'btn';
            clearFilterButton.style.cssText = 'background-color: #f3f4f6; color: var(--dark-color); margin-top: 20px;';
            clearFilterButton.innerHTML = '<i class="fas fa-times"></i> Bersihkan Filter';
            
            clearFilterButton.addEventListener('click', function() {
                filterInputs.forEach(input => {
                    if (input.tagName === 'INPUT') {
                        input.value = '';
                    } else if (input.tagName === 'SELECT') {
                        input.selectedIndex = 0;
                    }
                });
                filterForm.submit();
            });

            // Insert clear button after form
            const filterActions = document.createElement('div');
            filterActions.className = 'form-group';
            filterActions.style.gridColumn = '1 / -1';
            filterActions.style.textAlign = 'right';
            filterActions.appendChild(clearFilterButton);
            filterForm.appendChild(filterActions);

            // Handle filter form submission with loading indicator
            filterForm.addEventListener('submit', function(e) {
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                submitButton.disabled = true;
                
                setTimeout(() => {
                    submitButton.innerHTML = originalText;
                    submitButton.disabled = false;
                }, 2000);
            });

            // Add tooltip for truncated note content
            const noteCells = document.querySelectorAll('.note-content');
            noteCells.forEach(cell => {
                const text = cell.textContent;
                if (text.length > 100) {
                    cell.title = text;
                    cell.style.cursor = 'help';
                }
            });

            // Add animation for new rows (if any)
            const newRows = document.querySelectorAll('tbody tr:first-child');
            newRows.forEach(row => {
                if (!row.querySelector('.empty-state')) {
                    row.style.animation = 'fadeIn 0.5s ease';
                    row.style.backgroundColor = 'rgba(16, 185, 129, 0.05)';
                    
                    setTimeout(() => {
                        row.style.backgroundColor = '';
                    }, 3000);
                }
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl + F to focus on filter form
                if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                    e.preventDefault();
                    const firstInput = filterForm.querySelector('input, select');
                    if (firstInput) {
                        firstInput.focus();
                    }
                }
                
                // Escape to clear filters
                if (e.key === 'Escape') {
                    clearFilterButton.click();
                }
            });

            // Style pagination links
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = 'var(--primary-light)';
                    }
                });
                
                link.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('active')) {
                        this.style.backgroundColor = '';
                    }
                });
            });
        });

        // Add fadeIn animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>