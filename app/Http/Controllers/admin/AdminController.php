<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

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
        if(Auth::check()){
            $user = Auth::user();
            echo $user->name;
            $user->name = "User1!";
            $user->save();
            dump(Auth::id());
            dump($this->request->user());
        }
        else{
            echo "<h4>Please Log in!</h4>";
            // return redirect('/login');
        }

        //
        return view('welcome');
    }

}
