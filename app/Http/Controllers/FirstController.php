<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

class FirstController extends Controller{

    public function about($id = 1){
        echo $id."<br>";
        echo __METHOD__;
    }
    public function getArticles(){
        print_r(['first', 'second', 'third']);
    }
}