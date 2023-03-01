<?php

namespace App\Http\Controllers;

use App\Attachment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AttachmentsController extends Controller
{
    public function store(Request $request)
    {

        if (! $request->hasFile('file')) {
            return response()->json('File not passed !', 422);
        }

        $file = $request->file('file');
        $name = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->move(attachment_path(), $name);

        $articleId = $request->input('articleId');

        $attachment = $articleId
            ? \App\Article::findOrFail($articleId)->attachments()->create(['name' => $name])
            : \App\Attachment::create(['name' => $name]);

        return response()->json([
            'id'   => $attachment->id,
            'name' => $name,
            'type' => $file->getClientMimeType(),
            'url'  => sprintf("/attachments/%s", $name),
        ]);
    }

    public function destroy($id)
    {
        $attachment = \App\Attachment::findOrFail($id);

        $path = attachment_path($attachment->name);
        if (\File::exists($path)) {
            \File::delete($path);
        }

        $attachment->delete();

        if (\Request::ajax()) {
            return response()->json(['status' => 'ok']);
        }

        flash()->success(trans('forum.deleted'));

        return back();
    }
}
