<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin:0; padding:0; overflow-x:hidden; }

        .bg-grid {
            background-image:
                linear-gradient(rgba(108,99,255,0.07) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108,99,255,0.07) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Spacer: sidebar muncul hanya desktop */
        .sb-spacer { display:none; width:272px; flex-shrink:0; }
        @media(min-width:1024px){ .sb-spacer { display:block; } }
    </style>
</head>
<body style="background:#080a18; min-height:100vh;">

    <div class="bg-grid" style="position:fixed;inset:0;pointer-events:none;z-index:0;opacity:0.55;"></div>
    <div style="position:fixed;top:-140px;left:-140px;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(108,99,255,0.17) 0%,transparent 70%);pointer-events:none;z-index:0;"></div>
    <div style="position:fixed;bottom:-120px;right:-100px;width:420px;height:420px;border-radius:50%;background:radial-gradient(circle,rgba(155,89,245,0.12) 0%,transparent 70%);pointer-events:none;z-index:0;"></div>

    <div style="position:relative;z-index:1;display:flex;min-height:100vh;">

        @include('components.pengguna.sidebar')

        <div class="sb-spacer"></div>

        {{-- Area kanan: ZERO padding di sini, biar navbar mepet tepi --}}
        <div style="flex:1;min-width:0;display:flex;flex-direction:column;">

            @include('components.pengguna.navbar')

            {{-- Konten: padding di sini saja --}}
            <main style="flex:1;padding:12px;min-width:0;">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>