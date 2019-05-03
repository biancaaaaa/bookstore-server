<?php

use Illuminate\Database\Seeder;
use \App\Author;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = new Author();
        $author1->firstName = 'Max';
        $author1->lastName = 'Mustermann';
        $author1->save();

        $author2 = new Author();
        $author2->firstName = 'Susi';
        $author2->lastName = 'Musterfrau';
        $author2->save();

        $author3 = new Author();
        $author3->firstName = 'John';
        $author3->lastName = 'Doe';
        $author3->save();
    }
}
