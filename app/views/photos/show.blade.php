@extends('layouts.main')

@section('content')

<h1>Showing photo #{{ $photo->id }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $photo->title }}</h2>
		<p>
			<strong>Description:</strong><div style="white-space: pre-wrap">{{ $photo->description }}</div>
			{{ $photo->is_favourite ? '&#x2764; marked as <strong>favourite</strong>' : null }}
		</p>
		<p>
			{{ HTML::image($photo->file_path) }}
		</p>
	</div>

@stop