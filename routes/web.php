<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'home', function () {
//    return view('welcome');

    $title = "My laravel";
    $headers = ['hed1', 'hed2', 'hed3'];

    return view('pages.page', compact('title', 'headers'))->withHeader("POSTS HERE");
}]);

////////////////// Controllers //////////////////////////////
Route::get('/about/{id?}', 'FirstController@about');

Route::get('/articles/index/{id?}', 'ArticleController@index');
Route::get('/articles/model', 'ArticleController@model');
Route::get('/articles/connections', 'ArticleController@connections');
Route::resource('/articles', 'ArticleController');
//
Route::get('/users/con', "UserController@con");
Route::get('/users/con2', "UserController@con2");
Route::resource('/users', 'UserController');
//
//Route::get('/pages/foo/{id?}', 'ResourceController@foo');
//Route::resource('/pages', 'ResourceController');
//
//

//Route::group(['middleware' => ['web']], function() {
    Route::get('/pages/show/{id?}', 'PagesController@show');//->middleware(['mymiddle:ggg1']);
    Route::get('/pages/auth', 'PagesController@auth');
    Route::match(['get', 'post'], '/pages/{page?}', ['uses' => 'PagesController@index', 'as' => 'pages_route']);
//});
//Route::resource('/pages', ['uses' => 'PagesController']);//->name("pages_route");
/////////////////////////////////////////////////////////////

Route::get('/form.html', function(){
    include "../public/form.html";
    return "form";
});

/////////////////////////////////
//Route::get('/page/{cat?}/{id?}', function ($cat = "def", $id = 1) {
//    return view('page', ['id' => $id]);
//});//->where(array('cat' => "[A-Za-z]+", 'id' => "[0-9]+"));
/////////////////////////////////
///
/*Route::group(['prefix' => 'admin', 'middleware' => ['mymiddle', 'auth']], function(){
    //echo "1";
    Route::get('page/create', function(){
        //return redirect()->route('home');
        echo "create";
    });
    Route::get('page/edit', [function(){
        echo route('home', array());
        echo "<br>edit<br>";

        $route = Route::current();
        echo $route->getName();

    }, 'middleware' => 'mymiddle'])->name('Editor');
});*/

Route::get('/env', function(){
    //echo $id;
    echo config('app.locale');
    echo "<pre>";
    print_r($_ENV);
    echo "</pre>";
    //return view('page');
    ?>
    <form action="/comments" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="text" name="name">
        <input type="text" name="phone">
        <button type="submit">Send</button>
    </form>
    <?
});


//Route::get('form.php', function () {
//    return 'form';
//});
Route::match(['post', 'get'], '/comments', function(){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
});
Route::any('/comments', function(){
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
});



Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

//admin
Route::group(['prefix' => 'admin', 'middleware' => ['web']], function(){

    Route::get('/', ['uses' => 'Admin\AdminController@show', 'as' => 'admin_index']);
    Route::get('/add/post', ['uses' => 'Admin\AdminPostController@create', 'as' => 'admin_add_post']);

});