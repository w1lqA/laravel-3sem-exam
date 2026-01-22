@extends('layouts.guest')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-24 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-7xl mx-auto">
        <!-- Герой -->
        <div class="text-center mb-20">
            <h1 class="text-6xl md:text-8xl font-bold tracking-tighter text-white mb-6">
                Storage of Things<span class="text-lime-400">.</span>
            </h1>
            <p class="text-neutral-500 font-mono text-lg uppercase tracking-widest max-w-2xl mx-auto">
                Система управления вещами и местами хранения
            </p>
        </div>

        <!-- Особенности -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            <div class="border border-neutral-800 p-8 hover:bg-neutral-900/50 transition-colors duration-500">
                <div class="w-12 h-12 bg-lime-400/10 border border-lime-400/30 rounded-lg flex items-center justify-center mb-6">
                    <span class="text-lime-400 text-2xl">📦</span>
                </div>
                <h3 class="text-xl font-medium text-white mb-4">Управление вещами</h3>
                <p class="text-neutral-500">
                    Создавайте, редактируйте и отслеживайте все ваши вещи в одном месте.
                </p>
            </div>

            <div class="border border-neutral-800 p-8 hover:bg-neutral-900/50 transition-colors duration-500">
                <div class="w-12 h-12 bg-lime-400/10 border border-lime-400/30 rounded-lg flex items-center justify-center mb-6">
                    <span class="text-lime-400 text-2xl">🗺️</span>
                </div>
                <h3 class="text-xl font-medium text-white mb-4">Места хранения</h3>
                <p class="text-neutral-500">
                    Организуйте места хранения с указанием статуса и доступности.
                </p>
            </div>

            <div class="border border-neutral-800 p-8 hover:bg-neutral-900/50 transition-colors duration-500">
                <div class="w-12 h-12 bg-lime-400/10 border border-lime-400/30 rounded-lg flex items-center justify-center mb-6">
                    <span class="text-lime-400 text-2xl">📊</span>
                </div>
                <h3 class="text-xl font-medium text-white mb-4">Использование</h3>
                <p class="text-neutral-500">
                    Отслеживайте использование вещей с подробной историей и аналитикой.
                </p>
            </div>
        </div>

        <!-- Призыв к действию -->
        <div class="text-center border-t border-neutral-800 pt-20">
            @if(Auth::check())
                <a href="{{ route('things.index') }}" 
                   class="inline-block px-12 py-4 bg-lime-400 text-black font-bold text-lg hover:bg-lime-300 transition-colors duration-300">
                    Перейти к управлению →
                </a>
            @else
                <div class="space-x-6">
                    <a href="{{ route('register') }}" 
                       class="inline-block px-12 py-4 bg-lime-400 text-black font-bold text-lg hover:bg-lime-300 transition-colors duration-300">
                        Начать бесплатно
                    </a>
                    <a href="{{ route('login') }}" 
                       class="inline-block px-12 py-4 border border-neutral-700 text-lg hover:bg-white hover:text-black transition-colors">
                        Войти в систему
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection