<?php

namespace App\Http\Controllers;

//use Illuminate\Validation\Validator;
use App\Http\Requests\PageRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Validator;


class PagesController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware();
    }

    public function auth(){
        return view('welcome');
        //return view('auth.passwords.email');
        //return view('auth.passwords.reset');
    }

    public function index(Request $request, $page = 1){
        /*if($request->isMethod('post')){

            $rules = [
                'name' => 'required|max:5|confirmed|exists:users,name',
                'last_name' => 'required|unique:users,name', //digits:4|
                'phone' => 'between:3,6|in:111,222',
                //'phone' => 'boolian',
            ];
            $this->validate($request, $rules);
            echo "!";
        }*/
        if($request->isMethod('post')){
            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению!',
                'name.required' => 'Поле :attribute обязательно к заполнению!', //only for name
                'max' => 'Телефон должен быть не более :max символов',
            ];
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'max:5',
            ], $messages);

            $validator->after(function($validator){
                $validator->errors()->add("name", "new message!");
            });
            $validator->sometimes(['name'], ['required'], function($input){
                return strlen($input->phone)>3;
                //return true;
            });

            if($validator->fails()){

                dump($validator->errors()->all("<p>:message</p>")); // dump($validator->errors()->first('name'));
                dump($validator->errors()->get('name'));
                dump($validator->failed());
                //return redirect()->route("pages_route")->withErrors($validator)->withInput();

            }
        }


        //$request->flash();
        //print_r($request->session()->all());
        //print_r($errors);

        ////////////////
        echo "<pre><h3>Page: $page</h3>";
        print_r($request->all());
        //print_r($request->only('name', 'phone'));
        //print_r($request->except('name'));
        //print_r($request->header());
        //print_r($request->server());

        //echo "address: ".$request->input('address', "Odessa");
        if($request->has("phone9") or $request->exists('phone9')){
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



        //echo "<br>Hi it is all pages";

        $title = "PAGES INDEX";
        $header = "POSTS";

        if(view()->exists('pages.index')){
            //view()->name("pages.index", 'alias1');
            //return view()->of("alias1", compact('title', 'header'));

            //$result = $request->session()->all();//получаем данные из сессии
            //$token = $result['_token'];

            $answer = view('pages.index', compact('title', 'header'))->render();
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
