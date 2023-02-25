<?php

namespace App;

use Illuminate\Support\Facades\File;

class Document
{
    private $directory = 'docs';

    public function get($file = null)
    {

        $file = is_null($file) ? 'index.md' : $file;
        if (! File::exists($this->getPath($file))) {
            abort(404, 'File not exist');
        }

        return File::get($this->getPath($file));
    }

    private function getPath($file)
    {
        return base_path($this->directory . DIRECTORY_SEPARATOR . $file);
    }
}
