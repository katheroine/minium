@extends('layouts.main')

@section('content')

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('/') }}">Minium</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('photos') }}">View All Photos</a></li>
		<li><a href="{{ URL::to('photos/create') }}">Upload a Photo</a>
	</ul>
</nav>

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