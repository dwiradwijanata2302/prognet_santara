@extends('layouts.app')

@section('title', 'Login - Santara')

@section('content')
<div class="login-user">
    <h2 style="text-align: center; margin-bottom: 2rem; color: #333;">Login</h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus
                class="form-input"
            >
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                required
                class="form-input"
            >
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label style="display: flex; align-items: center; gap: 8px; font-weight: normal;">
                <input type="checkbox" name="remember">
                <span>Ingat saya</span>
            </label>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">
            Login
        </button>
    </form>

    <p style="text-align: center; margin-top: 1.5rem; color: #666;">
        Belum punya akun? 
        <a href="{{ route('register') }}" style="color: rgba(110, 65, 48, 0.85); font-weight: 600;">Daftar di sini</a>
    </p>
</div>
@endsection