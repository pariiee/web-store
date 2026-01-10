<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manajemen Pengguna - Admin Panel</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #4361ee;
      --primary-gradient: linear-gradient(135deg, #4361ee 0%, #3a56d4 100%);
      --primary-light: #eef2ff;
      --success-color: #10b981;
      --success-light: rgba(16, 185, 129, 0.1);
      --danger-color: #ef4444;
      --danger-light: rgba(239, 68, 68, 0.1);
      --warning-color: #f59e0b;
      --warning-light: rgba(245, 158, 11, 0.1);
      --info-color: #3b82f6;
      --dark-color: #1f2937;
      --dark-light: #374151;
      --light-color: #ffffff;
      --gray-50: #f9fafb;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-400: #9ca3af;
      --gray-500: #6b7280;
      --gray-600: #4b5563;
      --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
      --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
      --radius-sm: 6px;
      --radius-md: 8px;
      --radius-lg: 12px;
      --radius-xl: 16px;
      --radius-full: 9999px;
      --transition-fast: 150ms ease-in-out;
      --transition-normal: 250ms ease-in-out;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f8fafc;
      color: var(--dark-color);
      line-height: 1.6;
      font-weight: 400;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    .page { padding: 24px; animation: fadeIn .4s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    .container { max-width: 1400px; margin: 0 auto; position: relative; }

    .header { margin-bottom: 32px; padding-bottom: 20px; border-bottom: 1px solid var(--gray-200); }
    .header-content { display: flex; align-items: center; gap: 16px; }
    .header-icon {
      width: 48px; height: 48px;
      border-radius: var(--radius-md);
      background: var(--primary-gradient);
      display: flex; align-items: center; justify-content: center;
      color: white; font-size: 20px;
      box-shadow: var(--shadow-md);
    }
    .header h1 { font-size: 28px; font-weight: 700; line-height: 1.2; }
    .header-subtitle { color: var(--gray-500); font-size: 14px; margin-top: 4px; }

    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-bottom: 32px;
    }

    .stat-card {
      background: var(--light-color);
      border-radius: var(--radius-lg);
      padding: 20px;
      box-shadow: var(--shadow-md);
      border: 1px solid var(--gray-200);
      transition: all var(--transition-normal);
      position: relative;
      overflow: hidden;
    }
    .stat-card:hover {
      transform: translateY(-4px);
      box-shadow: var(--shadow-lg);
      border-color: var(--gray-300);
    }
    .stat-card::before {
      content: '';
      position: absolute; top: 0; left: 0;
      width: 4px; height: 100%;
      background: var(--primary-gradient);
      border-radius: var(--radius-full) 0 0 var(--radius-full);
    }
    .stat-card:nth-child(2)::before { background: linear-gradient(135deg, #10b981 0%, #0da271 100%); }
    .stat-card:nth-child(3)::before { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
    .stat-card:nth-child(4)::before { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }

    .stat-icon {
      width: 48px; height: 48px;
      border-radius: var(--radius-md);
      display: flex; align-items: center; justify-content: center;
      margin-bottom: 16px;
      font-size: 20px; color: #fff;
      background: var(--primary-gradient);
    }
    .stat-card:nth-child(2) .stat-icon { background: linear-gradient(135deg, #10b981 0%, #0da271 100%); }
    .stat-card:nth-child(3) .stat-icon { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
    .stat-card:nth-child(4) .stat-icon { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }

    .stat-card h3 { font-size: 32px; font-weight: 700; margin-bottom: 4px; }
    .stat-card p { color: var(--gray-500); font-size: 14px; font-weight: 500; }

    .notification {
      padding: 16px 20px;
      border-radius: var(--radius-md);
      margin-bottom: 18px;
      display: flex;
      align-items: flex-start;
      gap: 12px;
      font-size: 14px;
      animation: slideInRight 0.25s ease-out;
      border-left: 4px solid;
      background: var(--light-color);
    }
    @keyframes slideInRight { from { transform: translateX(20px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    .notification.success { background-color: #f0fdf4; color: #166534; border-left-color: var(--success-color); }
    .notification.error   { background-color: #fef2f2; color: #991b1b; border-left-color: var(--danger-color); }
    .notification.info    { background-color: #eff6ff; color: #1e40af; border-left-color: var(--info-color); }
    .notification i { font-size: 18px; flex-shrink: 0; margin-top: 1px; }
    .notification-content { flex: 1; }
    .notification-content ul { margin: 8px 0 0 18px; }

    .action-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      flex-wrap: wrap;
      gap: 16px;
      padding: 20px;
      background: var(--light-color);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-sm);
      border: 1px solid var(--gray-200);
    }
    .controls-group { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }

    .btn {
      padding: 10px 20px;
      border-radius: var(--radius-md);
      font-weight: 600;
      cursor: pointer;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all var(--transition-fast);
      text-decoration: none;
      font-size: 14px;
      position: relative;
      overflow: hidden;
    }

    .btn-primary {
      background: var(--primary-gradient);
      color: white;
      box-shadow: 0 2px 4px rgba(67, 97, 238, 0.3);
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(67, 97, 238, 0.4); }

    .btn-secondary {
      background: var(--light-color);
      color: var(--dark-color);
      border: 1px solid var(--gray-300);
    }
    .btn-secondary:hover {
      background: var(--gray-50);
      border-color: var(--gray-400);
      transform: translateY(-2px);
    }

    .btn-warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: white;
      box-shadow: 0 2px 4px rgba(245, 158, 11, 0.3);
    }
    .btn-warning:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(245, 158, 11, 0.4); }

    .btn-danger {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
    }
    .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(239, 68, 68, 0.4); }

    .search-box { position: relative; width: 280px; }
    .search-box input {
      width: 100%;
      padding: 11px 16px 11px 44px;
      border: 1px solid var(--gray-300);
      border-radius: var(--radius-md);
      font-size: 14px;
      background-color: var(--light-color);
      transition: all var(--transition-fast);
    }
    .search-box input:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }
    .search-box i {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray-400);
      font-size: 16px;
      pointer-events: none;
    }
    .search-box:focus-within i { color: var(--primary-color); }

    .filter-select {
      padding: 11px 40px 11px 16px;
      border: 1px solid var(--gray-300);
      border-radius: var(--radius-md);
      font-size: 14px;
      background-color: var(--light-color);
      appearance: none;
      cursor: pointer;
      width: 180px;
      font-weight: 500;
      transition: all var(--transition-fast);
    }
    .filter-select:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
    }
    .select-wrapper { position: relative; }
    .select-wrapper i {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray-400);
      font-size: 14px;
      pointer-events: none;
    }

    .table-container {
      background-color: var(--light-color);
      border-radius: var(--radius-lg);
      border: 1px solid var(--gray-200);
      overflow: hidden;
      margin-bottom: 32px;
      box-shadow: var(--shadow-md);
    }

    table { width: 100%; border-collapse: collapse; font-size: 14px; }
    thead {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      border-bottom: 2px solid var(--gray-200);
    }
    th {
      padding: 16px 20px;
      text-align: left;
      font-weight: 600;
      color: var(--dark-light);
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      white-space: nowrap;
    }
    td { padding: 20px; border-bottom: 1px solid var(--gray-100); }

    tbody tr { transition: all var(--transition-fast); }
    tbody tr:hover {
      background-color: #f8fafc;
      transform: scale(1.001);
      box-shadow: inset 0 0 0 1px var(--primary-light);
    }
    tbody tr.inactive { opacity: 0.75; background-color: var(--gray-50); }
    tbody tr.inactive:hover { opacity: 1; }

    .user-info { display: flex; align-items: center; gap: 12px; }
    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: var(--radius-full);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 16px;
      font-weight: 700;
      box-shadow: var(--shadow-sm);
      flex-shrink: 0;
      overflow: hidden;
      background: var(--primary-gradient);
      position: relative;
      user-select: none;
    }
    .user-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      display: block;
    }
    .avatar-fallback { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; }
    .user-avatar.has-image .avatar-fallback { display: none; }

    .user-details { min-width: 0; }
    .user-details h4 {
      font-weight: 600;
      color: var(--dark-color);
      margin-bottom: 4px;
      font-size: 15px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .user-details p {
      color: var(--gray-500);
      font-size: 13px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .user-id {
      display: inline-block;
      padding: 2px 8px;
      background: var(--gray-100);
      border-radius: var(--radius-full);
      font-size: 11px;
      font-weight: 500;
      color: var(--gray-500);
      margin-top: 4px;
    }

    .contact-info { display: flex; flex-direction: column; gap: 8px; }
    .contact-item { display: flex; align-items: center; gap: 8px; font-size: 14px; }
    .contact-item i { color: var(--gray-400); width: 16px; font-size: 14px; flex-shrink: 0; }
    .contact-item:hover i { color: var(--primary-color); transform: scale(1.1); transition: transform var(--transition-fast); }

    .role-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 12px;
      border-radius: var(--radius-full);
      font-size: 12px;
      font-weight: 700;
      letter-spacing: 0.3px;
      text-transform: uppercase;
      border: 1px solid transparent;
      white-space: nowrap;
    }
    .role-admin {
      background-color: var(--primary-light);
      color: var(--primary-color);
      border-color: rgba(67, 97, 238, 0.2);
    }
    .role-reseller {
      background-color: var(--success-light);
      color: var(--success-color);
      border-color: rgba(16, 185, 129, 0.2);
    }
    .role-guest {
      background-color: var(--gray-100);
      color: var(--gray-500);
      border-color: var(--gray-200);
    }

    .inactive-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 10px;
      border-radius: var(--radius-full);
      font-size: 11px;
      font-weight: 700;
      background-color: var(--warning-light);
      color: var(--warning-color);
      border: 1px solid rgba(245, 158, 11, 0.2);
      white-space: nowrap;
    }

    .change-info {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 10px;
      border-radius: var(--radius-full);
      font-size: 11px;
      font-weight: 700;
      border: 1px solid transparent;
      white-space: nowrap;
    }
    .change-info.ready {
      background-color: rgba(34, 197, 94, 0.1);
      color: #16a34a;
      border-color: rgba(34, 197, 94, 0.2);
    }
    .change-info.waiting {
      background-color: rgba(239, 68, 68, 0.1);
      color: #dc2626;
      border-color: rgba(239, 68, 68, 0.2);
    }
    .change-info.admin {
      background-color: rgba(139, 92, 246, 0.1);
      color: #7c3aed;
      border-color: rgba(139, 92, 246, 0.2);
    }

    .balance {
      font-weight: 800;
      font-size: 15px;
      padding: 6px 12px;
      border-radius: var(--radius-md);
      background: var(--gray-50);
      display: inline-block;
      white-space: nowrap;
    }
    .balance.low  { color: var(--danger-color); background: rgba(239, 68, 68, 0.1); }
    .balance.high { color: var(--success-color); background: rgba(16, 185, 129, 0.1); }

    .points { font-weight: 800; font-size: 18px; color: #7c3aed; display: block; }
    .points-info { font-size: 12px; color: var(--gray-500); margin-top: 2px; }

    .kebab {
      width: 36px; height: 36px;
      border: 1px solid var(--gray-300);
      border-radius: var(--radius-md);
      background: var(--light-color);
      cursor: pointer;
      font-size: 18px;
      color: var(--dark-color);
      display: inline-flex;
      align-items: center;
      justify-content: center;
      transition: all var(--transition-fast);
    }
    .kebab:hover {
      background-color: var(--primary-light);
      border-color: var(--primary-color);
      color: var(--primary-color);
      transform: rotate(90deg);
    }

    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-state i { font-size: 64px; color: var(--gray-300); margin-bottom: 16px; opacity: 0.5; }
    .empty-state h3 { font-size: 18px; color: var(--gray-500); margin-bottom: 8px; font-weight: 700; }
    .empty-state p { color: var(--gray-400); font-size: 14px; max-width: 420px; margin: 0 auto; }

    .footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 32px;
      padding-top: 20px;
      border-top: 1px solid var(--gray-200);
      color: var(--gray-500);
      font-size: 14px;
      flex-wrap: wrap;
      gap: 16px;
    }

    .pagination { display: flex; gap: 6px; align-items: center; }
    .pagination a, .pagination span.disabled, .pagination span.ellipsis {
      min-width: 36px;
      height: 36px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: var(--radius-md);
      text-decoration: none;
      color: var(--dark-color);
      font-size: 14px;
      font-weight: 600;
      border: 1px solid var(--gray-300);
      transition: all var(--transition-fast);
      padding: 0 10px;
      background: var(--light-color);
    }
    .pagination a:hover { background: var(--gray-100); border-color: var(--gray-400); }
    .pagination a.active {
      background: var(--primary-gradient);
      color: white;
      border-color: transparent;
      box-shadow: var(--shadow-sm);
    }
    .pagination span.disabled {
      opacity: 0.5;
      cursor: not-allowed;
      pointer-events: none;
      background: var(--gray-50);
    }
    .pagination span.ellipsis {
      border-color: transparent;
      background: transparent;
      color: var(--gray-400);
      min-width: auto;
      padding: 0 6px;
    }

    /* ===== MODAL ===== */
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.55);
      backdrop-filter: blur(4px);
      z-index: 1000;
      align-items: center;
      justify-content: center;
      padding: 16px;
      animation: fadeIn .2s ease-out;
    }
    .modal.show { display: flex; }

    .modal-content {
      background-color: var(--light-color);
      border-radius: var(--radius-xl);
      padding: 28px;
      max-width: 560px;
      width: 100%;
      max-height: 90vh;
      overflow-y: auto;
      border: 1px solid var(--gray-200);
      box-shadow: var(--shadow-xl);
      animation: slideUp .25s ease-out;
    }
    @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    .modal-header { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
    .modal-icon {
      width: 48px; height: 48px;
      border-radius: var(--radius-md);
      background: var(--primary-gradient);
      display: flex; align-items: center; justify-content: center;
      color: white; font-size: 20px;
    }
    .modal-header h3 { font-size: 20px; font-weight: 800; flex: 1; }
    .close-modal {
      width: 38px; height: 38px;
      border-radius: var(--radius-md);
      background: var(--gray-100);
      border: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: var(--gray-500);
      cursor: pointer;
      transition: all var(--transition-fast);
    }
    .close-modal:hover { background: var(--gray-200); color: var(--dark-color); }
    .modal-body { margin-bottom: 22px; }
    .modal-footer { display: flex; justify-content: flex-end; gap: 12px; flex-wrap: wrap; }

    .action-menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 12px;
      margin-top: 16px;
    }
    .action-btn {
      border: 1px solid var(--gray-200);
      background: var(--light-color);
      border-radius: var(--radius-md);
      padding: 16px;
      cursor: pointer;
      text-align: left;
      transition: all var(--transition-fast);
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }
    .action-btn:hover {
      background-color: var(--primary-light);
      border-color: var(--primary-color);
      transform: translateY(-2px);
      box-shadow: var(--shadow-md);
    }
    .action-btn i { font-size: 20px; color: var(--primary-color); margin-top: 2px; }
    .action-btn.danger i { color: var(--danger-color); }
    .action-btn.danger:hover { background-color: var(--danger-light); border-color: var(--danger-color); }
    .action-btn-content .title { font-size: 14px; font-weight: 800; margin-bottom: 4px; }
    .action-btn-content .subtitle { font-size: 12px; color: var(--gray-500); line-height: 1.4; }

    .user-status-container { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }

    /* ===== FORM UI ===== */
    .form-grid { display: grid; gap: 14px; }
    .form-group { display: grid; gap: 8px; }
    .form-label { font-weight: 700; font-size: 13px; color: var(--gray-600); }
    .form-input, .form-select {
      width: 100%;
      padding: 11px 14px;
      border: 1px solid var(--gray-300);
      border-radius: var(--radius-md);
      font-size: 14px;
      background: var(--light-color);
      transition: all var(--transition-fast);
    }
    .form-input:focus, .form-select:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.12);
    }
    .form-hint { font-size: 12px; color: var(--gray-500); }

    .input-row { display: grid; grid-template-columns: 1fr; gap: 12px; }
    @media (min-width: 520px) { .input-row { grid-template-columns: 1fr 1fr; } }

    .password-wrap { position: relative; }
    .toggle-pass {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      background: transparent;
      border: none;
      cursor: pointer;
      color: var(--gray-500);
      padding: 6px;
      border-radius: var(--radius-md);
    }
    .toggle-pass:hover { background: var(--gray-100); color: var(--dark-color); }

    .preview-box {
      margin-top: 10px;
      padding: 14px;
      border-radius: var(--radius-md);
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
    }
    .preview-box strong { display: block; margin-bottom: 6px; }
    .preview-value { font-weight: 900; font-size: 18px; }

    .role-options {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 10px;
      margin-top: 6px;
    }
    .role-option { position: relative; }
    .role-option input { position: absolute; opacity: 0; pointer-events: none; }
    .role-card {
      border: 2px solid var(--gray-200);
      border-radius: var(--radius-lg);
      padding: 12px 10px;
      cursor: pointer;
      text-align: center;
      transition: all var(--transition-fast);
      background: var(--light-color);
    }
    .role-card i { display: block; font-size: 18px; margin-bottom: 6px; color: var(--gray-500); }
    .role-card .role-name { font-weight: 900; font-size: 13px; }

    .role-option input[value="admin"]:checked + .role-card {
      border-color: var(--primary-color);
      background: var(--primary-light);
    }
    .role-option input[value="admin"]:checked + .role-card i { color: var(--primary-color); }

    .role-option input[value="reseller"]:checked + .role-card {
      border-color: var(--success-color);
      background: var(--success-light);
    }
    .role-option input[value="reseller"]:checked + .role-card i { color: var(--success-color); }

    .role-option input[value="guest"]:checked + .role-card {
      border-color: var(--gray-500);
      background: var(--gray-100);
    }
    .role-option input[value="guest"]:checked + .role-card i { color: var(--gray-600); }

    .warn-box {
      margin-top: 14px;
      padding: 12px;
      border-radius: var(--radius-md);
      background: var(--warning-light);
      border: 1px solid rgba(245,158,11,.25);
      color: var(--dark-color);
      font-size: 13px;
      display: flex;
      gap: 10px;
      align-items: flex-start;
    }
    .warn-box i { color: var(--warning-color); margin-top: 2px; }

    @media (max-width: 768px) {
      .page { padding: 16px; }

      .stats-container { grid-template-columns: repeat(2, 1fr); gap: 16px; }

      .action-bar { flex-direction: column; align-items: stretch; padding: 16px; }
      .controls-group { width: 100%; }
      .search-box, .select-wrapper { width: 100%; }

      .table-container { overflow-x: auto; border-radius: var(--radius-md); }
      table { min-width: 1000px; }

      .footer { flex-direction: column; gap: 16px; text-align: center; }
      .header-content { flex-direction: column; align-items: flex-start; gap: 12px; }
    }
    @media (max-width: 480px) {
      .stats-container { grid-template-columns: 1fr; }
      .modal-content { padding: 18px; }
      .role-options { grid-template-columns: 1fr; }
    }
  </style>
</head>

<body>
  <x-sidebar />

  <main class="page">
    <div class="container">

      <div class="header">
        <div class="header-content">
          <div class="header-icon">
            <i class="fas fa-users"></i>
          </div>
          <div>
            <h1>Manajemen Pengguna</h1>
            <div class="header-subtitle">Kelola data pengguna dan reseller dengan mudah</div>
          </div>
        </div>
      </div>

      <div class="stats-container">
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-users"></i></div>
          <h3>{{ $totalUsers ?? ($users->total() ?? 0) }}</h3>
          <p>Total Pengguna</p>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-store"></i></div>
          <h3>{{ $activeResellers ?? 0 }}</h3>
          <p>Reseller Aktif</p>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-user-clock"></i></div>
          <h3>{{ $inactiveUsers ?? 0 }}</h3>
          <p>Tidak Aktif</p>
        </div>
        <div class="stat-card">
          <div class="stat-icon"><i class="fas fa-star"></i></div>
          <h3>{{ $avgPoints ?? 0 }}</h3>
          <p>Poin/Bulan</p>
        </div>
      </div>

      {{-- ERROR VALIDATION --}}
      @if ($errors->any())
        <div class="notification error">
          <i class="fas fa-exclamation-circle"></i>
          <div class="notification-content">
            <strong>Terjadi error validasi:</strong>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif

      @if(session('success'))
        <div class="notification success">
          <i class="fas fa-check-circle"></i>
          <div class="notification-content">{{ session('success') }}</div>
        </div>
      @endif

      @if(session('error'))
        <div class="notification error">
          <i class="fas fa-exclamation-circle"></i>
          <div class="notification-content">{{ session('error') }}</div>
        </div>
      @endif

      <div class="action-bar">
        <div class="controls-group">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari nama, email, telegram, whatsapp...">
          </div>

          <div class="select-wrapper">
            <select id="filterRole" class="filter-select">
              <option value="">Semua Role</option>
              <option value="admin">Admin</option>
              <option value="reseller">Reseller</option>
              <option value="guest">Guest</option>
            </select>
            <i class="fas fa-chevron-down"></i>
          </div>
        </div>

        <div class="controls-group">
          <form
            action="{{ route('admin.users.trigger-auto-delete') }}"
            method="POST"
            onsubmit="return confirm('Jalankan auto delete? Akan menghapus user yang tidak order 30+ hari & saldo < 10k (kecuali admin).')"
            style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-warning">
              <i class="fas fa-robot"></i> Auto Delete
            </button>
          </form>

          <a href="{{ route('admin.users.deleted') }}" class="btn btn-secondary">
            <i class="fas fa-trash-restore"></i> Terhapus
          </a>
        </div>
      </div>

      <div class="table-container">
        <table id="usersTable">
          <thead>
            <tr>
              <th>Pengguna</th>
              <th>Kontak</th>
              <th>Pesanan Terakhir</th>
              <th>Role & Status</th>
              <th>Saldo</th>
              <th>Poin</th>
              <th style="text-align: center;">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse($users as $user)
              @php
                $saldoValue = (int) ($user->saldo ?? 0);

                $isInactive = $user->role !== 'admin'
                  && ($saldoValue < 10000)
                  && (is_null($user->last_order_at) || $user->last_order_at->lt(now()->subDays(30)));

                // Status change username/password: pakai method jika ada, fallback ke property
                $canChangeUsername = method_exists($user, 'canChangeUsername')
                  ? (bool) $user->canChangeUsername()
                  : (bool) ($user->can_change_username ?? false);

                $canChangePassword = method_exists($user, 'canChangePassword')
                  ? (bool) $user->canChangePassword()
                  : (bool) ($user->can_change_password ?? false);

                $usernameStatus = $user->role === 'admin' ? 'admin' : ($canChangeUsername ? 'ready' : 'waiting');
                $passwordStatus = $user->role === 'admin' ? 'admin' : ($canChangePassword ? 'ready' : 'waiting');

                // initials max 2 kata
                $cleanName = trim(preg_replace('/\s+/', ' ', $user->name ?? ''));
                $nameParts = collect(explode(' ', $cleanName))->filter()->take(2)->values();
                $initials = $nameParts->map(fn($w) => strtoupper(mb_substr($w, 0, 1, 'UTF-8')))->implode('');
                if ($initials === '') $initials = '?';

                // foto (optional)
                $defaultPhotos = ['default.png','default.jpg','avatar.png','profile.png'];
                $photoUrl = null;
                if (!empty($user->profile_photo) && !in_array(strtolower($user->profile_photo), $defaultPhotos, true)) {
                  $photoUrl = asset('storage/profile/' . $user->profile_photo);
                }

                // Points: ambil dari accessor kalau ada, fallback dari relation points (current month)
                $p = $user->points->first() ?? null;
                $currentMonthPoints = $user->current_month_points ?? ($p->points ?? 0);
                $currentMonthItems  = $user->current_month_items  ?? ($p->total_items ?? 0);

                $roleIcon = $user->role === 'admin' ? 'fa-crown' : ($user->role === 'reseller' ? 'fa-store' : 'fa-user');
              @endphp

              <tr class="{{ $isInactive ? 'inactive' : '' }}" data-role="{{ $user->role }}">
                <td>
                  <div class="user-info">
                    <div class="user-avatar {{ $photoUrl ? 'has-image' : '' }}">
                      @if($photoUrl)
                        <img src="{{ $photoUrl }}" alt="{{ $user->name }}" loading="lazy" decoding="async">
                      @endif
                      <span class="avatar-fallback">{{ $initials }}</span>
                    </div>

                    <div class="user-details">
                      <h4>{{ $user->name }}</h4>
                      <p>{{ $user->email }}</p>
                      <span class="user-id">#{{ $user->id }}</span>
                    </div>
                  </div>
                </td>

                <td>
                  <div class="contact-info">
                    @if($user->nama_tele)
                      <div class="contact-item">
                        <i class="fab fa-telegram"></i>
                        <span>{{ $user->nama_tele }}</span>
                      </div>
                    @endif

                    @if($user->whatsapp)
                      <div class="contact-item">
                        <i class="fab fa-whatsapp"></i>
                        <span>{{ $user->whatsapp }}</span>
                      </div>
                    @endif

                    @if(!$user->nama_tele && !$user->whatsapp)
                      <div class="contact-item" style="color: var(--gray-400); font-style: italic;">
                        <i class="fas fa-minus"></i>
                        <span>-</span>
                      </div>
                    @endif
                  </div>
                </td>

                <td>
                  @if($user->last_order_at)
                    <div style="font-size: 15px; font-weight: 800;">
                      {{ $user->last_order_at->format('d/m/Y') }}
                    </div>
                    <div style="color: var(--gray-500); font-size: 13px; margin-top: 4px;">
                      {{ $user->last_order_at->diffForHumans() }}
                    </div>
                  @else
                    <span style="color: var(--gray-400); font-style: italic; font-size: 13px;">Belum order</span>
                  @endif
                </td>

                <td>
                  <div class="user-status-container">
                    <span class="role-badge role-{{ $user->role }}">
                      <i class="fas {{ $roleIcon }}"></i>
                      {{ ucfirst($user->role) }}
                    </span>

                    @if($isInactive)
                      <span class="inactive-badge" title="Tidak aktif: last order > 30 hari & saldo < 10k (kecuali admin)">
                        <i class="fas fa-clock"></i> Tidak Aktif
                      </span>
                    @endif

                    @if($usernameStatus === 'admin')
                      <span class="change-info admin" title="Admin: bebas ganti username">
                        <i class="fas fa-user"></i> Username
                      </span>
                    @elseif($usernameStatus === 'ready')
                      <span class="change-info ready" title="Username bisa diganti">
                        <i class="fas fa-user"></i> Username
                      </span>
                    @else
                      <span class="change-info waiting" title="Username belum bisa diganti">
                        <i class="fas fa-user-clock"></i> Username
                      </span>
                    @endif

                    @if($passwordStatus === 'admin')
                      <span class="change-info admin" title="Admin: bebas ganti password">
                        <i class="fas fa-key"></i> Password
                      </span>
                    @elseif($passwordStatus === 'ready')
                      <span class="change-info ready" title="Password bisa diganti">
                        <i class="fas fa-key"></i> Password
                      </span>
                    @else
                      <span class="change-info waiting" title="Password belum bisa diganti">
                        <i class="fas fa-clock"></i> Password
                      </span>
                    @endif
                  </div>
                </td>

                <td>
                  <span class="balance {{ $saldoValue < 10000 ? 'low' : 'high' }}">
                    Rp {{ number_format($saldoValue,0,',','.') }}
                  </span>
                </td>

                <td>
                  <span class="points">{{ (int) $currentMonthPoints }}</span>
                  <div class="points-info">{{ (int) $currentMonthItems }} items</div>
                </td>

                <td style="text-align:center;">
                  @if($user->id !== auth()->id())
                    <button
                      type="button"
                      class="kebab"
                      title="Klik untuk aksi"
                      data-user-id="{{ $user->id }}"
                      data-user-name="{{ $user->name }}"
                      data-user-email="{{ $user->email }}"
                      data-user-role="{{ $user->role }}"
                      data-user-saldo="{{ $saldoValue }}"
                      data-user-tele="{{ $user->nama_tele ?? '' }}"
                      data-user-wa="{{ $user->whatsapp ?? '' }}"
                      data-avatar-url="{{ $photoUrl ?? '' }}"
                      data-avatar-initials="{{ $initials }}"
                    >⋮</button>
                  @else
                    <span style="color: var(--primary-color); font-size: 13px; font-weight: 800;">
                      <i class="fas fa-user-check"></i> Anda
                    </span>
                  @endif
                </td>
              </tr>
            @empty
              <tr data-empty="1">
                <td colspan="7">
                  <div class="empty-state">
                    <i class="fas fa-users-slash"></i>
                    <h3>Tidak ada pengguna ditemukan</h3>
                    <p>Belum ada data user atau filter pencarian tidak menemukan hasil.</p>
                  </div>
                </td>
              </tr>
            @endforelse

            {{-- Row empty state tambahan untuk filter/search (JS) --}}
            <tr id="jsEmptyRow" data-empty="1" style="display:none;">
              <td colspan="7">
                <div class="empty-state">
                  <i class="fas fa-search"></i>
                  <h3>Tidak ada hasil</h3>
                  <p>Coba ubah kata kunci pencarian atau filter role.</p>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="footer">
        <div class="pagination-info">
          Menampilkan {{ $users->count() }} dari {{ $totalUsers ?? ($users->total() ?? 0) }} pengguna
          @if(method_exists($users, 'currentPage'))
            • Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}
          @endif
        </div>

        @if(method_exists($users, 'lastPage') && $users->lastPage() > 1)
          @php
            $currentPage = $users->currentPage();
            $totalPages = $users->lastPage();
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $currentPage + 2);
          @endphp

          <div class="pagination">
            {{-- Prev --}}
            @if($users->onFirstPage())
              <span class="disabled"><i class="fas fa-chevron-left"></i></span>
            @else
              <a href="{{ $users->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
            @endif

            {{-- First + ellipsis --}}
            @if($startPage > 1)
              <a href="{{ $users->url(1) }}">1</a>
              @if($startPage > 2)
                <span class="ellipsis">…</span>
              @endif
            @endif

            {{-- Middle pages --}}
            @for($i = $startPage; $i <= $endPage; $i++)
              @if($i == $currentPage)
                <a href="{{ $users->url($i) }}" class="active">{{ $i }}</a>
              @else
                <a href="{{ $users->url($i) }}">{{ $i }}</a>
              @endif
            @endfor

            {{-- Last + ellipsis --}}
            @if($endPage < $totalPages)
              @if($endPage < $totalPages - 1)
                <span class="ellipsis">…</span>
              @endif
              <a href="{{ $users->url($totalPages) }}">{{ $totalPages }}</a>
            @endif

            {{-- Next --}}
            @if($users->hasMorePages())
              <a href="{{ $users->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
            @else
              <span class="disabled"><i class="fas fa-chevron-right"></i></span>
            @endif
          </div>
        @endif
      </div>

    </div>
  </main>

  {{-- =========================
      ACTION MODAL
  ========================= --}}
  <div id="actionModal" class="modal" aria-hidden="true">
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="actionModalTitle">
      <div class="modal-header">
        <div class="modal-icon"><i class="fas fa-user-cog"></i></div>
        <h3 id="actionModalTitle">Kelola Pengguna</h3>
        <button type="button" class="close-modal" data-close-modal>
          <i class="fas fa-times"></i>
        </button>
      </div>

      <div class="modal-body">
        <p style="margin-bottom: 14px; font-size: 14px; color: var(--gray-600);">
          Kelola pengguna: <strong id="actionUserName" style="color: var(--dark-color);"></strong>
        </p>

        <div class="user-info" style="margin-bottom: 14px; padding: 14px; background: var(--gray-50); border-radius: var(--radius-md); border: 1px solid var(--gray-200);">
          <div class="user-avatar" id="modalUserAvatar" style="width: 60px; height: 60px; font-size: 20px;">
            <span class="avatar-fallback">?</span>
          </div>

          <div class="user-details">
            <h4 id="modalUserName"></h4>
            <p id="modalUserEmail"></p>
            <div style="display:flex; gap: 8px; margin-top: 10px; flex-wrap: wrap;">
              <span class="role-badge role-guest" id="modalUserRoleBadge"><i class="fas fa-user"></i> GUEST</span>
              <span class="balance" id="modalUserBalance">Rp 0</span>
            </div>
          </div>
        </div>

        <div class="action-menu">
          <button type="button" class="action-btn" id="actionEditBtn">
            <i class="fas fa-edit"></i>
            <div class="action-btn-content">
              <div class="title">Edit Data</div>
              <div class="subtitle">Ubah nama, telegram & whatsapp</div>
            </div>
          </button>

          <button type="button" class="action-btn" id="actionPasswordBtn">
            <i class="fas fa-key"></i>
            <div class="action-btn-content">
              <div class="title">Reset Password</div>
              <div class="subtitle">Buat password baru untuk pengguna</div>
            </div>
          </button>

          <button type="button" class="action-btn" id="actionSaldoBtn">
            <i class="fas fa-wallet"></i>
            <div class="action-btn-content">
              <div class="title">Kelola Saldo</div>
              <div class="subtitle">Tambah atau kurangi saldo</div>
            </div>
          </button>

          <button type="button" class="action-btn" id="actionRoleBtn">
            <i class="fas fa-user-tag"></i>
            <div class="action-btn-content">
              <div class="title">Ubah Role</div>
              <div class="subtitle">Ubah role pengguna</div>
            </div>
          </button>

          <button type="button" class="action-btn" id="actionResetUsernameBtn">
            <i class="fas fa-user-clock"></i>
            <div class="action-btn-content">
              <div class="title">Reset Username Timer</div>
              <div class="subtitle">Agar username bisa diubah lagi</div>
            </div>
          </button>

          <button type="button" class="action-btn" id="actionResetPasswordTimerBtn">
            <i class="fas fa-clock"></i>
            <div class="action-btn-content">
              <div class="title">Reset Password Timer</div>
              <div class="subtitle">Agar password bisa diubah lagi</div>
            </div>
          </button>

          <button type="button" class="action-btn danger" id="actionDeleteBtn">
            <i class="fas fa-trash-alt"></i>
            <div class="action-btn-content">
              <div class="title">Hapus Pengguna</div>
              <div class="subtitle">Soft delete (bisa direstore)</div>
            </div>
          </button>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-close-modal>Tutup</button>
      </div>
    </div>
  </div>

  {{-- =========================
      EDIT MODAL
  ========================= --}}
  <div id="editModal" class="modal" aria-hidden="true">
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="editModalTitle">
      <div class="modal-header">
        <div class="modal-icon"><i class="fas fa-edit"></i></div>
        <h3 id="editModalTitle">Edit Data Pengguna</h3>
        <button type="button" class="close-modal" data-close-modal><i class="fas fa-times"></i></button>
      </div>

      <form id="editForm" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-body">
          <div class="form-grid">
            <div class="form-group">
              <div class="form-label">Nama</div>
              <input type="text" class="form-input" name="name" id="editName" required maxlength="100">
            </div>

            <div class="input-row">
              <div class="form-group">
                <div class="form-label">Telegram</div>
                <input type="text" class="form-input" name="nama_tele" id="editTele" required maxlength="50" placeholder="username telegram">
              </div>
              <div class="form-group">
                <div class="form-label">WhatsApp</div>
                <input type="text" class="form-input" name="whatsapp" id="editWa" required maxlength="20" placeholder="08xxxxxxxxxx">
              </div>
            </div>

            <div class="preview-box">
              <strong>Email</strong>
              <div class="form-hint">
                Email biasanya ikut ter-update otomatis dari sistem (sesuai logika model kamu).
              </div>
              <div style="margin-top: 6px; font-weight: 800;" id="editEmailPreview">-</div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-close-modal>Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>

  {{-- =========================
      PASSWORD MODAL
  ========================= --}}
  <div id="passwordModal" class="modal" aria-hidden="true">
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="passwordModalTitle">
      <div class="modal-header">
        <div class="modal-icon" style="background: linear-gradient(135deg,#f59e0b 0%,#d97706 100%);">
          <i class="fas fa-key"></i>
        </div>
        <h3 id="passwordModalTitle">Reset Password</h3>
        <button type="button" class="close-modal" data-close-modal><i class="fas fa-times"></i></button>
      </div>

      <form id="passwordForm" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-body">
          <p style="font-size: 14px; color: var(--gray-600); margin-bottom: 12px;">
            Reset password untuk: <strong id="passwordUserName"></strong>
          </p>

          <div class="form-grid">
            <div class="form-group">
              <div class="form-label">Password Baru</div>
              <div class="password-wrap">
                <input type="password" class="form-input" name="password" id="passwordInput" required minlength="8" placeholder="Minimal 8 karakter">
                <button type="button" class="toggle-pass" data-toggle-pass="passwordInput" aria-label="Toggle password">
                  <i class="fas fa-eye"></i>
                </button>
              </div>
              <div class="form-hint">User akan logout dari semua perangkat setelah password diubah.</div>
            </div>

            <div class="form-group">
              <div class="form-label">Konfirmasi Password</div>
              <input type="password" class="form-input" name="password_confirmation" id="passwordConfirmInput" required minlength="8" placeholder="Ulangi password">
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-close-modal>Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update</button>
        </div>
      </form>
    </div>
  </div>

  {{-- =========================
      SALDO MODAL
  ========================= --}}
  <div id="saldoModal" class="modal" aria-hidden="true">
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="saldoModalTitle">
      <div class="modal-header">
        <div class="modal-icon" style="background: linear-gradient(135deg,#10b981 0%,#0da271 100%);">
          <i class="fas fa-wallet"></i>
        </div>
        <h3 id="saldoModalTitle">Kelola Saldo</h3>
        <button type="button" class="close-modal" data-close-modal><i class="fas fa-times"></i></button>
      </div>

      <form id="saldoForm" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-body">
          <p style="font-size: 14px; color: var(--gray-600); margin-bottom: 10px;">
            Ubah saldo untuk: <strong id="saldoUserName"></strong>
          </p>

          <div class="preview-box">
            <strong>Saldo saat ini</strong>
            <div class="preview-value" id="saldoCurrentText">Rp 0</div>
          </div>

          <div class="form-grid" style="margin-top: 14px;">
            <div class="form-group">
              <div class="form-label">Nominal (Rp)</div>
              <input type="number" class="form-input" name="amount" id="saldoAmount" required min="1" placeholder="Masukkan nominal">
            </div>

            <div class="form-group">
              <div class="form-label">Tindakan</div>
              <div style="display:flex; gap: 12px; flex-wrap: wrap;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-weight:700;">
                  <input type="radio" name="action" value="add" checked>
                  Tambah
                </label>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-weight:700;">
                  <input type="radio" name="action" value="reduce">
                  Kurangi
                </label>
              </div>
            </div>

            <div class="form-group">
              <div class="form-label">Catatan (opsional)</div>
              <input type="text" class="form-input" name="note" id="saldoNote" maxlength="500" placeholder="Contoh: Bonus bulanan, koreksi saldo, dll">
            </div>

            <div class="preview-box">
              <strong>Preview saldo baru</strong>
              <div class="preview-value" id="saldoNewPreview">Rp 0</div>
              <div class="form-hint" id="saldoHint"></div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-close-modal>Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
        </div>
      </form>
    </div>
  </div>

  {{-- =========================
      ROLE MODAL
  ========================= --}}
  <div id="roleModal" class="modal" aria-hidden="true">
    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="roleModalTitle">
      <div class="modal-header">
        <div class="modal-icon"><i class="fas fa-user-tag"></i></div>
        <h3 id="roleModalTitle">Ubah Role</h3>
        <button type="button" class="close-modal" data-close-modal><i class="fas fa-times"></i></button>
      </div>

      <form id="roleForm" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-body">
          <p style="font-size: 14px; color: var(--gray-600); margin-bottom: 10px;">
            Ubah role untuk: <strong id="roleUserName"></strong>
          </p>

          <div class="form-group">
            <div class="form-label">Pilih role</div>
            <div class="role-options">
              <label class="role-option">
                <input type="radio" name="role" value="guest" required>
                <div class="role-card">
                  <i class="fas fa-user"></i>
                  <div class="role-name">GUEST</div>
                </div>
              </label>

              <label class="role-option">
                <input type="radio" name="role" value="reseller" required>
                <div class="role-card">
                  <i class="fas fa-store"></i>
                  <div class="role-name">RESELLER</div>
                </div>
              </label>

              <label class="role-option">
                <input type="radio" name="role" value="admin" required>
                <div class="role-card">
                  <i class="fas fa-crown"></i>
                  <div class="role-name">ADMIN</div>
                </div>
              </label>
            </div>

            <div class="warn-box">
              <i class="fas fa-exclamation-triangle"></i>
              <div>
                <strong>Catatan:</strong> Role Admin memberikan akses penuh ke sistem. Hanya berikan kepada pengguna tepercaya.
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-close-modal>Batal</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Update</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Hidden forms untuk aksi cepat --}}
  <form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
  </form>
  <form id="resetUsernameForm" method="POST" style="display:none;">@csrf</form>
  <form id="resetPasswordTimerForm" method="POST" style="display:none;">@csrf</form>

  <script>
    const routes = {
      base: '/admin/manage-users',
      updateData: (id) => `/admin/manage-users/${id}/data`,
      updatePassword: (id) => `/admin/manage-users/${id}/password`,
      updateBalance: (id) => `/admin/manage-users/${id}/balance`,
      updateRole: (id) => `/admin/manage-users/${id}/role`,
      delete: (id) => `/admin/manage-users/${id}/delete`,
      resetUsernameTimer: (id) => `/admin/manage-users/${id}/reset-username-timer`,
      resetPasswordTimer: (id) => `/admin/manage-users/${id}/reset-password-timer`,
    };

    let currentUser = {
      id: null, name: '', email: '', role: 'guest', saldo: 0,
      tele: '', wa: '', avatarUrl: '', initials: '?'
    };

    const MODALS = ['actionModal', 'editModal', 'passwordModal', 'saldoModal', 'roleModal'];

    function anyModalOpen() {
      return MODALS.some(id => document.getElementById(id)?.classList.contains('show'));
    }
    function openModal(id) {
      MODALS.forEach(mid => {
        const el = document.getElementById(mid);
        if (!el) return;
        el.classList.toggle('show', mid === id);
      });
      document.body.style.overflow = 'hidden';
    }
    function closeAllModals() {
      MODALS.forEach(mid => document.getElementById(mid)?.classList.remove('show'));
      document.body.style.overflow = '';
    }

    function formatIDR(n) {
      const num = Number(n || 0);
      return 'Rp ' + num.toLocaleString('id-ID');
    }

    function roleIcon(role) {
      if (role === 'admin') return 'fa-crown';
      if (role === 'reseller') return 'fa-store';
      return 'fa-user';
    }

    function renderAvatar(container, avatarUrl, initials) {
      container.innerHTML = '';
      container.classList.remove('has-image');

      const fallback = document.createElement('span');
      fallback.className = 'avatar-fallback';
      fallback.textContent = (initials || '?').trim() || '?';
      container.appendChild(fallback);

      if (!avatarUrl) return;

      const img = document.createElement('img');
      img.src = avatarUrl;
      img.alt = initials || 'avatar';
      img.loading = 'lazy';
      img.decoding = 'async';

      img.addEventListener('load', () => container.classList.add('has-image'));
      img.addEventListener('error', () => {
        img.remove();
        container.classList.remove('has-image');
      });

      container.insertBefore(img, fallback);
    }

    function updateActionModalUI() {
      document.getElementById('actionUserName').textContent = currentUser.name || '-';
      document.getElementById('modalUserName').textContent = currentUser.name || '-';
      document.getElementById('modalUserEmail').textContent = currentUser.email || '-';
      document.getElementById('modalUserBalance').textContent = formatIDR(currentUser.saldo);

      const roleBadge = document.getElementById('modalUserRoleBadge');
      roleBadge.className = `role-badge role-${currentUser.role}`;
      roleBadge.innerHTML = `<i class="fas ${roleIcon(currentUser.role)}"></i> ${(currentUser.role || '').toUpperCase()}`;

      renderAvatar(
        document.getElementById('modalUserAvatar'),
        (currentUser.avatarUrl || '').trim(),
        (currentUser.initials || '?').trim()
      );
    }

    function setFormActions() {
      const id = currentUser.id;
      if (!id) return;

      document.getElementById('editForm').action = routes.updateData(id);
      document.getElementById('passwordForm').action = routes.updatePassword(id);
      document.getElementById('saldoForm').action = routes.updateBalance(id);
      document.getElementById('roleForm').action = routes.updateRole(id);

      document.getElementById('deleteForm').action = routes.delete(id);
      document.getElementById('resetUsernameForm').action = routes.resetUsernameTimer(id);
      document.getElementById('resetPasswordTimerForm').action = routes.resetPasswordTimer(id);
    }

    function openActionFromButton(btn) {
      currentUser = {
        id: btn.dataset.userId,
        name: btn.dataset.userName || '',
        email: btn.dataset.userEmail || '',
        role: btn.dataset.userRole || 'guest',
        saldo: parseFloat(btn.dataset.userSaldo) || 0,
        tele: btn.dataset.userTele || '',
        wa: btn.dataset.userWa || '',
        avatarUrl: btn.dataset.avatarUrl || '',
        initials: btn.dataset.avatarInitials || '?'
      };

      setFormActions();
      updateActionModalUI();
      openModal('actionModal');
    }

    // ===== Filters: search + role (gabung)
    function applyFilters() {
      const term = (document.getElementById('searchInput').value || '').toLowerCase().trim();
      const role = document.getElementById('filterRole').value || '';
      const rows = document.querySelectorAll('#usersTable tbody tr');

      let visibleCount = 0;
      rows.forEach(row => {
        if (row.dataset.empty === '1' || row.id === 'jsEmptyRow') return;

        const rowRole = row.dataset.role || '';
        const name = row.querySelector('.user-details h4')?.textContent.toLowerCase() || '';
        const email = row.querySelector('.user-details p')?.textContent.toLowerCase() || '';
        const contact = row.querySelector('.contact-info')?.textContent.toLowerCase() || '';

        const matchRole = !role || rowRole === role;
        const matchTerm = !term || name.includes(term) || email.includes(term) || contact.includes(term);
        const visible = matchRole && matchTerm;

        row.style.display = visible ? '' : 'none';
        if (visible) visibleCount++;
      });

      // empty row JS
      const jsEmpty = document.getElementById('jsEmptyRow');
      if (jsEmpty) jsEmpty.style.display = (visibleCount === 0) ? '' : 'none';
    }

    // ===== Saldo preview
    let saldoCurrentValue = 0;

    function updateSaldoPreview() {
      const amount = parseFloat(document.getElementById('saldoAmount').value) || 0;
      const action = document.querySelector('#saldoForm input[name="action"]:checked')?.value || 'add';

      let next = saldoCurrentValue;
      if (action === 'add') next = saldoCurrentValue + amount;
      if (action === 'reduce') next = saldoCurrentValue - amount;

      const el = document.getElementById('saldoNewPreview');
      const hint = document.getElementById('saldoHint');

      el.textContent = formatIDR(next);
      if (next < 0) {
        el.style.color = 'var(--danger-color)';
        hint.textContent = 'Saldo akan negatif (backend akan menolak jika saldo tidak cukup).';
      } else if (next < 10000) {
        el.style.color = 'var(--warning-color)';
        hint.textContent = 'Saldo < 10k. User bisa masuk kategori tidak aktif.';
      } else {
        el.style.color = 'var(--success-color)';
        hint.textContent = '';
      }
    }

    // ===== Open child modals
    function openEditModal() {
      // fill
      document.getElementById('editName').value = currentUser.name || '';
      document.getElementById('editTele').value = currentUser.tele || '';
      document.getElementById('editWa').value = currentUser.wa || '';
      document.getElementById('editEmailPreview').textContent = currentUser.email || '-';

      openModal('editModal');
      setTimeout(() => document.getElementById('editName').focus(), 50);
    }

    function openPasswordModal() {
      document.getElementById('passwordUserName').textContent = currentUser.name || '';
      document.getElementById('passwordInput').value = '';
      document.getElementById('passwordConfirmInput').value = '';

      openModal('passwordModal');
      setTimeout(() => document.getElementById('passwordInput').focus(), 50);
    }

    function openSaldoModal() {
      document.getElementById('saldoUserName').textContent = currentUser.name || '';
      saldoCurrentValue = parseFloat(currentUser.saldo) || 0;

      document.getElementById('saldoCurrentText').textContent = formatIDR(saldoCurrentValue);
      document.getElementById('saldoAmount').value = '';
      document.querySelector('#saldoForm input[name="action"][value="add"]').checked = true;
      document.getElementById('saldoNote').value = 'Penyesuaian saldo oleh admin';

      updateSaldoPreview();
      openModal('saldoModal');
      setTimeout(() => document.getElementById('saldoAmount').focus(), 50);
    }

    function openRoleModal() {
      document.getElementById('roleUserName').textContent = currentUser.name || '';

      // set checked
      document.querySelectorAll('#roleForm input[name="role"]').forEach(r => {
        r.checked = (r.value === currentUser.role);
      });

      openModal('roleModal');
    }

    // ===== submit helpers
    function submitDelete() {
      if (!currentUser.id) return;
      if (confirm(`Hapus pengguna "${currentUser.name}"?\n\nPengguna akan di-soft delete dan bisa direstore.`)) {
        document.getElementById('deleteForm').submit();
      }
    }

    function submitResetUsernameTimer() {
      if (!currentUser.id) return;
      if (confirm(`Reset timer username untuk ${currentUser.name}?`)) {
        document.getElementById('resetUsernameForm').submit();
      }
    }

    function submitResetPasswordTimer() {
      if (!currentUser.id) return;
      if (confirm(`Reset timer password untuk ${currentUser.name}?`)) {
        document.getElementById('resetPasswordTimerForm').submit();
      }
    }

    // ===== Password toggle
    function togglePassword(inputId) {
      const input = document.getElementById(inputId);
      if (!input) return;

      const btn = document.querySelector(`[data-toggle-pass="${inputId}"]`);
      const icon = btn?.querySelector('i');

      if (input.type === 'password') {
        input.type = 'text';
        if (icon) { icon.classList.remove('fa-eye'); icon.classList.add('fa-eye-slash'); }
      } else {
        input.type = 'password';
        if (icon) { icon.classList.remove('fa-eye-slash'); icon.classList.add('fa-eye'); }
      }
    }

    // ===== DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
      // fallback avatar image error (tabel)
      document.querySelectorAll('.user-avatar img').forEach(img => {
        img.addEventListener('error', () => {
          const wrapper = img.closest('.user-avatar');
          if (wrapper) wrapper.classList.remove('has-image');
          img.remove();
        });
      });

      // kebab action
      document.querySelectorAll('.kebab').forEach(btn => {
        btn.addEventListener('click', (e) => {
          e.preventDefault();
          e.stopPropagation();
          openActionFromButton(btn);
        });
      });

      // close modal buttons
      document.addEventListener('click', (e) => {
        if (e.target.matches('[data-close-modal]') || e.target.closest('[data-close-modal]')) {
          closeAllModals();
        }
      });

      // click outside (overlay)
      window.addEventListener('click', (e) => {
        if (e.target.classList && e.target.classList.contains('modal') && e.target.classList.contains('show')) {
          closeAllModals();
        }
      });

      // esc
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && anyModalOpen()) closeAllModals();
      });

      // filters
      let t;
      document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(t);
        t = setTimeout(applyFilters, 250);
      });
      document.getElementById('filterRole').addEventListener('change', applyFilters);

      // action modal buttons
      document.getElementById('actionEditBtn').addEventListener('click', openEditModal);
      document.getElementById('actionPasswordBtn').addEventListener('click', openPasswordModal);
      document.getElementById('actionSaldoBtn').addEventListener('click', openSaldoModal);
      document.getElementById('actionRoleBtn').addEventListener('click', openRoleModal);
      document.getElementById('actionResetUsernameBtn').addEventListener('click', submitResetUsernameTimer);
      document.getElementById('actionResetPasswordTimerBtn').addEventListener('click', submitResetPasswordTimer);
      document.getElementById('actionDeleteBtn').addEventListener('click', submitDelete);

      // saldo preview listeners
      document.getElementById('saldoAmount').addEventListener('input', updateSaldoPreview);
      document.querySelectorAll('#saldoForm input[name="action"]').forEach(r => {
        r.addEventListener('change', updateSaldoPreview);
      });

      // password toggle
      document.querySelectorAll('[data-toggle-pass]').forEach(btn => {
        btn.addEventListener('click', () => togglePassword(btn.dataset.togglePass));
      });

      // form validations (client-side minimal)
      document.getElementById('passwordForm').addEventListener('submit', function(e) {
        const p = document.getElementById('passwordInput').value || '';
        const c = document.getElementById('passwordConfirmInput').value || '';
        if (p.length < 8) { e.preventDefault(); alert('Password minimal 8 karakter'); return; }
        if (p !== c) { e.preventDefault(); alert('Password dan konfirmasi tidak cocok'); return; }
      });

      document.getElementById('saldoForm').addEventListener('submit', function(e) {
        const amt = parseFloat(document.getElementById('saldoAmount').value);
        if (isNaN(amt) || amt <= 0) { e.preventDefault(); alert('Masukkan nominal yang valid (> 0)'); return; }
      });

      document.getElementById('roleForm').addEventListener('submit', function(e) {
        const selected = document.querySelector('#roleForm input[name="role"]:checked');
        if (!selected) { e.preventDefault(); alert('Pilih role terlebih dahulu'); return; }
      });

      document.getElementById('editForm').addEventListener('submit', function(e) {
        const nm = (document.getElementById('editName').value || '').trim();
        const tl = (document.getElementById('editTele').value || '').trim();
        const wa = (document.getElementById('editWa').value || '').trim();
        if (!nm || !tl || !wa) { e.preventDefault(); alert('Nama, Telegram, dan WhatsApp wajib diisi'); return; }
      });
    });
  </script>
</body>
</html>
