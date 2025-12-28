<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // USER
        User::factory()->admin()->create([
            'full_name' => 'Admin Shop',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        User::factory(10)->create();

        // CATEGORIES
        $categories = Categories::create([
            'slug' => 'ca-phe',
            'name' => 'Cà phê',
        ]);

        // PRODUCTS
        Products::factory(8)->create([
            'category_id' => $categories->id,
        ]);
        Products::factory(4)->outOfStock()->create([
            'category_id' => $categories->id,
        ]);
    }
}
