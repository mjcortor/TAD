<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
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
        // Crear categorías
        $categories = Category::factory(8)->create();

        // Crear productos y asociarlos a categorías
        Product::factory(20)->create()->each(function ($product) use ($categories) {
            $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        // Crear usuario de prueba
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@reposa.com',
            'password' => bcrypt('password'),
        ]);
    }
}
