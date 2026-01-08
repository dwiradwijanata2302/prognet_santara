<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'region_id',
        'content',
        'image',
        'user_id',
        'views_count',
        'likes_count',
        'comments_count',
    ];

    protected $casts = [
        'views_count' => 'integer',
        'likes_count' => 'integer',
        'comments_count' => 'integer',
    ];

    // Auto generate slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($story) {
            if (empty($story->slug)) {
                $story->slug = Str::slug($story->title);
            }
        });

        static::updating(function ($story) {
            if ($story->isDirty('title')) {
                $story->slug = Str::slug($story->title);
            }
        });
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // Scopes dengan search logging
    public function scopeSearch($query, $search, $logSearch = true)
    {
        $results = $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhereHas('region', function($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
        });

        // Log pencarian jika enabled
        if ($logSearch && !empty($search)) {
            $resultsCount = $results->count();
            SearchLog::logSearch($search, $resultsCount, auth()->id());
        }

        return $results;
    }

    public function scopeByRegion($query, $region, $logSearch = false)
    {
        $results = $query->whereHas('region', function($q) use ($region) {
            $q->where('name', 'like', "%{$region}%");
        });

        // Optional: log region filter
        if ($logSearch && !empty($region)) {
            $resultsCount = $results->count();
            SearchLog::logSearch("region:{$region}", $resultsCount, auth()->id());
        }

        return $results;
    }

    // Helper methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-story.jpg');
    }

    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 200);
    }
}