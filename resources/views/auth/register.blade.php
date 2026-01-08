@extends('layouts.app')

@section('title', 'Daftar - Santara')

@section('content')
<div class="login-user">
    <h2 style="text-align: center; margin-bottom: 2rem; color: #333;"> Register</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Username</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name') }}" 
                required 
                autofocus
                class="form-input"
            >
            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="{{ old('email') }}" 
                required
                class="form-input"
            >
            @error('email')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="password">Password</label>
            <div style="position: relative;">
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required
                    class="form-input"
                    autocomplete="new-password"
                >
                <button type="button" onclick="togglePassword('password', this)" tabindex="-1" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #6e4130; font-size: 1.1rem;">
                    <span id="icon-password">
                        <!-- Mata polos SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"><path stroke="#6e4130" stroke-width="2" d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"/><circle cx="12" cy="12" r="3" stroke="#6e4130" stroke-width="2"/></svg>
                    </span>
                </button>
            </div>
            @error('password')
                <div class="form-error">{{ $message }}</div>
            @enderror
            <small style="color: #666; font-size: 0.9rem;">Minimal 8 karakter</small>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                required
                class="form-input"
                autocomplete="new-password"
            >
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">
            Daftar
        </button>
    </form>

    <p style="text-align: center; margin-top: 1.5rem; color: #666;">
        Sudah punya akun? 
        <a href="{{ route('login') }}" style="color: rgba(110, 65, 48, 0.85); font-weight: 600;">Login di sini</a>
    </p>
</div>
@endsection

@push('scripts')
<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon = btn.querySelector('span');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `
            <!-- Mata tersilang SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"><path stroke="#6e4130" stroke-width="2" d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"/><circle cx="12" cy="12" r="3" stroke="#6e4130" stroke-width="2"/><line x1="4" y1="4" x2="20" y2="20" stroke="#6e4130" stroke-width="2"/></svg>
        `;
    } else {
        input.type = 'password';
        icon.innerHTML = `
            <!-- Mata polos SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24"><path stroke="#6e4130" stroke-width="2" d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12Z"/><circle cx="12" cy="12" r="3" stroke="#6e4130" stroke-width="2"/></svg>
        `;
    }
}
</script>
@endpush