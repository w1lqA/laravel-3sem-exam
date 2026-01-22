@extends('layouts.app')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-12 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-4xl mx-auto">
        <!-- Заголовок -->
        <div class="flex justify-between items-end mb-8 border-b border-neutral-800 pb-6">
            <div>
                <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white">
                    {{ $place->name }}<span class="text-lime-400">.</span>
                </h2>
                <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mt-2">
                    ID: {{ $place->id }}
                </p>
            </div>
            <a href="{{ route('places.index') }}" 
               class="px-4 py-2 border border-neutral-700 text-sm hover:bg-white hover:text-black transition-colors">
                ← Назад
            </a>
        </div>

        <!-- Основная информация -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Левая колонка -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Карточка деталей -->
                <div class="border border-neutral-800 p-8">
                    <h3 class="text-2xl font-medium text-white mb-6">Детали места</h3>
                    
                    <div class="space-y-6">
                        <!-- Название -->
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Название
                            </p>
                            <p class="text-white text-lg">{{ $place->name }}</p>
                        </div>

                        <!-- Описание -->
                        @if($place->description)
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Описание
                            </p>
                            <p class="text-neutral-300">{{ $place->description }}</p>
                        </div>
                        @endif

                        <!-- Статусы -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border border-neutral-800 p-4 rounded">
                                <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                    Статус ремонта
                                </p>
                                @if($place->repair)
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></span>
                                        <span class="text-yellow-400 font-medium">На ремонте</span>
                                    </div>
                                    <p class="text-neutral-500 text-xs mt-2">
                                        Место временно недоступно для использования
                                    </p>
                                @else
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                                        <span class="text-green-400 font-medium">Исправно</span>
                                    </div>
                                @endif
                            </div>

                            <div class="border border-neutral-800 p-4 rounded">
                                <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                    Статус работы
                                </p>
                                @if($place->work)
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 bg-lime-400 rounded-full"></span>
                                        <span class="text-lime-400 font-medium">Работает</span>
                                    </div>
                                    <p class="text-neutral-500 text-xs mt-2">
                                        Место доступно для использования
                                    </p>
                                @else
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                                        <span class="text-red-400 font-medium">Не работает</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Дата создания -->
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Создано
                            </p>
                            <p class="text-neutral-300">{{ $place->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- История использования -->
                @if($place->usages->count() > 0)
                <div class="border border-neutral-800 p-8">
                    <h3 class="text-2xl font-medium text-white mb-6">История использования</h3>
                    
                    <div class="space-y-4">
                        @foreach($place->usages as $usage)
                        <div class="border border-neutral-800 p-4 hover:bg-neutral-900/50 transition-colors">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-white font-medium">{{ $usage->thing->name }}</p>
                                    <p class="text-neutral-500 text-sm mt-1">
                                        Пользователь: {{ $usage->user->name }}
                                    </p>
                                </div>
                                <span class="text-xs font-mono px-2 py-1 border border-neutral-700 rounded text-neutral-400">
                                    {{ $usage->amount }} шт.
                                </span>
                            </div>
                            <p class="text-neutral-500 font-mono text-xs mt-2">
                                {{ $usage->created_at->format('d.m.Y H:i') }}
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Правая колонка -->
            <div class="space-y-6">
                <!-- Действия -->
                <div class="border border-neutral-800 p-6">
                    <h4 class="text-lg font-medium text-white mb-4">Действия</h4>
                    
                    <div class="space-y-3">
                        <a href="{{ route('places.edit', $place) }}" 
                           class="block w-full text-center py-3 border border-neutral-700 hover:bg-white hover:text-black transition-colors">
                            Редактировать
                        </a>
                        
                        <form method="POST" action="{{ route('places.destroy', $place) }}">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Вы уверены, что хотите удалить это место?')"
                                    class="w-full py-3 border border-neutral-700 text-sm hover:bg-red-500 hover:border-red-500 hover:text-white transition-colors">
                                Удалить место
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Статистика -->
                <div class="border border-neutral-800 p-6">
                    <h4 class="text-lg font-medium text-white mb-4">Статистика</h4>
                    
                    <div class="space-y-4 font-mono text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-400">Всего использований</span>
                            <span class="text-lime-400">{{ $place->usages->count() }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-400">Статус</span>
                            @if($place->repair)
                                <span class="text-yellow-400">На ремонте</span>
                            @elseif($place->work)
                                <span class="text-green-400">Работает</span>
                            @else
                                <span class="text-red-400">Не активно</span>
                            @endif
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-400">Дата создания</span>
                            <span class="text-neutral-300">{{ $place->created_at->format('d.m.Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Быстрое создание использования -->
                <div class="border border-neutral-800 p-6">
                    <h4 class="text-lg font-medium text-white mb-4">Использовать место</h4>
                    <p class="text-neutral-500 text-sm mb-4">
                        Зарегистрировать использование этого места
                    </p>
                    <a href="{{ route('usages.create') }}?place_id={{ $place->id }}" 
                       class="block w-full text-center py-3 border border-lime-400 text-lime-400 hover:bg-lime-400 hover:text-black transition-colors">
                        Создать запись использования
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection