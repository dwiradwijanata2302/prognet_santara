<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\SearchLog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Halaman Home - List semua cerita
    public function index(Request $request)
    {
        $query = Story::with('user')->latest();

        // Jika ada pencarian
        if ($request->has('q') && !empty($request->q)) {
            $searchTerm = $request->q;
            $query->search($searchTerm, true); // true = enable logging
        }

        // Jika ada filter region
        if ($request->has('region') && !empty($request->region)) {
            $query->byRegion($request->region);
        }

        $stories = $query->paginate(12);
        
        // Get popular searches untuk suggestion
        $popularSearches = SearchLog::getPopularSearches(5);

        return view('home', compact('stories', 'popularSearches'));
    }

    // Detail cerita
    public function show($slug)
    {
        $story = Story::where('slug', $slug)
            ->with(['user', 'comments.user'])
            ->firstOrFail();

        // Increment views
        $story->incrementViews();

        // Check if user already liked
        $hasLiked = auth()->check() ? auth()->user()->hasLikedStory($story->id) : false;

        // Related stories (same region)
        $relatedStories = Story::where('region_id', $story->region_id)
            ->where('id', '!=', $story->id)
            ->limit(3)
            ->get();

        return view('story-detail', compact('story', 'hasLiked', 'relatedStories'));
    }
}