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

<h1>Showing photo #{{ $photo->id }}</h1>

	<div class="jumbotron text-center">
		<h2>{{ $photo->title }}</h2>
		<p>
			<strong>Description:</strong> {{ $photo->description }}<br>
			<strong>Is favourite:</strong> {{ $photo->is_favourite }}
		</p>
		<p>
			{{ HTML::image($photo->file_path) }}
		</p>
	</div>

</div>
</body>
</html>