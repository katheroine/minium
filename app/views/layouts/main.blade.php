<!DOCTYPE html>
<html>
<head>
	<title>Minium</title>
	{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css') }}
	{{ HTML::script('//code.jquery.com/jquery-1.10.1.min.js') }}
	{{ HTML::script('//code.jquery.com/jquery-migrate-1.2.1.min.js') }}
	{{ HTML::style('//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.css') }}
	{{ HTML::script('//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.js') }}
</head>
<body>
<div class="container">
	@include('layouts.partials.navbar')
	@yield('content')
</div>
</body>
</html>