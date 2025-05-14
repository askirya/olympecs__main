@extends('layouts.app')

@section('title', 'Мои заявки')

@section('content')
<div class="content-header">
    <h1><i class="fas fa-ticket-alt"></i> Мои заявки</h1>
</div>

<div class="tickets-list">
    @if($tickets->isEmpty())
        <div class="card">
            <div class="card-body">
                <p class="empty-text"><i class="fas fa-info-circle"></i> У вас пока нет заявок</p>
            </div>
        </div>
    @else
        @foreach($tickets as $ticket)
            <div class="card ticket-card">
                <div class="card-header">
                    <span class="ticket-id">#{{ $ticket->id }}</span>
                    <span class="status-badge status-{{ $ticket->status }}">
                        @switch($ticket->status)
                            @case('new')
                                <i class="fas fa-circle-notch"></i> Новая
                                @break
                            @case('in_progress')
                                <i class="fas fa-spinner fa-spin"></i> В работе
                                @break
                            @case('completed')
                                <i class="fas fa-check-circle"></i> Выполнена
                                @break
                            @case('cancelled')
                                <i class="fas fa-times-circle"></i> Отменена
                                @break
                        @endswitch
                    </span>
                </div>
                <div class="card-body">
                    <div class="ticket-info">
                        <p><strong><i class="fas fa-tag"></i> Категория:</strong> {{ $ticket->category->name }}</p>
                        <p><strong><i class="fas fa-align-left"></i> Описание:</strong></p>
                        <p class="ticket-description">{{ $ticket->description }}</p>
                    </div>
                    <div class="ticket-date">
                        <small><i class="far fa-clock"></i> Создано: {{ $ticket->created_at->format('d.m.Y H:i') }}</small>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
