@extends('layouts.main')

@section('content')

<h1>Edit photo #{{ $photo->id }}</h1>

<!-- if there are creation errors, they will show here -->
@if ($errors->has())
	<div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
@endif

{{ Form::model($photo, array('route' => array('photos.update', $photo->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('title', 'Title') }}
		{{ Form::text('title', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', 'Description') }}
		{{ Form::textarea('description', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('file_path', 'File path') }}
		{{ Form::text('file_path', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('is_favourite', 'Is favourite') }}
		{{ Form::checkbox('is_favourite', null, null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Edit the Photo!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop