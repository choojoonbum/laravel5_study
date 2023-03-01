<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;
class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('author:comment', ['except' => ['store']]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'commentable_type' => 'required|in:App\Article',
            'commentable_id'   => 'required|numeric',
            'parent_id'        => 'numeric|exists:comments,id',
            'content'          => 'required',
        ]);

        $parentModel = "\\" . $request->input('commentable_type');
        $parentModel::find($request->input('commentable_id'))
            ->comments()->create([
                'author_id' => \Auth::user()->id,
                'parent_id' => $request->input('parent_id', null),
                'content'   => $request->input('content')
            ]);

        flash()->success(trans('forum.comment_add'));

        return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, ['content' => 'required']);

        Comment::findOrFail($id)->update($request->only('content'));
        flash()->success(trans('forum.comment_edit'));

        return back();
    }

    public function destroy(Request $request, $id)
    {
        $comment = Comment::find($id);
        $this->recursiveDestroy($comment);

        if ($request->ajax()) {
            return response()->json('', 204);
        }

        flash()->success(trans('forum.deleted'));

        return back();
    }

    public function recursiveDestroy(Comment $comment)
    {
        if ($comment->replies->count()) {
            $comment->replies->each(function($reply) {
                if ($reply->replies->count()) {
                    $this->recursiveDestroy($reply);
                } else {
                    $reply->delete();
                }
            });
        }

        return $comment->delete();
    }
}
