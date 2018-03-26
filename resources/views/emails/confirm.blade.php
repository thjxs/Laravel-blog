<!DOCTYPE html>
<html>
<head>
	<title>Email Confirm</title>
</head>
<body>
<h1>Before we get stared..</h1>

<p>
	Please take a second to make sure we've got your email right.
	<a href="{{ route('confirm_email', $user->activation_token) }}">
		{{ route('confirm_email', $user->activation_token) }}
	</a>
</p>

<p>
	Didn't sign up for blog? Let us know.
</p>
</body>
</html>