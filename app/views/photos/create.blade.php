@extends('layouts.main')

@section('content')

<h1>Upload a Photo</h1>

<!-- if there are creation errors, they will show here -->
@if ($errors->has())
	<div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
@endif

{{ Form::open(array('url' => 'photos', 'files' => true, 'method' => 'post')) }}

	<div class="form-group">
		{{ Form::label('title', 'Title') }}
		{{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', 'Description') }}
		{{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('file', 'File') }}
		{{ Form::file('file', Input::old('file'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('is_favourite', 'Is favourite') }}
		{{ Form::checkbox('is_favourite', Input::old('is_favourite'), null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Upload the Photo!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop