<div class="navbar">
@foreach($photo_categories as $photo_category)
	{{ HTML::link('/photo_category/' . $photo_category->id, $photo_category->name) }}
@endforeach
</div>