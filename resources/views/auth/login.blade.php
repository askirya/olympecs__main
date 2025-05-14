@extends('layouts.app')

@section('title', 'Вход')

@section('content')
<div class="auth-container">
    <div class="card">
        <div class="card-header">
            <i class="fas fa-sign-in-alt"></i> Вход в систему
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email адрес</label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="{{ old('email') }}" placeholder="Введите email" required>
                    @error('email')<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Пароль</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Введите пароль" required>
                    @error('password')<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                </div>

                <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i> Войти</button>
            </form>
        </div>
    </div>
</div>
@endsection
