<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CakeProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $cakes = [
            ['cake_flavor' => 'Chocolate', 'cake_size' => '8 inch', 'base_price' => 1200],
            ['cake_flavor' => 'Vanilla', 'cake_size' => '8 inch', 'base_price' => 1100],
            ['cake_flavor' => 'Red Velvet', 'cake_size' => '10 inch', 'base_price' => 1800],
            ['cake_flavor' => 'Ube', 'cake_size' => '10 inch', 'base_price' => 1600],
        ];

        foreach ($cakes as $cake) {
            CakeProduct::firstOrCreate(
                ['cake_flavor' => $cake['cake_flavor'], 'cake_size' => $cake['cake_size']],
                ['base_price' => $cake['base_price']]
            );
        }
    }
}
