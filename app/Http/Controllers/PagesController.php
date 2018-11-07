<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{
    //
    public function index(Request $request, $page = 1){
        echo "<pre><h3>Page: $page</h3>";
        print_r($request->all());
        print_r($request->only('name', 'phone'));
        print_r($request->except('name'));
        print_r($request->header());
        print_r($request->server());

        echo "address: ".$request->input('address', "Odessa");
        if($request->has("phone") or $request->exists('phone')){
            echo "<br>phone: ".$request->input('phone');
            echo "<br>".$request->page."<hr>";
            echo "<br>".$request->path();
            echo "<br>".$request->url();
            echo "<br>".$request->fullUrl();
            echo "<br>".$request->method();
            if($request->isMethod("get")){

//                $request->flash();
                $request->flashOnly('name');
                //$request->flush();
                echo $request->old('name');
                print_r($request->session()->all());
                echo "<br>GET realy!";

            }
        }
        echo "</pre>";



        echo "<br>Hi it is all pages";

        $title = "PAGES INDEX";
        $header = "POSTS";

        if(view()->exists('pages.index')){
            //view()->name("pages.index", 'alias1');
            //return view()->of("alias1", compact('title', 'header'));

            $result = $request->session()->all();//получаем данные из сессии
            $token = $result['_token'];

            $answer = view('pages.index', compact('title', 'header', 'token'))->render();
            echo view('pages.index', compact('title', 'header'))->getPath();
            echo $answer;
            //return view('pages.index', compact('title', 'header'));
        }
        else{
            abort(404);
        }
    }
    public function show($id = 1){

        $view = view('pages.index', ['title' => 'response1', 'header' => 'default'])->render();
        //return (new Response($view))->header("Content-Type", 'my_type');//, 202, ["Content-Type" => 'my_type']);

        //return response($view);
        //return response()->view('')->header('', '');
        //return response()->json(['name' => "Alex", 'phone' => 34343434, 'address' => "Kiev"]);
        //return response()->download("form.php", "File For You");

        //return redirect("/");
        //return redirect()->action("PagesController@index");

        return response()->Res1("hi");

        echo "get show: ".$id;
    }
}
