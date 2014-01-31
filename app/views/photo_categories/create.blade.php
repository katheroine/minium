@extends('layouts.main')

@section('content')

<h1>Create a Photo category</h1>

<!-- if there are creation errors, they will show here -->
@if ($errors->has())
	<div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
@endif

{{ Form::open(array('url' => 'admin/photo_categories', 'method' => 'post')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', 'Description') }}
		{{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Create the Photo category!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop