<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Thing;
use App\Models\Place;
use App\Models\Usage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $user1 = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);

        $user2 = User::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
        ]);

        $things = [
            Thing::factory()->create(['name' => 'Ноутбук', 'description' => 'Игровой ноутбук', 'master_id' => $admin->id]),
            Thing::factory()->create(['name' => 'Смартфон', 'description' => 'Флагманский смартфон', 'master_id' => $admin->id]),
            Thing::factory()->create(['name' => 'Наушники', 'description' => 'Беспроводные наушники', 'master_id' => $admin->id]),
            
            Thing::factory()->create(['name' => 'Книги', 'description' => 'Коллекция книг', 'master_id' => $user1->id]),
            Thing::factory()->create(['name' => 'Велосипед', 'description' => 'Горный велосипед', 'master_id' => $user1->id]),
            
            Thing::factory()->create(['name' => 'Фотоаппарат', 'description' => 'Зеркальный фотоаппарат', 'master_id' => $user2->id]),
            Thing::factory()->create(['name' => 'Инструменты', 'description' => 'Набор инструментов', 'master_id' => $user2->id]),
        ];

        $places = [
            Place::factory()->create(['name' => 'Гараж', 'description' => 'Основное место хранения']),
            Place::factory()->create(['name' => 'Кладовая', 'description' => 'Внутренняя кладовая']),
            Place::factory()->create(['name' => 'Антресоли', 'description' => 'Верхние полки']),
            Place::factory()->create(['name' => 'Ремонтная зона', 'description' => 'Место для ремонта', 'repair' => true]),
            Place::factory()->create(['name' => 'Рабочий стол', 'description' => 'Ежедневное использование', 'work' => true]),
        ];

        Usage::create([
            'thing_id' => $things[0]->id,
            'place_id' => $places[4]->id,
            'user_id' => $admin->id,
            'amount' => 1,
        ]);

        Usage::create([
            'thing_id' => $things[1]->id,
            'place_id' => $places[2]->id,
            'user_id' => $admin->id,
            'amount' => 1,
        ]);

        Usage::create([
            'thing_id' => $things[3]->id,
            'place_id' => $places[1]->id,
            'user_id' => $user2->id,      
            'amount' => 3,
        ]);

        Usage::create([
            'thing_id' => $things[6]->id,
            'place_id' => $places[3]->id,
            'user_id' => $user1->id,    
            'amount' => 1,
        ]);
    }
}