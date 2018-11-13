<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use App\Article;
use App\Policies\ArticlePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Article' => 'App\Policies\ArticlePolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        /*Gate::define('add-article', function ($user) {
            $roles = $user->roles;
            foreach($roles as $role){
                if($role->name == "admin"){
                    return true;
                }
            }
            return false;
        });
        Gate::define('update-article', function ($user, $article) {
            $roles = $user->roles;
            foreach($roles as $role){
                if($role->name == "admin"){
                    if($user->id == $article->user_id){
                        return true;
                    }
                }
            }
            return false;
        });*/
    }
}
