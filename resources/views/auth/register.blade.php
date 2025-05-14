@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
<div class="auth-container">
    <div class="card">
        <div class="card-header">
            <i class="fas fa-user-plus"></i> Регистрация
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-group">
                    <label for="full_name"><i class="fas fa-user"></i> ФИО</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" 
                        value="{{ old('full_name') }}" placeholder="Введите ваше полное имя" required>
                    @error('full_name')<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> Телефон</label>
                    <input type="text" class="form-control" id="phone" name="phone" 
                        value="{{ old('phone') }}" placeholder="+7(XXX)-XXX-XX-XX" required>
                    @error('phone')<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="department"><i class="fas fa-building"></i> Отдел</label>
                    <input type="text" class="form-control" id="department" name="department" 
                        value="{{ old('department') }}" placeholder="Укажите ваш отдел" required>
                    @error('department')<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                        value="{{ old('email') }}" placeholder="Введите email" required>
                    @error('email')<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Пароль</label>
                    <input type="password" class="form-control" id="password" name="password" 
                        placeholder="Минимум 5 символов" required>
                    @error('password')<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                </div>

                <button type="submit" class="btn"><i class="fas fa-user-plus"></i> Зарегистрироваться</button>
            </form>
        </div>
    </div>
</div>
@endsection