@extends('layouts.main')

@section('content')

<h1>Showing photo #{{ $photo_category->id }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $photo_category->name }}</h2>
		<p>
			<strong>Description:</strong><div style="white-space: pre-wrap">{{ $photo_category->description }}</div>
		</p>
		<p>
			<strong>Photos number: </strong>{{ $photo_category->photos->count() }}
		</p>
		<p>
			<strong>Creation date:</strong> {{ date("d F Y, H:i:s", strtotime($photo_category->created_at)) }}
		</p>
		@if ( $photo_category->updated_at != $photo_category->created_at )
		<p>
			<strong>Last modification date:</strong>  {{ date("d F Y, H:i:s", strtotime($photo_category->updated_at)) }}
		</p>
		@endif
	</div>

@stop