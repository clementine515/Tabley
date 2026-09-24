<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Restaurant;
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
        /// 1. 固定ユーザーの作成（ログインテスト用）
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $manager = User::create([
            'name' => 'Restaurant Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        $testUser = User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 2. エリアデータの作成 (英語表記)
        $areas = ['Tokyo', 'Osaka', 'Fukuoka', 'Kyoto', 'Hokkaido'];
        $areaModels = [];
        foreach ($areas as $areaName) {
            $areaModels[] = Area::create(['area_name' => $areaName]);
        }

        // 3. ジャンルデータの作成 (5つの指定ジャンル)
        $genres = ['Sushi', 'Yakiniku', 'Italian', 'Izakaya', 'Ramen'];
        $genreModels = [];
        foreach ($genres as $genreName) {
            $genreModels[] = Genre::create(['genre_name' => $genreName]);
        }

        // 4. サンプルレストランデータの作成（英語）
        Restaurant::create([
            'manager_id' => $manager->id,
            'area_id' => $areaModels[0]->id, // Tokyo
            'genre_id' => $genreModels[0]->id, // Sushi
            'restaurant_name' => 'Sushi Ginza Master',
            'description' => 'Enjoy authentic Edomae sushi prepared by master chefs using fresh seafood directly shipped from Toyosu Market.',
            'photo_url' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c',
        ]);

        Restaurant::create([
            'manager_id' => $manager->id,
            'area_id' => $areaModels[1]->id, // Osaka
            'genre_id' => $genreModels[1]->id, // Yakiniku
            'restaurant_name' => 'Yakiniku Prime Namba',
            'description' => 'Premium A5 Wagyu beef grilled to perfection over natural charcoal. Ideal for anniversary and business dinners.',
            'photo_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947',
        ]);

        Restaurant::create([
            'manager_id' => $manager->id,
            'area_id' => $areaModels[3]->id, // Kyoto
            'genre_id' => $genreModels[2]->id, // Italian
            'restaurant_name' => 'Trattoria Kyoto Bella',
            'description' => 'Modern Italian dining incorporating fresh local Kyoto vegetables and handmade pasta with fine Italian wines.',
            'photo_url' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5',
        ]);

    }
}
