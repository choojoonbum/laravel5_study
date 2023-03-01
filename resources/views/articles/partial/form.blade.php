<div class="form-group">
    <label for="title">{{ trans('forum.title') }}</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $article->title) }}"/>
    {!! $errors->first('title', '<span class="form-error">:message</span>') !!}
</div>

<div class="form-group">
    <label for="content">{{ trans('forum.content') }}</label>
    <textarea name="content" class="form-control forum__content" rows="10">{{ old('content', $article->content) }}</textarea>
    {!! $errors->first('content', '<span class="form-error">:message</span>') !!}
    <div class="preview__forum">{{ markdown(old('content', 'Preview will be shown here...')) }}</div>
</div>

@include('layouts.partial.markdown')

<div class="form-group">
    <label for="my-dropzone">
        Files
        <small class="text-muted">
            Click to attach files <i class="fa fa-chevron-down"></i>
        </small>
        <small class="text-muted" style="display: none;">
            Click to close pane <i class="fa fa-chevron-up"></i>
        </small>
    </label>
    <div id="my-dropzone" class="dropzone"></div>
</div>

<div class="form-group">
    @include('articles.partial.tagselector')
</div>

<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="notification" checked="{{ $article->notification ?: 'checked' }}">
            {{ trans('forum.notification') }}
        </label>
    </div>
</div>

<script>
    /* Modal window for Markdown Cheatsheet */
    $("#md-caller").on("click", function(e) {
        e.preventDefault();
        $("#md-modal").modal();
        return false;
    });

    $("select#tags").select2({
        placeholder: "{{ trans('forum.tags_help') }}",
        maximumSelectionLength: 3
    });

    var dropzone  = $("div.dropzone"),
        dzControl = $("label[for=my-dropzone]>small");

    dzControl.on("click", function(e) {
        dropzone.fadeToggle(0);
        dzControl.fadeToggle(0);
    });

    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("div#my-dropzone", {
        url: "/files",
        params: {
            _token: "{{ csrf_token() }}",
            articleId: "{{ $article->id }}"
        }
    });

    var insertImage = function(objId, imgUrl) {
        var caretPos = document.getElementById(objId).selectionStart;
        var textAreaTxt = $("#" + objId).val();
        var txtToAdd = "![](" + imgUrl + ")";
        $("#" + objId).val(
            textAreaTxt.substring(0, caretPos) +
            txtToAdd +
            textAreaTxt.substring(caretPos)
        );
    };

    myDropzone.on("success", function(file, data) {
        file._id = data.id;
        file._name = data.name;

        $("<input>", {
            type: "hidden",
            name: "attachments[]",
            class: "attachments",
            value: data.id
        }).appendTo('.form__forum');

        if (/^image/.test(data.type)) {
            console.log(data);
            insertImage('content', data.url);
        }
    });

    myDropzone.on("removedfile", function(file) {
        $.ajax({
            type: "POST",
            url: "/files/" + file._id,
            data: {
                _method: "DELETE",
                _token: $('meta[name="csrf-token"]').attr('content')
            }
        }).success(function(data) {
            console.log(data);
        })
    });
</script>
