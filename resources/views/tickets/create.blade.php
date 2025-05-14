@extends('layouts.app')

@section('title', 'Создать заявку')

@section('content')
    <div class="content-header">
        <h1><i class="fas fa-plus-circle"></i> Создать заявку</h1>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-file-alt"></i> Новая заявка
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('tickets.store') }}">
                @csrf

                <div class="form-group">
                    <label for="category_id"><i class="fas fa-tag"></i> Категория</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Выберите категорию</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="description"><i class="fas fa-align-left"></i> Описание проблемы</label>
                    <textarea name="description" id="description" class="form-control"
                              rows="5" required>{{ old('description') }}</textarea>
                    @error('description')<span class="text-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Отправить заявку</button>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Отмена</a>
                </div>
            </form>
        </div>
    </div>
@endsection
