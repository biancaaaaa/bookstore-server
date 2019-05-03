<?php

use Illuminate\Database\Seeder;
use \App\Book;
use \App\User;
use \App\Author;
use \App\Image;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        DB::table('books')->insert([
            'title' => 'Brave new world',
            'isbn' => '2342342342',
            'subtitle' => 'A new dystopia',
            'rating' => 10,
            'description' => 'bestseller worldwide',
            'published' => new DateTime()
        ]);*/
        $book = new Book();
        $book->title = 'Herr der Ringe';
        $book->isbn = '2341342342';
        $book->subtitle = 'Rückkehr der Könige';
        $book->rating = 9;
        $book->price = 12.99;
        $book->description = 'Letzter Teil der Trilogie';
        $book->published = new DateTime();

        // get first user from db
        $user = User::all()->first();
        $book->user()->associate($user);
        $book->save();

        $authors = Author::all()->pluck('id');
        $book->authors()->sync($authors);
        $book->save();

        $image1 = new Image();
        $image1->title = "Cover1";
        $image1->url = "https://images-na.ssl-images-amazon.com/images/I/51VKKN0KZEL._SY445_.jpg";
        $image1->book()->associate($book);
        $image1->save();

        $image2 = new Image();
        $image2->title = "Cover2";
        $image2->url = "https://images-na.ssl-images-amazon.com/images/I/51ZV53S7ZTL._SY445_.jpg";
        $image2->book()->associate($book);
        $image2->save();

        // $book->images()->saveMany([$image1, $image2]);
        // saves book in db
        $book->save();
        // Element in Beziehung einfügen
        /*
        $book->images()->save($image);
        $book->images()->saveMany([$image1, $image2]);
        $book->user()->associate($user1);
        $book->save();
        $book->user()->dissociate($user1);
        $book->save();

        //m:n Beziehungen
        $book->authors()->attach($authorId);
        $book->authors()->detach($authorId);
        $book->authors()->detach(); // all authors will be detached

        $book->authors()->sync([1, 2, 3]); // exactly these authors will be in there - rest will be added or kicked
        */
        /*
        $book = Book::find(1);
        $book->title = 'Dark Tower';
        $book->save();
        // delete
        $book->delete();
        // findOrCreate updateOrCreate
        $book = Book::findOrCreate(['title'=>'Buchtitel']);
        $book = Book::updateOrCreate(['title'=>'Buchtitel'], ['description'=>'Neue Beschreibung']);
        */

        $book1 = new Book();
        $book1->title = 'Friedhof der Kuscheltiere';
        $book1->isbn = '4645645745';
        $book1->subtitle = 'One of the best thrillers';
        $book1->rating = 10;
        $book1->price = 14.99;
        $book1->description = 'Stephen King rules';
        $book1->published = new DateTime();

        // get first user from db
        $user = User::all()->first();
        $book1->user()->associate($user);
        $book1->save();

        $authors = Author::all()->pluck('id');
        $book1->authors()->sync($authors);
        $book1->save();

        $image3 = new Image();
        $image3->title = "Cover1";
        $image3->url = "https://images-na.ssl-images-amazon.com/images/I/51eezd0h7uL._SX313_BO1,204,203,200_.jpg";
        $image3->book()->associate($book1);
        $image3->save();

        $image4 = new Image();
        $image4->title = "Cover2";
        $image4->url = "https://www.kingwiki.de/images/2/22/Friedhof_der_Kuscheltiere_Weltbild.jpg";
        $image4->book()->associate($book1);
        $image4->save();

        // $book->images()->saveMany([$image1, $image2]);
        // saves book in db
        $book1->save();
    }
}
