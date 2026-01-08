<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SearchLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'query',
        'user_id',
        'results_count',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'results_count' => 'integer',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Static method untuk log pencarian
    public static function logSearch($query, $resultsCount, $userId = null)
    {
        return self::create([
            'query' => $query,
            'user_id' => $userId,
            'results_count' => $resultsCount,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    // Get popular searches (untuk autocomplete/suggestion)
    public static function getPopularSearches($limit = 10, $days = 30)
    {
        return self::select('query', DB::raw('COUNT(*) as search_count'))
            ->where('created_at', '>=', now()->subDays($days))
            ->where('results_count', '>', 0) // hanya yang ada hasilnya
            ->groupBy('query')
            ->orderByDesc('search_count')
            ->limit($limit)
            ->get();
    }

    // Get trending searches (pencarian yang meningkat)
    public static function getTrendingSearches($limit = 10, $days = 7)
    {
        return self::select('query', DB::raw('COUNT(*) as search_count'))
            ->where('created_at', '>=', now()->subDays($days))
            ->where('results_count', '>', 0)
            ->groupBy('query')
            ->orderByDesc('search_count')
            ->limit($limit)
            ->get();
    }

    // Get search suggestions based on query
    public static function getSuggestions($query, $limit = 5)
    {
        return self::select('query', DB::raw('COUNT(*) as search_count'))
            ->where('query', 'like', "{$query}%")
            ->where('results_count', '>', 0)
            ->groupBy('query')
            ->orderByDesc('search_count')
            ->limit($limit)
            ->pluck('query');
    }

    // Analytics: Get search statistics
    public static function getSearchStats($days = 30)
    {
        $startDate = now()->subDays($days);

        return [
            'total_searches' => self::where('created_at', '>=', $startDate)->count(),
            'unique_queries' => self::where('created_at', '>=', $startDate)
                ->distinct('query')
                ->count('query'),
            'successful_searches' => self::where('created_at', '>=', $startDate)
                ->where('results_count', '>', 0)
                ->count(),
            'failed_searches' => self::where('created_at', '>=', $startDate)
                ->where('results_count', '=', 0)
                ->count(),
            'avg_results' => self::where('created_at', '>=', $startDate)
                ->avg('results_count'),
        ];
    }

    // Get searches by region
    public static function getSearchesByRegion($days = 30)
    {
        return self::select('query', DB::raw('COUNT(*) as search_count'))
            ->where('created_at', '>=', now()->subDays($days))
            ->where('query', 'like', '%jawa%')
            ->orWhere('query', 'like', '%sumatra%')
            ->orWhere('query', 'like', '%kalimantan%')
            ->orWhere('query', 'like', '%sulawesi%')
            ->orWhere('query', 'like', '%bali%')
            ->orWhere('query', 'like', '%papua%')
            ->groupBy('query')
            ->orderByDesc('search_count')
            ->get();
    }
}