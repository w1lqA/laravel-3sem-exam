@extends('layouts.guest')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-24 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-md mx-auto">
        <!-- Заголовок -->
        <div class="mb-12 text-center">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white mb-4">
                Регистрация<span class="text-lime-400">.</span>
            </h2>
            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest">
                Создайте новый аккаунт
            </p>
        </div>

        <!-- Форма -->
        <div class="border border-neutral-800 p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                
                <!-- Имя -->
                <div>
                    <label for="name" class="block text-sm font-medium text-neutral-400 mb-2">
                        Имя
                    </label>
                    <input type="text" 
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors"
                           placeholder="Иван Иванов"
                           required
                           autofocus>
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

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
                           required>
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
                           placeholder="Минимум 6 символов"
                           required>
                    @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Подтверждение пароля -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-neutral-400 mb-2">
                        Подтверждение пароля
                    </label>
                    <input type="password" 
                           id="password_confirmation"
                           name="password_confirmation"
                           class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors"
                           placeholder="Повторите пароль"
                           required>
                </div>

                <!-- Кнопка отправки -->
                <button type="submit" 
                        class="w-full py-4 bg-lime-400 text-black font-bold hover:bg-lime-300 transition-colors duration-300">
                    Зарегистрироваться
                </button>
            </form>

            <!-- Ссылка на вход -->
            <div class="mt-8 pt-8 border-t border-neutral-800 text-center">
                <p class="text-neutral-500 text-sm">
                    Уже есть аккаунт?
                    <a href="{{ route('login') }}" class="text-lime-400 hover:text-lime-300 ml-2">
                        Войти
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection