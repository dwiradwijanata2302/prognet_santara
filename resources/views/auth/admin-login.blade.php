@extends('layouts.app')

@section('title', 'Admin Login - Santara')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <span class="icon">👨‍💼</span>
            <span class="admin-badge">Administrator Access</span>
            <h2>Admin Login</h2>
        </div>

        <div class="alert alert-info" style="margin-bottom: 1.5rem;">
            <strong>⚠️ Khusus Administrator</strong><br>
            Halaman ini hanya untuk admin. Jika Anda user biasa, silakan 
            <a href="{{ route('login') }}" style="color: #1e40af; font-weight: 600;">login di sini</a>.
        </div>

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label form-label-required">Email Admin</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input"
                    value="{{ old('email') }}" 
                    placeholder="admin@santara.com"
                    required 
                    autofocus
                >
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label form-label-required">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input"
                    placeholder="••••••••"
                    required
                >
                @error('password')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya selama 30 hari</span>
                </label>
            </div>

            <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                 Login sebagai Admin
            </button>
        </form>

        <div class="auth-link">
            <a href="{{ route('home') }}">← Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection