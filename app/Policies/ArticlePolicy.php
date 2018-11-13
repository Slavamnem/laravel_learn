<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
//    public function before($user){
//        foreach( $user->roles as $role){
//            if($role->name == "admin"){
//                return true;
//            }
//        }
//        return false;
//    }
    public function add($user){
        //if($user->name == "User1!"){ return true; }
        //else{ return false; }
        $roles = $user->roles;
        foreach($roles as $role){
            if($role->name == "admin"){
                return true;
            }
        }
        return false;
    }
    public function update(User $user, Article $article){
        //if($user->name == "User1!"){ return true; }
        //else{ return false; }
        $roles = $user->roles;
        foreach($roles as $role){
            if($role->name == "admin"){
                if($user->id == $article->user_id){
                    return true;
                }
            }
        }
        return false;
    }
}
