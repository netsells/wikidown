@extends('layout')

@section('body')

<a href="/{{ $slug }}/edit" class="btn btn-default pull-right">Edit Page</a>

{{ $page }}

@stop