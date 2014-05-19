@extends('layout')

@section('head')
    <link rel="stylesheet" href="/assets/codemirror/codemirror.css"/>
@stop

@section('body')

{{ Form::open() }}
    {{ Form::textarea('markdown', $markdown, ['id' => 'markdownEditor']) }}
    {{ Form::submit('Save', ['class' => 'btn btn-default']) }}
{{ Form::close() }}

@stop

@section('foot')
    <script src="/assets/codemirror/codemirror.js"></script>
    <script src="/assets/codemirror/markdown.js"></script>
    <script>
        var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('markdownEditor'), {
            lineNumbers: true,
            lineWrapping: true
        });
    </script>
@stop