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

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Title</td>
			<td>Description</td>
			<td>Order</td>
		</tr>
	</thead>
	<tbody>
	@foreach($photos as $photo)
		<tr>
			<td>{{ $photo->id }}</td>
			<td>{{ $photo->title }}</td>
			<td>{{ $photo->description }}</td>
			<td>{{ $photo->order }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->

				<!-- show the nerd (uses the show method found at GET /nerds/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('photos/' . $value->id) }}">Show this Photo</a>

				<!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('photos/' . $value->id . '/edit') }}">Edit this Photo</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

</div>
</body>
</html>