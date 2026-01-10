<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kode Redeem</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
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
            max-width:700px;
            margin:auto;
        }

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
        }

        .card {
            background:white;
            padding:25px;
            border-radius:var(--radius);
            box-shadow:var(--shadow);
        }

        .form-group {
            margin-bottom:18px;
        }

        label {
            font-size:14px;
            font-weight:600;
            margin-bottom:5px;
            display:block;
        }

        input[type="text"],
        input[type="number"],
        select {
            width:100%;
            padding:10px 14px;
            border:1px solid var(--border-color);
            border-radius:var(--radius);
            font-size:14px;
            transition:.3s;
            box-sizing:border-box;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            outline:none;
            border-color:var(--primary-color);
            box-shadow:0 0 0 3px rgba(67,97,238,0.15);
        }

        .radio-group {
            display:flex;
            gap:20px;
            margin-bottom:15px;
        }

        .radio-group-vertical {
            display:flex;
            flex-direction:column;
            gap:10px;
            margin-bottom:20px;
        }

        .radio-item {
            display:flex;
            align-items:center;
            gap:10px;
            padding:12px;
            border:1px solid var(--border-color);
            border-radius:var(--radius);
            cursor:pointer;
            transition:.2s;
        }

        .radio-item:hover {
            border-color:var(--primary-color);
            background:var(--primary-light);
        }

        .radio-item input[type="radio"] {
            width:18px;
            height:18px;
            margin:0;
        }

        .radio-content {
            flex:1;
        }

        .radio-title {
            font-weight:600;
            font-size:14px;
            margin-bottom:2px;
        }

        .radio-desc {
            font-size:12px;
            color:var(--gray-color);
        }

        .info-box {
            background:#f8fafc;
            border-left:4px solid var(--primary-color);
            padding:12px 16px;
            border-radius:var(--radius);
            margin-bottom:20px;
            font-size:13px;
            display:none;
        }

        .warning-box {
            background:#fef3c7;
            border-left:4px solid var(--warning-color);
            padding:12px 16px;
            border-radius:var(--radius);
            margin-bottom:20px;
            font-size:13px;
            display:none;
        }

        .summary-box {
            background:#eef2ff;
            padding:12px 16px;
            border-radius:var(--radius);
            margin-bottom:20px;
            font-size:13px;
            display:none;
        }

        .btn {
            padding:10px 18px;
            border-radius:var(--radius);
            cursor:pointer;
            text-decoration:none;
            font-size:14px;
            display:inline-flex;
            align-items:center;
            gap:8px;
            font-weight:500;
            border:none;
            transition:.3s;
        }

        .btn-primary {
            background:var(--primary-color);
            color:white;
        }

        .btn-primary:hover {
            background:#314ad4;
        }

        .btn-secondary {
            background:#e5e7eb;
            color:var(--dark-color);
        }

        .btn-secondary:hover {
            background:#d5d7da;
        }

        .alert {
            background:#fee2e2;
            padding:12px 16px;
            border-left:4px solid var(--danger-color);
            border-radius:var(--radius);
            margin-bottom:20px;
            color:#991b1b;
        }

        .alert ul {
            margin:0;
            padding-left:20px;
        }

        .success {
            background:#d1fae5;
            padding:12px 16px;
            border-left:4px solid var(--success-color);
            border-radius:var(--radius);
            margin-bottom:20px;
            color:#065f46;
        }

        .form-actions {
            margin-top:20px;
            display:flex;
            gap:10px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <i class="fas fa-gift" style="color:var(--primary-color);font-size:22px;"></i>
        <h1>Buat Kode Redeem</h1>
    </div>

    <!-- FORM CARD -->
    <div class="card">
        <!-- ERROR MESSAGES -->
        @if($errors->any())
            <div class="alert">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
            <div class="alert">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.redeem.store') }}">
            @csrf

            <!-- TIPE HADIAH -->
            <div class="form-group">
                <label>Tipe Hadiah</label>
                <div class="radio-group">
                    <label><input type="radio" name="type" value="saldo" checked onclick="toggleType()"> Saldo</label>
                    <label><input type="radio" name="type" value="stock" onclick="toggleType()"> Stock</label>
                </div>
            </div>

            <!-- KODE -->
            <div class="form-group">
                <label>Kode (Opsional)</label>
                <input type="text" name="code" maxlength="10" placeholder="Misal: ABC123" value="{{ old('code') }}">
            </div>

            <!-- SALDO FIELDS -->
            <div id="saldo-fields">
                <!-- SUMMARY BOX -->
                <div class="summary-box" id="summary-box">
                    <i class="fas fa-calculator"></i>
                    <span id="summary-text"></span>
                </div>

                <!-- WARNING BOX -->
                <div class="warning-box" id="warning-box">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span id="warning-text"></span>
                </div>

                <!-- INFO BOX -->
                <div class="info-box" id="info-box">
                    <i class="fas fa-info-circle"></i>
                    <span id="info-text">Informasi distribusi akan muncul di sini</span>
                </div>

                <!-- NOMINAL SALDO -->
                <div class="form-group">
                    <label>Nominal Saldo</label>
                    <input type="number" name="nominal_saldo" id="nominal_saldo" min="1" 
                           value="{{ old('nominal_saldo') }}" oninput="updateInfo()" 
                           placeholder="Contoh: 1000">
                </div>

                <!-- JUMLAH USER -->
                <div class="form-group">
                    <label>Jumlah User yang Boleh Claim</label>
                    <input type="number" name="max_users" id="max_users" min="1" 
                           value="{{ old('max_users') }}" oninput="updateInfo()" 
                           placeholder="Contoh: 10">
                </div>

                <!-- TIPE DISTRIBUSI -->
                <div class="form-group">
                    <label>Tipe Distribusi</label>
                    <div class="radio-group-vertical" id="distribution-options">
                        <label class="radio-item">
                            <input type="radio" name="distribution_type" value="rata" checked onclick="updateInfo()">
                            <div class="radio-content">
                                <div class="radio-title">Distribusi Rata</div>
                                <div class="radio-desc">Setiap user mendapatkan nominal saldo yang SAMA PERSIS dengan yang diisi</div>
                            </div>
                        </label>
                        
                        <label class="radio-item">
                            <input type="radio" name="distribution_type" value="acak" onclick="updateInfo()">
                            <div class="radio-content">
                                <div class="radio-title">Distribusi Acak</div>
                                <div class="radio-desc">Nominal saldo dibagikan secara acak ke setiap user</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- STOCK FIELDS -->
            <div id="stock-fields" style="display:none;">
                <!-- PILIH ITEM -->
                <div class="form-group">
                    <label>Pilih Item Stok</label>
                    <select name="item_id">
                        <option value="">-- pilih item --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }} ({{ $item->stocks_count }} stok)
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- TOTAL STOK -->
                <div class="form-group">
                    <label>Total Stok Yang Dibagikan</label>
                    <input type="number" name="total_stock" min="1" value="{{ old('total_stock') }}">
                </div>
            </div>

            <!-- FORM ACTIONS -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>

                <a href="{{ route('admin.redeem.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

</div>

<script>
function toggleType() {
    const isSaldo = document.querySelector('input[name="type"][value="saldo"]').checked;
    
    document.getElementById('saldo-fields').style.display = isSaldo ? 'block' : 'none';
    document.getElementById('stock-fields').style.display = isSaldo ? 'none' : 'block';
    
    if (isSaldo) {
        updateInfo();
    } else {
        hideAllBoxes();
    }
}

function updateInfo() {
    const nominal = parseInt(document.getElementById('nominal_saldo').value) || 0;
    const users = parseInt(document.getElementById('max_users').value) || 0;
    const isRata = document.querySelector('input[name="distribution_type"][value="rata"]').checked;
    
    if (nominal > 0 && users > 0) {
        // Tampilkan semua box
        document.getElementById('summary-box').style.display = 'block';
        document.getElementById('info-box').style.display = 'block';
        
        if (isRata) {
            // DISTRIBUSI RATA (MULTIPLIKASI)
            const totalSaldo = nominal * users;
            
            // Summary box
            document.getElementById('summary-text').innerHTML = 
                `<strong>Total saldo yang akan dikeluarkan: Rp ${totalSaldo.toLocaleString('id-ID')}</strong><br>
                 (${users} user × Rp ${nominal.toLocaleString('id-ID')})`;
            
            // Info box
            document.getElementById('info-text').innerHTML = 
                `<strong>SETIAP USER AKAN MENDAPATKAN: Rp ${nominal.toLocaleString('id-ID')}</strong><br>
                 Semua ${users} user mendapatkan jumlah yang SAMA PERSIS.`;
            
            // Hide warning
            document.getElementById('warning-box').style.display = 'none';
            
        } else {
            // DISTRIBUSI ACAK
            // Summary box
            document.getElementById('summary-text').innerHTML = 
                `<strong>Total saldo yang akan dikeluarkan: Rp ${nominal.toLocaleString('id-ID')}</strong>`;
            
            // Info box
            if (nominal >= users) {
                document.getElementById('info-text').innerHTML = 
                    `Total saldo <strong>Rp ${nominal.toLocaleString('id-ID')}</strong> akan dibagikan secara acak ke ${users} user.<br>
                     Setiap user minimal mendapatkan Rp 1.`;
                document.getElementById('warning-box').style.display = 'none';
            } else {
                document.getElementById('info-text').innerHTML = 
                    `Total saldo <strong>Rp ${nominal.toLocaleString('id-ID')}</strong> akan dibagikan secara acak ke ${users} user.`;
                
                // Show warning
                document.getElementById('warning-box').style.display = 'block';
                document.getElementById('warning-text').innerHTML = 
                    `Nominal saldo (Rp ${nominal.toLocaleString('id-ID')}) kurang dari jumlah user (${users}).<br>
                     Hanya ${nominal} user pertama yang akan mendapatkan saldo (minimal Rp 1).`;
            }
        }
    } else {
        // Hide all if no input
        hideAllBoxes();
        document.getElementById('info-text').innerHTML = 
            'Masukkan nominal saldo dan jumlah user untuk melihat detail distribusi.';
        document.getElementById('info-box').style.display = 'block';
    }
}

function hideAllBoxes() {
    document.getElementById('summary-box').style.display = 'none';
    document.getElementById('warning-box').style.display = 'none';
    document.getElementById('info-box').style.display = 'none';
}

// Initialize
toggleType();
</script>
</body>
</html>