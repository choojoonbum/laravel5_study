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

Route::resource('posts', 'PostsController');
//Route::resource('posts.comments', 'PostCommentController');


Route::get('/', [
    'as' => 'root',
    'uses' => 'WelcomeController@index'
]);

Route::get('home', [
    'as' => 'home',
    'uses' => 'WelcomeController@home'
]);

/* User Registration */
Route::group(['prefix' => 'auth', 'as' => 'user.'], function () {
    Route::get('register', [
        'as'   => 'create',
        'uses' => 'Auth\AuthController@getRegister'
    ]);
    Route::post('register', [
        'as'   => 'store',
        'uses' => 'Auth\AuthController@postRegister'
    ]);
});


/* Session */
Route::group(['prefix' => 'auth', 'as' => 'session.'], function () {
    Route::get('login', [
        'as'   => 'create',
        'uses' => 'Auth\AuthController@getLogin'
    ]);
    Route::post('login', [
        'as'   => 'store',
        'uses' => 'Auth\AuthController@postLogin'
    ]);
    Route::get('logout', [
        'as'   => 'destroy',
        'uses' => 'Auth\AuthController@getLogout'
    ]);
    /* Social Login */
    Route::get('github', [
        'as'   => 'github.login',
        'uses' => 'Auth\AuthController@redirectToProvider'
    ]);
    Route::get('github/callback', [
        'as'   => 'github.callback',
        'uses' => 'Auth\AuthController@handleProviderCallback'
    ]);
});

/* Password Reminder */
Route::group(['prefix' => 'password'], function () {
    Route::get('remind', [
        'as'   => 'reminder.create',
        'uses' => 'Auth\PasswordController@getEmail'
    ]);
    Route::post('remind', [
        'as'   => 'reminder.store',
        'uses' => 'Auth\PasswordController@postEmail'
    ]);
    Route::get('reset/{token}', [
        'as'   => 'reset.create',
        'uses' => 'Auth\PasswordController@getReset'
    ]);
    Route::post('reset', [
        'as'   => 'reset.store',
        'uses' => 'Auth\PasswordController@postReset'
    ]);
});

Route::pattern('image', '(?P<parent>[0-9]{2}-[\pL\pN\._-]+)-(?P<suffix>image-[0-9]{2}.png)');
Route::group(['prefix' => 'docs', 'as' => 'documents.'], function () {
    Route::get('{image}', [
        'as'   => 'image',
        'uses' => 'DocumentsController@image'
    ]);
    Route::get('{file?}', [
        'as'   => 'show',
        'uses' => 'DocumentsController@show'
    ]);
});

Route::get('locale', [
    'as' => 'locale',
    'uses' => 'WelcomeController@locale'
]);

Route::resource('articles', 'ArticlesController');

Route::get('mail', function() {
    $to = 'YOUR@EMAIL.ADDRESS';
    $subject = 'Studying sending email in Laravel';
    $data = [
        'title' => 'Hi there',
        'body'  => 'This is the body of an email message',
        'user'  => App\User::find(1)
    ];

    return Mail::send('emails.welcome', $data, function($message) use($to, $subject) {
        $message->to($to)->subject($subject);
    });
});

/*
Route::get('auth', function () {
    $credentials = [
        'email'    => 'john@example.com',
        'password' => 'password'
    ];

    if (! Auth::attempt($credentials)) {
        return 'Incorrect username and password combination';
    }

    Event::fire('user.login', [Auth::user()]);

    var_dump('Event fired and continue to next line...');

    return;
});

Event::listen('user.login', function($user) {
    $user->last_login = (new DateTime)->format('Y-m-d H:i:s');
    return $user->save();
});
*/
/*
DB::listen(function($sql, $bindings, $time){
    var_dump($sql);
    var_dump($bindings);
});
*/