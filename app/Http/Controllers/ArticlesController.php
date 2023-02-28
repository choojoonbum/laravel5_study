<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\ArticlesRequest;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('accessible', ['except' => ['index', 'show', 'create','store']]);

        view()->share('allTags', \App\Tag::with('articles')->get());
        parent::__construct();
    }

    public function index()
    {
        $articles = Article::with('comments', 'author', 'tags')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::with('comments', 'author', 'tags')->findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        $article = new Article;
        return view('articles.create', compact('article'));
    }

    public function store(ArticlesRequest $request)
    {
        $article = Article::create($request->all());
        flash()->success(trans('forum.created'));

        return redirect(route('articles.index'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    public function update(ArticlesRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->except('_token', '_method'));
        flash()->success(trans('forum.updated'));

        return redirect(route('articles.index'));
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();
        flash()->success(trans('forum.deleted'));

        return redirect(route('articles.index'));
    }
}
