@extends('layouts.app')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-12 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-4xl mx-auto">
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <div class="border border-neutral-800 p-8">
                    <h3 class="text-2xl font-medium text-white mb-6">Детали</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Название
                            </p>
                            <p class="text-white text-lg">{{ $thing->name }}</p>
                        </div>

                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Статус
                            </p>
                            @thingStatus($thing)
                        </div>

                        @if($thing->description)
                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Описание
                            </p>
                            <p class="text-neutral-300">{{ $thing->description }}</p>
                        </div>
                        @endif

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

                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Владелец
                            </p>
                            <p class="text-neutral-300">{{ $thing->master->name }}</p>
                        </div>

                        <div>
                            <p class="text-neutral-500 font-mono text-sm uppercase tracking-widest mb-2">
                                Создано
                            </p>
                            <p class="text-neutral-300">{{ $thing->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection