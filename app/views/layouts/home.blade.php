<!DOCTYPE html>
<html>
<head>
	<title>Minium</title>
	{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css') }}
	@yield('assets')
</head>
<body>
<div class="container">
	@include('layouts.partials.menubar')
	@include('layouts.partials.photo_categories_menu')
	@yield('content')
</div>
</body>
</html>