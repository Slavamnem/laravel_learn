<?php

namespace App\Http\Controllers;

use DeepCopy\f001\A;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Article;

class ArticleController extends Controller
{
    //

    public function index($id = 1)
    {
        echo "<h3>All articles</h3>";

        $articles = DB::select("SELECT * FROM article WHERE id < :id", ["id" => 5]);
        echo "<pre>"; print_r($articles); echo "</pre>";
        //dump($articles);

        $article = DB::select("SELECT * FROM article WHERE id = :id", ["id" => $id]);
        echo "<pre>";
        print_r($article);
        echo "</pre>";

        DB::insert("INSERT INTO article (name, text, img) VALUES (?, ?, ?)", ["test1", "text2", "img1"]);

        $last_id = DB::connection()->getPdo()->lastInsertId();
        echo $last_id;

        DB::update("UPDATE article SET name = 'SPORT !!!' WHERE id = :id", ['id' => $id]);

        DB::delete("DELETE FROM article WHERE id > :id", ['id' => 10]);

        //DB::statement("DROP table article2");
    }

    public function connections(){
        echo "Connection";

        $article = Article::find(1);
        //dump($article->user);
        //echo $article->user->password;

        $articles = Article::all();
        $articles->load("user");
        //$articles = Article::with("user")->get();
        foreach($articles as $article){
            $article = $article->toArray();
            dump($article);
            $article->name .= ".";
            //$article->save();
            //echo $article->user->name;
        }

        $article = new Article();
        $article->name = "5";
        $article->text = ['key' => "hi", "by" => "ok!"];
        $article->img = "6";
        //$article->save();

    }

    public function model(){
        echo "model work";

        $articles = Article::all();
        $articles = Article::where('id', '=', 2)
            ->orderBy('img')->take(5)->get();
        //dump($articles);
        foreach($articles as $article){
            echo $article->name."<br>";
        }
        dump($articles);

        $article = Article::find(1); // find([1, 2, 3])
        $article = Article::findOrFail(1);
        dump($article);
        echo $article->text;

        //insert
        $article = new Article();
        $article->name = "name1";
        $article->text = "text1";
        $article->img = "img1";
        //$article->save();

        Article::create([
            'name' => 1,
            'text' => 2,
            'img' => 3
        ]);
        $article = Article::firstOrCreate([
            'name' => 1111,
            'text' => 2,
            'img' => 3
        ]);

        $article = Article::firstOrNew([ //возвращает новый или старый объект, но сразу ничего в базу не добавляет
            'name' => 1111,
            'text' => 2,
            'img' => 3
        ]);
        $article->save();

        //update
        $article = Article::find(7);
        $article->name = "name2";
        $article->text = "text2";
        $article->img = "img2";
        $article->save();

        $article = Article::where('img', "=", 'sp7.jpg')->first();
        $article->text = "NEW TEXT";
        $article->save();

        Article::where('img', "=", 'sp9.jpg')->update(['img' => 'NEW IMG']);

        //delete
        Article::where('img', "=", 'sp8.jpg')->delete();

        $article = Article::find(53);
        //$article->delete();

        //Article::destroy(54);

        $article = Article::find(58);
        $article->delete();

        //Article::withTrashed()->get(); $article->trashed()  -  $article->restore();

        //Article->onlyTrashed()->restore(); // восстановление всех удаленных записей

        //$article->forceDelete(); - жесткое удаление когда подключено мягкое
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //echo $id;
        $data = DB::table('article')->get();
        $data = DB::table('article')->first();
        $data = DB::table('article')->value("name");

        $data = DB::table('article')->count();
        $data = DB::table('article')->max('name');
        //$data = [];
//        DB::table('article')->chunk(5, function($articles){
//            foreach($articles as $article){
//                $data[] = $article;
//            }
//        })->orderBy('created_at', 'asc');
        //$data = DB::table('article')->pluck('name');


        $data = DB::table('article')->distinct()->select(['name', 'text'])->get();
        $query = DB::table('article')->distinct()->select(['name', 'text']);
        $data = $query->addSelect('img')
            ->where('id', '<', 8)
            ->where('name', 'like', 'sp%', 'or')
            ->orWhere('text', 'like', 't%')
            ->get();

        $data = DB::table('article')->select(['name', 'text'])->whereBetween('id', [1, 6])->get();
        $data = DB::table('article')->select(['name', 'text'])->whereIn('id', [1, 2, 3])->get();
        $data = DB::table('article')->select(['name', 'text'])->groupBy('id')->get();

        $data = DB::table('article')->select(['name', 'text'])->take(6)->skip(1)->get(); //limit and offset
        //dump($data);

        $res = DB::table('article')->insertGetId(
            [
                'name' => "pool new1",
                'text' => "pool new text full",
                'img' => "pool.jpg",
            ]
        );
        //dump($res);

//
        DB::table('article')->where('id', 28)->update(
            [
                'name' => 'new name!!!'
            ]
        );

        DB::table('article')->where('id', 29)->delete();

        //DB::table('article')->increment('name', 3);
    }

}


