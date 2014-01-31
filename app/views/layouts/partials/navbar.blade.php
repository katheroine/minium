<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('/') }}">Minium</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('admin/photos') }}">View All Photos</a></li>
		<li><a href="{{ URL::to('admin/photos/create') }}">Upload a Photo</a>
		<li><a href="{{ URL::to('admin/photo_categories') }}">View All Photo categories</a></li>
		<li><a href="{{ URL::to('admin/photo_categories/create') }}">Add a Photo category</a>
	</ul>
</nav>

