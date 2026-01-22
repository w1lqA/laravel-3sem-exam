<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Storage of Things | {{ $title ?? 'Система управления' }}</title>
    
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
    <!-- Навигация -->
    <nav class="border-b border-neutral-800">
        <div class="max-w-7xl mx-auto px-6 md:px-12 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center gap-8 mb-4 md:mb-0">
                    <a href="{{ route('things.index') }}" class="text-xl font-bold text-white">
                        Storage of Things
                    </a>
                    <div class="flex gap-6">
                        <a href="{{ route('things.index') }}" 
                           class="text-neutral-400 hover:text-lime-400 transition-colors {{ request()->routeIs('things.*') ? 'text-lime-400' : '' }}">
                            Вещи
                        </a>
                        <a href="{{ route('places.index') }}" 
                           class="text-neutral-400 hover:text-lime-400 transition-colors {{ request()->routeIs('places.*') ? 'text-lime-400' : '' }}">
                            Места
                        </a>
                        <a href="{{ route('usages.index') }}" 
                           class="text-neutral-400 hover:text-lime-400 transition-colors {{ request()->routeIs('usages.*') ? 'text-lime-400' : '' }}">
                            Использование
                        </a>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <span class="text-neutral-400 font-mono text-sm">
                        {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 border border-neutral-700 text-sm hover:bg-white hover:text-black transition-colors">
                            Выйти
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Сообщения -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-6 md:px-12 pt-6">
        <div class="p-4 bg-green-500/10 border border-green-500/30 rounded-lg flex items-center gap-3">
            <span class="text-green-400">✓</span>
            <p class="text-green-400">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="max-w-7xl mx-auto px-6 md:px-12 pt-6">
        <div class="p-4 bg-red-500/10 border border-red-500/30 rounded-lg flex items-center gap-3">
            <span class="text-red-400">✗</span>
            <p class="text-red-400">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <!-- Основной контент -->
    <main>
        @yield('content')
    </main>
</body>
</html>