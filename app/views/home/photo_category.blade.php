@extends('layouts.home')

@section('assets')

{{ HTML::script('//code.jquery.com/jquery-1.10.1.min.js') }}
{{ HTML::script('//code.jquery.com/jquery-migrate-1.2.1.min.js') }}
{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css') }}
{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.js') }}
{{ HTML::style('assets/css/home.photo_category.css') }}
{{ HTML::script('assets/js/home.photo_category.js') }}

@stop

@section('content')

<h1>{{ $photo_category->name }}</h1>

<div id="gallery">
@if ($categorised_photos->count())
	@foreach (TileGalleryViewHelper::replenishPhotosCollection($categorised_photos) as $photo)@if ($photo->id)<a href="{{ '/' . $photo->file_path }}"  class="fancybox" rel="group">{{ HTML::image($photo->file_path, '', array('class' => 'tile')) }}</a>@else{{ HTML::image($photo->file_path, '', array('class' => 'tile')) }}@endif@endforeach
@else
	<div class="alert alert-info">There's no pictures in the category.</div>
@endif
</div>

@stop