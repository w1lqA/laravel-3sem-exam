@extends('layouts.app')

@section('content')
<div class="w-full bg-neutral-950 text-neutral-200 py-12 px-6 md:px-12 font-sans selection:bg-lime-400 selection:text-black">
    <div class="max-w-3xl mx-auto">
        <!-- Заголовок -->
        <div class="flex justify-between items-end mb-8 border-b border-neutral-800 pb-6">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tighter text-white">
                Редактировать запись<span class="text-lime-400">.</span>
            </h2>
            <a href="{{ route('usages.index') }}" 
               class="px-4 py-2 border border-neutral-700 text-sm hover:bg-white hover:text-black transition-colors">
                ← Назад
            </a>
        </div>

        <!-- Форма -->
        <div class="border border-neutral-800 p-8">
            <form method="POST" action="{{ route('usages.update', $usage) }}" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Вещь -->
                <div>
                    <label for="thing_id" class="block text-sm font-medium text-neutral-400 mb-2">
                        Вещь *
                    </label>
                    <select id="thing_id"
                            name="thing_id"
                            required
                            class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors">
                        <option value="">Выберите вещь</option>
                        @foreach($things as $thing)
                            <option value="{{ $thing->id }}" 
                                    {{ old('thing_id', $usage->thing_id) == $thing->id ? 'selected' : '' }}>
                                {{ $thing->name }} (ID: {{ $thing->id }})
                            </option>
                        @endforeach
                    </select>
                    @error('thing_id')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Место -->
                <div>
                    <label for="place_id" class="block text-sm font-medium text-neutral-400 mb-2">
                        Место хранения *
                    </label>
                    <select id="place_id"
                            name="place_id"
                            required
                            class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors">
                        <option value="">Выберите место</option>
                        @foreach($places as $place)
                            <option value="{{ $place->id }}" 
                                    {{ old('place_id', $usage->place_id) == $place->id ? 'selected' : '' }}
                                    class="{{ $place->repair ? 'text-yellow-400' : ($place->work ? 'text-green-400' : 'text-red-400') }}">
                                {{ $place->name }}
                                @if($place->repair)
                                    (На ремонте)
                                @elseif(!$place->work)
                                    (Не работает)
                                @endif
                            </option>
                        @endforeach
                    </select>
                    @error('place_id')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Пользователь -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-neutral-400 mb-2">
                        Пользователь *
                    </label>
                    <select id="user_id"
                            name="user_id"
                            required
                            class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors">
                        <option value="">Выберите пользователя</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $usage->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Количество -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-neutral-400 mb-2">
                        Количество *
                    </label>
                    <input type="number" 
                           id="amount"
                           name="amount"
                           value="{{ old('amount', $usage->amount) }}"
                           min="1"
                           max="999"
                           class="w-full px-4 py-3 bg-neutral-900 border border-neutral-700 rounded focus:border-lime-400 focus:ring-1 focus:ring-lime-400 focus:outline-none transition-colors"
                           placeholder="Количество единиц"
                           required>
                    @error('amount')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Кнопки -->
                <div class="flex gap-4 pt-8 border-t border-neutral-800">
                    <button type="submit" 
                            class="px-8 py-3 bg-lime-400 text-black font-medium hover:bg-lime-300 transition-colors duration-300">
                        Сохранить изменения
                    </button>
                    <a href="{{ route('usages.index') }}" 
                       class="px-8 py-3 border border-neutral-700 hover:bg-white hover:text-black transition-colors">
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection