<!DOCTYPE html>
<html>
<head>
	<title>Photos</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('/') }}">Minium</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('photos') }}">View All Photos</a></li>
		<li><a href="{{ URL::to('photos/create') }}">Upload a Photo</a>
	</ul>
</nav>

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
		{{ Form::text('is_favourite', Input::old('is_favourite'), array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Upload the Photo!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>