<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($postId)
    {
        // GET http://localhost:8000/posts/1/comments
        return '[' . __METHOD__ . "] \$postId = {$postId}";
        // [App\Http\Controllers\PostCommentController::index] $postId = 1
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($postId,$commentId)
    {
        // GET http://localhost:8000/posts/1/comments/20
        return $postId . '-' . $commentId;
        // [App\Http\Controllers\PostCommentController::show] $postId = 1, $commentId = 20
    }


}
