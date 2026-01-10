<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Dihapus | Admin Panel</title>
    <style>
        /* Reset dan Font */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        main {
            max-width: 1400px; /* Lebarkan untuk kolom tambahan */
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Header dan Navigasi */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title {
            font-size: 24px;
            color: #2c3e50;
            font-weight: 600;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }

        /* Card Container */
        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 25px;
        }

        /* Info Box */
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 18px;
            border-radius: 0 6px 6px 0;
            margin-bottom: 25px;
        }

        .info-box p {
            margin-bottom: 8px;
            color: #555;
        }

        .info-box b {
            color: #2c3e50;
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        /* Buttons */
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-success {
            background-color: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background-color: #219653;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 14px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .auto-delete-form {
            margin-bottom: 25px;
        }

        /* Table Styles */
        .table-container {
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            min-width: 1100px; /* Lebarkan untuk mobile scrolling */
        }

        .data-table thead {
            background-color: #2c3e50;
            color: white;
        }

        .data-table th {
            padding: 16px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #eaeaea;
            transition: background-color 0.15s;
        }

        .data-table tbody tr:hover {
            background-color: #f9f9f9;
        }

        .data-table td {
            padding: 14px 12px;
            font-size: 14px;
        }

        /* Status Badge */
        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-warning {
            background-color: #fef9e7;
            color: #b7950b;
        }

        .badge-danger {
            background-color: #fdedec;
            color: #c0392b;
        }

        /* Telegram Badge */
        .telegram-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: linear-gradient(135deg, #0088cc 0%, #00aced 100%);
            color: white;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        /* Email info */
        .email-info {
            font-size: 11px;
            color: #666;
            margin-top: 3px;
            font-style: italic;
        }

        /* System info box */
        .system-info {
            background-color: #e8f4fc;
            border: 1px solid #b3d7ff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .system-info h4 {
            color: #0066cc;
            margin-bottom: 8px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .system-info ul {
            margin-left: 20px;
            color: #555;
        }

        .system-info li {
            margin-bottom: 5px;
        }

        .system-info .highlight {
            background-color: #fff3cd;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 600;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #7f8c8d;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #bdc3c7;
        }

        .empty-state h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .data-table {
                font-size: 13px;
            }
            
            .data-table th, .data-table td {
                padding: 10px 8px;
            }
            
            .btn-group {
                flex-direction: column;
                width: 100%;
            }
            
            .btn-group .btn {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<x-sidebar />

<main>
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Akun yang Dihapus (Soft Delete)</h1>
        <a href="{{ route('admin.manage-users') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Manajemen Pengguna
        </a>
    </div>

    <!-- System Info -->
    <div class="system-info">
        <h4><i class="fas fa-info-circle"></i> Sistem Baru - Informasi</h4>
        <ul>
            <li>Email di-generate otomatis dari <span class="highlight">Username Telegram</span></li>
            <li>Format email: <code>username@ayastore.com</code></li>
            <li>Username Telegram wajib diisi saat restore akun</li>
            <li>Akun yang direstore akan mendapatkan email otomatis sesuai username Telegram</li>
        </ul>
    </div>

    <!-- Auto Delete Button -->
    <div class="auto-delete-form">
        <form action="{{ route('admin.users.trigger-auto-delete') }}" method="POST"
              onsubmit="return confirm('Jalankan auto delete permanen untuk akun yang dihapus lebih dari 7 hari?')">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash-alt"></i> Hapus Permanent Akun (>7 hari)
            </button>
        </form>
    </div>

    <!-- Info Box -->
    <div class="card info-box">
        <p>
            <b>Informasi:</b> Akun yang di-soft delete lebih dari <b>7 hari</b> akan dihapus permanen secara otomatis.
            Anda juga dapat menjalankan penghapusan manual dengan tombol di atas.
        </p>
        <p>
            Status "Expired" menandakan akun sudah dapat dihapus permanen.
        </p>
        <p>
            <b>Perhatian:</b> Saat memulihkan akun, pastikan username Telegram terisi agar email otomatis berfungsi.
        </p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Content -->
    @if($deletedUsers->isEmpty())
        <!-- Empty State -->
        <div class="card empty-state">
            <div class="empty-state-icon">📭</div>
            <h3>Tidak ada akun yang dihapus</h3>
            <p>Semua akun masih aktif atau belum melewati masa soft delete.</p>
        </div>
    @else
        <!-- Table -->
        <div class="card">
            <h3 style="margin-bottom: 20px; color: #2c3e50;">
                <i class="fas fa-trash"></i> Daftar Akun Dihapus ({{ count($deletedUsers) }})
            </h3>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username Telegram</th>
                            <th>Email</th>
                            <th>WhatsApp</th>
                            <th>Role</th>
                            <th>Saldo</th>
                            <th>Last Order</th>
                            <th>Dihapus</th>
                            <th>Sisa Hari</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($deletedUsers as $user)
                        @php
                            // LOGIKA HARI YANG FIX (TIDAK ADA DESIMAL)
                            $deletedAt = $user->deleted_at;
                            $daysDiff = $deletedAt->startOfDay()->diffInDays(now()->startOfDay());
                            $daysLeft = max(0, 7 - $daysDiff);
                            $isExpired = $daysLeft <= 0;
                            $hasUsername = !empty($user->nama_tele);
                            $isAutoEmail = $hasUsername && strpos($user->email ?? '', '@ayastore.com') !== false;
                        @endphp
                        <tr>
                            <td><b>#{{ $user->id }}</b></td>
                            <td>{{ $user->name }}</td>
                            
                            <!-- Username Telegram -->
                            <td>
                                @if($hasUsername)
                                    <span class="telegram-badge">
                                        <i class="fab fa-telegram"></i>
                                        {{ $user->nama_tele }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic" style="font-size: 12px;">Tidak ada</span>
                                    <div class="email-info">⚠️ Perlu username saat restore</div>
                                @endif
                            </td>
                            
                            <!-- Email -->
                            <td>
                                {{ $user->email }}
                                @if($isAutoEmail)
                                    <div class="email-info">
                                        <i class="fas fa-robot"></i> Auto dari username
                                    </div>
                                @elseif(!$hasUsername)
                                    <div class="email-info" style="color: #e74c3c;">
                                        <i class="fas fa-exclamation-triangle"></i> Manual
                                    </div>
                                @endif
                            </td>
                            
                            <!-- WhatsApp -->
                            <td>{{ $user->whatsapp ?? '-' }}</td>
                            
                            <!-- Role -->
                            <td>
                                <span style="padding: 3px 8px; background: #e8f4fc; border-radius: 4px; font-size: 12px;">
                                    {{ $user->role }}
                                </span>
                            </td>
                            
                            <!-- Saldo -->
                            <td><b>Rp {{ number_format($user->saldo,0,',','.') }}</b></td>
                            
                            <!-- Last Order -->
                            <td>{{ $user->last_order_at?->format('d/m/Y') ?? '-' }}</td>
                            
                            <!-- Deleted At -->
                            <td>{{ $deletedAt->format('d/m/Y H:i') }}</td>
                            
                            <!-- Days Left -->
                            <td>
                                @if($isExpired)
                                    <span class="badge badge-danger">
                                        <i class="fas fa-clock"></i> Expired
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock"></i> {{ $daysLeft }} hari
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Actions -->
                            <td>
                                <div class="btn-group">
                                    @if(!$isExpired)
                                    <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-undo"></i> Pulihkan
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{ route('admin.users.force-delete', $user->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin menghapus permanen akun ini? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Hapus Permanen
                                        </button>
                                    </form>
                                </div>
                                
                                <!-- Warning for username -->
                                @if(!$hasUsername && !$isExpired)
                                <div style="margin-top: 8px; font-size: 11px; color: #e67e22;">
                                    <i class="fas fa-exclamation-triangle"></i> Butuh username Telegram
                                </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</main>

<script>
    // Konfirmasi restore untuk user tanpa username
    document.addEventListener('DOMContentLoaded', function() {
        const restoreForms = document.querySelectorAll('form[action*="restore"]');
        
        restoreForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const userId = this.action.match(/\/users\/(\d+)\/restore/)[1];
                const userRow = document.querySelector(`tr:has(td:contains("#${userId}"))`);
                
                if (userRow) {
                    const usernameCell = userRow.querySelector('td:nth-child(3)');
                    const warningText = usernameCell?.querySelector('.text-gray-400.italic');
                    
                    if (warningText) {
                        e.preventDefault();
                        const confirmed = confirm(
                            'PERHATIAN: User ini tidak memiliki username Telegram.\n' +
                            'Setelah dipulihkan, email akan tetap seperti sebelumnya.\n' +
                            'User mungkin tidak bisa login dengan sistem baru.\n\n' +
                            'Lanjutkan restore?'
                        );
                        
                        if (confirmed) {
                            this.submit();
                        }
                    }
                }
            });
        });
    });
</script>

</body>
</html>