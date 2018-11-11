<?php

namespace App\Http\Controllers;

use App\Article;
use App\Country;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function con2(){
        $country = Country::find(1);
        $user2 = User::find(2);

        $country->user()->associate($user2);
        //$country->save();

        $article = Article::find(1);
        $article->user()->associate($user2);
        //$article->save();

        // belongsToMany

        $role = Role::find(1);
        //$user2->roles()->attach($role->id);
        //$role->users()->attach($user2->id);
        $role->users()->detach($user2->id);
    }
    public function con(){
        //$users = User::with('articles', 'roles')->get();
        $users = User::has('articles', ">", "3")->get(); // only who has more than 3 articles
        foreach ($users as $user) {
            //dump($user);
        }
        //

        $user = User::find(2);
        $article = new Article([
            "name" => "N1",
            "text" => "T1",
            "img" => "I1",
        ]);
        $article2 = new Article([
            "name" => "N2",
            "text" => "T2",
            "img" => "I2",
        ]);
        $article3 = new Article([
            "name" => "N3",
            "text" => "T3",
            "img" => "I3",
        ]);
        //$user->articles()->saveMany([$article, $article2, $article3]);
        //$user->articles()->save($article);
//        $user->articles()->create([
//            "name" => "N1",
//            "text" => "T1",
//            "img" => "I1",
//        ]);

        $role = new Role([
            'name' => 'ceo'
        ]);
        //$user->roles()->save($role);

        ///
        ///
        //$user->articles()->where('id', 68)->update(['name'=>'N3!!!']);
    }


    public function index(){
        echo "USER CONTROLLER<br>";

        $role = Role::find(1);
        dump($role->users);

        $user = User::find(1);

        dump($user->roles);
        //dump($user->country);
        echo $user->country->name;
        //dump($user->articles()->where('id', "=", 50)->first());

        $country = Country::find(1);
        //dump($country->user);
        echo $country->user->name;


    }
}
