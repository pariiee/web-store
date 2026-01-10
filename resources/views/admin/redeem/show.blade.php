<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Kode Redeem: {{ $code->code }}</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #eef2ff;
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
        --success-color: #10b981;
        --dark-color: #1f2937;
        --gray-color: #6b7280;
        --border-color: #e5e7eb;
        --radius: 8px;
        --shadow: 0 4px 6px rgba(0,0,0,0.08);
    }

    body {
        background:#f5f7fa;
        font-family:'Segoe UI',sans-serif;
        padding:20px;
        color:var(--dark-color);
    }

    .container {
        max-width:900px;
        margin:auto;
    }

    /* HEADER */
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
        margin:0;
    }

    /* CARD */
    .card {
        background:white;
        padding:25px;
        border-radius:var(--radius);
        box-shadow:var(--shadow);
        margin-bottom:25px;
    }

    table {
        width:100%;
        border-collapse:collapse;
        margin-top:15px;
    }

    th, td {
        padding:14px 14px;
        border-bottom:1px solid var(--border-color);
        text-align:left;
        font-size:14px;
    }

    thead {
        background:var(--primary-light);
        font-weight:600;
    }

    textarea {
        width:100%;
        padding:10px;
        border-radius:var(--radius);
        border:1px solid var(--border-color);
        font-family:monospace;
        resize:none;
    }

    .btn-copy {
        margin-top:6px;
        background:var(--primary-color);
        padding:6px 12px;
        border-radius:var(--radius);
        color:white;
        border:none;
        cursor:pointer;
        font-size:13px;
    }

    .btn-copy:hover {
        background:#314ad4;
    }

    /* BADGE */
    .badge {
        display:inline-block;
        padding:4px 8px;
        background:#e5e7eb;
        border-radius:var(--radius);
        font-size:12px;
        font-weight:600;
        color:#374151;
    }

    .badge-saldo { background:#d1fae5; color:#065f46; }
    .badge-stock { background:#fee2e2; color:#b91c1c; }
    .badge-rata { background:#dbeafe; color:#1e40af; }
    .badge-acak { background:#fef3c7; color:#92400e; }
    .badge-warning { background:#fef3c7; color:#92400e; }
    .badge-success { background:#d1fae5; color:#065f46; }

    /* TOAST */
    #toast {
        visibility:hidden;
        min-width:200px;
        background:#111;
        color:#fff;
        text-align:center;
        border-radius:var(--radius);
        padding:12px;
        position:fixed;
        z-index:9999;
        left:50%;
        bottom:30px;
        transform:translateX(-50%);
        font-size:14px;
        box-shadow:var(--shadow);
    }

    #toast.show {
        visibility:visible;
        animation:fadein 0.3s, fadeout 0.3s 2.2s;
    }

    @keyframes fadein {
        from { bottom:0; opacity:0; }
        to { bottom:30px; opacity:1; }
    }

    @keyframes fadeout {
        from { bottom:30px; opacity:1; }
        to { bottom:0; opacity:0; }
    }

    .info-box {
        margin-top:15px;
        padding:12px;
        background:#f8fafc;
        border-radius:var(--radius);
        border-left:4px solid var(--primary-color);
    }

    .calculation-box {
        background:#f0f9ff;
        padding:12px 16px;
        border-radius:var(--radius);
        margin:10px 0;
        border:1px dashed #bae6fd;
    }

</style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <i class="fas fa-gift"></i>
        <h1>Detail Redeem Code: {{ $code->code }}</h1>
    </div>

    <!-- INFO HEADER -->
    <div class="card">
        <p style="margin-bottom:8px;">
            <strong>Tipe:</strong> 
            @if($code->type === 'saldo')
                <span class="badge badge-saldo">SALDO</span>
            @else
                <span class="badge badge-stock">STOCK</span>
            @endif
            
            @if($code->type === 'saldo')
                <strong style="margin-left:10px;">Distribusi:</strong>
                @if($code->distribution_type === 'rata')
                    <span class="badge badge-rata">RATA</span>
                @else
                    <span class="badge badge-acak">ACAK</span>
                @endif
            @endif
        </p>

        @if($code->type === 'saldo')
            <p>
                @if($code->distribution_type === 'rata')
                    <strong>Distribusi Rata (SETIAP USER DAPAT SAMA):</strong><br>
                    Nominal per user: <strong>Rp {{ number_format($code->nominal_per_user, 0, ',', '.') }}</strong><br>
                    Jumlah user: <strong>{{ $code->max_users }}</strong><br>
                    Total saldo yang dikeluarkan: <strong>Rp {{ number_format($code->expected_total, 0, ',', '.') }}</strong><br>
                    
                    <div class="calculation-box">
                        <small>
                            Perhitungan: {{ $code->max_users }} × Rp {{ number_format($code->nominal_per_user, 0, ',', '.') }} = Rp {{ number_format($code->expected_total, 0, ',', '.') }}
                        </small>
                    </div>
                @else
                    <strong>Distribusi Acak (TOTAL DIBAGI ACAK):</strong><br>
                    Total saldo: <strong>Rp {{ number_format($code->total_saldo, 0, ',', '.') }}</strong><br>
                    Jumlah user: <strong>{{ $code->max_users }}</strong><br>
                @endif
                
                Sisa kuota: <strong>{{ $code->remaining_quota }} user</strong><br>
                Saldo terdistribusi: <strong>Rp {{ number_format($code->total_distributed, 0, ',', '.') }}</strong>
            </p>
            
            <div class="info-box">
                <strong>Rencana Pembagian Saldo:</strong><br>
                @foreach($code->per_user_saldo as $index => $amount)
                    @if($amount > 0)
                        User {{ $index + 1 }}: Rp {{ number_format($amount, 0, ',', '.') }}<br>
                    @else
                        User {{ $index + 1 }}: <span style="color:var(--gray-color);">Tidak mendapatkan saldo</span><br>
                    @endif
                @endforeach
                
                <div style="margin-top:10px; padding-top:10px; border-top:1px dashed var(--border-color);">
                    <strong>Total Terdistribusi:</strong> Rp {{ number_format($code->total_distributed, 0, ',', '.') }}
                    
                    @if($code->distribution_type === 'rata')
                        @if($code->total_distributed < $code->expected_total)
                            <br><small style="color:var(--primary-color);">
                                Sisa Rp {{ number_format($code->expected_total - $code->total_distributed, 0, ',', '.') }} akan dikeluarkan jika semua user claim
                            </small>
                        @endif
                    @else
                        @php
                            $remaining_saldo = $code->total_saldo - $code->total_distributed;
                        @endphp
                        @if($remaining_saldo > 0)
                            <br><small style="color:var(--warning-color);">
                                Sisa Rp {{ number_format($remaining_saldo, 0, ',', '.') }} tidak terbagi
                            </small>
                        @elseif($remaining_saldo === 0)
                            <br><small style="color:var(--success-color);">
                                Semua saldo telah terdistribusi
                            </small>
                        @endif
                    @endif
                </div>
            </div>
        @else
            <p>
                Item: <strong>{{ $code->item->name ?? '-' }}</strong><br>
                Total stok dibagikan: <strong>{{ $code->total_stock }}</strong><br>
                Sisa kuota: <strong>{{ $code->remaining_quota }} stock</strong>
            </p>
        @endif
    </div>

    <!-- CLAIM LIST -->
    <div class="card">
        <h3 style="margin-bottom:15px;">Daftar User Yang Redeem</h3>

        @if($code->claims->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Hadiah</th>
                        <th>Tanggal</th>
                        <th>Data Stock</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($code->claims as $claim)
                    <tr>
                        <td>{{ $claim->user->name }}</td>

                        <td>
                            @if($claim->reward_type === 'saldo')
                                <span class="badge badge-saldo">
                                    + Rp {{ number_format($claim->saldo_awarded, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="badge badge-stock">1 Stock</span>
                            @endif
                        </td>

                        <td>{{ $claim->created_at->format('d M Y H:i') }}</td>

                        <td>
                            @if($claim->reward_type === 'stock')
                                @php
                                    $ds = (array) $claim->data_stock;
                                    $text = implode("\n", $ds);
                                @endphp

                                <textarea rows="3" id="stock{{ $claim->id }}">{{ $text }}</textarea>
                                <button class="btn-copy" onclick="copyStock({{ $claim->id }})">
                                    <i class="fas fa-copy"></i> Copy
                                </button>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p style="text-align:center; color:var(--gray-color); padding:20px;">
                <i class="fas fa-inbox" style="font-size:48px; margin-bottom:10px; display:block;"></i>
                Belum ada user yang melakukan redeem.
            </p>
        @endif
    </div>

</div>

<!-- Toast Notification -->
<div id="toast">Data stok disalin!</div>

<script>
function copyStock(id) {
    const t = document.getElementById('stock' + id);
    t.select();
    t.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(t.value);

    const toast = document.getElementById("toast");
    toast.className = "show";
    setTimeout(() => toast.className = toast.className.replace("show", ""), 2500);
}
</script>

</body>
</html>