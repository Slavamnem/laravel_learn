<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        DB::insert("INSERT INTO article (name, text, img) VALUES(?, ?, ?)",
//            ['politic', '<p>it is hot new!!</p>', 'def.png']
//        );
//
//        DB::table('article')->insert(
//            [
//                'name' => "sport new1",
//                'text' => "sport new text full",
//                'img' => "sp.jpg",
//            ]
//        );
//
//        Article::create(
//            [
//                'name' => "sport new2",
//                'text' => "sport new 2 text full",
//                'img' => "sp2.jpg",
//            ]
//        );

        DB::table('article')->insert(Article::getData());
    }
}
