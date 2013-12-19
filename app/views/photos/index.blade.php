<!DOCTYPE html>
<html>
<head>
	<title>Photos</title>
	{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css') }}
	{{ HTML::script('//code.jquery.com/jquery-1.10.1.min.js') }}
	{{ HTML::script('//code.jquery.com/jquery-migrate-1.2.1.min.js') }}
	{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css') }}
	{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.js') }}
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
			<td>Data</td>
			<td style="width: 200px">Miniature</td>
			<td style="width: 404px">Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($photos as $photo)
		<tr>
			<td>
				<p><strong>Title </strong>{{ $photo->title }}</p>
				<p style="white-space: pre-wrap"><strong>Description </strong>{{ $photo->description }}</p>
				<p>{{ $photo->is_favourite ? '&#x2764; marked as <strong>favourite</strong>' : null }}</p>
			</td>
			<!--
			<td>{{ HTML::image($photo->file_path, $alt="image miniature", array('style' => "width: 200px")) }}</td>
			-->
			<td><a href="{{ $photo->file_path }}" class="fancybox" rel="group">{{ HTML::image($photo->file_path, '', array('style' => 'width: 200px')) }}</a></td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>
				<!-- show the photo (uses the show method found at GET /photos/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('photos/' . $photo->id) }}">Show this Photo</a>

				<!-- edit this photo (uses the edit method found at GET /photos/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('photos/' . $photo->id . '/edit') }}">Edit this Photo</a>

				<!-- delete the photo (uses the destroy method DESTROY /photos/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				{{ Form::open(array('url' => 'photos/' . $photo->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this Photo', array('class' => 'btn btn-small btn-warning')) }}
				{{ Form::close() }}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
</div>
<script>
$(document).ready(function() {
	$("a.fancybox").fancybox();
});
</script>
</body>
</html>