@extends('layouts.main')

@section('content')

<h1>Edit photo category #{{ $photo_category->id }}</h1>

<!-- if there are creation errors, they will show here -->
@if ($errors->has())
	<div class="alert alert-danger">{{ HTML::ul($errors->all()) }}</div>
@endif

{{ Form::model($photo_category, array('route' => array('photo_categories.update', $photo_category->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('name', 'Name') }}
		{{ Form::text('name', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('description', 'Description') }}
		{{ Form::textarea('description', null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Edit the Photo category!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop