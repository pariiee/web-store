<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Point extends Model
{
    protected $fillable = [
        'user_id',
        'month',
        'year',
        'total_items',
        'points',
        'last_updated_by',
        'adjustment_note'
    ];

    protected $casts = [
        'month' => 'integer',
        'year' => 'integer',
        'total_items' => 'integer',
        'points' => 'integer',
        'last_updated_by' => 'integer'
    ];

    /**
     * Relationship dengan User pemilik point
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship dengan admin yang melakukan adjustment
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_updated_by');
    }

    /**
     * Scope untuk mendapatkan data berdasarkan periode
     */
    public function scopeForPeriod($query, $month, $year)
    {
        return $query->where('month', $month)->where('year', $year);
    }

    /**
     * Scope untuk mendapatkan data bulan ini
     */
    public function scopeCurrentMonth($query)
    {
        return $query->where('month', now()->month)->where('year', now()->year);
    }

    /**
     * Scope untuk mendapatkan data dengan adjustment
     */
    public function scopeWithAdjustments($query)
    {
        return $query->whereNotNull('adjustment_note');
    }

    /**
     * Accessor untuk nama bulan dalam bahasa Indonesia
     */
    public function getMonthNameAttribute(): string
    {
        $bulanIndonesia = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        return $bulanIndonesia[$this->month] ?? $this->month;
    }

    /**
     * Accessor untuk periode lengkap
     */
    public function getFullPeriodAttribute(): string
    {
        return "{$this->monthName} {$this->year}";
    }

    /**
     * Method untuk menghitung points berdasarkan jumlah items
     * Sistem sederhana: 1 item = 1 point
     * Atau bisa dikustom dengan formula tertentu
     */
    public static function calculatePoints(int $totalItems): int
    {
        // Sistem sederhana: 1 item = 1 point
        return $totalItems;
        
        // Atau jika ingin sistem yang lebih kompleks:
        // if ($totalItems >= 100) {
        //     return $totalItems * 2; // Bonus 2x untuk pembelian besar
        // } elseif ($totalItems >= 50) {
        //     return (int) ($totalItems * 1.5); // Bonus 1.5x
        // } else {
        //     return $totalItems;
        // }
    }

    /**
     * Method untuk mendapatkan ranking user dalam periode tertentu
     */
    public static function getUserRank($month, $year, $userId): ?int
    {
        $points = self::where('month', $month)
            ->where('year', $year)
            ->orderBy('points', 'desc')
            ->orderBy('total_items', 'desc')
            ->orderBy('updated_at', 'asc')
            ->get();

        $rank = 1;
        foreach ($points as $point) {
            if ($point->user_id == $userId) {
                return $rank;
            }
            $rank++;
        }
        
        return null; // User tidak ada di ranking bulan ini
    }

    /**
     * Method untuk mendapatkan current month point user
     */
    public static function getCurrentMonthPoint($userId): int
    {
        return self::where('user_id', $userId)
            ->currentMonth()
            ->value('points') ?? 0;
    }

    /**
     * Method untuk mendapatkan lifetime point user
     */
    public static function getLifetimePoint($userId): int
    {
        return self::where('user_id', $userId)->sum('points');
    }

    /**
     * Method untuk mendapatkan user point history
     */
    public static function getUserPointHistory($userId, $limit = 12)
    {
        return self::where('user_id', $userId)
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Method untuk update user point berdasarkan pembelian
     */
    public static function updateUserPoint($userId, $itemsBought, $adminId = null): Point
    {
        $point = self::firstOrCreate([
            'user_id' => $userId,
            'month' => now()->month,
            'year' => now()->year
        ], [
            'total_items' => 0,
            'points' => 0
        ]);

        $point->total_items += $itemsBought;
        $point->points = self::calculatePoints($point->total_items);
        
        if ($adminId) {
            $point->last_updated_by = $adminId;
            $point->adjustment_note = "Auto update from purchase: +{$itemsBought} items";
        }
        
        $point->save();

        return $point;
    }

    /**
     * Method untuk mendapatkan ranking bulan tertentu
     */
    public static function getRanking($month, $year, $limit = 100)
    {
        return self::with(['user' => function($query) {
            $query->select('id', 'name', 'email', 'profile_photo', 'whatsapp');
        }])
            ->where('month', $month)
            ->where('year', $year)
            ->orderBy('points', 'desc')
            ->orderBy('total_items', 'desc')
            ->orderBy('updated_at', 'asc')
            ->limit($limit)
            ->get();
    }

    /**
     * Method untuk adjust points secara manual
     */
    public static function adjustPoints($userId, $month, $year, $points, $items = null, $action = 'set', $adminId = null, $note = ''): Point
    {
        $point = self::firstOrNew([
            'user_id' => $userId,
            'month' => $month,
            'year' => $year
        ]);

        $originalPoints = $point->points ?? 0;
        $originalItems = $point->total_items ?? 0;

        switch ($action) {
            case 'add':
                $newPoints = ($point->points ?? 0) + $points;
                $newItems = ($point->total_items ?? 0) + ($items ?? $points);
                break;
                
            case 'subtract':
                $newPoints = max(0, ($point->points ?? 0) - $points);
                $newItems = max(0, ($point->total_items ?? 0) - ($items ?? $points));
                break;
                
            case 'set':
            default:
                $newPoints = $points;
                $newItems = $items ?? $points;
                break;
        }

        $point->total_items = $newItems;
        $point->points = $newPoints;
        
        if ($adminId) {
            $point->last_updated_by = $adminId;
            $point->adjustment_note = $note . " | Action: {$action}, From: {$originalPoints} points, {$originalItems} items";
        }

        $point->save();

        return $point;
    }

    /**
     * Method untuk mendapatkan statistik periode
     */
    public static function getPeriodStats($month, $year): array
    {
        $totalPoints = self::where('month', $month)
            ->where('year', $year)
            ->sum('points');
            
        $totalItems = self::where('month', $month)
            ->where('year', $year)
            ->sum('total_items');
            
        $totalUsers = self::where('month', $month)
            ->where('year', $year)
            ->distinct('user_id')
            ->count('user_id');
            
        $averagePoints = $totalUsers > 0 ? $totalPoints / $totalUsers : 0;

        return [
            'total_points' => $totalPoints,
            'total_items' => $totalItems,
            'total_users' => $totalUsers,
            'average_points' => round($averagePoints, 2),
        ];
    }

    /**
     * Method untuk mendapatkan top N users
     */
    public static function getTopUsers($month, $year, $limit = 10)
    {
        return self::with(['user' => function($query) {
            $query->select('id', 'name', 'profile_photo');
        }])
            ->where('month', $month)
            ->where('year', $year)
            ->orderBy('points', 'desc')
            ->orderBy('total_items', 'desc')
            ->limit($limit)
            ->get()
            ->map(function($point, $index) {
                $point->rank = $index + 1;
                return $point;
            });
    }

    /**
     * Method untuk export data ke format array
     */
    public function toExportArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'user_name' => $this->user->name ?? 'Unknown',
            'user_email' => $this->user->email ?? '',
            'month' => $this->month,
            'year' => $this->year,
            'period' => $this->full_period,
            'total_items' => $this->total_items,
            'points' => $this->points,
            'last_updated' => $this->updated_at->format('Y-m-d H:i:s'),
            'updated_by' => $this->updatedBy->name ?? 'System',
            'adjustment_note' => $this->adjustment_note ?? '',
        ];
    }

    /**
     * Method untuk mendapatkan data bulanan dalam format chart
     */
    public static function getMonthlyChartData($year, $userId = null)
    {
        $query = self::selectRaw('month, SUM(points) as total_points, SUM(total_items) as total_items')
            ->where('year', $year)
            ->groupBy('month')
            ->orderBy('month');
            
        if ($userId) {
            $query->where('user_id', $userId);
        }
        
        return $query->get()->map(function($item) {
            $bulanIndonesia = [
                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
                5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
                9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
            ];
            
            return [
                'month' => $bulanIndonesia[$item->month] ?? $item->month,
                'points' => $item->total_points,
                'items' => $item->total_items,
            ];
        });
    }

    /**
     * Method untuk reset points bulanan
     */
    public static function resetMonthlyPoints($month, $year, $adminId = null): int
    {
        $points = self::where('month', $month)->where('year', $year)->get();
        
        foreach ($points as $point) {
            $point->last_updated_by = $adminId;
            $point->adjustment_note = "Monthly reset for {$point->month}/{$point->year}";
            $point->save();
        }
        
        return self::where('month', $month)
            ->where('year', $year)
            ->delete();
    }

    /**
     * Method untuk mendapatkan users tanpa points di bulan tertentu
     */
    public static function getUsersWithoutPoints($month, $year)
    {
        $usersWithPoints = self::where('month', $month)
            ->where('year', $year)
            ->pluck('user_id');
            
        return User::whereNotIn('id', $usersWithPoints)
            ->whereNull('deleted_at')
            ->where('role', '!=', 'admin')
            ->get();
    }

    /**
     * Method untuk mendapatkan perbandingan ranking bulan ini vs bulan lalu
     */
    public static function getRankingComparison($userId)
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;
        
        $lastMonth = $currentMonth == 1 ? 12 : $currentMonth - 1;
        $lastMonthYear = $currentMonth == 1 ? $currentYear - 1 : $currentYear;
        
        $currentRank = self::getUserRank($currentMonth, $currentYear, $userId);
        $lastRank = self::getUserRank($lastMonth, $lastMonthYear, $userId);
        
        $currentPoints = self::getCurrentMonthPoint($userId);
        $lastPoints = self::where('user_id', $userId)
            ->where('month', $lastMonth)
            ->where('year', $lastMonthYear)
            ->value('points') ?? 0;
        
        return [
            'current' => [
                'rank' => $currentRank,
                'points' => $currentPoints,
                'month' => $currentMonth,
                'year' => $currentYear,
            ],
            'previous' => [
                'rank' => $lastRank,
                'points' => $lastPoints,
                'month' => $lastMonth,
                'year' => $lastMonthYear,
            ],
            'rank_change' => $lastRank ? $lastRank - $currentRank : null,
            'points_change' => $currentPoints - $lastPoints,
        ];
    }
}