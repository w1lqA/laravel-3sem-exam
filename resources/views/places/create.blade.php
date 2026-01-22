@extends('layouts.app')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-12 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-3xl mx-auto">
        <!-- Заголовок -->
        <div class="flex justify-between items-end mb-8 border-b border-neutral-800 pb-6">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white">
                Новое место<span class="text-lime-400">.</span>
            </h2>
            <a href="{{ route('places.index') }}" 
               class="px-4 py-2 border border-neutral-700 text-sm hover:bg-white hover:text-black transition-colors">
                ← Назад
            </a>
        </div>

        <!-- Форма -->
        <div class="border border-neutral-800 p-8">
            <form method="POST" action="{{ route('places.store') }}" class="space-y-8">
                @csrf
                
                <!-- Название -->
                <div>
                    <label for="name" class="block text-sm font-medium text-neutral-400 mb-2">
                        Название *
                    </label>
                    <input type="text" 
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors"
                           placeholder="Название места хранения"
                           required>
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Описание -->
                <div>
                    <label for="description" class="block text-sm font-medium text-neutral-400 mb-2">
                        Описание
                    </label>
                    <textarea id="description"
                              name="description"
                              rows="4"
                              class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors"
                              placeholder="Описание места, местоположение и т.д.">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Статусы -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Ремонт -->
                    <div class="border border-neutral-800 p-4 rounded hover:bg-neutral-900/50 transition-colors">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" 
                                   id="repair"
                                   name="repair"
                                   value="1"
                                   {{ old('repair') ? 'checked' : '' }}
                                   class="w-4 h-4 text-lime-400 bg-neutral-900 border-neutral-700 rounded focus:ring-lime-400 focus:ring-2">
                            <div>
                                <label for="repair" class="text-sm font-medium text-neutral-300">
                                    На ремонте
                                </label>
                                <p class="text-neutral-500 text-xs mt-1">
                                    Место временно недоступно
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Работает -->
                    <div class="border border-neutral-800 p-4 rounded hover:bg-neutral-900/50 transition-colors">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" 
                                   id="work"
                                   name="work"
                                   value="1"
                                   {{ old('work', true) ? 'checked' : '' }}
                                   class="w-4 h-4 text-lime-400 bg-neutral-900 border-neutral-700 rounded focus:ring-lime-400 focus:ring-2">
                            <div>
                                <label for="work" class="text-sm font-medium text-neutral-300">
                                    Работает
                                </label>
                                <p class="text-neutral-500 text-xs mt-1">
                                    Место доступно для использования
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Кнопки -->
                <div class="flex gap-4 pt-8 border-t border-neutral-800">
                    <button type="submit" 
                            class="px-8 py-3 bg-lime-400 text-black font-medium hover:bg-lime-300 transition-colors duration-300">
                        Создать место
                    </button>
                    <a href="{{ route('places.index') }}" 
                       class="px-8 py-3 border border-neutral-700 hover:bg-white hover:text-black transition-colors">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection