<?php

namespace App\Http\Controllers;

use App\Models\SearchLog;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // Get search suggestions (AJAX)
    public function suggestions(Request $request)
    {
        $query = $request->input('q');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = SearchLog::getSuggestions($query, 5);

        return response()->json($suggestions);
    }

    // Get popular searches (AJAX)
    public function popular()
    {
        $popular = SearchLog::getPopularSearches(10);

        return response()->json($popular);
    }
}