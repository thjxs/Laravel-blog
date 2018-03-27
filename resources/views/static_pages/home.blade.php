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
				<section class="stats">
					@include('shared._stats', ['user' => Auth::user()])
				</section>
			</aside>
		</div>
	@else
		<div class="jumbotron">
			
			<p class="lead">
				As every knows nowadays, the knowledge we possess of life before the beginnings of memory and tradition is derived from the markings and fossils of living things in the stratified rocks. We find ...
			</p>
			<p>A long trip begin with...</p>
			<p><a href="{{ route('signup') }}" class="btn btn-lg btn-success" role="button">Sign up</a></p>
		</div>
	@endif
@endsection