@extends('layouts.home')

@section('assets')

{{ HTML::script('//code.jquery.com/jquery-1.10.1.min.js') }}
{{ HTML::script('//code.jquery.com/jquery-migrate-1.2.1.min.js') }}
{{ HTML::style('assets/css/home.index.css') }}
{{ HTML::script('assets/js/home.index.js') }}

@stop

@section('content')

<div id="gallery">
	<div id="gallery_slider">
	@foreach($favourite_photos as $photo)
		{{ HTML::image($photo->file_path, '', array('id' => $photo->id, 'class' => 'slider')) }}
	@endforeach
	</div>
	<a id="prev"><</a><a id="next">></a>
</div>

@stop