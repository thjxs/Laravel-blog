<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', 'blog')</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
	@include('_header')
	<div class="container">
		<div class="col-md-offset-1 col-md-10">
			@include('shared._message')
			@yield('content')
			@include('_footer')
		</div>
	</div>

</body>
</html>