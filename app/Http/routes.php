<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    //return view('welcome');
    $greeting = 'Hello';
    return view('index')->with([
        'greeting' => 'Good morning ^^/',
        'name'     => 'Appkr',
        'items' => [
            'Apple',
            'Banana'
        ]
    ]);
    //return view('index', compact('greeting','name'));
});
*/
Route::get('/index', 'IndexController@index');

Route::resource('posts', 'PostsController');
Route::get('posts', [
    'as'   => 'posts.index',
    function() {
        return view('posts.index');
    }
]);
Route::resource('posts.comments', 'PostCommentController');

/*
Route::get('auth', function () {
    $credentials = [
        'email'    => 'john@example.com',
        'password' => 'password'
    ];

    if (! Auth::attempt($credentials)) {
        return 'Incorrect username and password combination';
    }

    return redirect('protected');
});
*/

Route::get('auth/logout', function () {
    Auth::logout();

    return 'See you again~';
});


Route::get('/', function() {
    return 'See you soon~';
});

Route::get('home', [
    'middleware' => 'auth',
    function() {
        return 'Welcome back, ' . Auth::user()->name;
    }
]);

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');