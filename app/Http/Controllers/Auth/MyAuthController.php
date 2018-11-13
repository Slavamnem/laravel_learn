<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MyAuthController extends Controller
{
    //
    public $request;
    public function __construct(Request $request){
        $this->request = $request;
    }
    public function showLogin(){
        //return view('welcome');
        return view('auth.login');
    }
    public function authenticate(){
        $array = $this->request->all();
        $remember = $this->request->has('remember');
        if(Auth::attempt([
            'login' => $array['login'],
            'password' => $array['password'],
        ], $remember)){
            return redirect()->intended("/home");
        }
        else{
            return redirect()->back()->withInput()->withErrors([
                'login' => 'Данные аутентификации не верны!'
            ]);
        }
        //return redirect();
        //dump($array);
    }
}
