<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', 'blog')</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
</head>
<body>
	@include('_header')
	<div class="container">
		<div class="col-md-offset-1 col-md-10">
			@include('shared._message')
			@yield('content')
			
		</div>
	</div>
	@include('_footer')
	<script src="/js/app.js"></script>
</body>
</html>