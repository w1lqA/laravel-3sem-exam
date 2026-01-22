@extends('layouts.app')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-12 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-4xl mx-auto">
        <!-- Заголовок -->
        <div class="flex justify-between items-end mb-8 border-b border-neutral-800 pb-6">
            <div>
                <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white">
                    Использование #{{ $usage->id }}<span class="text-lime-400">.</span>
                </h2>
                <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mt-2">
                    Запись об использовании вещи
                </p>
            </div>
            <a href="{{ route('usages.index') }}" 
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
                    <h3 class="text-2xl font-medium text-white mb-6">Детали использования</h3>
                    
                    <div class="space-y-6">
                        <!-- Информация о вещи -->
                        <div class="border border-neutral-800 p-6 rounded-lg hover:bg-neutral-900/50 transition-colors">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-lime-400/10 border border-lime-400/30 rounded-lg flex items-center justify-center">
                                    <span class="text-lime-400 text-xl">📦</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium text-white">Вещь</h4>
                                    <a href="{{ route('things.show', $usage->thing) }}" 
                                       class="text-lime-400 hover:text-lime-300 text-sm">
                                        Подробнее →
                                    </a>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Название:</span>
                                    <span class="text-white">{{ $usage->thing->name }}</span>
                                </div>
                                @if($usage->thing->description)
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Описание:</span>
                                    <span class="text-neutral-300 text-right">{{ $usage->thing->description }}</span>
                                </div>
                                @endif
                                @if($usage->thing->wrnt)
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Гарантия:</span>
                                    <span class="{{ $usage->thing->wrnt->isFuture() ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $usage->thing->wrnt->format('d.m.Y') }}
                                    </span>
                                </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Владелец:</span>
                                    <span class="text-neutral-300">{{ $usage->thing->master->name }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Информация о месте -->
                        <div class="border border-neutral-800 p-6 rounded-lg hover:bg-neutral-900/50 transition-colors">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 {{ $usage->place->work ? 'bg-green-400/10 border-green-400/30' : 'bg-red-400/10 border-red-400/30' }} border rounded-lg flex items-center justify-center">
                                    <span class="{{ $usage->place->work ? 'text-green-400' : 'text-red-400' }} text-xl">🗺️</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium text-white">Место хранения</h4>
                                    <a href="{{ route('places.show', $usage->place) }}" 
                                       class="text-lime-400 hover:text-lime-300 text-sm">
                                        Подробнее →
                                    </a>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Название:</span>
                                    <span class="text-white">{{ $usage->place->name }}</span>
                                </div>
                                @if($usage->place->description)
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Описание:</span>
                                    <span class="text-neutral-300 text-right">{{ $usage->place->description }}</span>
                                </div>
                                @endif
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Статус:</span>
                                    <div class="flex items-center gap-2">
                                        @if($usage->place->repair)
                                            <span class="px-2 py-1 bg-yellow-500/20 text-yellow-400 text-xs rounded">
                                                На ремонте
                                            </span>
                                        @elseif($usage->place->work)
                                            <span class="px-2 py-1 bg-green-500/20 text-green-400 text-xs rounded">
                                                Работает
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-red-500/20 text-red-400 text-xs rounded">
                                                Не работает
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Информация о пользователе -->
                        <div class="border border-neutral-800 p-6 rounded-lg hover:bg-neutral-900/50 transition-colors">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-blue-400/10 border border-blue-400/30 rounded-lg flex items-center justify-center">
                                    <span class="text-blue-400 text-xl">👤</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-medium text-white">Пользователь</h4>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Имя:</span>
                                    <span class="text-white">{{ $usage->user->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-neutral-500">Email:</span>
                                    <span class="text-neutral-300">{{ $usage->user->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Правая колонка -->
            <div class="space-y-6">
                <!-- Количественная информация -->
                <div class="border border-neutral-800 p-6">
                    <h4 class="text-lg font-medium text-white mb-4">Количество</h4>
                    
                    <div class="text-center py-8">
                        <div class="text-6xl font-bold text-lime-400 mb-2">
                            {{ $usage->amount }}
                        </div>
                        <p class="text-neutral-500 font-mono uppercase tracking-widest">
                            единиц
                        </p>
                    </div>
                </div>

                <!-- Мета-информация -->
                <div class="border border-neutral-800 p-6">
                    <h4 class="text-lg font-medium text-white mb-4">Метаданные</h4>
                    
                    <div class="space-y-4 font-mono text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-400">ID записи:</span>
                            <span class="text-white">{{ $usage->id }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-400">Создано:</span>
                            <span class="text-neutral-300">{{ $usage->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-400">Обновлено:</span>
                            <span class="text-neutral-300">{{ $usage->updated_at->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Действия -->
                <div class="border border-neutral-800 p-6">
                    <h4 class="text-lg font-medium text-white mb-4">Действия</h4>
                    
                    <div class="space-y-3">
                        <a href="{{ route('usages.edit', $usage) }}" 
                           class="block w-full text-center py-3 border border-neutral-700 hover:bg-white hover:text-black transition-colors">
                            Редактировать
                        </a>
                        
                        <form method="POST" action="{{ route('usages.destroy', $usage) }}">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Вы уверены, что хотите удалить эту запись?')"
                                    class="w-full py-3 border border-neutral-700 text-sm hover:bg-red-500 hover:border-red-500 hover:text-white transition-colors">
                                Удалить запись
                            </button>
                        </form>
                        
                        <a href="{{ route('usages.create') }}" 
                           class="block w-full text-center py-3 border border-lime-400 text-lime-400 hover:bg-lime-400 hover:text-black transition-colors">
                            Создать новую запись
                        </a>
                    </div>
                </div>

                <!-- Статус -->
                <div class="border border-neutral-800 p-6">
                    <h4 class="text-lg font-medium text-white mb-4">Статус</h4>
                    
                    <div class="space-y-4">
                        <!-- Статус вещи -->
                        <div>
                            <p class="text-neutral-400 text-sm mb-2">Вещь:</p>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                                <span class="text-green-400">Доступна</span>
                            </div>
                        </div>
                        
                        <!-- Статус места -->
                        <div>
                            <p class="text-neutral-400 text-sm mb-2">Место:</p>
                            @if($usage->place->repair)
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-yellow-400 rounded-full animate-pulse"></span>
                                    <span class="text-yellow-400">На ремонте</span>
                                </div>
                            @elseif($usage->place->work)
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                                    <span class="text-green-400">Работает</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                                    <span class="text-red-400">Не работает</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Статус пользователя -->
                        <div>
                            <p class="text-neutral-400 text-sm mb-2">Пользователь:</p>
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 bg-blue-400 rounded-full"></span>
                                <span class="text-blue-400">Активен</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection