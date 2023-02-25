<?php

namespace App\Http\Controllers;

use App\Document;

class DocumentsController extends Controller
{
    protected $document;

    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    public function show($file = null)
    {
        return view('documents.index', [
            'index'   => markdown($this->document->get()),
            'content' => markdown($this->document->get($file ?: '01-welcome.md'))
        ]);
    }
}
