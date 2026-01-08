@extends('layouts.admin')

@section('title', 'Tambah Cerita Baru')
@section('page-title', 'Tambah Cerita Baru')

@section('content')
<div class="form-container">
    <div class="tambah-cerita-simple">
        <form action="{{ route('admin.stories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label form-label-required">Judul Cerita</label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title') }}" 
                    class="form-input"
                    placeholder="Masukkan judul cerita..."
                    required
                >
                @error('title')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label form-label-required">Region</label>
                <select name="region_id" class="form-select" required>
                    <option value="">Pilih Region</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
                @error('region_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    <img src="{{ asset('images/basil--image-outline.svg') }}" alt="Gambar" width="20" height="20" style="vertical-align:middle; margin-right:6px;"/>
                    Gambar/Thumbnail
                </label>
                <input 
                    type="file" 
                    name="image" 
                    accept="image/*"
                    class="form-input"
                >
                <p class="form-hint">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                @error('image')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label form-label-required">Konten Cerita</label>
                <textarea 
                    name="content" 
                    rows="12" 
                    class="form-textarea"
                    placeholder="Tulis cerita Anda di sini..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary"> Simpan Cerita</button>
                <a href="{{ route('admin.stories.index') }}" class="btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
