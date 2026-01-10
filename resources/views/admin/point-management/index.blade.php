<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Poin - Admin Panel</title>
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
            color: var(--primary-color);
        }

        .action-buttons {
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

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-success {
            background-color: var(--success-color);
            color: white;
        }

        .btn-info {
            background-color: var(--info-color);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-primary:hover { background-color: #3a56d4; }
        .btn-success:hover { background-color: #0da271; }
        .btn-info:hover { background-color: #2563eb; }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
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

        .stat-primary .stat-icon {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .stat-success .stat-icon {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }

        .stat-warning .stat-icon {
            background-color: rgba(245, 158, 11, 0.1);
            color: var(--warning-color);
        }

        .stat-info .stat-icon {
            background-color: rgba(59, 130, 246, 0.1);
            color: var(--info-color);
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

        .stat-content small {
            font-size: 12px;
            color: var(--gray-color);
        }

        /* Chart Container */
        .chart-container {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 25px;
            margin-bottom: 30px;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .chart-header h3 {
            font-size: 18px;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chart-header h3 i {
            color: var(--primary-color);
        }

        .chart-wrapper {
            height: 300px;
            position: relative;
        }

        /* Recent Activity */
        .activity-container {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 25px;
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .activity-header h3 {
            font-size: 18px;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .activity-header h3 i {
            color: var(--info-color);
        }

        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .activity-item {
            padding: 15px;
            border-radius: var(--radius);
            background-color: #f9fafb;
            border-left: 4px solid var(--info-color);
        }

        .activity-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .activity-user {
            font-weight: 600;
            color: var(--dark-color);
        }

        .activity-time {
            font-size: 12px;
            color: var(--gray-color);
        }

        .activity-note {
            color: var(--dark-color);
            font-size: 14px;
            margin-bottom: 5px;
        }

        .activity-meta {
            display: flex;
            gap: 15px;
            font-size: 12px;
            color: var(--gray-color);
        }

        .activity-points {
            color: var(--success-color);
            font-weight: 600;
        }

        .empty-activity {
            text-align: center;
            padding: 40px 20px;
            color: var(--gray-color);
        }

        .empty-activity i {
            font-size: 48px;
            margin-bottom: 15px;
        }

        /* Layout */
        .dashboard-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        @media (max-width: 1024px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .action-buttons {
                width: 100%;
                justify-content: flex-start;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .chart-header, .activity-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
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
                <h1><i class="fas fa-star"></i> Manajemen Poin Dashboard</h1>
                <div class="action-buttons">
                    <a href="{{ route('admin.point-management.leaderboard') }}" class="btn btn-primary">
                        <i class="fas fa-trophy"></i> Leaderboard
                    </a>
                    <a href="{{ route('admin.point-management.users') }}" class="btn btn-success">
                        <i class="fas fa-users"></i> Semua Pengguna
                    </a>
                    <a href="{{ route('admin.point-management.history') }}" class="btn btn-info">
                        <i class="fas fa-history"></i> Riwayat Penyesuaian
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card stat-primary">
                    <div class="stat-icon"><i class="fas fa-star"></i></div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['total_points_this_month']) }}</h3>
                        <p>Total Poin (Bulan Ini)</p>
                    </div>
                </div>

                <div class="stat-card stat-success">
                    <div class="stat-icon"><i class="fas fa-user-check"></i></div>
                    <div class="stat-content">
                        <h3>{{ $stats['total_users_with_points'] }}</h3>
                        <p>Pengguna dengan Poin</p>
                    </div>
                </div>

                <div class="stat-card stat-warning">
                    <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                    <div class="stat-content">
                        <h3>{{ number_format($stats['average_points'], 1) }}</h3>
                        <p>Rata-rata Poin</p>
                    </div>
                </div>

                <div class="stat-card stat-info">
                    <div class="stat-icon"><i class="fas fa-crown"></i></div>
                    <div class="stat-content">
                        @if($stats['top_user'])
                            <h3>{{ $stats['top_user']->user->name }}</h3>
                            <p>Top Pengguna</p>
                            <small>{{ number_format($stats['top_user']->points) }} poin</small>
                        @else
                            <h3>-</h3>
                            <p>Top Pengguna</p>
                            <small>Tidak ada data</small>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Charts and Recent Activity -->
            <div class="dashboard-layout">
                <!-- Chart Section -->
                <div class="chart-container">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-area"></i> Tren Poin (6 Bulan Terakhir)</h3>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="pointsChart"></canvas>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="activity-container">
                    <div class="activity-header">
                        <h3><i class="fas fa-history"></i> Penyesuaian Terbaru</h3>
                        <a href="{{ route('admin.point-management.history') }}" class="btn btn-primary btn-sm">
                            Lihat Semua
                        </a>
                    </div>
                    
                    <div class="activity-list">
                        @forelse($recentAdjustments as $adjustment)
                            <div class="activity-item">
                                <div class="activity-header-row">
                                    <div class="activity-user">{{ $adjustment->user->name }}</div>
                                    <div class="activity-time">{{ $adjustment->updated_at->diffForHumans() }}</div>
                                </div>
                                <div class="activity-note">{{ Str::limit($adjustment->adjustment_note, 50) }}</div>
                                <div class="activity-meta">
                                    <span>{{ $adjustment->month }}/{{ $adjustment->year }}</span>
                                    <span class="activity-points">{{ $adjustment->points }} poin</span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-activity">
                                <i class="fas fa-inbox"></i>
                                <p>Belum ada penyesuaian poin</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Points Chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('pointsChart').getContext('2d');
            const months = @json(array_column($months, 'name'));
            const points = @json(array_column($months, 'total_points'));
            
            const pointsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months.reverse(),
                    datasets: [{
                        label: 'Total Poin',
                        data: points.reverse(),
                        borderColor: 'rgb(67, 97, 238)',
                        backgroundColor: 'rgba(67, 97, 238, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: 'rgb(67, 97, 238)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y.toLocaleString() + ' poin';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }
                    }
                }
            });

            // Add hover effect to activity items
            const activityItems = document.querySelectorAll('.activity-item');
            activityItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                    this.style.transition = 'transform 0.3s ease';
                });
                
                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>