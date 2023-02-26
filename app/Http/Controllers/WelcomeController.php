<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['home']]);
    }

    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }
}
