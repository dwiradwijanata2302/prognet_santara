@extends('layouts.app')

@section('title', 'Santara - Cerita Rakyat Nusantara')

@section('content')
<!-- Hero Section with Search -->
<section class="search-container search-background search-hero">
    <div class="container">
        <h1> SANTARA </h1>
        <p>Jelajahi kekayaan budaya Indonesia melalui legenda dan cerita rakyat dari berbagai daerah</p>
        
        <form action="{{ route('home') }}" method="GET">
            <div class="search-box">
                <input 
                    type="text" 
                    name="q" 
                    id="searchInput"
                    placeholder="Cari berdasarkan judul atau daerah asal..." 
                    value="{{ request('q') }}"
                    autocomplete="off"
                >
                <button type="submit">Cari</button>
                
                <!-- Suggestions Box -->
                <div id="suggestionsBox" class="suggestions-box hidden"></div>
            </div>
        </form>
    </div>
</section>

<!-- Stories Grid -->
<section class="stories-section">
    <div class="container">
        @if(request('q'))
            <div style="padding-bottom: 2rem;">
                <h2 style="font-size: 2rem; font-weight: 600; color: #6e4130; text-align: center;">
                    Hasil pencarian: <strong>"{{ request('q') }}"</strong> 
                    ({{ $stories->total() }} cerita ditemukan)
                </h2>
            </div>
        @else
            <div style="padding-bottom: 2rem;">
                <h2 class="oval-bg" style="font-size: 2rem; font-weight: 600; color: #6e4130; text-align: center;">Cerita Terbaru</h2>
            </div>
        @endif

        @if($stories->count() > 0)
            <div class="stories-grid" style="margin-top: 3rem;">
                @foreach($stories as $story)
                    <div class="card">
                        @if($story->image)
                            <img src="{{ $story->image_url }}" alt="{{ $story->title }}" class="card-image">
                        @else
                            <div class="card-image" style="background: url('/images/bg_santara.png') center/cover; display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; position: relative;">
                                <div style="position: absolute; inset: 0; background: rgba(0, 0, 0, 0.3);"></div>
                                <span style="position: relative; z-index: 1;">📖</span>
                            </div>
                        @endif
                        
                        <div class="card-content">
                            <div class="card-region">📍 {{ $story->region->name ?? 'Tidak ada region' }}</div>
                            <h3 class="card-title" data-url="{{ route('story.show', $story->slug) }}">{{ $story->title }}</h3>
                            <p class="card-excerpt">{{ $story->excerpt }}</p>
                            
                            <div class="card-meta">
                                <span>👁️ {{ number_format($story->views_count) }}</span>
                                <span>❤️ {{ number_format($story->likes_count) }}</span>
                                <span>💬 {{ number_format($story->comments_count) }}</span>
                            </div>
                            
                            <a href="{{ route('story.show', $story->slug) }}" class="card-link">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{ $stories->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 3rem; background: white; border-radius: 12px;">
                <p style="font-size: 3rem; margin-bottom: 1rem;">🔍</p>
                <h3 style="margin-bottom: 0.5rem;">Tidak Ada Cerita Ditemukan</h3>
                <p style="color: #666;">Coba kata kunci lain atau <a href="{{ route('home') }}" style="color: rgba(110, 65, 48, 0.85);">lihat semua cerita</a></p>
            </div>
        @endif
    </div>
</section>
@endsection