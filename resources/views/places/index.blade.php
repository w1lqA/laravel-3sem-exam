@extends('layouts.app')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-12 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-7xl mx-auto">
        <!-- Заголовок -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 border-b border-neutral-800 pb-6">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white">
                Места<span class="text-lime-400">.</span>
            </h2>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="{{ route('places.create') }}" 
                   class="px-6 py-3 bg-lime-400 text-black font-medium hover:bg-lime-300 transition-colors duration-300">
                    + Добавить место
                </a>
            </div>
        </div>

        <!-- Список мест -->
        @if($places->isEmpty())
            <div class="border border-neutral-800 p-12 text-center">
                <p class="text-neutral-500 font-mono uppercase tracking-widest">Нет мест хранения</p>
                <a href="{{ route('places.create') }}" class="text-lime-400 hover:text-lime-300 mt-4 inline-block">
                    Создать первое место →
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($places as $place)
                <div class="group border border-neutral-800 p-6 hover:bg-neutral-900/50 transition-colors duration-500">
                    <!-- Заголовок карточки -->
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-medium text-white">{{ $place->name }}</h3>
                        <div class="flex flex-col items-end gap-2">
                            <span class="text-xs font-mono px-2 py-1 border border-neutral-700 rounded text-neutral-400">
                                ID: {{ $place->id }}
                            </span>
                            <!-- Статусы -->
                            <div class="flex gap-2">
                                @if($place->repair)
                                    <span class="text-xs font-mono px-2 py-1 bg-yellow-500/20 text-yellow-400 border border-yellow-500/30 rounded">
                                        Ремонт
                                    </span>
                                @endif
                                @if($place->work)
                                    <span class="text-xs font-mono px-2 py-1 bg-green-500/20 text-green-400 border border-green-500/30 rounded">
                                        Работает
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Описание -->
                    @if($place->description)
                    <p class="text-neutral-500 text-sm mb-4">{{ Str::limit($place->description, 100) }}</p>
                    @endif
                    
                    <!-- Детали -->
                    <ul class="space-y-3 font-mono text-sm text-neutral-400 mb-6">
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-neutral-700 rounded-full group-hover:bg-lime-400 transition-colors"></span>
                            Использований: {{ $place->usages->count() }}
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-neutral-700 rounded-full group-hover:bg-lime-400 transition-colors"></span>
                            Статус: 
                            @if($place->repair)
                                <span class="text-yellow-400 ml-1">На ремонте</span>
                            @elseif($place->work)
                                <span class="text-green-400 ml-1">Работает</span>
                            @else
                                <span class="text-neutral-500 ml-1">Не активно</span>
                            @endif
                        </li>
                    </ul>
                    
                    <!-- Действия -->
                    <div class="flex gap-3 pt-4 border-t border-neutral-800">
                        <a href="{{ route('places.show', $place) }}" 
                           class="flex-1 text-center py-2 border border-neutral-700 text-sm hover:bg-white hover:text-black transition-colors">
                            Просмотр
                        </a>
                        <a href="{{ route('places.edit', $place) }}" 
                           class="flex-1 text-center py-2 border border-neutral-700 text-sm hover:bg-white hover:text-black transition-colors">
                            Редактировать
                        </a>
                        <form method="POST" action="{{ route('places.destroy', $place) }}" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Удалить место?')"
                                    class="w-full py-2 border border-neutral-700 text-sm hover:bg-red-500 hover:border-red-500 hover:text-white transition-colors">
                                Удалить
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection