<?php

namespace App\Http\Controllers;

use App\Document;
use Request;
class DocumentsController extends Controller
{
    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
        parent::__construct();
    }

    public function show($file = '01-welcome.md')
    {

        $index = \Cache::remember('documents.index', 120, function () {
            return markdown($this->document->get());
        });

        $content = \Cache::remember("documents.{$file}", 120, function() use ($file) {
            return markdown($this->document->get($file));
        });

        return view('documents.index', compact('index', 'content'));
    }

    public function image($file)
    {
        $image = $this->document->image($file);
        $reqEtag = Request::getEtags();
        $genEtag = $this->document->etag($file);

        if (isset($reqEtag[0])) {
            if ($reqEtag[0] === $genEtag) {
                return response('', 304);
            }
        }

        return response($image->encode('png'), 200, [
            'Content-Type'  => 'image/png',
            'Cache-Control' => 'public, max-age=0',
            'Etag'          => $genEtag,
        ]);
    }
}
