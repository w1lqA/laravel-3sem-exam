<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage of Things | {{ $title ?? 'Аутентификация' }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'neutral': {
                            50: '#fafafa',
                            100: '#f5f5f5',
                            200: '#e5e5e5',
                            300: '#d4d4d4',
                            400: '#a3a3a3',
                            500: '#737373',
                            600: '#525252',
                            700: '#404040',
                            800: '#262626',
                            900: '#171717',
                            950: '#0a0a0a',
                        },
                        'lime': {
                            400: '#a3e635',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'mono': ['JetBrains Mono', 'monospace'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-feature-settings: "ss01", "ss02", "cv01", "cv02";
        }
        .selection\\:bg-lime-400 ::selection {
            background-color: #a3e635;
        }
        .selection\\:text-black ::selection {
            color: #0a0a0a;
        }
    </style>
</head>
<body class="bg-neutral-950 text-neutral-200 font-sans selection:bg-lime-400 selection:text-black min-h-screen">
    <!-- Навигация для гостей -->
    <nav class="border-b border-neutral-800">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-xl font-bold text-white">
                    Storage of Things
                </a>
                <div class="flex gap-4">
                    <a href="{{ route('login') }}" 
                       class="text-neutral-400 hover:text-lime-400 transition-colors">
                        Вход
                    </a>
                    <a href="{{ route('register') }}" 
                       class="text-neutral-400 hover:text-lime-400 transition-colors">
                        Регистрация
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Контент -->
    <main>
        @yield('content')
    </main>
</body>
</html>