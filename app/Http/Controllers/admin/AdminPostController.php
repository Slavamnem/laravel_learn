<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Gate;
use App\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Events\onAddArticleEvent;
use Illuminate\Support\Facades\Event;

class AdminPostController extends Controller
{
    //
    public $request;
    public function __construct(Request $request){
        $this->middleware(['auth']);
        $this->request = $request;
    }
    public function session()
    {
        echo "session<br>";
        //////////////////
        /*
        $result = $this->request->session()->get('key', 'default');
        dump($result);
        if (!$this->request->session()->has('time')){
            $this->request->session()->put('time', 'now');
        }
        dump($this->request->session()->all());
        */
        //$this->request->session()->put('categories.phone', '5');
        //$this->request->session()->push('categories', '20');

        //dump(Session::get('key', 'default'));
        //dump(Session::all());
        Session::forget('key');
        //Session::flush(); // clear all
        //Session::pull('key); //get and delete
        Session::flash('success', "Congratulations");
        Session::reflash(); //все флешки сохраняются еще на один раз

        //session(['key' => "17"]);
        dump(session('key', 'none'));
    }
    public function add()
    {
        return view('admin.add');
    }

    public function create()
    {
        $article = new Article;
        //if(Gate::denies('add-article', Auth::user())) { // usual Gate
        /*if(Gate::denies('add', $article)){//}, Auth::user())) {
            echo "Error!!!";
        }*/
        $this->authorize('add', new Article());
        if($this->request->user()->cannot('add', $article)){
            echo "Error!!!";
        }
        else {
            $data = $this->request->all();
            $this->validate($this->request, [
                'name' => 'required',
            ]);
            $user = Auth::user();
            $res = $user->articles()->create([
                'name' => $data['name'],
                'text' => $data['text'],
                'img' => $data['img'],
            ]);
            Event::fire(new onAddArticleEvent($res, $user));

            return redirect()->back()->with('message', 'Post was added!');
        }
    }

    public function change($id)
    {
        $article = Article::find($id);
        //dump($article);
        //echo $article->text;

        return view('admin.update', compact('article'));
    }

    public function update()
    {
        $data = $this->request->all();
        $this->validate($this->request, [
            'name' => 'required',
        ]);

        $user = Auth::user();
        $article = Article::find($data['id']);

        //if(Gate::denies('update-article', $user, $article)) {
        if($this->request->user()->cannot('update', $article)) {
            echo "Error!!!";
        }
        else{
            $article->name = $data['name'];
            $article->text = $data['text'];
            $article->img = $data['img'];
            $user->articles()->save($article);
//        $user->articles()->where('id', $data['id'])->update([
//            'name' => $data['name'],
//            'text' => $data['text'],
//            'img' => $data['img'],
//        ]);
            return redirect()->back()->with('message', 'Post was updated!');
        }
    }
}
