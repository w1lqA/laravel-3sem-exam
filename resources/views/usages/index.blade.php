@extends('layouts.app')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-12 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-7xl mx-auto">
        <!-- Заголовок -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 border-b border-neutral-800 pb-6">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white">
                Использование<span class="text-lime-400">.</span>
            </h2>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="{{ route('usages.create') }}" 
                   class="px-6 py-3 bg-lime-400 text-black font-medium hover:bg-lime-300 transition-colors duration-300">
                    + Новая запись
                </a>
            </div>
        </div>

        <!-- Список записей -->
        @if($usages->isEmpty())
            <div class="border border-neutral-800 p-12 text-center">
                <p class="text-neutral-500 font-mono uppercase tracking-widest">Нет записей об использовании</p>
                <a href="{{ route('usages.create') }}" class="text-lime-400 hover:text-lime-300 mt-4 inline-block">
                    Создать первую запись →
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-neutral-800">
                            <th class="text-left py-4 px-4 text-neutral-500 font-mono text-sm uppercase tracking-widest">
                                Вещь
                            </th>
                            <th class="text-left py-4 px-4 text-neutral-500 font-mono text-sm uppercase tracking-widest">
                                Место
                            </th>
                            <th class="text-left py-4 px-4 text-neutral-500 font-mono text-sm uppercase tracking-widest">
                                Пользователь
                            </th>
                            <th class="text-left py-4 px-4 text-neutral-500 font-mono text-sm uppercase tracking-widest">
                                Количество
                            </th>
                            <th class="text-left py-4 px-4 text-neutral-500 font-mono text-sm uppercase tracking-widest">
                                Дата
                            </th>
                            <th class="text-left py-4 px-4 text-neutral-500 font-mono text-sm uppercase tracking-widest">
                                Действия
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usages as $usage)
                        <tr class="border-b border-neutral-800 hover:bg-neutral-900/50 transition-colors duration-300">
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 bg-lime-400 rounded-full"></span>
                                    <div>
                                        <p class="text-white font-medium">{{ $usage->thing->name }}</p>
                                        <p class="text-neutral-500 text-xs">
                                            ID: {{ $usage->thing->id }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <span class="w-2 h-2 {{ $usage->place->work ? 'bg-green-400' : 'bg-red-400' }} rounded-full"></span>
                                    <div>
                                        <p class="text-white font-medium">{{ $usage->place->name }}</p>
                                        @if($usage->place->repair)
                                            <p class="text-yellow-400 text-xs">На ремонте</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-white">{{ $usage->user->name }}</p>
                                <p class="text-neutral-500 text-xs">{{ $usage->user->email }}</p>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-mono text-lime-400">{{ $usage->amount }}</span>
                                <span class="text-neutral-500 text-sm ml-1">шт.</span>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-neutral-300">{{ $usage->created_at->format('d.m.Y') }}</p>
                                <p class="text-neutral-500 text-xs">{{ $usage->created_at->format('H:i') }}</p>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('usages.show', $usage) }}" 
                                       class="px-3 py-1 border border-neutral-700 text-xs hover:bg-white hover:text-black transition-colors">
                                        Просмотр
                                    </a>
                                    <a href="{{ route('usages.edit', $usage) }}" 
                                       class="px-3 py-1 border border-neutral-700 text-xs hover:bg-white hover:text-black transition-colors">
                                        Редакт.
                                    </a>
                                    <form method="POST" action="{{ route('usages.destroy', $usage) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Удалить запись?')"
                                                class="px-3 py-1 border border-neutral-700 text-xs hover:bg-red-500 hover:border-red-500 hover:text-white transition-colors">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Карточное отображение для мобильных -->
            <div class="grid grid-cols-1 gap-6 mt-8 md:hidden">
                @foreach($usages as $usage)
                <div class="border border-neutral-800 p-6 hover:bg-neutral-900/50 transition-colors duration-500">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-medium text-white">{{ $usage->thing->name }}</h3>
                            <p class="text-neutral-500 text-sm mt-1">
                                Место: {{ $usage->place->name }}
                            </p>
                        </div>
                        <span class="text-xs font-mono px-2 py-1 border border-neutral-700 rounded text-lime-400">
                            {{ $usage->amount }} шт.
                        </span>
                    </div>
                    
                    <div class="space-y-3 font-mono text-sm text-neutral-400 mb-4">
                        <div class="flex items-center justify-between">
                            <span>Пользователь:</span>
                            <span class="text-white">{{ $usage->user->name }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Дата:</span>
                            <span class="text-white">{{ $usage->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                    
                    <div class="flex gap-2 pt-4 border-t border-neutral-800">
                        <a href="{{ route('usages.show', $usage) }}" 
                           class="flex-1 text-center py-2 border border-neutral-700 text-xs hover:bg-white hover:text-black transition-colors">
                            Просмотр
                        </a>
                        <a href="{{ route('usages.edit', $usage) }}" 
                           class="flex-1 text-center py-2 border border-neutral-700 text-xs hover:bg-white hover:text-black transition-colors">
                            Редактировать
                        </a>
                        <form method="POST" action="{{ route('usages.destroy', $usage) }}" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Удалить запись?')"
                                    class="w-full py-2 border border-neutral-700 text-xs hover:bg-red-500 hover:border-red-500 hover:text-white transition-colors">
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