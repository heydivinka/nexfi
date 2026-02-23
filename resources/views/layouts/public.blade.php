<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Nexfi' }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        body{
            background:#0f0f14;
            color:white;
            font-family: Inter, sans-serif;
        }
    </style>
</head>
<body>

    <div class="min-h-screen flex items-center justify-center p-6">

        @yield('content')

    </div>

</body>
</html>