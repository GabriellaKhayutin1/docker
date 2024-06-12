<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
<div class="container">
    <header>
        <!-- Navigation -->
        <nav>
            <a href="{{ url('/') }}">Home</a>

            @auth
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <!-- Add profile link if needed -->
                <a href="{{ route('profile.edit') }}">Profile</a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Logout') }}
                    </a>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </nav>
    </header>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
