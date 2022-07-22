<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookPublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books_count = Book::all()->count();
        $publishers_count = Publisher::all()->count();

        if(0 === $books_count) {
            $this->command->info('No books found, skipping assigning books to publishers');
            return;
        } elseif(0 === $publishers_count) {
            $this->command->info('No publishers found, skipping assigning publishers to books');
            return;
        }

        $howManyMin =  max((int)$this->command->ask('Minimum publishers on book?', 1), 1);
        $howManyMax = min((int)$this->command->ask('Maximum publishers on book?', $publishers_count), $publishers_count);

        Book::all()->each(function (Book $book) use($howManyMin, $howManyMax) {
            $take = random_int($howManyMin, $howManyMax);

            $publishers = Publisher::inRandomOrder()->take($take)->get()->pluck('id');
            $book->publishers()->sync($publishers);
        });
    }
}
