<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/clients">Companies</a></li>
                <li><a href="/vacancies">Vacancies</a></li>
                <li><a href="/reports/commission-in-pipeline">Report</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} My Laravel App</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Add additional scripts here -->
</body>
</html>
