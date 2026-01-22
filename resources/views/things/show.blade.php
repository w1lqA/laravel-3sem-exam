@extends('layouts.app')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-12 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-4xl mx-auto">
        <!-- Заголовок -->
        <div class="flex justify-between items-end mb-8 border-b border-neutral-800 pb-6">
            <div>
                <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white">
                    {{ $thing->name }}<span class="text-lime-400">.</span>
                </h2>
                <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mt-2">
                    ID: {{ $thing->id }}
                </p>
            </div>
            <a href="{{ route('things.index') }}" 
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
                    <h3 class="text-2xl font-medium text-white mb-6">Детали</h3>
                    
                    <div class="space-y-6">
                        <!-- Название -->
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Название
                            </p>
                            <p class="text-white text-lg">{{ $thing->name }}</p>
                        </div>

                        <!-- Описание -->
                        @if($thing->description)
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Описание
                            </p>
                            <p class="text-neutral-300">{{ $thing->description }}</p>
                        </div>
                        @endif

                        <!-- Гарантия -->
                        @if($thing->wrnt)
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Гарантия
                            </p>
                            <p class="text-neutral-300">
                                До {{ $thing->wrnt->format('d.m.Y') }}
                                @if($thing->wrnt->isFuture())
                                    <span class="ml-2 px-2 py-1 bg-green-500/20 text-green-400 text-xs rounded">
                                        Активна
                                    </span>
                                @else
                                    <span class="ml-2 px-2 py-1 bg-red-500/20 text-red-400 text-xs rounded">
                                        Истекла
                                    </span>
                                @endif
                            </p>
                        </div>
                        @endif

                        <!-- Владелец -->
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Владелец
                            </p>
                            <p class="text-neutral-300">{{ $thing->master->name }}</p>
                        </div>

                        <!-- Дата создания -->
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Создано
                            </p>
                            <p class="text-neutral-300">{{ $thing->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- История использования -->
                @if($thing->usages->count() > 0)
                <div class="border border-neutral-800 p-8">
                    <h3 class="text-2xl font-medium text-white mb-6">История использования</h3>
                    
                    <div class="space-y-4">
                        @foreach($thing->usages as $usage)
                        <div class="border border-neutral-800 p-4 hover:bg-neutral-900/50 transition-colors">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-white font-medium">{{ $usage->place->name }}</p>
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
                        <a href="{{ route('things.edit', $thing) }}" 
                           class="block w-full text-center py-3 border border-neutral-700 hover:bg-white hover:text-black transition-colors">
                            Редактировать
                        </a>
                        
                        <form method="POST" action="{{ route('things.destroy', $thing) }}">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Вы уверены, что хотите удалить эту вещь?')"
                                    class="w-full py-3 border border-neutral-700 text-sm hover:bg-red-500 hover:border-red-500 hover:text-white transition-colors">
                                Удалить вещь
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Статус -->
                <div class="border border-neutral-800 p-6">
                    <h4 class="text-lg font-medium text-white mb-4">Статус</h4>
                    
                    <div class="space-y-4 font-mono text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-400">Активна</span>
                            <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                        </div>
                        
                        @if($thing->usages->count() > 0)
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-400">Используется</span>
                            <span class="text-lime-400">{{ $thing->usages->count() }} раз</span>
                        </div>
                        @endif
                        
                        @if($thing->wrnt)
                        <div class="flex items-center justify-between">
                            <span class="text-neutral-400">Гарантия</span>
                            <span class="{{ $thing->wrnt->isFuture() ? 'text-green-400' : 'text-red-400' }}">
                                {{ $thing->wrnt->isFuture() ? 'Активна' : 'Истекла' }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection