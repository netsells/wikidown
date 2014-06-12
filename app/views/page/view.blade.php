@extends('layout')

@section('body')

<a href="/{{ ($slug == '/') ? 'index' : $slug }}/edit" class="btn btn-default pull-right">Edit Page</a>

{{ $menu }}

{{ $page }}

@stop
