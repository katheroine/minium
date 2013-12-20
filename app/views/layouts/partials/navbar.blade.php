<nav class="navbar navbar-inverse">
	<div class="navbar-header">
		<a class="navbar-brand" href="{{ URL::to('/') }}">Minium</a>
	</div>
	<ul class="nav navbar-nav">
		<li><a href="{{ URL::to('photos') }}">View All Photos</a></li>
		<li><a href="{{ URL::to('photos/create') }}">Upload a Photo</a>
	</ul>
</nav>

