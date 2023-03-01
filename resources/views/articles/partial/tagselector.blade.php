<div class="form-group">
    <label for="tags">{{ trans('forum.tags') }}</label>
    <select class="form-control" multiple="multiple" id="tags" name="tags[]">
        @foreach($allTags as $tag)
            <option value="{{ $tag->id }}" {{ in_array($tag->id, $article->tags->lists('id')->toArray()) ? 'selected="selected"' : '' }}>{{ $tag->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('tags', '<span class="form-error">:message</span>') !!}
</div>
