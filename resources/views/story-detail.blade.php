@extends('layouts.app')

@section('title', $story->title . ' - Santara')

@section('content')
<!-- Story Content -->
<div class="container">
    <div class="story-title-section">
        <h1 class="story-title">{{ $story->title }}</h1>
    </div>
    
    @if($story->image)
        <img src="{{ $story->image_url }}" alt="{{ $story->title }}" class="story-image">
    @endif

    <div class="story-content">
        {!! nl2br(e($story->content)) !!}
    </div>

    <!-- Interaction Section -->
    <div class="interaction-section">
        <h3 style="margin-bottom: 1rem;">Bagaimana menurut Anda?</h3>
        
        @auth
            <button 
                class="like-button {{ $hasLiked ? 'liked' : '' }}" 
                data-url="{{ route('story.like', $story) }}"
            >
                <span class="like-icon">
                    @if($hasLiked)
                        <img src="{{ asset('images/basil--heart-solid.svg') }}" alt="Like" width="22" height="22"/>
                    @else
                        <img src="{{ asset('images/basil--heart-outline.svg') }}" alt="Belum Like" width="22" height="22"/>
                    @endif
                </span>
                <span class="like-count">{{ $story->likes_count }}</span>
                <span>{{ $hasLiked ? 'Disukai' : 'Sukai' }}</span>
            </button>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary">
                🤍 Login untuk menyukai cerita ini
            </a>
        @endauth
    </div>

    <!-- Comments Section -->
    <div class="comments-section">
        <h3 style="margin-bottom: 1.5rem;">
              <img src="{{ asset('images/basil--comment-minus-solid.svg') }}" alt="Komentar" width="22" height="22" style="vertical-align:middle; margin-right:6px;"/>
            Komentar ({{ $story->comments_count }})
        </h3>

        @auth
            <!-- Comment Form -->
            <form action="{{ route('comment.store', $story) }}" method="POST" class="comment-form">
                @csrf
                <textarea 
                    name="comment" 
                    placeholder="Tulis komentar Anda..." 
                    required
                >{{ old('comment') }}</textarea>
                
                @error('comment')
                    <div class="form-error">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn btn-primary" style="margin-top: 1rem; display:flex; align-items:center; gap:6px;">
                    <img src="{{ asset('images/basil--send-solid.svg') }}" alt="Kirim" width="18" height="18"/>
                    Kirim Komentar
                </button>
            </form>
        @else
            <div class="alert alert-info">
                <a href="{{ route('login') }}" style="color: #1e40af; font-weight: 600;">Login</a> untuk berkomentar
            </div>
        @endauth

        <!-- Comments List -->
        @if($story->comments->count() > 0)
            @foreach($story->comments as $comment)
                <div class="comment-item">
                    <div class="comment-author">
                        👤 {{ $comment->user->name }}
                    </div>
                    <div class="comment-text">
                        {{ $comment->comment }}
                    </div>
                    <div class="comment-date">
                        {{ $comment->created_at->diffForHumans() }}
                    </div>

                    @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->user()->isAdmin()))
                        <form action="{{ route('comment.destroy', $comment) }}" method="POST" style="margin-top: 0.5rem;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 0.3rem 0.8rem; font-size: 0.9rem;" onclick="return confirm('Hapus komentar ini?')">
                                🗑️ Hapus
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        @else
            <p style="text-align: center; color: #999; padding: 2rem;">
                Belum ada komentar. Jadilah yang pertama!
            </p>
        @endif
    </div>

    <!-- Story Info -->
    <div class="story-info-section">
        <div class="story-meta-detail">
            <span>📍 {{ $story->region->name ?? 'Tidak ada region' }}</span>
            <span>👤 Oleh: <strong>{{ $story->user->name }}</strong></span>
            <span>📅 {{ $story->created_at->format('d M Y') }}</span>
            <span>👁️ {{ number_format($story->views_count) }} views</span>
        </div>
    </div>

    <!-- Related Stories -->
    @if($relatedStories->count() > 0)
        <div style="margin-top: 3rem;">
            <h3 style="margin-bottom: 1.5rem;">📚 Cerita Terkait dari {{ $story->region->name ?? 'daerah ini' }}</h3>
            
            <div class="stories-grid" style="grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));">
                @foreach($relatedStories as $related)
                    <div class="card">
                        @if($related->image)
                            <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="card-image">
                        @else
                            <div class="card-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem;">
                                
                            </div>
                        @endif
                        
                        <div class="card-content">
                            <h4 class="card-title" style="font-size: 1.1rem;">{{ $related->title }}</h4>
                            <p class="card-excerpt" style="font-size: 0.9rem;">{{ Str::limit($related->excerpt, 80) }}</p>
                            
                            <a href="{{ route('story.show', $related->slug) }}" class="card-link">
                                Baca →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection