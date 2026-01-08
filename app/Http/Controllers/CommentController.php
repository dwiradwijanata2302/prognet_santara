<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CommentController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Store comment
    public function store(Request $request, Story $story)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'story_id' => $story->id,
            'comment' => $validated['comment'],
        ]);

        // Return JSON for AJAX
        if ($request->wantsJson()) {
            $comment->load('user');
            return response()->json([
                'success' => true,
                'comment' => $comment,
            ]);
        }

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    // Delete comment
    public function destroy(Comment $comment)
    {
        // Check authorization
        if ($comment->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }
}