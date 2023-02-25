<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use Validator;
class PostsController extends Controller
{
    public function index()
    {
        //$posts = App\Post::get();
        //$posts = App\Post::with('user')->get();
        //$posts->load('user');
        $posts = Post::with('user')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, Post::$rules);
        return '[' . __METHOD__ . '] ' . 'validate the form data from the create form and create a new instance';
    }

    public function show($id)
    {
        return '[' . __METHOD__ . '] ' . 'respond an instance having id of ' . $id;
    }

    public function edit($id)
    {
        return '[' . __METHOD__ . '] ' . 'respond an edit form for id of ' . $id;
    }

    public function update(Request $request, $id)
    {
        return '[' . __METHOD__ . '] ' . 'validate the form data from the edit form and update the resource having id of ' . $id;
    }

    public function destroy($id)
    {
        return '[' . __METHOD__ . '] ' . 'delete resource ' . $id;
    }
}
