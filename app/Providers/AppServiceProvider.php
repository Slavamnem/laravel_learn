<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive("My1", function($var){
           return "<div>{$var}</div>";
        });

        Response::macro("Res1", function($val){
            return Response::make($val);
        });

//        DB::listen(function($query){
//           dump($query->sql);
//           //dump($query->bindings);
//        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
