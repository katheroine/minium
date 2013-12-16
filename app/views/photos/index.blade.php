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

<h1>All the Photos</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@if (Session::has('error'))
	<div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Title</td>
			<td>Miniature</td>
			<td>Description</td>
			<td>Order</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($photos as $photo)
		<tr>
			<td>{{ $photo->id }}</td>
			<td>{{ $photo->title }}</td>
			<td>{{ HTML::image($photo->file_path, $alt="image miniature", $attributes = array('width' => '200px')) }}</td>
			<td>{{ $photo->description }}</td>
			<td>{{ $photo->order }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the nerd (uses the destroy method DESTROY /photos/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				{{ Form::open(array('url' => 'photos/' . $photo->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this Photo', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}

				<!-- show the nerd (uses the show method found at GET /photos/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('photos/' . $photo->id) }}">Show this Photo</a>

				<!-- edit this nerd (uses the edit method found at GET /photos/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('photos/' . $photo->id . '/edit') }}">Edit this Photo</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>