<?php

namespace Database\Seeders;

use App\Models\Auther;
use App\Models\Book;
use App\Models\Categor;
use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $book1 = Book::create(['title' => 'haha',
                                'categor_id' => Categor::where('name' , 'reada')->first()->id,
                                'publisher_id' => Publisher::where('name' , 'name')->first()->id,
                                'title' => 'reaf',
                                'description' => 'her her hjer awe',
                                'isbn' => '000230002030',
                                'publish_year' => '1982' ,
                                'number_of_page' => '213',
                                'number_of_copy' => '3',
                                'price' => '123',
                                'cover_image' => 'images/covers/3.png']);
        $book1->auther()->attach(Auther::where('name' , 'hekra')->first());
    
    $book1 = Book::create(['title' => 'haha',
                                'categor_id' => Categor::where('name' , 'reada')->first()->id,
                                'publisher_id' => Publisher::where('name' , 'name')->first()->id,
                                'title' => 'reaf',
                                'description' => 'her her hjer awe',
                                'isbn' => '000230002030',
                                'publish_year' => '1982' ,
                                'number_of_page' => '213',
                                'number_of_copy' => '3',
                                'price' => '123',
                                'cover_image' => 'images/covers/3.png']);
        $book1->auther()->attach(Auther::where('name' , 'hekra')->first());
    
    $book1 = Book::create(['title' => 'haha',
                                'categor_id' => Categor::where('name' , 'reada')->first()->id,
                                'publisher_id' => Publisher::where('name' , 'name')->first()->id,
                                'title' => 'reaf',
                                'description' => 'her her hjer awe',
                                'isbn' => '000230002030',
                                'publish_year' => '1982' ,
                                'number_of_page' => '213',
                                'number_of_copy' => '3',
                                'price' => '123',
                                'cover_image' => 'images/covers/3.png']);
        $book1->auther()->attach(Auther::where('name' , 'hekra')->first());
    
    $book1 = Book::create(['title' => 'haha',
                                'categor_id' => Categor::where('name' , 'reada')->first()->id,
                                'publisher_id' => Publisher::where('name' , 'name')->first()->id,
                                'title' => 'reaf',
                                'description' => 'her her hjer awe',
                                'isbn' => '000230002030',
                                'publish_year' => '1982' ,
                                'number_of_page' => '213',
                                'number_of_copy' => '3',
                                'price' => '123',
                                'cover_image' => 'images/covers/3.png']);
        $book1->auther()->attach(Auther::where('name' , 'hekra')->first());
    
}
}