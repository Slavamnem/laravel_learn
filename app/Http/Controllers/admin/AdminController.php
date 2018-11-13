<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class AdminController extends Controller
{
    //
    public $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware(['auth']);
    }

    public function show(){
        //
        if(Auth::viaRemember()){
            echo "<br>cookie login<br>";
        }
        if(Auth::check()){
            $user = Auth::user();
            echo $user->name;
            //$user->name = "User1!";
            $user->save();
            dump(Auth::id());
            dump($this->request->user());
        }
        else{
            $user = User::find(5);
            Auth::login($user); //Auth::loginUsingId(5); //once()
            Auth::logout();

            dump(Auth::check());
            dump(Auth::id());
            echo "<h4>Please Log in!</h4>";
            // return redirect('/login');
        }

        //
        return view('welcome');
    }

}
