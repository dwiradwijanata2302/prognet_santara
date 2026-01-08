<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LikeController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Toggle like
    public function toggle(Story $story)
    {
        $user = auth()->user();

        // Check if already liked
        $like = Like::where('user_id', $user->id)
            ->where('story_id', $story->id)
            ->first();

        if ($like) {
            // Unlike
            $like->delete();
            $message = 'Like dibatalkan';
            $liked = false;
        } else {
            // Like
            Like::create([
                'user_id' => $user->id,
                'story_id' => $story->id,
            ]);
            $message = 'Cerita disukai';
            $liked = true;
        }

        // Return JSON for AJAX request
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'liked' => $liked,
                'likes_count' => $story->fresh()->likes_count,
            ]);
        }

        return back()->with('success', $message);
    }
}