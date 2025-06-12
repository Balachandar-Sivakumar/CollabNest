<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'My App')</title>
    <!-- Add your CSS links here -->
    <script src="https://cdn.tailwindcss.com"></script>
   
</head>
<body>
    <header>
        <!-- Your navbar or header here -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Your footer here -->
    </footer>
</body>
</html>
