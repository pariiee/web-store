<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Kode Redeem</title>

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
    --gray-color: #6b7280;
    --border-color: #e5e7eb;
    --radius: 10px;
    --shadow: 0 10px 24px rgba(17, 24, 39, 0.08);
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    background:#f5f7fa;
    font-family: 'Segoe UI', sans-serif;
    color: var(--dark-color);
  }

  .page { padding: 28px 20px 24px; }
  @media (min-width:768px){ .page{ padding-top: 48px; } }

  .container { max-width: 1200px; margin: auto; }

  .header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding-bottom: 15px;
    border-bottom: 1px solid var(--border-color);
    margin-bottom: 25px;
    gap: 12px;
    flex-wrap: wrap;
  }

  .header h1 {
    display:flex;
    align-items:center;
    gap:10px;
    font-size: 24px;
  }

  .header h1 i { color: var(--primary-color); font-size: 22px; }

  .btn{
    padding:10px 16px;
    border-radius: var(--radius);
    font-size: 14px;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    gap:8px;
    cursor:pointer;
    border:none;
    white-space: nowrap;
    transition: transform .08s ease, opacity .15s ease, background .15s ease;
  }
  .btn:active{ transform: scale(.98); }

  .btn-primary { background: var(--primary-color); color: #fff; }
  .btn-primary:hover { background:#314ad4; }

  .btn-danger { background: var(--danger-color); color:#fff; }
  .btn-danger:hover { background:#dc2626; }

  .btn-secondary {
    background:#e5e7eb;
    color: var(--dark-color);
    border: none;
  }
  .btn-secondary:hover { background:#d5d7da; }

  .btn-sm { padding: 7px 10px; font-size: 13px; border-radius: 9px; }

  .table-container {
    background:#fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow:hidden;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  table{
    width:100%;
    border-collapse: collapse;
    min-width: 900px;
  }

  thead{ background: var(--primary-light); }

  th, td{
    padding: 16px 20px;
    border-bottom: 1px solid var(--border-color);
    font-size: 14px;
    text-align:left;
    white-space: nowrap;
    vertical-align: top;
  }

  tbody tr:hover{ background:#f9fafb; }

  .alert-success{
    background:#d1fae5;
    padding:12px 16px;
    margin-bottom:20px;
    border-left:4px solid var(--success-color);
    color:#065f46;
    border-radius: var(--radius);
    display:flex;
    gap:10px;
    align-items:center;
  }

  /* BADGE STYLES */
  .badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    margin-right: 4px;
  }
  
  .badge-type {
    font-size: 12px;
    padding: 4px 10px;
    margin-bottom: 4px;
  }
  
  .badge-saldo {
    background: #d1fae5;
    color: #065f46;
  }
  
  .badge-stock {
    background: #fee2e2;
    color: #b91c1c;
  }
  
  .badge-rata {
    background: #dbeafe;
    color: #1e40af;
  }
  
  .badge-acak {
    background: #fef3c7;
    color: #92400e;
  }
  
  .badge-info {
    background: #e0f2fe;
    color: #0369a1;
  }

  /* REWARD INFO STYLES */
  .reward-info {
    white-space: normal;
    min-width: 280px;
  }
  
  .reward-header {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 4px;
  }
  
  .reward-details {
    color: var(--gray-color);
    font-size: 13px;
    line-height: 1.5;
  }
  
  .reward-details strong {
    color: var(--dark-color);
  }
  
  .reward-details .calculation {
    background: #f8fafc;
    padding: 6px 8px;
    border-radius: 6px;
    margin-top: 4px;
    border-left: 3px solid var(--info-color);
    font-size: 12px;
  }

  /* MODAL */
  .modal{
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:9999;
    padding: 16px;
  }

  .modal-content{
    background:#fff;
    padding: 22px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    width: 420px;
    max-width: 100%;
  }

  .modal-header{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom: 10px;
  }

  .modal-header i{
    font-size: 20px;
    color: var(--danger-color);
  }

  .modal-content p{
    color:#374151;
    margin-top: 8px;
    line-height: 1.5;
  }

  .modal-footer{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-top: 18px;
  }

  /* STATUS INDICATOR */
  .status-indicator {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    padding: 2px 8px;
    border-radius: 12px;
    background: #f3f4f6;
    margin-left: 8px;
  }
  
  .status-active {
    background: #d1fae5;
    color: #065f46;
  }
  
  .status-expired {
    background: #fee2e2;
    color: #b91c1c;
  }
  
  .status-partial {
    background: #fef3c7;
    color: #92400e;
  }
</style>
</head>

<body>
  <x-sidebar />

  <main class="page">
    <div class="container">

      <div class="header">
        <h1><i class="fas fa-gift"></i> Daftar Kode Redeem</h1>

        <a href="{{ route('admin.redeem.create') }}" class="btn btn-primary">
          <i class="fas fa-plus"></i> Buat Kode Redeem
        </a>
      </div>

      @if(session('success'))
        <div class="alert-success">
          <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
      @endif

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Kode</th>
              <th>Tipe</th>
              <th>Hadiah</th>
              <th>Terpakai</th>
              <th>Dibuat</th>
              <th style="text-align:center;">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @foreach($codes as $c)
              <tr>
                <td>{{ $c->id }}</td>
                <td><strong>{{ $c->code }}</strong></td>
                <td>
                  @if($c->type === 'saldo')
                    <span class="badge badge-type badge-saldo">SALDO</span>
                    @if($c->distribution_type === 'rata')
                      <span class="badge badge-rata">RATA</span>
                    @else
                      <span class="badge badge-acak">ACAK</span>
                    @endif
                  @else
                    <span class="badge badge-type badge-stock">STOCK</span>
                  @endif
                </td>

                <td class="reward-info">
                  @if($c->type === 'saldo')
                    @if($c->distribution_type === 'rata')
                      <div class="reward-header">
                        <span class="badge badge-rata">Distribusi Rata</span>
                      </div>
                      <div class="reward-details">
                        <strong>SETIAP USER: Rp {{ number_format($c->nominal_per_user,0,',','.') }}</strong><br>
                        Max user: {{ $c->max_users }}<br>
                        Total: Rp {{ number_format($c->expected_total,0,',','.') }}
                        
                        <div class="calculation">
                          {{ $c->max_users }} × Rp {{ number_format($c->nominal_per_user,0,',','.') }} = Rp {{ number_format($c->expected_total,0,',','.') }}
                        </div>
                        
                        @if($c->remaining_quota > 0)
                          <span class="status-indicator status-active">
                            <i class="fas fa-circle" style="font-size: 8px;"></i>
                            Sisa {{ $c->remaining_quota }} user
                          </span>
                        @else
                          <span class="status-indicator status-expired">
                            <i class="fas fa-circle" style="font-size: 8px;"></i>
                            Kuota habis
                          </span>
                        @endif
                      </div>
                    @else
                      <div class="reward-header">
                        <span class="badge badge-acak">Distribusi Acak</span>
                      </div>
                      <div class="reward-details">
                        Total saldo: <strong>Rp {{ number_format($c->total_saldo,0,',','.') }}</strong><br>
                        Max user: {{ $c->max_users }}<br>
                        Dibagi acak ke {{ $c->max_users }} user
                        
                        @if($c->claims_count > 0)
                          <div class="calculation">
                            Sudah digunakan: {{ $c->claims_count }} user
                            @if($c->total_distributed > 0)
                              (Rp {{ number_format($c->total_distributed,0,',','.') }} terdistribusi)
                            @endif
                          </div>
                        @endif
                        
                        @if($c->remaining_quota > 0)
                          <span class="status-indicator status-partial">
                            <i class="fas fa-circle" style="font-size: 8px;"></i>
                            Sisa {{ $c->remaining_quota }} user
                          </span>
                        @else
                          <span class="status-indicator status-expired">
                            <i class="fas fa-circle" style="font-size: 8px;"></i>
                            Kuota habis
                          </span>
                        @endif
                      </div>
                    @endif
                  @else
                    <div class="reward-header">
                      <span class="badge badge-stock">STOCK ITEM</span>
                    </div>
                    <div class="reward-details">
                      <strong>Item:</strong> {{ $c->item->name ?? '-' }}<br>
                      Total stock: {{ $c->total_stock }}<br>
                      
                      @if($c->remaining_quota > 0)
                        <span class="status-indicator status-active">
                          <i class="fas fa-circle" style="font-size: 8px;"></i>
                          Sisa {{ $c->remaining_quota }} stock
                        </span>
                      @else
                        <span class="status-indicator status-expired">
                          <i class="fas fa-circle" style="font-size: 8px;"></i>
                          Stock habis
                        </span>
                      @endif
                    </div>
                  @endif
                </td>

                <td>
                  {{ $c->claims_count }}
                  @if($c->type === 'saldo' && $c->claims_count > 0 && $c->total_distributed > 0)
                    <br>
                    <small style="color: var(--info-color);">
                      Rp {{ number_format($c->total_distributed,0,',','.') }}
                    </small>
                  @endif
                </td>

                <td>
                  {{ $c->created_at->format('d M Y') }}
                  <br>
                  <small style="color: var(--gray-color);">
                    {{ $c->created_at->format('H:i') }}
                  </small>
                </td>

                <td style="text-align:center;">
                  <a href="{{ route('admin.redeem.show', $c->id) }}"
                     class="btn btn-primary btn-sm">
                    <i class="fas fa-eye"></i> Detail
                  </a>

                  <button type="button"
                          class="btn btn-danger btn-sm delete-btn"
                          data-id="{{ $c->id }}">
                    <i class="fas fa-trash"></i> Hapus
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <br>
      {{ $codes->links() }}

    </div>
  </main>

  <!-- MODAL -->
  <div id="deleteModal" class="modal" aria-hidden="true">
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
      <div class="modal-header">
        <i class="fas fa-exclamation-triangle"></i>
        <h3 id="modalTitle">Konfirmasi Hapus</h3>
      </div>

      <p>Apakah Anda yakin ingin menghapus kode redeem ini?</p>

      <form id="deleteForm" method="POST" style="margin-top:14px;">
        @csrf
        @method('DELETE')

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="cancelDelete">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById("deleteModal");
    const deleteForm = document.getElementById("deleteForm");
    const cancelBtn = document.getElementById("cancelDelete");

    const destroyUrlTemplate = @json(route('admin.redeem.destroy', '__ID__'));

    function openModalWithId(id){
      deleteForm.action = destroyUrlTemplate.replace('__ID__', id);
      modal.style.display = "flex";
      modal.setAttribute("aria-hidden", "false");
    }

    function closeModal(){
      modal.style.display = "none";
      modal.setAttribute("aria-hidden", "true");
    }

    document.addEventListener("click", (e) => {
      const btn = e.target.closest(".delete-btn");
      if (!btn) return;

      const id = btn.dataset.id;
      if (!id) return;

      openModalWithId(id);
    });

    cancelBtn.addEventListener("click", closeModal);

    modal.addEventListener("click", (e) => {
      if (e.target === modal) closeModal();
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape" && modal.style.display === "flex") closeModal();
    });
  </script>
</body>
</html>