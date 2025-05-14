@extends('layouts.app')

@section('title', 'Панель администратора')

@section('content')
    <div class="content-header">
        <h1><i class="fas fa-tachometer-alt"></i> Панель администратора</h1>
    </div>

    @if($tickets->isEmpty())
        <div class="card">
            <div class="card-body">
                <p class="empty-text"><i class="fas fa-info-circle"></i> Заявок не найдено</p>
            </div>
        </div>
    @else
        <div class="admin-filters">
            <h3><i class="fas fa-filter"></i> Фильтры</h3>
            <form action="{{ route('admin.dashboard') }}" method="GET" class="filter-form">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value="">Все статусы</option>
                        <option value="new">Новые</option>
                        <option value="in_progress">В работе</option>
                        <option value="completed">Завершенные</option>
                        <option value="cancelled">Отмененные</option>
                    </select>
                </div>
                <button type="submit" class="btn"><i class="fas fa-search"></i> Применить</button>
            </form>
        </div>
        
        <div class="card">
            <div class="card-header">
                <i class="fas fa-list"></i> Список заявок
            </div>
            <div class="card-body">
                <table class="tickets-table">
                    <tr>
                        <th>#</th>
                        <th>Пользователь</th>
                        <th>Отдел</th>
                        <th>Категория</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>Дата</th>
                        <th>Действия</th>
                    </tr>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->user->full_name }}</td>
                            <td>{{ $ticket->user->department }}</td>
                            <td>{{ $ticket->category->name }}</td>
                            <td>{{ Str::limit($ticket->description, 50) }}</td>
                            <td>
                                <span class="status-badge status-{{ $ticket->status }}">
                                    @switch($ticket->status)
                                        @case('new')
                                            <i class="fas fa-circle-notch"></i> Новая
                                            @break
                                        @case('in_progress')
                                            <i class="fas fa-spinner fa-spin"></i> В работе
                                            @break
                                        @case('completed')
                                            <i class="fas fa-check-circle"></i> Завершена
                                            @break
                                        @case('cancelled')
                                            <i class="fas fa-times-circle"></i> Отменена
                                            @break
                                    @endswitch
                                </span>
                            </td>
                            <td>{{ $ticket->created_at->format('d.m.Y') }}</td>
                            <td>
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
@endsection
