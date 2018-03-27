@extends('default')

@section('content')
	@if (Auth::check())
		<div class="row">
			<div class="col-md-8">
				<section class="status_form">
					@include('shared._status_form')
				</section>
				<h3>Blog List</h3>
				@include('shared._feed')
			</div>

			<aside class="col-md-4">
				<section class="user_info">
					@include('shared._user_info', ['user' => Auth::user()])
				</section>
			</aside>
		</div>
	@else
		<div class="jumbotron">
			<h1>hello</h1>
			<p class="lead">
				Your are looking for something
			</p>
			<p>begin with</p>
			<p><a href="{{ route('signup') }}" class="btn btn-lg btn-success" role="button">Register</a></p>
		</div>
	@endif
@endsection