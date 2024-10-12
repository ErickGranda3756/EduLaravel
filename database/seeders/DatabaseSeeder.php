<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Llamar al seeder de roles */
        $this->call(RolSeeder::class);
        /* LLamar al seeder de usuarios */
        $this->call(UserSeeder::class);
        
        //eliminar carpeta articles
        Storage::deleteDirectory('articles');

        //eliminar la carpeta categories
        Storage::deleteDirectory('categories');

            //crear carpeta articles
        Storage::makeDirectory('articles');

            //Crea la carpeta categories
        Storage::makeDirectory('categories');
        /* Factories */
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();
    }
}
