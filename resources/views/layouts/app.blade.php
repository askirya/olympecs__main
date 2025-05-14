<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="{{ auth()->check() && auth()->user()->is_admin ? route('admin.dashboard') : route('tickets.index') }}" class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-img">
                <span>HELPDESK</span>
            </a>
            <div class="nav-menu">
                <ul class="nav-left">
                    @auth
                        @if(!auth()->user()->is_admin)
                            <li><a href="{{ route('tickets.index') }}"><i class="fas fa-ticket-alt"></i> Мои заявки</a></li>
                            <li><a href="{{ route('tickets.create') }}"><i class="fas fa-plus-circle"></i> Создать заявку</a></li>
                        @endif
                    @endauth
                </ul>
                <ul class="nav-right">
                    @guest
                        <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Вход</a></li>
                        <li><a href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Регистрация</a></li>
                    @else
                        <li>
                            <span class="username">{{ auth()->user()->full_name }}</span>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Выход</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @if(session('success'))
            <div class="alert success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button class="alert-close" onclick="this.parentElement.style.display='none'">&times;</button>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        // Простая анимация для элементов при загрузке страницы
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100 * index);
            });
        });
    </script>
</body>
</html>
