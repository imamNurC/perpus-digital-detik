<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 10; $i++) {
            DB::table('books')->insert([
                'title' => 'Book ' . $i,
                'category_id' =>  $i,
                'description' => 'Description for Book ' . $i,
                'quantity' => rand(1, 100),
                'pdf_path' => 'path/to/pdf/book_' . $i . '.pdf',
                'cover_image_path' => 'path/to/images/cover_' . $i . '.jpg',
                'user_id' => 1,
            ]);
        }
    }
}
