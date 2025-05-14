@extends('layouts.app')

@section('title', 'Просмотр заявки #' . $ticket->id)

@section('content')
    <div class="content-header">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Назад к списку
        </a>
        <h1><i class="fas fa-ticket-alt"></i> Заявка #{{ $ticket->id }}</h1>
    </div>

    <div class="card">
        <div class="card-header">
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
        </div>
        <div class="card-body">
            <div class="ticket-info">
                <div class="info-group">
                    <div class="info-label"><i class="fas fa-user"></i> Пользователь:</div>
                    <div class="info-value">
                        {{ $ticket->user->full_name }}
                        <div class="info-secondary">{{ $ticket->user->department }}</div>
                    </div>
                </div>
                
                <div class="info-group">
                    <div class="info-label"><i class="fas fa-tag"></i> Категория:</div>
                    <div class="info-value">{{ $ticket->category->name }}</div>
                </div>
                
                <div class="info-group">
                    <div class="info-label"><i class="far fa-clock"></i> Дата создания:</div>
                    <div class="info-value">{{ $ticket->created_at->format('d.m.Y H:i') }}</div>
                </div>
                
                <div class="info-group full-width">
                    <div class="info-label"><i class="fas fa-align-left"></i> Описание проблемы:</div>
                    <div class="info-value ticket-description">{{ $ticket->description }}</div>
                </div>
            </div>

            <div class="ticket-actions">
                @if($ticket->status === 'new')
                    <form action="{{ route('admin.tickets.status', $ticket) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="in_progress">
                        <button type="submit" class="btn">
                            <i class="fas fa-play"></i> Принять в работу
                        </button>
                    </form>
                @elseif($ticket->status === 'in_progress')
                    <form action="{{ route('admin.tickets.status', $ticket) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="btn">
                            <i class="fas fa-check"></i> Завершить заявку
                        </button>
                    </form>
                    <form action="{{ route('admin.tickets.status', $ticket) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Отменить заявку
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection