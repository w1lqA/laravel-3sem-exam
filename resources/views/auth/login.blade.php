@extends('layouts.guest')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-24 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-md mx-auto">
        <!-- Заголовок -->
        <div class="mb-12 text-center">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white mb-4">
                Вход<span class="text-lime-400">.</span>
            </h2>
            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest">
                Войдите в систему управления
            </p>
        </div>

        <!-- Форма -->
        <div class="border border-neutral-800 p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-400 mb-2">
                        Email
                    </label>
                    <input type="email" 
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors"
                           placeholder="you@example.com"
                           required
                           autofocus>
                    @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Пароль -->
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-400 mb-2">
                        Пароль
                    </label>
                    <input type="password" 
                           id="password"
                           name="password"
                           class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors"
                           placeholder="••••••••"
                           required>
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Общие ошибки -->
                @if($errors->any())
                    <div class="p-4 bg-red-500/10 border border-red-500/30 rounded-lg">
                        <p class="text-red-400 text-sm">{{ $errors->first() }}</p>
                    </div>
                @endif

                <!-- Кнопка отправки -->
                <button type="submit" 
                        class="w-full py-4 bg-lime-400 text-black font-bold hover:bg-lime-300 transition-colors duration-300">
                    Войти
                </button>
            </form>

            <!-- Ссылка на регистрацию -->
            <div class="mt-8 pt-8 border-t border-neutral-800 text-center">
                <p class="text-neutral-500 text-sm">
                    Нет аккаунта?
                    <a href="{{ route('register') }}" class="text-lime-400 hover:text-lime-300 ml-2">
                        Зарегистрироваться
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection