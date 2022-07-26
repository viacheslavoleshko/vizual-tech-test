<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() // php artisan migrate:refresh --seed || php artisan db:seed (запустить заполнение без очистки базы)
    {
        $this->call([
            AuthorsSeeder::class,
            BooksSeeder::class,
            PublishersSeeder::class,
            AuthorBookSeeder::class,
            BookPublisherSeeder::class,
        ]);
    }
}
