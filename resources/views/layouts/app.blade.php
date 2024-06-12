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
        <!-- Navigation, etc. -->
    </header>

    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
