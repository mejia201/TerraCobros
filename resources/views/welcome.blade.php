@extends('layouts/guest')
@section('title', 'Login')


@section('contenido')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
        <img src="{{ asset('images/logos/management.png') }}" width="90" alt="Logo sistema" />
    </a>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">Correo:</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
    
        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" />
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
    
        <!-- Submit Button -->
        <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Iniciar sesión">
    
    </form>
    

@endsection