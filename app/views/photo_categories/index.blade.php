@extends('layouts.main')

@section('content')

<h1>All the Photo categories</h1>

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
			<td>Name</td>
			<td>Description</td>
			<td style="width: 581px">Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($photo_categories as $photo_category)
		<tr>
			<td>{{ $photo_category->name }}</td>
			<td style="white-space: pre-wrap">{{ $photo_category->description }}</td>
			
			<!-- we will also add show, edit, and delete buttons -->
			<td>
				<!-- show the photo category (uses the show method found at GET /photo_categories/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('photo_categories/' . $photo_category->id) }}">Show this Photo category</a>

				<!-- edit this photo (uses the edit method found at GET /photos/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('photo_categories/' . $photo_category->id . '/edit') }}">Edit this Photo category</a>

				<!-- delete the photo (uses the destroy method DESTROY /photos/{id} -->
				<!-- we will add this later since its a little more complicated than the other two buttons -->
				{{ Form::open(array('url' => 'photo_categories/' . $photo_category->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this Photo category', array('class' => 'btn btn-small btn-warning')) }}
				{{ Form::close() }}
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<script>
$(document).ready(function() {
	$("a.fancybox").fancybox();
});
</script>

@stop