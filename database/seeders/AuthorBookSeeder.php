<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books_count = Book::all()->count();
        $authors_count = Author::all()->count();

        if(0 === $books_count) {
            $this->command->info('No books found, skipping assigning books to authros');
            return;
        } elseif(0 === $authors_count) {
            $this->command->info('No authors found, skipping assigning authors to books');
            return;
        }

        $howManyMin =  max((int)$this->command->ask('Minimum authors on book?', 1), 1);
        $howManyMax = min((int)$this->command->ask('Maximum authors on book?', 3), $authors_count);

        Book::all()->each(function (Book $book) use($howManyMin, $howManyMax) {
            $take = random_int($howManyMin, $howManyMax);

            $authros = Author::inRandomOrder()->take($take)->get()->pluck('id');
            $book->authors()->sync($authros);
        });
    }
}
