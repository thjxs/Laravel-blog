@extends('default')
@section('title', 'Sign in')

@section('content')
<div class="col-md-offset-2 col-md-8">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5>Please sign in</h5>
		</div>
		<div class="panel-body">
			@include('shared._errors')

			<form method="post" action="{{ route('signin') }}" class="form-signin">
				{{ csrf_field() }}


				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
				</div>

				<div class="form-group">
					<label for="password">Password &nbsp;&nbsp;<a href="{{ route('password.request') }}">Forgot password?</a></label>
					<input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password">
				</div>

				<div class="checkbox mb-3">
					<label><input type="checkbox" name="remember">Remember Me</label>
				</div>

				<button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
			</form>

			<hr>

			<p>New to blog? <a href="{{ route('signup') }}">Create an account</a></p>
		</div>
	</div>
</div>
@endsection