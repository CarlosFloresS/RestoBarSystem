<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\MenuEntry;
use App\Models\Table;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Carlos',
            'email' => 'carlos@example.com',
            'password' => bcrypt(123456),
            'role' => Role::Frontline,
        ]);

        User::factory()->create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => bcrypt(123456),
            'role' => Role::Kitchen,
        ]);

        Table::factory()->count(5)
            ->state(new Sequence(
                ['id' => 1, 'name' => 'Mesa 1'],
                ['id' => 2, 'name' => 'Mesa 2'],
                ['id' => 3, 'name' => 'Mesa 3'],
                ['id' => 4, 'name' => 'Mesa 4'],
                ['id' => 5, 'name' => 'Mesa 5'],
            ))
        ->create();

        MenuEntry::factory()->count(5)
            ->state(new Sequence(
                ['id' => 1, 'name' => 'Pizza', 'description' => 'Pizza de carne', 'price' => 10.00],
                ['id' => 2, 'name' => 'Hamburguer', 'description' => 'Hamburguer de carne', 'price' => 15.00],
                ['id' => 3, 'name' => 'Pasta', 'description' => 'Pasta de carne', 'price' => 12.00],
                ['id' => 4, 'name' => 'Pizza', 'description' => 'Pizza de frango', 'price' => 15.00],
                ['id' => 5, 'name' => 'Hamburguer', 'description' => 'Hamburguer de frango', 'price' => 20.00],
        ))
            ->create();
    }
}
