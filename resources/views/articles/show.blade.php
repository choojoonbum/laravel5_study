@extends('layouts.master')

@section('content')
    <div class="page-header">
        ...
    </div>

    <div class="row container__forum">
        <div class="col-md-3 sidebar__forum">
            <aside>
                @include('layouts.partial.search')
                @include('tags.partial.index')
            </aside>
        </div>

        <div class="col-md-9">
            <article>
                @include('articles.partial.article', ['article' => $article])

                <p>
                    {!! markdown($article->content) !!}
                </p>
            </article>
            ...
            <article>
                @if (auth()->check() && ($article->isAuthor() or auth()->user()->isAdmin()))
                <div class="text-center">
                    <form action="{{ route('articles.destroy', $article->id) }}" method="post">
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}
                        <button type="submit" class="btn btn-danger">
                            {!! icon('delete') !!} Delete
                        </button>
                        <a href="{{route('articles.edit', $article->id)}}" class="btn btn-info">
                            {!! icon('pencil') !!} Edit
                        </a>
                    </form>
                </div>
                @endif
            </article>
        </div>
    </div>
@stop
