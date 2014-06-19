@extends('layout')

@section('body')
<div class="controls">
	<i class="fa fa-pencil"></i>
	<a href="/{{ ($slug == '/') ? 'index' : $slug }}/edit" class="btn btn-default">Edit Page</a>
</div>




{{ $page }}

@stop
