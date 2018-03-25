<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', 'blog')</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
	@include('_header')
	<div class="container">
		@yield('content')
		@include('_footer')
	</div>

</body>
</html>