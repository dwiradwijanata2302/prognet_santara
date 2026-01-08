@extends('layouts.admin')

@section('title', 'Dashboard Admin - Santara')
@section('page-title', 'Dashboard')

@section('content')
<!-- Quick Actions -->
<div class="dashboard-actions">
    <a href="{{ route('admin.stories.create') }}" class="btn-primary">
        Tambah Cerita Baru
    </a>
    <a href="{{ route('admin.stories.index') }}" class="btn-secondary">
        Kelola Cerita
    </a>
</div>

<!-- Statistics Cards -->
<div class="stats-grid">
    <div class="stat-card stat-card-brown">
        <h3 class="stat-number">{{ $stats['total_stories'] }}</h3>
        <p class="stat-label">Total Cerita</p>
    </div>

    <div class="stat-card stat-card-saddle">
        <h3 class="stat-number">{{ $stats['total_users'] }}</h3>
        <p class="stat-label">Total User</p>
    </div>

    <div class="stat-card stat-card-maroon">
        <h3 class="stat-number">{{ number_format($stats['total_views']) }}</h3>
        <p class="stat-label">Total Views</p>
    </div>

    <div class="stat-card stat-card-rose">
        <h3 class="stat-number">{{ $stats['total_likes'] }}</h3>
        <p class="stat-label">Total Likes</p>
    </div>

    <div class="stat-card stat-card-tan">
        <h3 class="stat-number">{{ $stats['total_comments'] }}</h3>
        <p class="stat-label">Total Komentar</p>
    </div>
</div>

<div class="dashboard-grid">
    <!-- Recent Stories -->
    <div class="dashboard-card">
        <h3 class="card-title oval-bg">Cerita Terbaru</h3>
        <div class="card-scroll">
            @forelse($recentStories as $story)
                <div class="story-item">
                    <h4 class="story-title">{{ $story->title }}</h4>
                    <p class="story-meta">
                        <span>{{ $story->region->name ?? 'N/A' }}</span>
                        <span>•</span>
                        <span>{{ $story->created_at->diffForHumans() }}</span>
                    </p>
                </div>
            @empty
                <p class="empty-message">Belum ada cerita</p>
            @endforelse
        </div>
    </div>

    <!-- Popular Stories -->
    <div class="dashboard-card">
        <h3 class="card-title">Cerita Terpopuler</h3>
        <div class="card-scroll">
            @forelse($popularStories as $story)
                <div class="story-item">
                    <h4 class="story-title">{{ $story->title }}</h4>
                    <p class="story-meta">
                        {{ number_format($story->views_count) }} views
                    </p>
                </div>
            @empty
                <p class="empty-message">Belum ada data</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Search Analytics -->
<div class="dashboard-card" style="margin-bottom: 2rem;">
    <h3 class="card-title">Analytics Pencarian (30 Hari Terakhir)</h3>
    
    <div class="analytics-grid">
        <div class="analytics-item">
            <p class="analytics-label">Total Pencarian</p>
            <h4 class="analytics-value">{{ $searchStats['total_searches'] }}</h4>
        </div>
        <div class="analytics-item">
            <p class="analytics-label">Query Unik</p>
            <h4 class="analytics-value">{{ $searchStats['unique_queries'] }}</h4>
        </div>
        <div class="analytics-item">
            <p class="analytics-label">Pencarian Sukses</p>
            <h4 class="analytics-value analytics-success">{{ $searchStats['successful_searches'] }}</h4>
        </div>
        <div class="analytics-item">
            <p class="analytics-label">Pencarian Gagal</p>
            <h4 class="analytics-value analytics-error">{{ $searchStats['failed_searches'] }}</h4>
        </div>
    </div>

    <h4 class="trending-title">Trending Searches</h4>
    <div class="trending-tags">
        @forelse($trendingSearches as $search)
            <span class="trending-tag">
                {{ $search->query }} ({{ $search->search_count }})
            </span>
        @empty
            <p class="empty-message">Belum ada data pencarian</p>
        @endforelse
    </div>
</div>

<!-- Recent Comments -->
<div class="dashboard-card">
    <h3 class="card-title">Komentar Terbaru</h3>
    @forelse($recentComments as $comment)
        <div class="comment-item">
            <p class="comment-author">{{ $comment->user->name }}</p>
            <p class="comment-text">{{ Str::limit($comment->comment, 100) }}</p>
            <p class="comment-meta">
                di cerita "<a href="{{ route('story.show', $comment->story->slug) }}" class="comment-link">{{ $comment->story->title }}</a>" • 
                {{ $comment->created_at->diffForHumans() }}
            </p>
        </div>
    @empty
        <p class="empty-message">Belum ada komentar</p>
    @endforelse
</div>
@endsection