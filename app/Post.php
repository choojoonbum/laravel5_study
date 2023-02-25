<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body'];

    public static $rules = [
        'title' => ['required'],
        'body' => ['required', 'min:10']
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
