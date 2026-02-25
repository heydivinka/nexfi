<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <style>
        *, *::before, *::after { box-sizing: border-box; }

        /* KUNCI: html dan body tidak boleh scroll sendiri */
        html, body {
            margin: 0;
            padding: 0;
            overflow: hidden;   /* ← ini yang bikin navbar diem */
            height: 100vh;
        }

        .bg-grid {
            background-image:
                linear-gradient(rgba(108,99,255,0.18) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108,99,255,0.18) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .sb-spacer { display:none; width:272px; flex-shrink:0; }
        @media(min-width:1024px){ .sb-spacer { display:block; } }

        /* Area konten kanan yang bisa scroll */
        #right-col {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;          /* ← tinggi penuh viewport */
            overflow-y: auto;       /* ← scroll di sini, bukan di body */
            overflow-x: hidden;
        }

        /* Navbar diem karena dia ada di ATAS scroll container */
        #nexfi-navbar {
            position: sticky !important;
            top: 0 !important;
            z-index: 30;
            flex-shrink: 0;
        }
    </style>
</head>
<body style="background:#080a18;">

    <div class="bg-grid" style="position:fixed;inset:0;pointer-events:none;z-index:0;opacity:1;"></div>
    <div style="position:fixed;top:-140px;left:-140px;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(108,99,255,0.35) 0%,transparent 70%);pointer-events:none;z-index:0;"></div>
    <div style="position:fixed;bottom:-120px;right:-100px;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(155,89,245,0.28) 0%,transparent 70%);pointer-events:none;z-index:0;"></div>

    <div style="position:relative;z-index:1;display:flex;height:100vh;overflow:hidden;">

        @include('components.pengguna.sidebar')

        <div class="sb-spacer"></div>

        {{-- Area kanan: scroll terjadi DI SINI --}}
        <div id="right-col">

            @include('components.pengguna.navbar')

            <main style="flex:1;padding:12px;min-width:0;">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>