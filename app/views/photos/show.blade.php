@extends('layouts.main')

@section('content')

<h1>Showing photo #{{ $photo->id }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $photo->title }}</h2>
		<p><strong>Category:</strong> {{ $photo->category->name }}</p>
		<p>
			<strong>Description:</strong><div style="white-space: pre-wrap">{{ $photo->description }}</div>
			{{ $photo->is_favourite ? '&#x2764; marked as <strong>favourite</strong>' : null }}
		</p>
		<p>
			<strong>Creation date:</strong> {{ date("d F Y, H:i:s", strtotime($photo->created_at)) }}
		</p>
		@if ( $photo->modified_at )
		<p>
			<strong>Last modification date:</strong>  {{ date("d F Y, H:i:s", strtotime($photo->modified_at)) }}
		</p>
		@endif
		<p>
			{{ HTML::image($photo->file_path) }}
		</p>
	</div>

@stop