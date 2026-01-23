@extends('layouts.app')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-12 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-8 border-b border-neutral-800 pb-6">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white">
                Вещи<span class="text-lime-400">.</span>
            </h2>
            <div class="flex gap-4 mt-4 md:mt-0">
                <a href="{{ route('things.create') }}" 
                   class="px-6 py-3 bg-lime-400 text-black font-medium hover:bg-lime-300 transition-colors duration-300">
                    + Добавить вещь
                </a>
            </div>
        </div>

        @if($things->isEmpty())
            <div class="border border-neutral-800 p-12 text-center">
                <p class="text-neutral-500 font-mono uppercase tracking-widest">Нет вещей</p>
                <a href="{{ route('things.create') }}" class="text-lime-400 hover:text-lime-300 mt-4 inline-block">
                    Создать первую вещь →
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($things as $thing)
                <div class="flex flex-col group border border-neutral-800 p-6 hover:bg-neutral-900/50 transition-colors duration-500">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-xl font-medium text-white">{{ $thing->name }}</h3>
                        <div class="flex flex-col items-end gap-2">
                            <span class="text-xs font-mono px-2 py-1 border border-neutral-700 rounded text-neutral-400">
                                ID: {{ $thing->id }}
                            </span>
                        </div>
                    </div>
                    
                    @if($thing->description)
                    <p class="text-neutral-500 text-sm mb-4">{{ Str::limit($thing->description, 100) }}</p>
                    @endif
                    
                    <ul class="flex flex-col items-start gap-3 font-mono text-sm text-neutral-400 mb-6">
                        @if($thing->wrnt)
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-neutral-700 rounded-full group-hover:bg-lime-400 transition-colors"></span>
                            Гарантия до: {{ $thing->wrnt->format('d.m.Y') }}
                        </li>
                        @endif
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-neutral-700 rounded-full group-hover:bg-lime-400 transition-colors"></span>
                            Владелец: {{ $thing->master->name }}
                        </li>
                        @thingStatus($thing)
                    </ul>
                    
                    <div class="flex gap-3 pt-4 border-t border-neutral-800 mt-auto">
                        <a href="{{ route('things.show', $thing) }}" 
                           class="flex-1 text-center py-2 border border-neutral-700 text-sm hover:bg-white hover:text-black transition-colors">
                            Просмотр
                        </a>
                        <a href="{{ route('things.edit', $thing) }}" 
                           class="flex-1 text-center py-2 border border-neutral-700 text-sm hover:bg-white hover:text-black transition-colors">
                            Редактировать
                        </a>
                        <form method="POST" action="{{ route('things.destroy', $thing) }}" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Удалить вещь?')"
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