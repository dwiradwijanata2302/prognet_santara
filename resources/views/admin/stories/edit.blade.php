@extends('layouts.admin')

@section('title', 'Edit Cerita')
@section('page-title', 'Edit Cerita')

@section('content')
<div class="form-container">
    <div class="card" style="padding: 2rem;">
        <form action="{{ route('admin.stories.update', $story) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label form-label-required">Judul Cerita</label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title', $story->title) }}" 
                    class="form-input"
                    required
                >
                @error('title')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label form-label-required">Region</label>
                <select name="region_id" class="form-select" required>
                    <option value="">-- Pilih Region --</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id', $story->region_id) == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
                @error('region_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Gambar/Thumbnail</label>
                @if($story->image)
                    <div class="image-preview">
                        <img src="{{ asset('storage/' . $story->image) }}" alt="Current Image">
                        <p class="form-hint">Gambar saat ini</p>
                    </div>
                @endif
                <input 
                    type="file" 
                    name="image" 
                    accept="image/*"
                    class="form-input"
                >
                <p class="form-hint">Kosongkan jika tidak ingin mengubah gambar</p>
                @error('image')
                    <p style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label form-label-required">Konten Cerita</label>
                <textarea 
                    name="content" 
                    rows="12" 
                    class="form-textarea"
                    required
                >{{ old('content', $story->content) }}</textarea>
                @error('content')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.stories.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">💾 Update Cerita</button>
            </div>
        </form>
    </div>
</div>
@endsection
