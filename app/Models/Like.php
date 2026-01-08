<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'story_id',
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

        static::created(function ($like) {
            $like->story->increment('likes_count');
        });

        static::deleted(function ($like) {
            $like->story->decrement('likes_count');
        });
    }
}