<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Sistem Manajemen</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* RESET + VARIABLES */
:root {
    --primary: #4361ee;
    --primary-dark: #3a56d4;
    --primary-light: #edf2ff;
    --success: #10b981;
    --success-dark: #0da271;
    --warning: #f59e0b;
    --warning-dark: #e68f0a;
    --danger: #ef4444;
    --danger-dark: #dc2626;
    --info: #3b82f6;
    --purple: #8b5cf6;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    --card-radius: 16px;
    --shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    --shadow-hover: 0 8px 30px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #f3f6fb 0%, #f8fafc 100%);
    color: var(--gray-800);
    line-height: 1.6;
    min-height: 100vh;
    overflow-x: hidden;
}

.dashboard-container {
    max-width: 1440px;
    margin: 0 auto;
    padding: 24px;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* HEADER */
.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    flex-wrap: wrap;
    gap: 20px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--gray-200);
}

.logo-section {
    display: flex;
    align-items: center;
    gap: 16px;
}

.logo-box {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--info) 100%);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.logo-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
}

.header-title h1 {
    font-size: 28px;
    font-weight: 700;
    background: linear-gradient(135deg, var(--gray-900) 0%, var(--gray-700) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    margin-bottom: 4px;
}

.header-title p {
    margin: 0;
    color: var(--gray-600);
    font-size: 15px;
    font-weight: 400;
}

.last-updated {
    padding: 14px 22px;
    background: white;
    border-radius: 12px;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 500;
    color: var(--gray-700);
    border: 1px solid var(--gray-200);
    transition: var(--transition);
}

.last-updated:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-1px);
}

.last-updated i {
    color: var(--primary);
    font-size: 18px;
}

/* STAT CARDS */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    box-shadow: var(--shadow);
    border-radius: var(--card-radius);
    padding: 26px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-left: 6px solid var(--primary);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), transparent);
    opacity: 0;
    transition: var(--transition);
}

.stat-card:hover {
    box-shadow: var(--shadow-hover);
    transform: translateY(-4px);
}

.stat-card:hover::before {
    opacity: 1;
}

.stat-card:nth-child(1) { border-left-color: var(--primary); }
.stat-card:nth-child(2) { border-left-color: var(--success); }
.stat-card:nth-child(3) { border-left-color: var(--warning); }
.stat-card:nth-child(4) { border-left-color: var(--danger); }
.stat-card:nth-child(5) { border-left-color: var(--info); }
.stat-card:nth-child(6) { border-left-color: var(--purple); }

.stat-content {
    flex: 1;
}

.stat-title {
    font-size: 15px;
    color: var(--gray-600);
    margin-bottom: 8px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 8px;
}

.stat-title i {
    font-size: 14px;
}

.stat-value {
    font-size: 36px;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 4px;
    line-height: 1.2;
}

.stat-subtitle {
    font-size: 13px;
    color: var(--gray-500);
    font-weight: 400;
}

.stat-icon {
    font-size: 32px;
    color: var(--primary);
    opacity: 0.9;
    margin-left: 16px;
}

.stat-card:nth-child(2) .stat-icon { color: var(--success); }
.stat-card:nth-child(3) .stat-icon { color: var(--warning); }
.stat-card:nth-child(4) .stat-icon { color: var(--danger); }
.stat-card:nth-child(5) .stat-icon { color: var(--info); }
.stat-card:nth-child(6) .stat-icon { color: var(--purple); }

/* CHART BOX */
.chart-section {
    background: white;
    padding: 30px;
    border-radius: var(--card-radius);
    box-shadow: var(--shadow);
    margin-bottom: 32px;
    border: 1px solid var(--gray-200);
    transition: var(--transition);
}

.chart-section:hover {
    box-shadow: var(--shadow-hover);
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 20px;
}

.chart-header h2 {
    font-size: 22px;
    font-weight: 600;
    color: var(--gray-900);
    display: flex;
    align-items: center;
    gap: 12px;
}

.chart-header h2 i {
    color: var(--primary);
    background: var(--primary-light);
    padding: 10px;
    border-radius: 10px;
    font-size: 18px;
}

.filter-tabs {
    display: flex;
    gap: 8px;
    background: var(--gray-100);
    padding: 6px;
    border-radius: 12px;
}

.filter-tab {
    padding: 10px 24px;
    border-radius: 10px;
    cursor: pointer;
    border: none;
    background: transparent;
    font-weight: 500;
    color: var(--gray-600);
    font-size: 14px;
    transition: var(--transition);
    font-family: 'Inter', sans-serif;
}

.filter-tab:hover {
    background: white;
    color: var(--primary);
}

.filter-tab.active {
    background: white;
    box-shadow: var(--shadow);
    color: var(--primary);
    font-weight: 600;
}

.chart-container {
    height: 350px;
    position: relative;
}

/* ACTIVITY SECTION */
.activity-section {
    background: white;
    padding: 30px;
    border-radius: var(--card-radius);
    box-shadow: var(--shadow);
    border: 1px solid var(--gray-200);
}

.activity-section h2 {
    font-size: 22px;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.activity-section h2 i {
    color: var(--primary);
    background: var(--primary-light);
    padding: 10px;
    border-radius: 10px;
    font-size: 18px;
}

.activity-list {
    max-height: 500px;
    overflow-y: auto;
    padding-right: 8px;
}

.activity-list::-webkit-scrollbar {
    width: 6px;
}

.activity-list::-webkit-scrollbar-track {
    background: var(--gray-100);
    border-radius: 10px;
}

.activity-list::-webkit-scrollbar-thumb {
    background: var(--gray-300);
    border-radius: 10px;
}

.activity-list::-webkit-scrollbar-thumb:hover {
    background: var(--gray-400);
}

.activity-item {
    display: flex;
    gap: 16px;
    padding: 20px;
    border-radius: 12px;
    transition: var(--transition);
    margin-bottom: 12px;
    border: 1px solid transparent;
}

.activity-item:hover {
    background: var(--gray-50);
    border-color: var(--gray-200);
    transform: translateX(4px);
}

.activity-icon {
    background: linear-gradient(135deg, var(--primary-light), #e0e7ff);
    color: var(--primary);
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    font-size: 20px;
    flex-shrink: 0;
}

.activity-content {
    flex: 1;
}

.activity-user {
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: 6px;
}

.activity-desc {
    color: var(--gray-700);
    margin-bottom: 10px;
    line-height: 1.5;
}

.activity-time {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--gray-500);
    font-size: 13px;
    font-weight: 400;
}

.activity-time i {
    font-size: 12px;
}

.no-activity {
    text-align: center;
    padding: 60px 20px;
    color: var(--gray-500);
}

.no-activity i {
    font-size: 48px;
    margin-bottom: 16px;
    opacity: 0.5;
}

.no-activity p {
    font-size: 16px;
    font-weight: 500;
}

/* RESPONSIVE DESIGN */
@media (max-width: 1200px) {
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 16px;
    }
    
    .dashboard-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .last-updated {
        width: 100%;
        justify-content: center;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .chart-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .filter-tabs {
        width: 100%;
        justify-content: center;
    }
    
    .chart-container {
        height: 300px;
    }
}

@media (max-width: 480px) {
    .stat-value {
        font-size: 32px;
    }
    
    .stat-icon {
        font-size: 28px;
    }
    
    .filter-tab {
        padding: 8px 16px;
        font-size: 13px;
    }
    
    .chart-section,
    .activity-section {
        padding: 20px;
    }
}

/* LOADING STATES */
.loading {
    position: relative;
    overflow: hidden;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.6), transparent);
    animation: loading 1.5s infinite;
}

@keyframes loading {
    100% { left: 100%; }
}

/* TOOLTIP */
[data-tooltip] {
    position: relative;
}

[data-tooltip]:hover::before {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: var(--gray-900);
    color: white;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 12px;
    white-space: nowrap;
    z-index: 1000;
    margin-bottom: 8px;
    font-weight: 400;
}

[data-tooltip]:hover::after {
    content: '';
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 6px solid transparent;
    border-top-color: var(--gray-900);
    margin-bottom: -4px;
}
</style>


</head>

<body>
<x-sidebar />

<div class="dashboard-container">

<!-- HEADER -->
<header class="dashboard-header">
    <div class="logo-section">
        <div class="logo-box" data-tooltip="Dashboard Analytics">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="header-title">
            <h1>Dashboard Admin</h1>
            <p>Sistem Monitoring Penjualan & Transaksi</p>
        </div>
    </div>

    <div class="last-updated">
        <i class="far fa-clock"></i>
        <span>Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}</span>
    </div>
</header>

<!-- STAT CARDS -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-title">
                <i class="fas fa-users"></i>
                Total Reseller
            </div>
            <div class="stat-value">{{ $totalReseller }}</div>
            <div class="stat-subtitle">Aktif bulan ini</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-title">
                <i class="fas fa-user-friends"></i>
                Total Guest
            </div>
            <div class="stat-value">{{ $totalGuest }}</div>
            <div class="stat-subtitle">Pelanggan non-reseller</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-user"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-title">
                <i class="fas fa-shopping-cart"></i>
                Total Transaksi
            </div>
            <div class="stat-value">{{ $totalTransaksi }}</div>
            <div class="stat-subtitle">Semua jenis transaksi</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-title">
                <i class="fas fa-money-bill-wave"></i>
                Total Pemasukan
            </div>
            <div class="stat-value">Rp {{ number_format($totalPemasukanTrx,0,",",".") }}</div>
            <div class="stat-subtitle">Dari semua transaksi</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-money-bill"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-title">
                <i class="fas fa-wallet"></i>
                Topup Berhasil
            </div>
            <div class="stat-value">{{ $totalTopupCount }}</div>
            <div class="stat-subtitle">Transaksi topup sukses</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-wallet"></i>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-content">
            <div class="stat-title">
                <i class="fas fa-coins"></i>
                Nominal Topup
            </div>
            <div class="stat-value">Rp {{ number_format($totalTopupNominal,0,",",".") }}</div>
            <div class="stat-subtitle">Total saldo ditopup</div>
        </div>
        <div class="stat-icon">
            <i class="fas fa-coins"></i>
        </div>
    </div>
</div>

<!-- CHART -->
<div class="chart-section">
    <div class="chart-header">
        <h2><i class="fas fa-chart-area"></i> Statistik Pembelian</h2>
        <div class="filter-tabs">
            <button class="filter-tab active" data-type="7">7 Hari Terakhir</button>
            <button class="filter-tab" data-type="30">30 Hari Terakhir</button>
        </div>
    </div>
    <div class="chart-container">
        <canvas id="salesChart"></canvas>
    </div>
</div>

<!-- ACTIVITY -->
<div class="activity-section">
    <h2><i class="fas fa-history"></i> Aktivitas Terbaru</h2>
    
    <div class="activity-list">
        @forelse ($logs as $log)
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="activity-content">
                <div class="activity-user">
                    {{ $log->user->name }}
                </div>
                <div class="activity-desc">
                    Melakukan pembelian:
                    @foreach ($log->items as $it)
                        <strong>{{ $it->item->name }}</strong> ({{ $it->quantity }}x)
                        @if(!$loop->last) • @endif
                    @endforeach
                </div>
                <div class="activity-time">
                    <i class="far fa-clock"></i>
                    {{ $log->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        @empty
        <div class="no-activity">
            <i class="far fa-clipboard"></i>
            <p>Belum ada aktivitas transaksi.</p>
        </div>
        @endforelse
    </div>
</div>

</div>

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
/* ==== DATA BACKEND ==== */
const data7 = {
    days: {!! json_encode($days7) !!},
    guest: {!! json_encode($guest7) !!},
    reseller: {!! json_encode($reseller7) !!}
};

const data30 = {
    days: {!! json_encode($days30) !!},
    guest: {!! json_encode($guest30) !!},
    reseller: {!! json_encode($reseller30) !!}
};

/* ==== CHART CONFIGURATION ==== */
function getNiceScale(maxVal) {
    let maxData = Math.max(maxVal, 0);
    let niceMax = Math.ceil(maxData / 5) * 5;
    if (niceMax < 50) niceMax = 50;
    return { max: niceMax, step: 5 };
}

function normalize(data){
    return {
        days: data.days,
        guest: data.guest.map(v => Math.round(v)),
        reseller: data.reseller.map(v => Math.round(v))
    };
}

let chartData = normalize(data7);
const ctx = document.getElementById('salesChart').getContext('2d');

// Create gradients
const gradientGuest = ctx.createLinearGradient(0, 0, 0, 400);
gradientGuest.addColorStop(0, 'rgba(123, 47, 247, 0.4)');
gradientGuest.addColorStop(1, 'rgba(123, 47, 247, 0.05)');

const gradientReseller = ctx.createLinearGradient(0, 0, 0, 400);
gradientReseller.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
gradientReseller.addColorStop(1, 'rgba(16, 185, 129, 0.05)');

/* ==== INITIALIZE CHART ==== */
const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.days,
        datasets: [
            {
                label: 'Guest',
                data: chartData.guest,
                borderColor: '#7b2ff7',
                backgroundColor: gradientGuest,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#7b2ff7',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            },
            {
                label: 'Reseller',
                data: chartData.reseller,
                borderColor: '#10b981',
                backgroundColor: gradientReseller,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#10b981',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            intersect: false,
            mode: 'index'
        },
        plugins: {
            tooltip: {
                backgroundColor: 'rgba(31, 41, 55, 0.95)',
                titleColor: '#fff',
                bodyColor: '#fff',
                borderColor: 'rgba(255, 255, 255, 0.1)',
                borderWidth: 1,
                padding: 12,
                cornerRadius: 8,
                displayColors: false,
                callbacks: {
                    label: function(context) {
                        return `${context.dataset.label}: ${context.parsed.y} transaksi`;
                    }
                }
            },
            legend: {
                display: true,
                position: 'top',
                align: 'end',
                labels: {
                    padding: 20,
                    usePointStyle: true,
                    pointStyle: 'circle',
                    font: {
                        size: 13
                    }
                }
            }
        },
        scales: {
            x: {
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                },
                ticks: {
                    font: {
                        size: 12
                    }
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                },
                ticks: {
                    font: {
                        size: 12
                    },
                    callback: function(value) {
                        return value;
                    }
                }
            }
        }
    }
});

/* ==== FILTER BUTTONS FUNCTIONALITY ==== */
document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Update active state
        document.querySelectorAll('.filter-tab').forEach(t => {
            t.classList.remove('active');
        });
        this.classList.add('active');
        
        // Add click animation
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
        
        // Update chart data
        const raw = this.dataset.type === '7' ? data7 : data30;
        chartData = normalize(raw);
        
        // Calculate scale
        const maxPossible = Math.max(
            Math.max(...chartData.guest),
            Math.max(...chartData.reseller)
        );
        const scale = getNiceScale(maxPossible);
        
        // Update chart
        salesChart.data.labels = chartData.days;
        salesChart.data.datasets[0].data = chartData.guest;
        salesChart.data.datasets[1].data = chartData.reseller;
        salesChart.options.scales.y.max = scale.max;
        salesChart.options.scales.y.ticks.stepSize = scale.step;
        
        salesChart.update();
    });
});

/* ==== SET INITIAL SCALE ==== */
const initialMax = Math.max(
    Math.max(...chartData.guest),
    Math.max(...chartData.reseller)
);
const initialScale = getNiceScale(initialMax);
salesChart.options.scales.y.max = initialScale.max;
salesChart.options.scales.y.ticks.stepSize = initialScale.step;
salesChart.update();

/* ==== ADD RESIZE LISTENER ==== */
window.addEventListener('resize', function() {
    salesChart.resize();
});

/* ==== ADD SMOOTH SCROLL FOR ACTIVITY LIST ==== */
const activityList = document.querySelector('.activity-list');
activityList.addEventListener('wheel', function(e) {
    if (e.deltaY > 0) {
        this.scrollTop += 50;
    } else {
        this.scrollTop -= 50;
    }
});
</script>

</body>
</html>