<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\SearchLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        // Statistics
        $stats = [
            'total_stories' => Story::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_comments' => Comment::count(),
            'total_likes' => Like::count(),
            'total_views' => Story::sum('views_count'),
        ];

        // Recent stories
        $recentStories = Story::with('user')->latest()->limit(5)->get();

        // Recent comments
        $recentComments = Comment::with(['user', 'story'])
            ->latest()
            ->limit(5)
            ->get();

        // Popular stories
        $popularStories = Story::orderByDesc('views_count')->limit(5)->get();

        // Search analytics
        $searchStats = SearchLog::getSearchStats(30);
        $trendingSearches = SearchLog::getTrendingSearches(10);

        return view('admin.dashboard', compact(
            'stats',
            'recentStories',
            'recentComments',
            'popularStories',
            'searchStats',
            'trendingSearches'
        ));
    }
}