<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use App\Http\Requests\ArticlesRequest;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('author:article', ['except' => ['index', 'show', 'create','store']]);

        view()->share('allTags', \App\Tag::with('articles')->get());
        parent::__construct();
    }

    public function index($id = null)
    {
        $query = $id ? Tag::find($id)->articles() : new Article;
        $articles = $query->with('comments', 'author', 'tags')->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::with('comments', 'author', 'tags')->findOrFail($id);
        $commentsCollection = $article->comments()->with('replies', 'author')->whereNull('parent_id')->latest()->get();
        return view('articles.show', [
            'article'         => $article,
            'comments'        => $commentsCollection,
            'commentableType' => Article::class,
            'commentableId'   => $article->id
        ]);
    }

    public function create()
    {
        $article = new Article;
        return view('articles.create', compact('article'));
    }

    public function store(ArticlesRequest $request)
    {
        $payload = array_merge($request->except('_token'), [
            'notification' => $request->has('notification')
        ]);

        $article = $request->user()->articles()->create($payload);
        $article->tags()->sync($request->input('tags'));
        flash()->success(trans('forum.created'));

        if ($request->has('attachments')) {
            $attachments = \App\Attachment::whereIn('id', $request->input('attachments'))->get();
            $attachments->each(function($attachment) use($article) {
                $attachment->article()->associate($article);
                $attachment->save();
            });
        }

        return redirect(route('articles.index'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('articles.edit', compact('article'));
    }

    public function update(ArticlesRequest $request, $id)
    {
        $payload = array_merge($request->except('_token'), [
            'notification' => $request->has('notification')
        ]);

        $article = Article::findOrFail($id);
        $article->update($payload);
        $article->tags()->sync($request->input('tags'));
        flash()->success(trans('forum.updated'));

        return redirect(route('articles.index'));
    }

    public function destroy($id)
    {
        $article = Article::with('attachments', 'comments')->findOrFail($id);

        foreach($article->attachments as $attachment) {
            \File::delete(attachment_path($attachment->name));
        }

        $article->attachments()->delete();
        $article->comments->each(function($comment) { // foreach 로 써도 된다.
            app(\App\Http\Controllers\CommentsController::class)->recursiveDestroy($comment);
        });
        $article->delete();

        flash()->success(trans('forum.deleted'));

        return redirect(route('articles.index'));
    }
}
