<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'story_id',
        'comment',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    // Event untuk update counter
    protected static function boot()
    {
        parent::boot();

        static::created(function ($comment) {
            $comment->story->increment('comments_count');
        });

        static::deleted(function ($comment) {
            $comment->story->decrement('comments_count');
        });
    }
}